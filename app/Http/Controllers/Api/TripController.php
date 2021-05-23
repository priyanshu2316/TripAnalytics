<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * @var \App\Http\Services\TripService
     */
    private TripService $trip_service;

    /**
     * TripController constructor.
     *
     * @param \App\Http\Services\TripService $trip_service
     */
    public function __construct(TripService $trip_service)
    {
        $this->trip_service = $trip_service;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showTripsStatus(Request $request)
    {
       $response = $this->trip_service->getAllTrips($request->all());

        return response()->json($response, 200);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showSalesPerformance(Request $request)
    {
        $response = $this->trip_service->getSalesPerformance($request->all());

        return response()->json($response, 200);
    }
}
