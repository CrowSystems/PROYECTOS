<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'logo_path', 'description', 'active'];

    protected $casts = ['active' => 'boolean'];

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
}
