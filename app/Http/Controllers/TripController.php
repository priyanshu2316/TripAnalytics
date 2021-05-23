<?php

namespace App\Http\Controllers;

class TripController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trip_status_options = [
            ['value' => 0, 'label' => 'weekly',],
            ['value' => 1, 'label' => 'monthly',],
            ['value' => 2, 'label' => 'yearly',],
        ];

        $sales_performance_options = [
            ['value' => 0, 'label' => 'travelling date',],
            ['value' => 1, 'label' => 'booking date',],
        ];

        return view(
            'layouts.app',
            compact('trip_status_options', 'sales_performance_options')
        );
    }
}
