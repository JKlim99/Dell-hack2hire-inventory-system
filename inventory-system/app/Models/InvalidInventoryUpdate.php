<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvalidInventoryUpdate extends Model
{
    use HasFactory;
    protected $table = 'invalid_inventory_update';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'product_name',
        'unit_price',
        'total_price',
        'quantity',
        'type',
        'reason',
        'file_id'
    ];
}
