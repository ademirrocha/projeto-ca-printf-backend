<?php

namespace App\Services\Project;

use App\Models\Project\Project;
use Illuminate\Support\Facades\Storage;

use App\Models\Image\Image;
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


    /**
     * #GetProjects
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Project::query();

        $query->orderBy('created_at', 'DESC');

        return $query->paginate($params['paginate'] ?? 10);
    }
    
    /**
     * #CreateProject
     * @param array $data
     * @return Project
     */

    public function create(array $data): Project
    {

        if(isset($data['image'])){

            if(env('FILESYSTEM_EXTERNAL') == true){
                $file = Storage::disk('s3')->put('images', $data['image']);
                $local = 's3';
            }else{
                $file = Storage::disk('local')->put('images', $data['image']);
                $local = 'local';
            }

            $nameImage = explode('images/', $file);


            $image = Image::create([
                'name' => $nameImage[1],
                'local' => $local
            ]);
        }
        
        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_id' => $image->id ?? null,
        ]);

        return $project;
    }

    /**
     * #UserUpdate-CaseUse.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }


    
}