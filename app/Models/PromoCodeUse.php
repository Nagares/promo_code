<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodeUse extends Model
{
    protected $fillable = ['promo_code_id', 'user_id'];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
