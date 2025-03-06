<?php

namespace Aaran\Entries\Models;

use Aaran\Entries\Database\Factories\PackingListFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingList extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected static function newFactory(): PackingListFactory
    {
        return new packingListFactory();
    }
}
