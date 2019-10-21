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
}