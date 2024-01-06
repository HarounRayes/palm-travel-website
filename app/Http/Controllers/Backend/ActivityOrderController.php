<?php

namespace App\Http\Controllers\Backend;

use App\ActivityOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityOrderController extends Controller
{
    public function index()
    {
        $orders = ActivityOrder::where('active', 1)->where('enquiry', 0)->orderBy('id', 'DESC')->paginate(20);
        return response()->view('backend.activity.order.index', ['orders' => $orders, 'type' => 'Orders']);
    }

    public function index_enquiry()
    {
        $orders = ActivityOrder::where('active', 1)->where('enquiry', 1)->orderBy('id', 'DESC')->paginate(20);
        return response()->view('backend.activity.order.index', ['orders' => $orders, 'type' => 'Enquiries']);
    }

    public function view(Request $request, $id)
    {
        $order = ActivityOrder::findorFail($id);
        return response()->view('backend.activity.order.view', ['order' => $order, 'type' => 'Order']);
    }

    public function view_enquiry(Request $request, $id)
    {
        $order = ActivityOrder::findorFail($id);
        return response()->view('backend.activity.order.view', ['order' => $order, 'type' => 'Enquiry']);
    }
}
