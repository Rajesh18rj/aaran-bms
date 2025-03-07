<?php

namespace Aaran\Transaction\Livewire\AccountBook;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Common\Models\AccountType;
use Aaran\Common\Models\Bank;
use Aaran\Transaction\Models\AccountBook;
use Aaran\Transaction\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    public $opening_balance;
    public $opening_balance_date;
    public $notes;
    public $account_no;
    public $ifsc_code;
    public $branch;
    public $trans_type_id = '';
    public $trans_type_name = '';

    public $filter;

    public function mount($id = null): void
    {
        if ($id != null) {
            $this->filter = $id;
        }
    }

    #region[Validation]
    public function rules(): array
    {
//        if ($this->trans_type_id == 108) {
//            return [
//                'common.vname' => 'required',
//            ];
//        } elseif ($this->trans_type_id == 136) {
//            return [
//                'common.vname' => 'required',
//                'bank_id' => 'required',
//            ];
//        } else
            return [
//                'common.vname' => 'required',
//                'account_no' => 'required',
//                'ifsc_code' => 'required',
//                'bank_id' => 'required',
//                'account_type_id' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' Enter your :attribute',
            'account_no.required' => ' Enter valid :attribute',
            'ifsc_code.required' => ' Required :attribute',
            'bank_id.required' => ' Mention the :attribute',
            'account_type_id.required' => ' Mention your :attribute',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Account Name',
            'account_no' => 'Account No',
            'ifsc_code' => 'IFSC code',
            'bank_id' => 'Bank name',
            'account_type_id' => 'A/C Type',
        ];
    }
    #endregion

    #region[Get-Save]
    public function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $AccountBook = new AccountBook();
                $extraFields = [
                    'trans_type_id' => $this->trans_type_id ?: 109,
                    'opening_balance' => $this->opening_balance ?: 0,
                    'opening_balance_date' => $this->opening_balance_date,
                    'notes' => $this->notes,
                    'account_no' => $this->account_no ?: '0',
                    'ifsc_code' => $this->ifsc_code ?: '0',
                    'bank_id' => $this->bank_id ?: '1',
                    'account_type_id' => $this->account_type_id ?: '1',
                    'branch' => $this->branch ?: '-',
                    'user_id' => auth()->id(),
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->save($AccountBook, $extraFields);
                $message = "Saved";
            } else {
                $AccountBook = AccountBook::find($this->common->vid);
                $extraFields = [
                    'trans_type_id' => $this->trans_type_id ?: 109,
                    'opening_balance' => $this->opening_balance,
                    'opening_balance_date' => $this->opening_balance_date,
                    'notes' => $this->notes,
                    'account_no' => $this->account_no,
                    'ifsc_code' => $this->ifsc_code,
                    'bank_id' => $this->bank_id,
                    'account_type_id' => $this->account_type_id,
                    'branch' => $this->branch,
                    'user_id' => auth()->id(),
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->edit($AccountBook, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[bank]
    public $bank_name = '';
    public $bank_id = '';
    public \Illuminate\Support\Collection $bankCollection;
    public $highlightBank = 0;
    public $bankTyped = false;

    public function decrementBank(): void
    {
        if ($this->highlightBank === 0) {
            $this->highlightBank = count($this->bankCollection) - 1;
            return;
        }
        $this->highlightBank--;
    }

    public function incrementBank(): void
    {
        if ($this->highlightBank === count($this->bankCollection) - 1) {
            $this->highlightBank = 0;
            return;
        }
        $this->highlightBank++;
    }

    public function setBank($name, $id): void
    {
        $this->bank_name = $name;
        $this->bank_id = $id;
        $this->getBankList();
    }

    public function enterBank(): void
    {
        $obj = $this->bankCollection[$this->highlightBank] ?? null;

        $this->bank_name = '';
        $this->bankCollection = Collection::empty();
        $this->highlightBank = 0;

        $this->bank_name = $obj['vname'] ?? '';
        $this->bank_id = $obj['id'] ?? '';
    }

    public function refreshBank($v): void
    {
        $this->bank_id = $v['id'];
        $this->bank_name = $v['name'];
        $this->bankTyped = false;
    }

    public function bankSave($name)
    {
        $obj = Bank::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshBank($v);
    }

    public function getBankList(): void
    {
        $this->bankCollection = $this->bank_name ?
            Bank::search(trim($this->bank_name))->get() :
            Bank::all();
    }
#endregion

    #region[account_type]
    public $account_type_name = '';
    public $account_type_id = '';
    public Collection $account_typeCollection;
    public $highlightAccountType = 0;
    public $account_typeTyped = false;

    public function decrementAccountType(): void
    {
        if ($this->highlightAccountType === 0) {
            $this->highlightAccountType = count($this->account_typeCollection) - 1;
            return;
        }
        $this->highlightAccountType--;
    }

    public function incrementAccountType(): void
    {
        if ($this->highlightAccountType === count($this->account_typeCollection) - 1) {
            $this->highlightAccountType = 0;
            return;
        }
        $this->highlightAccountType++;
    }

    public function setAccountType($name, $id): void
    {
        $this->account_type_name = $name;
        $this->account_type_id = $id;
        $this->getAccountTypeList();
    }

    public function enterAccountType(): void
    {
        $obj = $this->account_typeCollection[$this->highlightAccountType] ?? null;

        $this->account_type_name = '';
        $this->account_typeCollection = Collection::empty();
        $this->highlightAccountType = 0;

        $this->account_type_name = $obj['vname'] ?? '';
        $this->account_type_id = $obj['id'] ?? '';
    }

    public function refreshAccountType($v): void
    {
        $this->account_type_id = $v['id'];
        $this->account_type_name = $v['name'];
        $this->account_typeTyped = false;
    }

    public function accountTypeSave($name)
    {
        $obj = AccountType::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshAccountType($v);
    }

    public function getAccountTypeList(): void
    {
        $this->account_typeCollection = $this->account_type_name ?
            AccountType::search(trim($this->account_type_name))->get() :
            AccountType::all();
    }
#endregion

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $AccountBook = AccountBook::find($id);
//            dd($AccountBook);
            $this->common->vid = $AccountBook->id;
            $this->common->vname = $AccountBook->vname;
            $this->trans_type_id = $AccountBook->trans_type_id;
            $this->trans_type_name = $AccountBook->transType->vname;
            $this->opening_balance = $AccountBook->opening_balance;
            $this->opening_balance_date = $AccountBook->opening_balance_date;
            $this->notes = $AccountBook->notes;
            $this->account_no = $AccountBook->account_no;
            $this->ifsc_code = $AccountBook->ifsc_code;
            $this->bank_id = $AccountBook->bank_id;
            $this->bank_name = $AccountBook->bank->vname;
            $this->account_type_id = $AccountBook->account_type_id;
//            $this->account_type_name = $AccountBook->accountType->vname;
            $this->account_type_name = $AccountBook->account_type_id ? AccountType::find($AccountBook->account_type_id)->vname : '';
            $this->branch = $AccountBook->branch;
            $this->common->active_id = $AccountBook->active_id;
            return $AccountBook;
        }
        return null;
    }

    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->trans_type_id = '';
        $this->trans_type_name = '';
        $this->common->vname = '';
        $this->opening_balance = '';
        $this->opening_balance_date = Carbon::now()->format('Y-m-d');
        $this->notes = '';
        $this->account_no = '';
        $this->ifsc_code = '';
        $this->bank_id = '';
        $this->bank_name = '';
        $this->account_type_id = '';
        $this->account_type_name = '';
        $this->branch = '';
        $this->common->active_id = '1';
    }
    #endregion

    #region[Transactions]

    public function getTransactions()
    {
        return Transaction::select(
            'transactions.id',
            'transactions.vname',
            'transactions.vdate',
            'transactions.account_book_id',
            'transactions.mode_id',
            'transactions.trans_type_id'
        )
            ->join('account_books', 'transactions.account_book_id', '=', 'account_books.id')
            ->where('account_books.active_id', '=', 1)
            ->get();
    }

    #region[render]
    public function render()
    {
        $this->getBankList();
        $this->getAccountTypeList();

        return view('transaction::AccountBook.index')->with([
            'list' => $this->getListForm->getList(AccountBook::class, function ($query)
            {
                if ($this->filter == 2) {
                    $query->where('trans_type_id', 109);
                } elseif ($this->filter == 3) {
                    $query->where('trans_type_id', 108);
                } elseif($this->filter == 4){
                    $query->where('trans_type_id', 136);
                }
                return $query->orderBy('id', 'desc');
            }),

            'transaction' => $this->getTransactions(),
        ]);
    }
    #endregion


}
