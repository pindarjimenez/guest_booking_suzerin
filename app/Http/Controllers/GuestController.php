<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GuestService;
use Illuminate\Http\Response;

class GuestController extends Controller
{
    /** @var GuestService $guestService */
    protected $guestService;

     /**
     * GuestController constructor.
     * @param GuestService $guestService
     */
    public function __construct(GuestService $guestService) 
    {
        $this->guestService = $guestService;
    }

    public function index()
    {
        return view('guest.index');
    }

    public function create()
    {
        return view('guest.create');
    }
    
    public function submitCreate(Request $request)
    {
        $this->guestService->createGuest($request->all());

        return response(null, Response::HTTP_OK);
    }

    public function getBookings()
    {
        $bookings = $this->guestService->getBookings();
        
        return response()->json($bookings);
    }

    public function delete($id)
    {
        $this->guestService->deleteBooking($id);

        return response(null, Response::HTTP_OK);
    }

    public function submitUpdate(Request $request)
    {
        $this->guestService->updateGuest($request->all());

        return response(null, Response::HTTP_OK);
    }
}