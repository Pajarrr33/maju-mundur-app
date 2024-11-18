<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class,'merchant_id','id');
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transactions::class,'product_id','id');
    }
}
