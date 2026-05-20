<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'logo_path', 'logo_mime', 'logo_data',
        'description', 'website_url',
        'active', 'show_in_carousel', 'carousel_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'show_in_carousel' => 'boolean',
        'carousel_order'   => 'integer',
    ];

    // Ocultamos el binario para que nunca aparezca al serializar a JSON ni en logs.
    protected $hidden = ['logo_data'];

    protected static function booted(): void
    {
        static::saving(function (Brand $brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name) ?: Str::random(8);
            }
        });
    }

    public function machines() { return $this->hasMany(Machine::class); }
    public function products() { return $this->hasMany(Product::class); }
    public function events()   { return $this->belongsToMany(Event::class, 'event_brand'); }

    public function scopeForCarousel($query)
    {
        return $query->where('active', true)
                     ->where('show_in_carousel', true)
                     ->orderBy('carousel_order')
                     ->orderBy('name');
    }

    /**
     * URL pública para mostrar el logo. Prioriza:
     *   1) BD (ruta dedicada que sirve el BLOB) — siempre disponible.
     *   2) Archivo en storage (fallback, requiere symlink).
     * Devuelve null si la marca no tiene logo.
     */
    public function logoUrl(): ?string
    {
        if (! empty($this->logo_mime)) {
            return route('brand.logo', $this->id);
        }
        if (! empty($this->logo_path)) {
            return asset('storage/'.$this->logo_path);
        }
        return null;
    }

    public function hasLogo(): bool
    {
        return ! empty($this->logo_mime) || ! empty($this->logo_path);
    }
}
