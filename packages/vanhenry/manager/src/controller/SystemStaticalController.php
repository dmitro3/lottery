<?php 
namespace vanhenry\manager\controller;

use Carbon\Carbon;
use vanhenry\manager\statisticals\SystemStatical;

class SystemStaticalController extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }
    public function allRevenueCost()
    {
        $startDate = now()->startOfMonth();
        $endDate = now();
        if (request()->time) {
            $time = request()->time ?? '';
            $infoTime   = explode('-',$time);
            $startTimeRequest   = isset($infoTime[0]) ? $infoTime[0]:"null";
            $endTimeRequest     = isset($infoTime[1]) ? $infoTime[1]:"null";
            if (isset($startTimeRequest) && isset($endTimeRequest)) {
                $startDate 	= Carbon::createFromFormat('d/m/Y',$startTimeRequest);
	            $endDate 	= Carbon::createFromFormat('d/m/Y',$endTimeRequest);
            }
        }
        return response()->json([
            'html' => view('vh::statical.system.all_revenue_cost')->render()
        ]);
    }
}
