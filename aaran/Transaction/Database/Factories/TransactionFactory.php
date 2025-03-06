<?php

namespace Aaran\Transaction\Database\Factories;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Order;
use Aaran\Transaction\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{

    protected $model = Transaction::class;
    public function definition(): array
    {
        $users = User::pluck('id');
        $orders = Order::pluck('id');
        $trans = Common::where('label_id', '=', '19')->pluck('id');
        $receipttypes = Common::where('label_id', '=', '14')->pluck('id');
        $modes = Common::where('label_id', '=', '20')->pluck('id');
        $banks = Common::where('label_id', '=', '9')->pluck('id');
        $contacts = Contact::pluck('id')->random();

        return [
            'acyear' => '2024_25',
            'company_id' => 1,
            'contact_id' => $contacts,
            'order_id' => $orders->random(),
            'trans_type_id' => $trans->random(),
            'mode_id' => $modes->random(),
            'vdate' => $this->faker->date(),
            'vname' => $this->faker->randomNumber(),
            'receipttype_id' => $receipttypes->random(),
            'remarks' => $this->faker->realText(),
            'chq_no' => $this->faker->randomNumber(),
            'chq_date' => $this->faker->date(),
            'bank_id' => $banks->random(),
            'deposit_on' => $this->faker->date(),
            'realised_on' => $this->faker->date(),
            'against_id' => 1,
            'ref_no' => $this->faker->randomNumber(),
            'ref_amount' => $this->faker->randomNumber(),
            'user_id' => $users->random(),
            'active_id' => '1',

        ];
    }
}
