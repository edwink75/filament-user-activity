<?php

namespace Edwink\FilamentUserActivity\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id', 'url',
    ];

    public function getTable()
    {
        return config('filament-user-activity.table.name');
    }

    /**
     * Get the user that owns the UserActivity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}