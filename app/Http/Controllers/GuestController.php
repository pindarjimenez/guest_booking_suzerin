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
}