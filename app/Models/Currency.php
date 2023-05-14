<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Rate;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencys';

    protected $fillable = ['name', 'short_name'];

    public function rates(): HasMany {
        return $this->hasMany(Rate::class);
    }
}
