<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics;
use Spatie\Analytics\Period;
use App\Models\Domain;

class DashboardController extends Controller
{
    public function view()
    {
        return view('admin.test');
    }

    public function index()
    {
         $orders = Order::with('user', 'plan')->where('price','>',0)->latest()->take(5)->get();
        return view('admin.dashboard', compact('orders'));
    }

    public function fetchdata()
    {
        $data['total_users']    = User::where('role_id', 2)->count();
        $data['pending_orders'] = Order::where('status', 2)->count();
        $data['active_orders']  = Order::where('status', 1)->count();
        $data['total_earning']  = Order::where('status', 1)->sum('price');

        return response()->json($data);
    }

    public function getchartdata(Request $request)
    {
        $day = $request->id;
        if ($request->id != 365) {
            $orders = Order::where('created_at', '>=', Carbon::now()->subDays($day))
            ->selectRaw('DATE(created_at) as date, SUM(price) as price')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        } else {
            $orders = Order::select(DB::raw('SUM(price) as price'),
                DB::raw('YEAR(created_at) year'),
                DB::raw('MONTH(created_at) month'))
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->where('created_at', '>=', Carbon::now()->subDays($day))
                ->get();
        }

        return $orders;
    }




     public function staticData()
    {
        $total_subscribers=Tenant::count();
        $total_domain_request=Domain::where('status',2)->count();
        $total_earnings=Order::where('status','!=',0)->sum('price');
        $total_expired=Tenant::where('will_expire','<', now())->count();
      
        

        $year=Carbon::parse(date('Y'))->year;
        $today=Carbon::today();

        $earnings=Order::whereYear('created_at', '=',$year)->where('status','!=',0)->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, sum(price) total')->groupBy('year', 'month')->get();
        $total_earnings_this_year=Order::where('status','!=',0)->whereYear('created_at', '=',$year)->sum('price');


        $orders=Order::whereYear('created_at', '=',$year)->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, count(*) orders')
                ->groupBy('year', 'month')
                ->get();
        $total_order_this_year=Order::where('status','!=',0)->whereYear('created_at', '=',$year)->count();        

        $data['total_subscribers']=number_format($total_subscribers);
        $data['total_domain_request']=number_format($total_domain_request);
        $data['total_expired']=number_format($total_expired);
        $data['total_earnings']=amount_admin_format($total_earnings);
        $data['earnings']=$earnings;
        $data['total_earnings_this_year']=amount_admin_format($total_earnings_this_year);
        $data['orders']=$orders;
        $data['total_order_this_year']=number_format($total_order_this_year);

        return response()->json($data);

    }

    public function perfomance($period)
    {
        if ($period != 365) {
            $earnings=Order::whereDate('created_at', '>', Carbon::now()->subDays($period))->where('status','!=',0)->orderBy('id', 'asc')->selectRaw('year(created_at) year, date(created_at) date, sum(price) total')->groupBy('year','date')->get();
        }
        else{
            $earnings=Order::whereDate('created_at', '>', Carbon::now()->subDays($period))->where('status','!=',0)->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, sum(price) total')->groupBy('year','month')->get();
        }
       
        
        return response()->json($earnings); 
    }

    public function order_statics($month)
    {
        $month=Carbon::parse($month)->month;
        $year=Carbon::parse(date('Y'))->year;

        $total_orders=Order::whereYear('created_at', '=',$year)->whereMonth('created_at', '=',$month)->count();

        $total_pending=Order::whereYear('created_at', '=',$year)->whereMonth('created_at', '=',$month)->where('status',2)->count();

        $total_completed=Order::whereYear('created_at', '=',$year)->whereMonth('created_at', '=',$month)->where('status',1)->count();

        $total_expired=Order::whereYear('created_at', '=',$year)->whereMonth('created_at', '=',$month)->where('status',3)->count();

        $data['total_orders']=number_format($total_orders);
        $data['total_pending']=number_format($total_pending);
        $data['total_completed']=number_format($total_completed);
        $data['total_processing']=number_format($total_expired);

        return response()->json($data);
    }


    public function google_analytics($days)
    {
        if (file_exists('uploads/service-account-credentials.json')) {
           
            $data['TotalVisitorsAndPageViews']=$this->fetchTotalVisitorsAndPageViews($days);
            $data['MostVisitedPages']=$this->fetchMostVisitedPages($days);
            $data['Referrers']=$this->fetchTopReferrers($days);
            $data['fetchUserTypes']=$this->fetchUserTypes($days);
            $data['TopBrowsers']=$this->fetchTopBrowsers($days);
        }
        else{
            $data['TotalVisitorsAndPageViews']=[];
            $data['MostVisitedPages']=[];
            $data['Referrers']=[];
            $data['fetchUserTypes']=[];
            $data['TopBrowsers']=[];
        }
                
        return response()->json($data);
    }


    public function fetchTotalVisitorsAndPageViews($period)
    {

        return \Analytics::fetchTotalVisitorsAndPageViews(Period::days($period))->map(function($data)
        {
            $row['date']=$data['date']->format('Y-m-d');
            $row['visitors']=$data['visitors'];
            $row['pageViews']=$data['pageViews'];
            return $row;
        });
        
    }
    public function fetchMostVisitedPages($period)
    {
        return \Analytics::fetchMostVisitedPages(Period::days($period));
        
    }

    public function fetchTopReferrers($period)
    {
        return \Analytics::fetchTopReferrers(Period::days($period));
        
    }

    public function fetchUserTypes($period)
    {
        return \Analytics::fetchUserTypes(Period::days($period));
        
    }

    public function fetchTopBrowsers($period)
    {
        return \Analytics::fetchTopBrowsers(Period::days($period));
        
    }

}
