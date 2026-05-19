<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SIGNED_IN_SITE = 'signed_in_site';
    public const STATUS_PENDING_CLIENT_APPROVAL = 'pending_client_approval';
    public const STATUS_CLIENT_APPROVED = 'client_approved';
    public const STATUS_SUPERVISOR_APPROVED = 'supervisor_approved';
    public const STATUS_REJECTED = 'rejected';

    public const STATUS_LABELS = [
        self::STATUS_DRAFT => 'Borrador',
        self::STATUS_SIGNED_IN_SITE => 'Firmado en sitio',
        self::STATUS_PENDING_CLIENT_APPROVAL => 'Pendiente confirmación cliente',
        self::STATUS_CLIENT_APPROVED => 'Confirmado por cliente',
        self::STATUS_SUPERVISOR_APPROVED => 'Aprobado por supervisor',
        self::STATUS_REJECTED => 'Rechazado',
    ];

    protected $fillable = [
        'code', 'technician_id', 'client_id', 'machine_id', 'product_id',
        'machine_name_snapshot', 'product_type_snapshot', 'service_date', 'observations',
        'client_signature_path', 'client_signed_name', 'client_signed_at',
        'client_approval_token', 'client_email_sent_at', 'client_approved_at', 'client_approval_ip',
        'supervisor_id', 'supervisor_reviewed_at', 'supervisor_notes', 'status',
    ];

    protected $casts = [
        'service_date' => 'date',
        'client_signed_at' => 'datetime',
        'client_email_sent_at' => 'datetime',
        'client_approved_at' => 'datetime',
        'supervisor_reviewed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Report $r) {
            if (empty($r->code)) {
                $r->code = 'RPT-'.strtoupper(Str::random(8));
            }
        });
    }

    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
    public function supervisor() { return $this->belongsTo(User::class, 'supervisor_id'); }
    public function client() { return $this->belongsTo(Client::class); }
    public function machine() { return $this->belongsTo(Machine::class); }
    public function product() { return $this->belongsTo(Product::class); }
    public function photos() { return $this->hasMany(ReportPhoto::class); }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT => 'bg-gray-100 text-gray-800',
            self::STATUS_SIGNED_IN_SITE => 'bg-blue-100 text-blue-800',
            self::STATUS_PENDING_CLIENT_APPROVAL => 'bg-yellow-100 text-yellow-800',
            self::STATUS_CLIENT_APPROVED => 'bg-emerald-100 text-emerald-800',
            self::STATUS_SUPERVISOR_APPROVED => 'bg-green-200 text-green-900',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
