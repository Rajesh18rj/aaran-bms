<?php

namespace Aaran\Entries\Models;

use Aaran\Entries\Database\Factories\ExportSaleItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportSaleItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected static function newFactory(): ExportSaleItemFactory
    {
        return new ExportSaleItemFactory();
    }
}
