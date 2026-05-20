<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company', 'email',
        'country_code', 'phone', 'country', 'state', 'message',
        'ip_address', 'user_agent', 'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }
}
