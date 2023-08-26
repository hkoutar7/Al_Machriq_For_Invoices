<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{

    public function __invoke(Request $request)
    {

        $allInv = Invoice::count();
        $allInv = ($allInv !== 0) ? $allInv : 1;

        $unpaidInv = Invoice::where('value_status', '0')->count();
        $UnpaidInvPerc = ($unpaidInv / $allInv) * 100;

            $paidInv = Invoice::where('value_status','2')->count();
            $paidInvPerc = ($paidInv / ($allInv)) * 100;

            $partiallyPaidInv = Invoice::where('value_status','1')->count();
            $partiallyPaidInvPerc = ($partiallyPaidInv / ($allInv)) * 100;

        $circleJs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                'backgroundColor'=> [
                    '#FF9B9B'
                    , '#A8DF8E'
                    , '#FFD6A5'
                ],
                'hoverBackgroundColor' => [
                    'rgb(255, 99, 132)'
                    , '#84d65e'
                    , 'rgb(255, 205, 86)'
                ],
                'data' => [$UnpaidInvPerc,$paidInvPerc,$partiallyPaidInvPerc]
            ]
        ])
        ->options([]);

        return view('dashboard/index',compact('UnpaidInvPerc','paidInvPerc','partiallyPaidInvPerc','circleJs'));
    }
}
