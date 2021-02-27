<?php

namespace App\Services\MemberCa;
use App\Models\MemberCa\MemberCa;

/**
 * Class MemberService
 *
 * @package App\Services\MemberCa
 */
class MemberService
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
     * #GetAllProjects
     * @param array $params
     *
     */

    public function all()
    {
        $members = MemberCa::all();
        return $members;
    }


    /**
     * #UpdateMembers.
     * @param array $params
     * @return Project
     */
    public function update(array $params)
    {
        
        foreach($params as $key => $value){
            if(!is_null($value)){
                $member = MemberCa::where('role', $key)->first();
                if(is_null($member)){
                    $member = MemberCa::create([
                        'name' => $value,
                        'role' => $key
                    ]);
                }else{
                    $member->name = $value;
                    $member->save();
                }

            }
        }

        return $this->all();


    }
    
}