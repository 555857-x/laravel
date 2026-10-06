<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    // Pencarian judul dilakukan di database sebelum data ditampilkan.
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where('title', 'like', "%{$keyword}%");
    }
}