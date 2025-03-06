<?php

namespace Aaran\Assets\LivewireForms;

use Aaran\MasterGst\Models\EwayBill;
use Aaran\MasterGst\Models\MasterGstEway;
use Aaran\MasterGst\Models\MasterGstIrn;
use Aaran\MasterGst\Models\MasterGstToken;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Form;

class MasterGstApi extends Form
{
    public $auth_token;

    #region[authenticate]
    public function authenticate()
    {
        try {
            $response = Http::withHeaders([
                'username' => 'mastergst',
                'password' => 'Malli#123',
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'gstin' => '29AABCT1332L000',
            ])->get('https://api.mastergst.com/einvoice/authenticate', [
                'email' => 'aaranoffice@gmail.com',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->updateOrCreateToken($data['data']);

                return $data;
            } else {
                return response()->json(['error' => 'Request failed with status code: '.$response->status()],
                    $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }
    }
    #endregion

    #region[updateOrCreateToken]
    public function updateOrCreateToken($data)
    {
        $this->auth_token = MasterGstToken::orderByDesc('id')->first();

        if ($this->auth_token) {
            $this->auth_token->token = $data['AuthToken'];
            $this->auth_token->expires_at = $data['TokenExpiry'];
            $this->auth_token->save();
        } else {
            MasterGstToken::create([
                'token' => $data['AuthToken'],
                'expires_at' => $data['TokenExpiry'],
                'user_id' => 1,
            ]);
        }
    }
    #endregion

    #region[getIrn]
    public function getIrn(Request $request, $token = null, $jsonData = null, $sales_id = null)
    {

        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'username' => 'mastergst',
                'auth-token' => $token,
                'gstin' => '29AABCT1332L000',
                'Content-Type' => 'application/json',
            ])->post('https://api.mastergst.com/einvoice/type/GENERATE/version/V1_03?email=aaranoffice%40gmail.com',
                $jsonData);
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['data'])) {
                    $obj = MasterGstIrn::create([
                        'sales_id' => $sales_id,
                        'ackno' => $data['data']['AckNo'],
                        'ackdt' => $data['data']['AckDt'],
                        'irn' => $data['data']['Irn'],
                        'signed_invoice' => $data['data']['SignedInvoice'],
                        'signed_qrcode' => $data['data']['SignedQRCode'],
                        'status' => 'Generated',
                    ]);
                }
                if (isset($data['data'])) {
                    if ($data['data']['EwbNo'] != '') {
                        MasterGstEway::create([
                            'irn_id' => $obj->id,
                            'sales_id' => $sales_id,
                            'ewbno' => $data['data']['EwbNo'],
                            'ewbdt' => $data['data']['EwbDt'],
                            'ewbvalidtill' => $data['data']['EwbValidTill'],
                        ]);
                    }
                }

                return $data;
            } else {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return response()->json([
                    'error' => 'Request failed with status code: '.$response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching IRN', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }
    }
    #endregion

    #region[getIrnCancel]
    public function getIrnCancel(Request $request, $jsonData = null, $token = null, $sales_id = null)
    {

        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'username' => 'mastergst',
                'auth-token' => $token,
                'gstin' => '29AABCT1332L000',
                'Content-Type' => 'application/json',
            ])->post('https://api.mastergst.com/einvoice/type/CANCEL/version/V1_03?email=aaranoffice%40gmail.com',
                $jsonData);

            if ($response->successful()) {
                $obj = MasterGstIrn::where('sales_id', $sales_id)->first();
                $obj->status = "Canceled";
                $obj->save();
                return $response->json();
            } else {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return response()->json([
                    'error' => 'Request failed with status code: '.$response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching IRN', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }

    }
    #endregion

    #region[getEwayBill]
    public function getEwayBill(Request $request, $jsonData = null, $token = null, $sales_id = null)
    {

        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'username' => 'mastergst',
                'auth-token' => $token,
                'gstin' => '29AABCT1332L000',
                'Content-Type' => 'application/json',
            ])->post('https://api.mastergst.com/einvoice/type/GENERATE_EWAYBILL/version/V1_03?email=aaranoffice%40gmail.com',
                $jsonData);

            if ($response->successful()) {
                $data = $response->json();
                $obj = MasterGstIrn::where('sales_id', $sales_id)->first();
                MasterGstEway::create([
                    'irn_id' => $obj->id,
                    'sales_id' => $sales_id,
                    'ewbno' => $data['data']['EwbNo'],
                    'ewbdt' => $data['data']['EwbDt'],
                    'ewbvalidtill' => $data['data']['EwbValidTill'],
                ]);
                return $data;
            } else {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return response()->json([
                    'error' => 'Request failed with status code: '.$response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching IRN', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }

    }
    #endregion

    #region[getEwayDetails]
    public function getEwayDetails($token = null, $irn = null, $supplier_gstn = null)
    {

        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'username' => 'mastergst',
                'auth-token' => $token,
                'gstin' => '29AABCT1332L000',
            ])->get('https://api.mastergst.com/einvoice/type/GETEWAYBILLIRN/version/V1_03', [
                'param1' => $irn,
                'supplier_gstn' => $supplier_gstn,
                'email' => 'aaranoffice@gmail.com',
            ]);
            if ($response->successful()) {
                $data = $response->json();
                if ($data !== null) {
                    return $data;
                } else {
                    return response()->json(['error' => 'Failed to decode JSON data.'], 500);
                }

            } else {
                echo "Request failed with status code: ".$response->status();
            }
        } catch (\Exception $e) {
            echo "An error occurred: ".$e->getMessage();
        }
    }
    #endregion

    #region[EwayBillGenerate]
    public function EwayBillGenerate(Request $request, $jsonData = null, $salesID = null)
    {
        $auth = Http::withHeaders([
            'ip_address' => '103.231.117.198',
            'client_id' => 'b569cf9a-72ba-4bc2-9558-3a94821c1ea4',
            'client_secret' => 'ee72ff2e-c441-4d77-be67-ebb960001a8b',
            'gstin' => '05AAACH6188F1ZM',
        ])->get('https://api.mastergst.com/ewaybillapi/v1.03/authenticate', [
            'email' => 'aaranoffice@gmail.com', 'username' => '05AAACH6188F1ZM', 'password' => 'abc123@@'
        ]);
        $auth->json();
        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.201',
                'client_id' => 'b569cf9a-72ba-4bc2-9558-3a94821c1ea4',
                'client_secret' => 'ee72ff2e-c441-4d77-be67-ebb960001a8b',
                'gstin' => '05AAACH6188F1ZM',
            ])->post('https://api.mastergst.com/ewaybillapi/v1.03/ewayapi/genewaybill?email=aaranoffice@gmail.com',
                $jsonData);
            if ($response->successful()) {
                $data = $response->json();
                EwayBill::create([
                    'sales_id' => $salesID,
                    'ewayBillNo' => $data['data']['ewayBillNo'],
                    'ewayBillDate' => $data['data']['ewayBillDate'],
                    'validUpto' => $data['data']['validUpto'],
                    'status' => 'Generated',
                ]);
                return $data;
            } else {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return response()->json([
                    'error' => 'Request failed with status code: '.$response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching IRN', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }

    }
    #endregion

    #region[EwayBillCancel]
    public function EwayBillCancel(Request $request, $jsonData = null, $salesID = null)
    {
        $auth = Http::withHeaders([
            'ip_address' => '103.231.117.198',
            'client_id' => 'b569cf9a-72ba-4bc2-9558-3a94821c1ea4',
            'client_secret' => 'ee72ff2e-c441-4d77-be67-ebb960001a8b',
            'gstin' => '05AAACH6188F1ZM',
        ])->get('https://api.mastergst.com/ewaybillapi/v1.03/authenticate', [
            'email' => 'aaranoffice@gmail.com', 'username' => '05AAACH6188F1ZM', 'password' => 'abc123@@'
        ]);
        $auth->json();
        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.201',
                'client_id' => 'b569cf9a-72ba-4bc2-9558-3a94821c1ea4',
                'client_secret' => 'ee72ff2e-c441-4d77-be67-ebb960001a8b',
                'gstin' => '05AAACH6188F1ZM',
            ])->post('https://api.mastergst.com/ewaybillapi/v1.03/ewayapi/canewb?email=aaranoffice@gmail.com',
                $jsonData);
            if ($response->successful()) {
                $data = $response->json();
                $obj = EwayBill::where('sales_id', $salesID)->first();
                $obj->status = 'Cancelled';
                $obj->cancelDate = $data['data']['cancelDate'];
                $obj->save();
                return $data;
            } else {
                Log::error('API Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return response()->json([
                    'error' => 'Request failed with status code: '.$response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching IRN', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: '.$e->getMessage()], 500);
        }
    }
    #endregion

    #region[getEwayDetails]
    public function getIrnDetail(Request $request,$token = null, $docDetail = null)
    {
        try {
            $response = Http::withHeaders([
                'ip_address' => '103.231.117.198',
                'client_id' => '7428e4e3-3dc4-45dd-a09d-78e70267dc7b',
                'client_secret' => '79a7b613-cf8f-466f-944f-28b9c429544d',
                'username' => 'mastergst',
                'auth-token' => $token,
                'gstin' => '29AABCT1332L000',
                'docnum' =>(string)($docDetail['No']),
                'docdate' => (string)($docDetail['Dt']),
            ])->get('https://api.mastergst.com/einvoice/type/GETIRNBYDOCDETAILS/version/V1_03', [
                'email' => 'aaranoffice@gmail.com',
                'param1' => $docDetail['Typ'],
            ]);
            if ($response->successful()) {
                $data = $response->json();
                if ($data !== null) {
                    return $data;
                } else {
                    return response()->json(['error' => 'Failed to decode JSON data.'], 500);
                }

            } else {
                echo "Request failed with status code: ".$response->status();
            }
        } catch (\Exception $e) {
            echo "An error occurred: ".$e->getMessage();
        }
    }
    #endregion
}
