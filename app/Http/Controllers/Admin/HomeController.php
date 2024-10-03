<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery_trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __invoke()
    // {
    //     $delivery_trip = Delivery_trip::first()->skip(0)->take(10)->get();
    //     return view('admin.index',[
    //         'delivery_trip' => $delivery_trip
    //     ]);
    // }
    public function calculateComm($currentYearMonth)
    {
        $KKIPdriverMonthlyCommission = DB::select("CALL driver_monthly_commission('".$currentYearMonth."','KKIP')");
        $KKIPworkmanMonthlyCommission = DB::select("CALL workman_monthly_commission('".$currentYearMonth."','KKIP')");

        $KK2driverMonthlyCommission = DB::select("CALL driver_monthly_commission('".$currentYearMonth."','KK2')");
        $KK2workmanMonthlyCommission = DB::select("CALL workman_monthly_commission('".$currentYearMonth."','KK2')");
        
        $totalKKIPMonthlyCommission = DB::select("CALL Total_Commission_by_Outlet('".$currentYearMonth."','KKIP')");
        $totalKK2MonthlyCommission = DB::select("CALL Total_Commission_by_Outlet('".$currentYearMonth."','KK2')");

        $totalKKIPMonthlyWeight = DB::select("CALL Total_weight_by_Outlet('".$currentYearMonth."','KKIP')");
        $totalKK2MonthlyWeight = DB::select("CALL Total_weight_by_Outlet('".$currentYearMonth."','KK2')");

        $t = \Carbon\Carbon::now();
        $currentYear = $t->year;
        $currentMonth = $t->month;
        if(!isset($_POST["month"])){
            $_POST["month"] = $currentMonth;
        }
        if(!isset($_POST["year"])){
            $_POST["year"] = $currentYear;
        }
        $selected_year = $_POST["year"];
        $selected_month = date('F', mktime(0, 0, 0, $_POST["month"], 1));

        return view('admin.index',[
            'KKIPdriverMonthlyCommission' => $KKIPdriverMonthlyCommission,
            'KKIPworkmanMonthlyCommission' => $KKIPworkmanMonthlyCommission,
            'KK2driverMonthlyCommission' => $KK2driverMonthlyCommission,
            'KK2workmanMonthlyCommission' => $KK2workmanMonthlyCommission,
            'totalKKIPMonthlyCommission' => $totalKKIPMonthlyCommission,
            'totalKK2MonthlyCommission' => $totalKK2MonthlyCommission,
            'totalKKIPMonthlyWeight' => $totalKKIPMonthlyWeight,
            'totalKK2MonthlyWeight' => $totalKK2MonthlyWeight,
            'currentYearMonth' => $currentYearMonth,
            'year' => $currentYear,
            'month' => $currentMonth,
            'selected_year' => $selected_year,
            'selected_month' => $selected_month,
            
        ]);
    }

    public function __invoke()
    {
        $currentYearMonth = \Carbon\Carbon::now()->format('Y-m');
        return HomeController::calculateComm($currentYearMonth);
        
    }

    public function monthComm(Request $request)
    {
        if( strlen($request->month)  == 1 ){
            $selectedMonth = $request->year."-0".$request->month;
        } else {
            $selectedMonth = $request->year."-".$request->month;
        }
        return HomeController::calculateComm($selectedMonth);
    }
}
