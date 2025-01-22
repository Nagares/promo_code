<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'start_date',
        'end_date',
        'is_active',
        'max_uses',
        'private_users',
        'frequency',
    ];
    protected $table = 'promo_codes';

    protected $casts = [
        'private_users' => 'array',
    ];

    // Проверка срока действия
    public function isExpired(): bool
    {
        return $this->end_date && now()->greaterThan($this->end_date);
    }


    public function isOverused(): bool
    {
        return $this->max_uses && $this->uses()->count() >= $this->max_uses;
    }


    public function uses()
    {
        return $this->hasMany(PromoCodeUse::class);
    }


    public function canBeUsedByUser($userId): bool
    {
        if ($this->isExpired() || $this->isOverused()) {
            return false;
        }

        if ($this->private_users && !in_array($userId, $this->private_users)) {
            return false;
        }

        if ($this->frequency === 'daily') {
            return !$this->uses()
                ->where('user_id', $userId)
                ->whereDate('created_at', now()->toDateString())
                ->exists();
        }

        if ($this->frequency === 'weekly') {
            return !$this->uses()
                ->where('user_id', $userId)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->exists();
        }

        return true;
    }
}
