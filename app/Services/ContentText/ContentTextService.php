<?php

namespace App\Services\ContentText;

use App\Models\ContentText\ContentText;
use App\Models\File\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class ContentTextService
 *
 * @package App\Services\ContentText
 */
class ContentTextService
{



    /**
     * #GetAllContentTexts
     * @param array $params
     *
     */

    public function all(array $params)
    {

        $query = ContentText::query();

        if(isset($params['contents']) && !is_null($params['contents'])){

            if(is_array($params['contents'])){
                $query->whereIn('content', $params['contents']);
            }else{
                $query->where('content', $params['contents']);
            }
        }
        return $query->get();
    }


    /**
     * #GetContentText
     * @param int $id
     *
     */

    public function get(int $id)
    {

        $contentText = ContentText::find($id);
        
        return $contentText;
    }

    /**
     * #CreateEvent
     * @param array $data
     * @return ContentText
     */

    private function create(array $data): ContentText
    {

        $contentText = ContentText::create([
            'content' => $data['content'],
            'text' => $data['newText'],
            'type' => $data['type'] ?? 'text',
            'file_id' => $file->id ?? null,
        ]);

        return $contentText;
    }


    /**
     * #UpdateContentText
     * @param array $data
     */
    public function update(array $data): ContentText
    {
        $contentText = ContentText::where('content', $data['content'])->first();

        if(is_null($contentText)){
            return $this->create($data);
        }

        $contentText->text = $data['newText'];
        $contentText->type = $data['type'] ?? $contentText->type;
        
        $contentText->save();
        
        return $contentText;
    }
    
}