<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\Common;
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
        return $this->belongsTo(Common::class);
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

        public function accountBook(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'account_book_id','id');
    }

}
