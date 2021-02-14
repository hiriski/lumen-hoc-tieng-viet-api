<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Discussion extends Model {
    use HasFactory, SoftDeletes, Favoritable;

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'body',
        'topic_id',
        'status_id',
        'type_id',
        'user_id',
        'hits',
    ];

    /**
     * Eager load relationship for every query.
     * 
     * @var array
     */
    protected $with = ['user', 'topic', 'type'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status_id' => 'integer',
        'type_id'   => 'integer',
        'topic_id'  => 'integer',
        'hits'      => 'integer',
    ];

    /**
     * Default attributes
     * 
     * @var array
     */
    protected $attributes = [
        'status_id' => 3, // default is active
        'hits'      => 0,
    ];

    /**
     * Appends custom attributes
     * 
     * @var array
     */
    protected $appends = ['replies_count', 'is_favorited'];

    /**
     * A discussion belongs to user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * A discussion is assigned a topic.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    /**
     * A discussion is assigned a status.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo(DiscussionStatus::class, 'status_id');
    }

    /**
     * A discussion may have different type
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(DiscussionType::class);
    }

    /**
     * A discussion may have many comments.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * Get the replies count for thread discussion.
     * 
     * @return int
     */
    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }
}



