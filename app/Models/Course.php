<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_confirmed' => false
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_confirmed' => 'boolean'
    ];

    protected $dates = [
        'date_from',
        'date_to'
    ];

    public function terms() {
        return $this->hasMany(Term::class, 'courseID');
    }

    public function guarantor() {
        return $this->belongsTo(Person::class, 'guarantorID');
    }
}
