<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\Common;
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

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

    public function transType(): BelongsTo
    {
        return $this->belongsTo(Common::class);

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
