<?php

use Aaran\Core\Models\DefaultCompany;
use Aaran\Core\Models\User;
use Aaran\Master\Livewire\Company\Index;
use Aaran\Master\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs, assertDatabaseHas};
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a new company', function () {
    // Mock the authenticated user
   $user = User::factory()->create(['company_id' => '1']);
    actingAs($user);

    // Mock the input data
    $data = [
        'common.vname' => 'Test Company',
        'gstin' => '1234567890',
        'address_1' => '123 Test St',
        'address_2' => 'Suite 100',
        'city_name' => 'Test City',
        'state_name' => 'Test State',
        'pincode_name' => '123456',
        'display_name' => 'Test Display Name',
        'mobile' => '1234567890',
        'landline' => '0987654321',
        'email' => 'test@example.com',
        'website' => 'https://example.com',
        'pan' => 'ABCDE1234F',
        'msme_no' => 'MSME123456',
        'msme_type_id' => 1,
        'city_id' => 1,
        'state_id' => 1,
        'pincode_id' => 1,
        'country_id' => 1,
        'bank' => 'Test Bank',
        'acc_no' => '1234567890',
        'ifsc_code' => 'IFSC0001234',
        'branch' => 'Test Branch',
        'inv_pfx' => 'INV',
        'iec_no' => 'IEC123456',
        'tenant_id' => 1,
        'logo' => null,
    ];

    // Call the getSave method
    Livewire::test(Index::class)
        ->set('common.vname', $data['common.vname'])
        ->set('gstin', $data['gstin'])
        ->set('address_1', $data['address_1'])
        ->set('address_2', $data['address_2'])
        ->set('city_name', $data['city_name'])
        ->set('state_name', $data['state_name'])
        ->set('pincode_name', $data['pincode_name'])
        ->set('display_name', $data['display_name'])
        ->set('mobile', $data['mobile'])
        ->set('landline', $data['landline'])
        ->set('email', $data['email'])
        ->set('website', $data['website'])
        ->set('pan', $data['pan'])
        ->set('msme_no', $data['msme_no'])
        ->set('msme_type_id', $data['msme_type_id'])
        ->set('city_id', $data['city_id'])
        ->set('state_id', $data['state_id'])
        ->set('pincode_id', $data['pincode_id'])
        ->set('country_id', $data['country_id'])
        ->set('bank', $data['bank'])
        ->set('acc_no', $data['acc_no'])
        ->set('ifsc_code', $data['ifsc_code'])
        ->set('branch', $data['branch'])
        ->set('inv_pfx', $data['inv_pfx'])
        ->set('iec_no', $data['iec_no'])
        ->set('tenant_id', $data['tenant_id'])
        ->call('save');

    // Assert the company was created
    assertDatabaseHas('companies', [
        'vname' => $data['common.vname'],
        'gstin' => $data['gstin'],
    ]);
});
