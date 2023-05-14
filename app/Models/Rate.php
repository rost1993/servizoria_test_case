<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Currency;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';
    protected $fillable = ['currency_id', 'date', 'rate'];

    public function currency(): BelongsTo {
        return $this->belongsTo(Currency::class);
    }
}
