<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'customer_id',
        'product_id',
        'points',
        'quantity',
        'total_price'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class,'customer_id','id');
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
}
