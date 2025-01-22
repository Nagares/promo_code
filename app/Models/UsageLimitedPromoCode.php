<?php

namespace App\Models;

class UsageLimitedPromoCode extends PromoCode
{
    public function canBeUsedByUser($userId): bool
    {
        if ($this->uses()->count() >= $this->max_uses) {
            return false;
        }
        return parent::canBeUsedByUser($userId);
    }
}
