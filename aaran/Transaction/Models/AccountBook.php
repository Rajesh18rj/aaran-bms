<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\AccountType;
use Aaran\Common\Models\Bank;
use Aaran\Common\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountBook extends Model
{
    use HasFactory;

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

    public function transType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);

    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'account_book_id','id');

    }

    public function accountBook(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'account_book_id','id');
    }

}
