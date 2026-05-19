<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand_id', 'model', 'serial',
        'description', 'image_path', 'active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function brand() { return $this->belongsTo(Brand::class); }
}
