<?php

namespace Aaran\Entries\Models;

use Aaran\Entries\Database\Factories\ExportSaleFactory;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Style;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExportSale extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected static function newFactory(): ExportSaleFactory
    {
        return new ExportSaleFactory();
    }

    public static function nextNo()
    {
        return
            static::where('company_id', '=', session()->get('company_id'))
                ->max('invoice_no') + 1;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }


}
