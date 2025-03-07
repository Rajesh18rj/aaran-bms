<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\AccountType;
use Aaran\Common\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankBook extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

        public function accountBook(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'account_book_id','id');
    }

}
