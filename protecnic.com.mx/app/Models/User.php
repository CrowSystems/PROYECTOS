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
    public const ROLE_IT_MANAGER = 'it_manager';

    public const ROLES = [
        self::ROLE_ADMIN => 'Administrador',
        self::ROLE_CONTENT_EDITOR => 'Editor de contenido',
        self::ROLE_SUPERVISOR => 'Supervisor de reportes',
        self::ROLE_TECHNICIAN => 'Técnico (generador de reportes)',
        self::ROLE_IT_MANAGER => 'Administrador de activos (IT)',
    ];

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'active',
        'microsoft_id', 'microsoft_data', 'created_via_sso', 'last_microsoft_login_at',
    ];

    protected $hidden = ['password', 'remember_token', 'microsoft_data'];

    protected function casts(): array
    {
        return [
            'email_verified_at'        => 'datetime',
            'password'                 => 'hashed',
            'active'                   => 'boolean',
            'created_via_sso'          => 'boolean',
            'microsoft_data'           => 'array',
            'last_microsoft_login_at'  => 'datetime',
        ];
    }

    /** Atajo para saber si la cuenta se autentica con Microsoft */
    public function isMicrosoftAccount(): bool
    {
        return ! empty($this->microsoft_id);
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

    // ---------- Relaciones de Activos / Inventario ----------

    /** Asignaciones históricas de equipo recibidas por este usuario */
    public function assetAssignments()
    {
        return $this->hasMany(AssetAssignment::class, 'user_id')->latest('assigned_at');
    }

    /** Asignaciones vigentes (equipos que tiene actualmente) */
    public function currentAssetAssignments()
    {
        return $this->hasMany(AssetAssignment::class, 'user_id')->whereNull('released_at');
    }

    public function hasAnyAsset(): bool
    {
        return $this->currentAssetAssignments()->exists();
    }
}
