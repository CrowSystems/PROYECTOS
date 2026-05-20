<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'logo_path', 'description', 'website_url',
        'active', 'show_in_carousel', 'carousel_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'show_in_carousel' => 'boolean',
        'carousel_order'   => 'integer',
    ];

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
}
