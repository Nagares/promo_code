<?php

namespace App\Models;

class PrivatePromoCode extends PromoCode
{
    public function canBeUsedByUser($userId): bool
    {
        if (!in_array($userId, $this->private_users)) {
            return false;
        }
        return parent::canBeUsedByUser($userId);
    }
}
