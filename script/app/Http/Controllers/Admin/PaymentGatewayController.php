<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPaymentGatewayRequest;
use App\Models\Getway;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('payment-gateway.index'), 401);
        $gateways = Getway::all();
        return view('admin.payment_gateway.index', compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentGateway $paymentGateway
     * @return Response
     */
    public function show($id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth()->user()->can('payment-gateway.edit'), 401);
        $gateway = Getway::findOrFail($id);
        return view('admin.payment_gateway.edit', compact('gateway'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPaymentGatewayRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\AdminPaymentGatewayRequest;

        $gateway = Getway::findOrFail($id);
        // to store  file with check old  file
        if ($request->hasFile('logo')) {
            if (!empty($gateway->logo) && file_exists($gateway->logo)) {
                unlink($gateway->logo);
            }
            $logo      = $request->file('logo');
            $logo_name = hexdec(uniqid()) . '.' . $logo->getClientOriginalExtension();
            $logo_path = 'uploads/payment-gateway/' . date('y/m/');
            $logo->move($logo_path, $logo_name);
            $gateway->logo = $logo_path . $logo_name;
        }

        $gateway->name           = $request->name;
        $gateway->rate           = $request->rate;
        $gateway->charge         = $request->charge;
        $gateway->currency_name  = $request->currency_name;
        $gateway->test_mode      = $request->test_mode;
        $gateway->status         = $request->status;
        if ($gateway->is_auto == 0) {
        $gateway->data           = $request->data ?? '';
        }
        else{
        $gateway->data           = $request->data ? json_encode($request->data) : '';
        }
       
        $gateway->save();

        return response()->json('Successfully Updated!');
    }
}
