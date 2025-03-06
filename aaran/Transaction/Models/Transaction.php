<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use Aaran\Transaction\Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo( AccountBook::class);
    }

    public function accountBook()
    {
        return $this->belongsTo(AccountBook::class, 'account_book_id');
    }

    public function openingBal()
    {
        return $this->belongsTo(AccountBook::class, 'opening_bal_id');
    }

    public function transType()
    {
        return $this->belongsTo(Common::class, 'trans_type_id');
    }

    public function receiptType()
    {
        return $this->belongsTo(Common::class, 'receipttype_id');
    }

    public function mode(): BelongsTo
    {
        return $this->belongsTo(Common::class);

    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Common::class);

    }

    protected static function newFactory():TransactionFactory
    {
        return new TransactionFactory();
    }

    public static function nextNo($value)
    {
        return
            static::where('mode_id', '=', $value)
                ->max('vch_no') + 1;
    }
}
