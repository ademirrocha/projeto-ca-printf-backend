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

        if(isset($data['image']['url']) && $data['image']['url'] != ''){
            $file = $this->createFile($data);
        }
            
        $contentText = ContentText::create([
            'content' => $data['content'],
            'text' => $data['newText'] ?? null,
            'type' => $data['type'] ?? 'text',
            'file_id' => $file->id ?? null,
        ]);

        return $contentText;
    }

    private function createFile($data, $context = null){


        if(!is_null($context) && !is_null($context->file_id)){

            $this->deleteFile($context);

            $file = File::find($context->file_id);

            $file->originalName = $data['image']['originalName'] ?? $file->originalName;
            $file->mimetype = $data['image']['mimetype'] ?? $file->mimetype;
            $file->size = $data['image']['size'] ?? $file->size;
            $file->key = $data['image']['key'] ?? $file->key;
            $file->url = $data['image']['url'] ?? $file->url;
            $file->url_download = $data['image']['url_download'] ?? $file->url_download;
            $file->local = $data['image']['local'] ?? $file->local;
            
            $file->save();

        }else{
            $file = File::create([
                'originalName' => $data['image']['originalName'] ?? null,
                'mimetype' => $data['image']['mimetype'],
                'size' => $data['image']['size'],
                'key' => $data['image']['key'],
                'url' => $data['image']['url'],
                'url_download' => $data['image']['url_download'] ?? null,
                'local' => $data['image']['local'] ?? null
            ]);
        }

        return $file;
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

        }else if(isset($data['image']['url']) && $data['image']['url'] != ''){

            $file = $this->createFile($data, $contentText);
        }

        $contentText->text = $data['newText'] ?? null;
        $contentText->file_id = $file->id ?? null;
        $contentText->type = $data['type'] ?? $contentText->type;
        
        $contentText->save();
        
        return $contentText;
    }

    private function deleteFile($contentText){
        $file = $contentText->file;

        if($file->local == 's3'){
            $nameFile = explode('/', $file->key);
            $nameFile = $nameFile[1];
        }else{
            $nameFile = $file->key;
        }

        if($contentText->file->local == 's3'){

            if (Storage::disk('s3')->exists('images/' . $nameFile)) {
                Storage::disk('s3')->delete('images/' . $nameFile);
            }
        }else{
            if (Storage::disk('local')->exists('images/' . $nameFile)) {
                Storage::disk('local')->delete('images/' . $nameFile);
            }
        }

    }
    
}