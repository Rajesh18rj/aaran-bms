<?php

namespace Aaran\Entries\Models;

use Aaran\Entries\Database\Factories\SaleFactory;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Style;
use Aaran\MasterGst\Models\MasterGstIrn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('invoice_no', 'like', '%' . $searches . '%');
    }

    public static function nextNo()
    {
        return
//            Customise::hasContinueSalesNo() ?
            static::where('company_id', '=', session()->get('company_id'))
                ->max('invoice_no') + 1
//            : static::where('company_id', '=', session()->get('company_id'))
//                ->where('acyear', '=', session()->get('acyear'))
//                ->max('invoice_no') + 1
    ;
    }


    public function saleItems():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function contactDetail(): BelongsTo
    {
        return $this->belongsTo(ContactDetail::class);
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


    public static function Irn($id)
    {
        return MasterGstIrn::where('sales_id',$id)->first();
    }

    protected static function newFactory(): SaleFactory
    {
        return new SaleFactory();
    }
}
