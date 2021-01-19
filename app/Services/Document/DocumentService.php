<?php

namespace App\Services\Document;

use App\Models\Document\Document;
use App\Models\File\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class DocumentService
 *
 * @package App\Services\Document
 */
class DocumentService
{

    /**
     * DocumentService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetDocuments
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Document::query();

        if(isset($params['search']) && !is_null($params['search'])){
            $query->where(function($query) use ($params){

                if(isset($params['search'])){

                    $query->where('title', 'LIKE', "%{$params['search']}%");
                    $query->orWhere('description', 'LIKE', "%{$params['search']}%");
                    $query->orWhere('type', 'LIKE', "%{$params['search']}%");

                }

            });
        }


        $query->orderBy('title', 'ASC');

        return $query->paginate($params['paginate'] ?? 10);

        //$contents = Storage::get('documents/DbVowhUHGDckKpnSUIenlOiOk8o1OraM1LWh1tFk.png');
        //
        //Storage::disk('local')->put('documents', $request->file);


    }

    private function getDocument($document){

        if($document->local == 's3'){

            if (Storage::disk('s3')->exists($document->file)) {
                $contents = Storage::disk('s3')->get($document->file);

                return $contents;
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('local')->get('documents/' . $document->file);

                return $contents;
            }
        }
    }


    public function download(array $params)
    {

        $file = File::where('key', $params['file'])->first();

        if($file->local == 's3'){
            $nameFile = explode('/', $file->key);
            $nameFile = $nameFile[1];
        }else{
            $nameFile = $file->key;
        }


        if($file->local == 's3' && Storage::disk('s3')->exists('documents/' . $nameFile) ) {

            $contents = Storage::disk('s3')->download('documents/' . $nameFile, $nameFile);

            return $contents;

        }else if (Storage::disk('local')->exists('documents/' . $nameFile)) {
            $contents = Storage::disk('local')->download('documents/' . $nameFile, $nameFile);

            return $contents;

        }else{

            return [
                'errors' => [
                    'file' => ['Arquivo não encontrado']
                ]
            ];
        }




    }

    /**
     * #CreateEvent
     * @param array $data
     * @return Document
     */

    public function create(array $data): Document
    {

        if(isset($data['file']) && !is_null($data['file']) && isset($data['file']['url']) && !is_null($data['file']['url'])){
            $file = $this->createFile($data);
        }

        if(isset($data['school_class']) && !is_null($data['school_class'])){
            $schoolClass = getSchoolClass($data);
        }


        $document = Document::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'type' => $data['type'] ?? null,
            'state' => $data['state'] ?? 'Ativo',
            'file_id' => $file->id,
            'school_class' => $schoolClass ?? null,
        ]);

        return $document;
    }


    private function getSchoolClass($data){


        if(is_integer($data['school_class']) && SchoolClass::where('id', $data['school_class'])->exists()){

            $schoolClass = SchoolClass::find($data['school_class']);
            
        }else{
            $schoolClass = SchoolClass::create([
                'name' => $data['school_class']
            ]);
        }

        return $schoolClass;
    }


    private function createFile($data, $document = null){


        if(!is_null($document) && !is_null($document->file_id)){
            $file = File::find($document->file_id);

            $file->originalName = $data['file']['originalName'] ?? $file->originalName;
            $file->mimetype = $data['file']['mimetype'] ?? $file->mimetype;
            $file->size = $data['file']['size'] ?? $file->size;
            $file->key = $data['file']['key'] ??$file->key;
            $file->url = $data['file']['url'] ?? $file->url;
            $file->url_download = $data['file']['url_download'] ?? $file->url_download;
            $file->local = $data['file']['local'] ?? $file->local;
            
            $file->save();

        }else{
            $file = File::create([
                'originalName' => $data['file']['originalName'] ?? null,
                'mimetype' => $data['file']['mimetype'],
                'size' => $data['file']['size'],
                'key' => $data['file']['key'],
                'url' => $data['file']['url'],
                'url_download' => $data['file']['url_download'] ?? null,
                'local' => $data['file']['local'] ?? null
            ]);
        }

        return $file;
    }


    private function deleteFile($document){

        if($document->local == 's3'){

            if (Storage::disk('s3')->exists('documents/' . $document->file)) {
                Storage::disk('s3')->delete('documents/' . $document->file);
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                Storage::disk('local')->delete('documents/' . $document->file);

            }
        }

    }

    /**
     * #UpdateDocument
     * @param object $data
     */
    public function update(object $data): Document
    {
        $document = Document::find($data['id']);

        if($data->hasFile('file')){
            $this->deleteFile($document);

            $file = $this->createFile($data);

        }

        $document->title = $data['title'];
        $document->file = $file[0] ?? $document->file;
        $document->local = $file[1] ?? $document->local;

        $document->save();
        

        return $document;
    }


    /**
     * #DeleteDocument
     * @param array $data
     */
    public function delete(array $data){
        $document = Document::find($data['id']);

        $this->deleteFile($document);
        
        return $document->delete();

    }


    
}