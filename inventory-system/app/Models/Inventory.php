<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';
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
        'file_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
