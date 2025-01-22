<?php

namespace App\Models;

class TimeLimitedPromoCode extends PromoCode
{
    public function canBeUsedByUser($userId): bool
    {
        if (now()->greaterThan($this->end_date)) {
            return false;
        }
        return parent::canBeUsedByUser($userId);
    }
}
