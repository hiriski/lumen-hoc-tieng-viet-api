<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhrasebookCategory extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    /** Disable for attribute timestamps */
    public $timestamps = false;
    
    /**
     * A category has many phrasebooks.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phrases() {
        return $this->hasMany(Phrasebook::class, 'category_id');
    }

    /**
     * Get the key name for route model binding
     * 
     * @return string
     */
    public function getRouteKeyName() {
        return 'slug';
    }
}
