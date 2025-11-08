<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name',
    ];

    /**
     * Get the books for the category.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Books::class, 'category_id');
    }
}
