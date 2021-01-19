<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
    	'originalName',
    	'mimetype',
    	'size',
    	'key',
    	'url',
    	'url_download',
    	'local',
    ];
}
