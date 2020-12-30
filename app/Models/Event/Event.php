<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'description',
    	'initial_date',
    	'final_date',
    	'state'
    ];

}
