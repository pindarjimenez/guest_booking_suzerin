<?php

namespace App\Services;

use App\Repositories\Eloquent\GuestRepository;

class GuestService
{
    /** @var GuestRepository $guestRepository */
    protected $guestRepository;

    /**
     * GuestService constructor.
     * @param GuestRepository $guestRepository
     */
    public function __construct(GuestRepository $guestRepository) {
        $this->guestRepository = $guestRepository;
    }

    public function createGuest($data)
    {
        $this->guestRepository->create($data);
    }

    public function getBookings()
    {
        return $this->guestRepository->all();
    }

    public function deleteBooking($id)
    {
       $this->guestRepository->destroy(['id' => $id]);
    }

    public function updateGuest($data)
    {
        $id = $data['id'];
        unset($data['id']);
        
        $this->guestRepository->update($data, $id);
    }
}