<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class OrderReportController extends Controller
{
    public function excel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ReportExport(), 'order-report.xlsx');
    }

    public function csv()
    {
        return (new ReportExport)->download('order-report.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function pdf(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return (new ReportExport)->download('order-report.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function invoicePdf($id)
    {
        $data = Order::with('plan', 'getway', 'user')->findOrFail($id);
        $pdf  = PDF::loadView('admin.order_report.invoice_pdf', compact('data'));
        return $pdf->download('order-invoice.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth()->user()->can('report.index'), 401);
        $total_orders  = Order::count('id');
        $total_earning = Order::where('status', 1)->sum('price');
        $total_pending = Order::where('status', 2)->count('*');
        $total_expired = Order::where('status', 3)->count('*');
        $data          = Order::with('plan', 'getway', 'user');

        if ($request->start_date || $request->end_date) {
            $start_date = $request->start_date . " 00:00:00";
            $end_date   = $request->end_date . " 23:59:59";
            if ($request->start_date == '' && $request->end_date == '') {
                $data = $data;
            } elseif ($request->start_date == '' && $request->end_date != '') {
                $data = $data->where('created_at', '<', $request->end_date);
            } elseif ($request->start_date != '' && $request->end_date == '') {
                $data = $data->where('created_at', '>', $request->start_date);
            } else {
                $data = $data->whereBetween('created_at', [$start_date, $end_date]);
            }
        } elseif ($request->day) {
            if ($request->day == 'today') {
                $data = $data->whereBetween('created_at', [Carbon::now()->setTime(0, 0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23, 59, 59)->format('Y-m-d H:i:s')]);
            } elseif ($request->day == 'thisWeek') {
                $data = $data->whereBetween('created_at', [Carbon::now()->startOfWeek()->setTime(0, 0)->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->setTime(23, 59, 59)->format('Y-m-d H:i:s')]);
            } elseif ($request->day == 'thisMonth') {
                $data = $data->whereBetween('created_at', [Carbon::now()->firstOfMonth()->setTime(0, 0)->format('Y-m-d H:i:s'), Carbon::now()->endOfMonth()->setTime(23, 59, 59)->format('Y-m-d H:i:s')]);
            } elseif ($request->day == 'thisYear') {
                $data = $data->whereBetween('created_at', [Carbon::now()->startOfYear()->setTime(0, 0)->format('Y-m-d H:i:s'), Carbon::now()->endOfYear()->setTime(23, 59, 59)->format('Y-m-d H:i:s')]);
            }
        } elseif ($request->type == 'user') {
            $q    = $request->q;
            $data = $data->whereHas('user', function ($query) use ($q) {
                return $query->where('name', 'LIKE', "%$q%");
            });
        } elseif ($request->type == 'plan') {
            $q    = $request->q;
            $data = $data->whereHas('plan', function ($query) use ($q) {
                return $query->where('name', 'LIKE', "%$q%");
            });
        } elseif ($request->type == 'getway') {
            $q    = $request->q;
            $data = $data->whereHas('getway', function ($query) use ($q) {
                return $query->where('name', 'LIKE', "%$q%");
            });
        } elseif ($request->type == 'trx') {
            $q    = $request->q;
            $data = $data->where('trx', 'LIKE', "%$q%");
        } else {
            $data = $data;
        }

        $data = $data->latest()->paginate(15);

        return view('admin.order_report.index', compact('data', 'total_orders', 'total_earning', 'total_pending', 'total_expired'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth()->user()->can('report.view'), 401);

        $data = Order::with('plan', 'getway', 'user')->findOrFail($id);
        return view('admin.order_report.show', compact('data'));
    }

}
