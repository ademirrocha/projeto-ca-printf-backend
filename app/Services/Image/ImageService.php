<?php

namespace App\Services\Image;

use App\Models\Image\Image;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageService
 *
 * @package App\Services\Image
 */
class ImageService
{

    /**
     * ImageService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetImages
     * @param int $id
     *
     */

    public function get(int $id)
    {

        $image = Image::find($id);

        if(!is_null($image)){

            if($image->local == 's3'){

                if (Storage::disk('s3')->exists('images/' . $image->name)) {
                    $contents = Storage::disk('s3')->get('images/' . $image->name);

                     $base64=base64_encode($contents);

                    return 'data:image;base64,'.$base64;
                }

            }else{
                if (Storage::disk('local')->exists('images/' . $image->name)) {
                    $contents = Storage::disk('local')->get('images/' . $image->name);

                    $base64=base64_encode($contents);

                    return 'data:image;base64,'.$base64;
                }
            }



        }

        return [
            'errors' => [
                'image' => ['Imagem não encontrada']
            ]
        ];

    }

}