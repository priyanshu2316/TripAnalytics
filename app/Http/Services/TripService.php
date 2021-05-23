<?php

namespace App\Http\Services;

use App\Models\Trip;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class TripService
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function getAllTrips(array $data)
    {
        $filter = $data['filter'];

        if($filter == 0) {
            $date = Carbon::now()->subWeek();
        } elseif ($filter == 1){
            $date = Carbon::now()->subMonth();
        } else {
            $date = Carbon::now()->subYear();
        }

        $response = [
            ['Status', 'Count'],
            ['Completed', Trip::where('trip_status', 2)->where('created_at','<=',$date)->count()],
            ['InProgress', Trip::where('trip_status', 1)->where('created_at','<=',$date)->count()],
            ['Cancelled', Trip::where('trip_status', 3)->where('created_at','<=',$date)->count()],
        ];
        return $response;
    }

    /**
     * @param array $data
     *
     * @return array|\string[][]
     */
    public function getSalesPerformance(array $data)
    {
        if ($data['filter']) {
            $sales_records = $this->getTravellingSalesPerformance();
        } else {
            $sales_records = $this->getBookingSalesPerformance();
        }

        $response = $this->preFillSalesMonthWise();

        foreach ($sales_records as $key => $val) {
            $date = DateTime::createFromFormat('!m', $val->month);
            $response[$val->month] = [$date->format('F'), $val->amount];
        }

        return $response;
    }

    /**
     * @return array
     */
    private function preFillSalesMonthWise()
    {
        $sales = [['Month', 'Amount']];

        $month = 1;
        while ($month != 13) {
            $date = DateTime::createFromFormat('!m', $month);
            $sales[$month] = [$date->format('F'), 0];
            $month++;
        }

        return $sales;
    }

    /**
     * @return mixed
     */
    private function getTravellingSalesPerformance()
    {
        return Trip::select(
            DB::raw("SUM(booking_cost) as amount"),
            DB::raw("MONTH(trip_date) as month")
        )
            ->groupBy(DB::raw("MONTH(trip_date)"))
            ->get();
    }

    /**
     * @return mixed
     */
    private function getBookingSalesPerformance()
    {
        return Trip::select(
            DB::raw("SUM(booking_cost) as amount"),
            DB::raw("MONTH(booking_date) as month")
        )
            ->groupBy(DB::raw("MONTH(booking_date)"))
            ->get();
    }
}
