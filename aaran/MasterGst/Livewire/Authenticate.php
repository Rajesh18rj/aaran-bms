<?php

namespace Aaran\MasterGst\Livewire;

use Aaran\MasterGst\Models\MasterGstToken;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Authenticate extends Component
{
    public $email;
    public $auth_token;

    public function mount()
    {
        $this->email='aaranoffice@gmail.com';
    }

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
                session()->put('gst_auth_token', $data['data']['AuthToken']);
                $this->updateOrCreateToken($data['data']);

                return $data;
            } else {
                return response()->json(['error' => 'Request failed with status code: ' . $response->status()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    protected function updateOrCreateToken($data)
    {
        $this->auth_token = MasterGstToken::where('token', session()->get('gst_auth_token'))->first();

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
    public function render()
    {
        return view('master-gst::authenticate');
    }
}
