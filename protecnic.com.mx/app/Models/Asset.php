<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    public const STATUS_AVAILABLE      = 'available';
    public const STATUS_ASSIGNED       = 'assigned';
    public const STATUS_MAINTENANCE    = 'maintenance';
    public const STATUS_DECOMMISSIONED = 'decommissioned';

    public const STATUSES = [
        self::STATUS_AVAILABLE      => 'Disponible',
        self::STATUS_ASSIGNED       => 'Asignado',
        self::STATUS_MAINTENANCE    => 'En mantenimiento',
        self::STATUS_DECOMMISSIONED => 'Dado de baja',
    ];

    protected $fillable = [
        'code', 'asset_type_id', 'brand', 'model', 'cost',
        'serial_number', 'service_tag',
        'processor', 'ram', 'disk', 'operating_system',
        'mac_ethernet', 'mac_wifi',
        'location', 'notes',
        'registered_at', 'last_maintenance_at',
        'status',
    ];

    protected $casts = [
        'registered_at'       => 'date',
        'last_maintenance_at' => 'date',
        'cost'                => 'decimal:2',
    ];

    public function type()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    public function assignments()
    {
        return $this->hasMany(AssetAssignment::class)->latest('assigned_at');
    }

    /** Asignación vigente (released_at = null) */
    public function currentAssignment()
    {
        return $this->hasOne(AssetAssignment::class)->whereNull('released_at');
    }

    /** Helper rápido para obtener al colaborador asignado */
    public function assignee(): ?User
    {
        return $this->currentAssignment?->user;
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isAssigned(): bool
    {
        return $this->status === self::STATUS_ASSIGNED;
    }

    // ---------------- Scopes ----------------
    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', self::STATUS_ASSIGNED);
    }

    public function scopeOfType($query, $typeId)
    {
        return $query->where('asset_type_id', $typeId);
    }
}
