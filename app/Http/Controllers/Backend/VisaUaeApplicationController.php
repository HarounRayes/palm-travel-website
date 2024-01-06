<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\VisaUaeApplication;
use Illuminate\Http\Request;

class VisaUaeApplicationController extends Controller
{
    public function index()
    {
        $applications = VisaUaeApplication::where('active' ,1)->orderBy('id', 'DESC')->paginate(20);
        return response()->view('backend.visa.uae.application.index', ['applications' => $applications]);
    }

    public function view(Request $request, $id)
    {
        $application = VisaUaeApplication::findorFail($id);
        return response()->view('backend.visa.uae.application.view', ['application' => $application]);
    }
}
