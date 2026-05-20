<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'subtitle', 'body',
        'main_image_path', 'location', 'event_date', 'published',
    ];

    protected $casts = [
        'event_date' => 'date',
        'published'  => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) ?: Str::random(8);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(EventImage::class)->orderBy('order');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'event_brand');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
