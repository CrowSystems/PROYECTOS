<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_CONTENT_EDITOR = 'content_editor';
    public const ROLE_SUPERVISOR = 'report_supervisor';
    public const ROLE_TECHNICIAN = 'technician';

    public const ROLES = [
        self::ROLE_ADMIN => 'Administrador',
        self::ROLE_CONTENT_EDITOR => 'Editor de contenido',
        self::ROLE_SUPERVISOR => 'Supervisor de reportes',
        self::ROLE_TECHNICIAN => 'Técnico (generador de reportes)',
    ];

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    public function hasRole(string|array $role): bool
    {
        return is_array($role)
            ? in_array($this->role, $role, true)
            : $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function roleLabel(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'technician_id');
    }
}
