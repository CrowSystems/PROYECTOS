<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'image',
        'order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'order'       => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/program-placeholder.jpg');
    }
}
