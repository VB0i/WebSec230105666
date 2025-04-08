<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoughtProduct extends Model
{
    protected $table = 'bought_products';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name', // Save the product name
        'product_price', // Save the product price
        'created_at'
    ];

    public $timestamps = false; // Because we’re only using created_at manually

    // Relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
