<?php

namespace App\Http\Controllers\Users\Admin;

use App\GlobalModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $activity = GlobalModel::findOrFail('activity');
        $uae_visa = GlobalModel::findOrFail('uaeVisa');
        $outbound_visa = GlobalModel::findOrFail('outboundVisa');
        return view('backend.admin')->with(['activity' => $activity,'uae_visa' => $uae_visa,'outbound_visa' => $outbound_visa]);
    }
}
