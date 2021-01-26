<?php

namespace App\Services\SchoolClass;

use App\Models\SchoolClass\SchoolClass;

/**
 * Class SchoolClassService
 *
 * @package App\Services\SchoolClass
 */
class SchoolClassService
{

    /**
     * SchoolClassService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetAllSchoolClasses
     * @param array $params
     *
     */

    public function all(array $params)
    {

        $query = SchoolClass::query();

        $query->orderBy('name', 'ASC');

        return $query->get();
    }

    /**
     * #GetSchoolClass
     * @param int $id
     *
     */

    public function get(int $id)
    {

        $schoolClass = SchoolClass::find($id);
        
        return $schoolClass;
    }

}

