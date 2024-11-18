<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Redemptions extends Model
{
    protected $table = 'redemptions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'customer_id',
        'reward_id',
        'reedeemed_at',
        'points',
    ];

    public function rewards(): BelongsTo
    {
        return $this->belongsTo(Rewards::class,'reward_id','id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class,'customer_id','id');
    }
}
