<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Comment extends Model {
    use HasFactory, Favoritable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'commentable_id',
        'commentable_type',
    ];

    /**
     * The relationships to always eager-load.
     * 
     * @var array
     */
    protected $with = ['user'];

    /**
     * Appends custom attributes.
     * 
     * @var array
     */
    protected $appends = ['is_favorited'];

    /**
     * A comment has an owner (user).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * A comment belongs to a discussion.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion() {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * A comment belongs to a phrasebook.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phrasebook() {
        return $this->belongsTo(Discussion::class);
    }
}
