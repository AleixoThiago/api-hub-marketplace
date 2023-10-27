<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'title',
        'status',
        'price',
        'promotional_price',
        'promotional_starts_on',
        'promotional_end_on',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'promotional_starts_on' => 'datetime',
        'promotional_end_on' => 'datetime',
    ];

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'product_offer');
    }
}
