<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Favoritable;

class Phrasebook extends Model {
    use HasFactory, SoftDeletes, Favoritable;

    /**
     * The attribute that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'bahasa_indonesia',
        'tieng_viet',
        'english',
        'notes',
        'created_by',
        'updated_by',
        'category_id'
    ];

    /**
     * A phrasebook has an creator.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * A phrasebook may have a updator. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * A phrasebook is assigned a category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(PhrasebookCategory::class, 'category_id');
    }

}
