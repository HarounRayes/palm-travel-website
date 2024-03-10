<?php

namespace App\Http\Controllers\Backend;

use App\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::where('is_enquiry', 1)->orderBy('id', 'DESC')->paginate(20);
        return view('backend.enquiry.index', compact('enquiries'));
    }

    public function index_order()
    {
        $enquiries = Enquiry::where('is_enquiry', 0)->orderBy('id', 'DESC')->paginate(20);
        return view('backend.order.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update(['view' => '1']);
        return view('backend.enquiry.view', compact('enquiry'));
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        try {
            $enquiry->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.enquiries.index');
    }
}
