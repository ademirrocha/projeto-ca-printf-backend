<?php

namespace App\Services\Project;

use App\Models\Project\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File\File;
/**
 * Class ProjectService
 *
 * @package App\Services\Project
 */
class ProjectService
{

    /**
     * ProjectService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    private function createFile($data, $project = null){


        if(!is_null($project) && !is_null($project->file_id)){
            $file = File::find($project->file_id);

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
     * #GetAllProjects
     * @param array $params
     *
     */

    public function all(array $params)
    {

        $query = Project::query();

        $query->orderBy('created_at', 'DESC');

        return $query->paginate($params['paginate'] ?? 10);
    }

    /**
     * #GetProject
     * @param int $id
     *
     */

    public function get(int $id)
    {

        $project = Project::find($id);
        
        return $project;
    }

    private function deleteFile($project){


        $file = $project->file;

        if($file->local == 's3'){
            $nameFile = explode('/', $file->key);
            $nameFile = $nameFile[1];
        }else{
            $nameFile = $file->key;
        }



        if($project->file->local == 's3'){

            if (Storage::disk('s3')->exists('images/' . $nameFile)) {
                Storage::disk('s3')->delete('images/' . $nameFile);
            }

        }else{
            if (Storage::disk('local')->exists('images/' . $nameFile)) {
                Storage::disk('local')->delete('images/' . $nameFile);

            }
        }

        $id = $project->file_id;
        $project->file_id = null;
        $project->save();

        File::where('id', $id)->delete();

    }
    
    /**
     * #CreateProject
     * @param array $data
     * @return Project
     */

    public function create(array $data): Project
    {

        if(isset($data['image']) && !is_null($data['image']) && isset($data['image']['url']) && !is_null($data['image']['url'])){
            $image = $this->createFile($data);
        }
        
        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_id' => $image->id ?? null,
        ]);

        return $project;
    }

    /**
     * #UpdateProject.
     * @param object $data
     * @return Project
     */
    public function update(object $data): Project
    {
        $project = Project::find($data['id']);

        if(isset($data['image']) && !is_null($data['image']) && isset($data['image']['url']) && !is_null($data['image']['url'])){

            $image = $this->createFile($data);

            if(!is_null($project->file_id)){
                $this->deleteFile($project);

            }

        }

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->file_id = $image->id ?? $project->file_id;

        $project->save();

        return $project;
    }


    /**
     * #DeleteProject
     * @param array $data
     */
    public function delete(array $data){

        $project = Project::find($data['id']);

        if(!is_null($project->file_id)){

            $this->deleteFile($project);
        }
        
        return $project->delete();

    }
    
}