<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\VisaOutboundApplication;
use Illuminate\Http\Request;

class VisaOutboundApplicationController extends Controller
{
    public function index()
    {
        $applications = VisaOutboundApplication::all();
        return response()->view('backend.visa.application.outbound.index', ['applications' => $applications]);
    }

    public function view(Request $request, $id)
    {
        $application = VisaOutboundApplication::findorFail($id);
        return response()->view('backend.visa.application.outbound.view', ['application' => $application]);
    }
}
