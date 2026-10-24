<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang boleh diisi lewat create() dan update().
    protected $fillable = [
        'title',
        'description',
        'status',
        'started_at',
        'budget',
    ];

    // started_at menjadi objek Carbon agar mudah diformat (pengganti $dates).
    protected function casts(): array
    {
        return [
            'started_at' => 'date',
            'budget' => 'integer',
        ];
    }

    // Pencarian judul atau deskripsi dilakukan di database.
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where(function (Builder $query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    // Project yang dibuat hari ini.
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', today());
    }

    // Project dengan status published.
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    // Project dengan status draft.
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }
}
