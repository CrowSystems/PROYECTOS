<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    protected $fillable = [
        'asset_id', 'user_id',
        'assigned_by_id', 'released_by_id',
        'assigned_at', 'released_at',
        'assignment_notes', 'release_notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function releasedBy()
    {
        return $this->belongsTo(User::class, 'released_by_id');
    }

    public function isActive(): bool
    {
        return is_null($this->released_at);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('released_at');
    }
}
