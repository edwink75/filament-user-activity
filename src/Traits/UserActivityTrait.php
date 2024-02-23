<?php

namespace Edwink\FilamentUserActivity\Traits;

use Edwink\FilamentUserActivity\Models\UserActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserActivityTrait
{
    /**
     * Get all of the comments for the UserActivityTrait
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }
}
