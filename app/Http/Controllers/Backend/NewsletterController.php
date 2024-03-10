<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Newsletter;

class NewsletterController extends Controller
{
    public function index(){
        $newsletters = Newsletter::orderBy('id', 'DESC')->paginate(20);
        return view('backend.newsletter.index', compact('newsletters'));
    }

}
