<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rewards extends Model
{
    protected $table = 'rewards';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemptions::class,'reward_id','id');
    }
}
