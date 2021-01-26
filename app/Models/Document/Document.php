<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\File\File;
use App\Models\SchoolClass\SchoolClass;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id',
        'title',
        'description',
        'type',
        'state',
        'file_id',
        'school_class_id',
    ];

    /**
     * Relationship: 1x1 - Document has File.
     *
     * @return object
     */
    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    /**
     * Relationship: 1x1 - SchoolClass has File.
     *
     * @return object
     */
    public function schoolClass(): HasOne
    {
        return $this->hasOne(SchoolClass::class, 'id', 'school_class_id');
    }



}
