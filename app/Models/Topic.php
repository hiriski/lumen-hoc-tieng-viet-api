<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
    use HasFactory;
    
    /** Disable for attribute timestamps */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug'
    ];

    /**
     * Get the key name for route model binding.
     * 
     * @return string
     */
    public function getRouteKeyName() {
        return 'slug';
    }

    /**
     * A topic consists of discussions.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions() {
        return $this->hasMany(Discussion::class);
    }

}
