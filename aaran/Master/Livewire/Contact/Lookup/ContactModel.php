<?php

namespace Aaran\Master\Livewire\Contact\Lookup;


use Aaran\Assets\Enums\MsmeType;
use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Common\Models\City;
use Aaran\Common\Models\ContactType;
use Aaran\Common\Models\Country;
use Aaran\Common\Models\Pincode;
use Aaran\Common\Models\State;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactModel extends Component
{

    use CommonTraitNew;

    #region[Contact properties]
    public bool $showModel = false;
    #[Validate]
    public $vname;
    public $active_id;
    public $vid;

    public string $mobile = '';
    public string $whatsapp = '';
    public string $contact_person = '';
    public mixed $contact_type = '';
    public string $msme_no = '';
    public mixed $opening_balance = 0;
    public mixed $outstanding = 0;
    public string $effective_from = '';
    public mixed $route;
    #endregion

    #region[Address Properties]
    #[validate]
    public $gstin = '';
    public $email = '';
    public $address_type;

    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'vname' => 'required|unique:contacts,vname',
            'gstin' => 'required|unique:contacts,gstin',
            'itemList.0.address_1' => 'required',
            'itemList.0.address_2' => 'required',
            'itemList.0.city_name' => 'required',
            'itemList.0.state_name' => 'required',
            'itemList.0.pincode_name' => 'required',
            'itemList.0.country_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vname.required' => ' :attribute is required.',
            'gstin.required' => ' :attribute is required.',
            'vname.unique' => ' :attribute is already taken.',
            'gstin.unique' => ' :attribute is already taken.',
            'itemList.0.address_1.required' => ' :attribute  is required.',
            'itemList.0.address_2.required' => ' :attribute  is required.',
            'itemList.0.city_name.required' => ' :attribute  is required.',
            'itemList.0.state_name.required' => ' :attribute  is required.',
            'itemList.0.pincode_name.required' => ' :attribute  is required.',
            'itemList.0.country_name' => ' :attribute  is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'vname' => 'contact name',
            'gstin' => 'GST No',
            'itemList.0.address_1' => 'Address',
            'itemList.0.address_2' => 'Area Road',
            'itemList.0.city_name' => 'City name',
            'itemList.0.state_name' => 'State name',
            'itemList.0.pincode_name' => 'Pincode name',
            'itemList.0.country_name' => 'Country name',
        ];
    }
    #endregion

    #region[array]
    #[validate]
    public $itemList = [];
    public mixed $itemIndex = '';
    public $secondaryAddress = [];
    public $addressIncrement = 0;
    public $openTab = 0;
    #endregion

    #region[addAddress]

    #region[addAddress]
    public function addAddress($id)
    {
        $this->addressIncrement = $id + 1;
        if (!in_array($this->addressIncrement, $this->secondaryAddress, true)) {
            $this->secondaryAddress[] = $this->addressIncrement;
        } elseif (!in_array(($this->addressIncrement + 1), $this->secondaryAddress, true)) {
            $this->secondaryAddress[] = $this->addressIncrement + 1;
        }


        $this->itemList[] = [
            'contact_detail_id' => 0,
            'address_type' => 'Secondary',
            "state_name" => "",
            "state_id" => "",
            "city_id" => "",
            "city_name" => "",
            "country_id" => "",
            "country_name" => "",
            "pincode_id" => "",
            "pincode_name" => "",
            "address_1" => "",
            "address_2" => "",
        ];
        $this->city_name = "";
        $this->state_name = "";
        $this->country_name = "";
        $this->pincode_name = "";
        $this->city_id = '';
        $this->state_id = '';
        $this->country_id = '';
        $this->pincode_id = '';
    }
    #endregion

    #region[removeAddress]
    public function removeAddress($id, $value): void
    {
        $this->openTab = 0;
        $this->addressIncrement = $value - 1;
        unset($this->secondaryAddress[$id]);
        $this->removeItems($value);
    }
    #endregion

    #region[sortSearch]
    public function sortSearch($id): void
    {
        $this->openTab = $id;
    }
    #endregion

    #region[City]
    #[validate]
    public $city_name = '';
    public $city_id = '';
    public Collection $cityCollection;
    public $highlightCity = 0;
    public $cityTyped = false;

    public function decrementCity(): void
    {
        if ($this->highlightCity === 0) {
            $this->highlightCity = count($this->cityCollection) - 1;
            return;
        }
        $this->highlightCity--;
    }

    public function incrementCity(): void
    {
        if ($this->highlightCity === count($this->cityCollection) - 1) {
            $this->highlightCity = 0;
            return;
        }
        $this->highlightCity++;
    }

    public function setCity($name, $id, $index = null): void
    {
        $this->city_name = $name;
        $this->city_id = $id;
        Arr::set($this->itemList[$index], 'city_name', $name);
        Arr::set($this->itemList[$index], 'city_id', $id);

        $this->getCityList();
    }

    public function enterCity($index): void
    {
        $obj = $this->cityCollection[$this->highlightCity] ?? null;

        $this->city_name = '';
        $this->cityCollection = Collection::empty();
        $this->highlightCity = 0;

        $this->city_name = $obj['vname'] ?? '';;
        $this->city_id = $obj['id'] ?? '';
        Arr::set($this->itemList[$index], 'city_name', $obj['vname']);
        Arr::set($this->itemList[$index], 'city_id', $obj['id']);

    }

    #[On('refresh-city')]
    public function refreshCity($v, $index): void
    {
        $this->city_id = $v['id'];
        $this->city_name = $v['name'];
        Arr::set($this->itemList[$index], 'city_name', $v['name']);
        Arr::set($this->itemList[$index], 'city_id', $v['id']);

        $this->cityTyped = false;

    }

    public function citySave($name, $index)
    {
        $obj = City::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshCity($v, $index);
    }

    public function getCityList(): void
    {
        $this->cityCollection = $this->itemList[$this->openTab]['city_name'] ?
            City::search(trim($this->city_name))->get() :
            City::all();
    }
    #endregion

    #region[State]
    #[validate]
    public $state_name = '';
    public $state_id = '';
    public Collection $stateCollection;
    public $highlightState = 0;
    public $stateTyped = false;

    public function decrementState(): void
    {
        if ($this->highlightState === 0) {
            $this->highlightState = count($this->stateCollection) - 1;
            return;
        }
        $this->highlightState--;
    }

    public function incrementState(): void
    {
        if ($this->highlightState === count($this->stateCollection) - 1) {
            $this->highlightState = 0;
            return;
        }
        $this->highlightState++;
    }

    public function setState($name, $id, $index): void
    {
        $this->state_name = $name;
        $this->state_id = $id;
        Arr::set($this->itemList[$index], 'state_name', $name);
        Arr::set($this->itemList[$index], 'state_id', $id);
        $this->getStateList();
    }

    public function enterState($index): void
    {
        $obj = $this->stateCollection[$this->highlightState] ?? null;

        $this->state_name = '';
        $this->stateCollection = Collection::empty();
        $this->highlightState = 0;

        $this->state_name = $obj['vname'] ?? '';;
        $this->state_id = $obj['id'] ?? '';;
        Arr::set($this->itemList[$index], 'state_name', $obj['vname']);
        Arr::set($this->itemList[$index], 'state_id', $obj['id']);
    }

    #[On('refresh-state')]
    public function refreshState($v): void
    {
        $this->state_id = $v['id'];
        $this->state_name = $v['name'];
        Arr::set($this->itemList[$v['index']], 'state_name', $v['name']);
        Arr::set($this->itemList[$v['index']], 'state_id', $v['id']);
        $this->stateTyped = false;
    }

    public function stateSave($name): void
    {
        $obj = State::create([
            'vname' => $name,
            'state_code' => '1',
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshState($v);
    }

    public function getStateList(): void
    {
        $this->stateCollection = $this->itemList[$this->openTab]['state_name'] ?
            State::search(trim($this->state_name))->get() :
            State::all();
    }
    #endregion

    #region[Pincode]
    #[validate]
    public $pincode_id = '';
    public $pincode_name = '';
    public Collection $pincodeCollection;
    public $highlightPincode = 0;
    public $pincodeTyped = false;

    public function decrementPincode(): void
    {
        if ($this->highlightPincode === 0) {
            $this->highlightPincode = count($this->pincodeCollection) - 1;
            return;
        }
        $this->highlightPincode--;
    }

    public function incrementPincode(): void
    {
        if ($this->highlightPincode === count($this->pincodeCollection) - 1) {
            $this->highlightPincode = 0;
            return;
        }
        $this->highlightPincode++;
    }

    public function enterPincode($index): void
    {
        $obj = $this->pincodeCollection[$this->highlightPincode] ?? null;

        $this->pincode_name = '';
        $this->pincodeCollection = Collection::empty();
        $this->highlightPincode = 0;

        $this->pincode_name = $obj['vname'] ?? '';;
        $this->pincode_id = $obj['id'] ?? '';;
        Arr::set($this->itemList[$index], 'pincode_name', $obj['vname']);
        Arr::set($this->itemList[$index], 'pincode_id', $obj['id']);
    }

    public function setPincode($name, $id, $index): void
    {
        $this->pincode_name = $name;
        $this->pincode_id = $id;
        Arr::set($this->itemList[$index], 'pincode_name', $name);
        Arr::set($this->itemList[$index], 'pincode_id', $id);
        $this->getPincodeList();
    }

    #[On('refresh-pincode')]
    public function refreshPincode($v): void
    {
        $this->pincode_id = $v['id'];
        $this->pincode_name = $v['name'];
        Arr::set($this->itemList[$v['index']], 'pincode_name', $v['name']);
        Arr::set($this->itemList[$v['index']], 'pincode_id', $v['id']);
        $this->pincodeTyped = false;
    }

    public function pincodeSave($name, $index)
    {
        $obj = Pincode::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id, 'index' => $index];
        $this->refreshPincode($v);
    }

    public function getPincodeList(): void
    {
        $this->pincodeCollection = $this->itemList[$this->openTab]['pincode_name'] ?
            Pincode::search(trim($this->pincode_name))->get():
            Pincode::all();
    }

    #endregion

    #region[Country]
    #[validate]
    public $country_name = '';
    public $country_id = '';
    public Collection $countryCollection;
    public $highlightCountry = 0;
    public $countryTyped = false;

    public function decrementCountry(): void
    {
        if ($this->highlightCountry === 0) {
            $this->highlightCountry = count($this->countryCollection) - 1;
            return;
        }
        $this->highlightCountry--;
    }

    public function incrementCountry(): void
    {
        if ($this->highlightCountry === count($this->countryCollection) - 1) {
            $this->highlightCountry = 0;
            return;
        }
        $this->highlightCountry++;
    }

    public function enterCountry($index): void
    {
        $obj = $this->countryCollection[$this->highlightCountry] ?? null;

        $this->country_name = '';
        $this->countryCollection = Collection::empty();
        $this->highlightCountry = 0;

        $this->country_name = $obj['vname'] ?? '';;
        $this->country_id = $obj['id'] ?? '';;
        Arr::set($this->itemList[$index], 'country_name', $obj['vname']);
        Arr::set($this->itemList[$index], 'country_id', $obj['id']);
    }

    public function setCountry($name, $id, $index): void
    {
        $this->country_name = $name;
        $this->country_id = $id;
        Arr::set($this->itemList[$index], 'country_name', $name);
        Arr::set($this->itemList[$index], 'country_id', $id);
        $this->getcountryList();
    }

    #[On('refresh-country')]
    public function refreshCountry($v, $index): void
    {
        $this->country_id = $v['id'];
        $this->country_name = $v['name'];
        Arr::set($this->itemList[$index], 'country_name', $v['name']);
        Arr::set($this->itemList[$index], 'country_id', $v['id']);
        $this->countryTyped = false;
    }

    public function countrySave($name, $index)
    {
        $obj = Country::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshCountry($v, $index);
    }

    public function getCountryList(): void
    {
        $this->countryCollection = $this->itemList[$this->openTab]['country_name'] ?
            Country::search(trim($this->country_name))->get() :
            Country::all();
    }

    #endregion

    #region[Contact Type]
    public $contact_type_id = '';
    public $contact_type_name = '';
    public Collection $contactTypeCollection;
    public $highlightContactType = 0;
    public $contactTypeTyped = false;

    public function decrementContactType(): void
    {
        if ($this->highlightContactType === 0) {
            $this->highlightContactType = count($this->contactTypeCollection) - 1;
            return;
        }
        $this->highlightContactType--;
    }

    public function incrementContactType(): void
    {
        if ($this->highlightContactType === count($this->contactTypeCollection) - 1) {
            $this->highlightContactType = 0;
            return;
        }
        $this->highlightContactType++;
    }

    public function setContactType($name, $id): void
    {
        $this->contact_type_name = $name;
        $this->contact_type_id = $id;
        $this->getContactTypeList();
    }

    public function enterContactType(): void
    {
        $obj = $this->contactTypeCollection[$this->highlightContactType] ?? null;

        $this->contact_type_name = '';
        $this->contactTypeCollection = Collection::empty();
        $this->highlightContactType = 0;

        $this->contact_type_name = $obj['vname'] ?? '';
        $this->contact_type_id = $obj['id'] ?? '';
    }

    #[On('refresh-contact-type')]
    public function refreshContactType($v): void
    {
        $this->contact_type_id = $v['id'];
        $this->contact_type_name = $v['name'];
        $this->contactTypeTyped = false;
    }

    public function contactTypeSave($name)
    {
        $obj = ContactType::create([
            'vname' => $name,
            'active_id' => '1'
        ]);

        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshContactType($v);
    }

    public function getContactTypeList(): void
    {
        $this->contactTypeCollection = !empty($this->contact_type_name) ?
            ContactType::search(trim($this->contact_type_name))->get() :
            ContactType::all();
    }
#endregion

    #region[MSME Type]
    public $msme_type_id = '';
    public $msme_type_name = '';
    public array $msmeTypeCollection = [];
    public $highlightMsmeType = 0;
    public $msmeTypeTyped = false;

    public function decrementMsmeType(): void
    {
        if ($this->highlightMsmeType === 0) {
            $this->highlightMsmeType = count($this->msmeTypeCollection) - 1;
            return;
        }
        $this->highlightMsmeType--;
    }

    public function incrementMsmeType(): void
    {
        if ($this->highlightMsmeType === count($this->msmeTypeCollection) - 1) {
            $this->highlightMsmeType = 0;
            return;
        }
        $this->highlightMsmeType++;
    }

    public function setMsmeType($id): void
    {
        $id = (int) $id; // Convert to integer before passing it
//        $msmeType = MsmeType::tryFrom((int) $id);
        $msmeType = MsmeType::tryFrom($id);


        if ($msmeType) {
            $this->msme_type_id = $msmeType->value;
            $this->msme_type_name = $msmeType->getName();
        }
    }


    public function enterMsmeType(): void
    {
        $obj = $this->msmeTypeCollection[$this->highlightMsmeType] ?? null;
        $this->msmeTypeCollection = [];
        $this->highlightMsmeType = 0;

        if ($obj) {
            $this->setMsmeType($obj['id']);
        }
    }

    #[On('refresh-msme-type')]
    public function refreshMsmeType($v): void
    {
        $this->setMsmeType($v['id']);
        $this->msmeTypeTyped = false;
    }

    public function getMsmeTypeList(): void
    {
        $this->msmeTypeCollection = collect(MsmeType::cases())->map(fn ($type) => [
            'id' => $type->value,
            'vname' => $type->getName(),
        ])->toArray();
    }
#endregion

    #region[Save]
    public function save(): void
    {
        if ($this->vname != '') {

            $this->validate($this->rules());

            $obj = Contact::create([
                'vname' => Str::upper($this->vname),
                'mobile' => $this->mobile,
                'whatsapp' => $this->whatsapp,
                'contact_person' => $this->contact_person,
                'contact_type_id' => $this->contact_type_id,
                'msme_no' => $this->msme_no ?: '-',
                'msme_type_id' => $this->msme_type_id ,
                'opening_balance' => $this->opening_balance ?: 0,
                'outstanding' => $this->outstanding ?: 0,
                'effective_from' => $this->effective_from,
                'active_id' => $this->active_id,
                'gstin' => Str::upper($this->gstin),
                'email' => $this->email,
                'user_id' => Auth::id(),
                'company_id' => session()->get('company_id'),
            ]);
            $this->saveItem($obj->id);

            $this->dispatch('refresh-contact', ['name' => $this->vname, 'id' => $obj->id]);


            $this->vname = '';
            $this->mobile = '';
            $this->whatsapp = '';
            $this->contact_person = '';
            $this->contact_type_id = '';
            $this->msme_no = '';
            $this->msme_type_id = '';
            $this->opening_balance = '';
            $this->effective_from = '';
            $this->gstin = '';
            $this->email = '';
        }
    }
    #endregion

    #region[Save Item]
    public function saveItem($id): void
    {
        if ($this->itemList != null) {
            foreach ($this->itemList as $sub) {
                if ($sub['contact_detail_id'] === 0 && $sub['address_1'] != "") {
                    ContactDetail::create([
                        'contact_id' => $id,
                        'address_type' => $sub['address_type'],
                        'address_1' => $sub['address_1'],
                        'address_2' => $sub['address_2'],
                        'city_id' => $sub['city_id'] ?: 1,
                        'state_id' => $sub['state_id'] ?: 1,
                        'pincode_id' => $sub['pincode_id'] ?: 1,
                        'country_id' => $sub['country_id'] ?: 1,
                    ]);
                } elseif ($sub['contact_detail_id'] != 0 && $sub['address_1'] != "") {
                    $detail = ContactDetail::find($sub['contact_detail_id']);
                    $detail->address_type = $sub['address_type'];
                    $detail->address_1 = $sub['address_1'];
                    $detail->address_2 = $sub['address_2'];
                    $detail->city_id = $sub['city_id'];
                    $detail->state_id = $sub['state_id'];
                    $detail->pincode_id = $sub['pincode_id'];
                    $detail->country_id = $sub['country_id'];
                    $detail->save();
                }
            }
        } else {
            ContactDetail::create([
                'contact_id' => $id,
                'address_type' => 'Primary',
                'address_1' => '-',
                'address_2' => '-',
                'city_id' => 1,
                'state_id' => 1,
                'pincode_id' => 1,
                'country_id' => 1,
            ]);
        }
    }

    #endregion

    #region[Mount]
    public function mount($id): void
    {
        $this->vname = $id;


//        $this->route = url()->previous();
//        if ($id != 0) {
//
//            $obj = Contact::find($id);
//            $this->vid = $obj->id;
//            $this->vname = $obj->vname;
//            $this->mobile = $obj->mobile;
//            $this->whatsapp = $obj->whatsapp;
//            $this->contact_person = $obj->contact_person;
//            $this->contact_type_id = $obj->contact_type_id;
//            $this->contact_type_name = Common::find($obj->contact_type_id)->vname;
//            $this->msme_no = $obj->msme_no;
//            $this->msme_type_id = $obj->msme_type_id;
//            $this->msme_type_name = Common::find($obj->msme_type_id)->vname;
//            $this->opening_balance = $obj->opening_balance;
//            $this->outstanding = $obj->outstanding;
//            $this->effective_from = $obj->effective_from;
//            $this->gstin = $obj->gstin;
//            $this->email = $obj->email;
//            $this->active_id = $obj->active_id;
//
//            $data = DB::table('contact_details')
//                ->select(
//                    'contact_details.*',
//                    'city.vname as city_name',
//                    'state.vname as state_name',
//                    'country.vname as country_name',
//                    'pincode.vname as pincode_name'
//                )
//                ->join('commons as city', 'city.id', '=', 'contact_details.city_id')
//                ->join('commons as state', 'state.id', '=', 'contact_details.state_id')
//                ->join('commons as country', 'country.id', '=', 'contact_details.country_id')
//                ->join('commons as pincode', 'pincode.id', '=', 'contact_details.pincode_id')
//                ->where('contact_id', '=', $id)
//                ->get()
//                ->transform(function ($data) {
//                    return [
//                        'contact_detail_id' => $data->id,
//                        'address_type' => $data->address_type,
//                        'city_name' => $data->city_name,
//                        'city_id' => $data->city_id,
//                        'state_name' => $data->state_name,
//                        'state_id' => $data->state_id,
//                        'pincode_name' => $data->pincode_name,
//                        'pincode_id' => $data->pincode_id,
//                        'country_name' => $data->country_name,
//                        'country_id' => $data->country_id,
//                        'address_1' => $data->address_1,
//                        'address_2' => $data->address_2,
//                    ];
//                });
//            $this->itemList = $data->toArray();
//            for ($j = 0; $j < $data->skip(1)->count(); $j++) {
//                $this->secondaryAddress[] = $j + 1;
//            }
//        } else {
        $this->effective_from = Carbon::now()->format('Y-m-d');
        $this->active_id = true;
        $this->itemList[0] = [
            "contact_detail_id" => 0,
            'address_type' => $this->address_type ?: "Primary",
            "state_name" => "-",
            "state_id" => "1",
            "city_id" => "1",
            "city_name" => "-",
            "country_id" => "1",
            "country_name" => "-",
            "pincode_id" => "1",
            "pincode_name" => "-",
            "address_1" => "-",
            "address_2" => "-",
        ];
        $this->address_type = "Primary";
//        }
    }
#endregion

    #region[removeItems]
    public function removeItems($index): void
    {
        $items = $this->itemList[$index];
        unset($this->itemList[$index]);
        if ($items['contact_detail_id'] != 0) {
            $obj = ContactDetail::find($items['contact_detail_id']);
            $obj->delete();
        }
    }

    #endregion

    public function clearAll(): void
    {
        $this->showModel = false;
    }

    #region[Route]
    public function getRoute(): void
    {
        $this->redirect(route('sales.upsert', ['0']));
    }

    public function render()
    {
        $this->getCityList();
        $this->getStateList();
        $this->getPincodeList();
        $this->getCountryList();
        $this->getMsmeTypeList();
        $this->getContactTypeList();
        return view('master::Contact.Lookup.contact-model');
    }
    #endregion

//    public function render()
//    {
//        return view('livewire.controls.model.contact-model');
//    }
}
