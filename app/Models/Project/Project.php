<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use App\Models\Image\Image;

class Project extends Model
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
    	'image_id'
    ];


    public function getImage()
    {
        
        $image = Image::find($this->image_id);

        if(!is_null($image) && $image->local == 's3'){

            if (Storage::disk('s3')->exists('images/' . $image->name)) {
                $contents = Storage::disk('s3')->get('images/' . $image->name);

                $base64=base64_encode($contents);

                return 'data:image;base64,'.$base64;
            }

        }else if(!is_null($image)){
            if (Storage::disk('local')->exists('images/' . $image->name)) {
                $contents = Storage::disk('local')->get('images/' . $image->name);

                $base64=base64_encode($contents);

                return 'data:image;base64,'.$base64;
            }
        }

        return 'Image Not Found';
    }
}
