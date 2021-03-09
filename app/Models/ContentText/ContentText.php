<?php

namespace App\Models\ContentText;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\File\File;

class ContentText extends Model
{
    use HasFactory;

    protected $fillable = [
    	'id',
        'content',
        'text',
        'type',
        'file_id'
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

}
