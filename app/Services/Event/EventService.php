<?php

namespace App\Services\Event;

use App\Models\Event\Event;

/**
 * Class EventService
 *
 * @package App\Services\Event
 */
class EventService
{

    /**
     * EventService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetEvents
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Event::query();

        $query->orderBy('initial_date', 'DESC');
    
        return $query->paginate($params['paginate'] ?? 10);
    }
    
    /**
     * #CreateEvent
     * @param array $data
     * @return Event
     */

    public function create(array $data): Event
    {

        $event = Event::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'initial_date' => $data['initial_date'],
            'final_date' => $data['final_date'],
            'state' => $data['state'] ?? 'Ativo',
        ]);

        return $event;
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