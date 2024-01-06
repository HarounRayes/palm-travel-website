<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityCard;
use App\Blog;
use App\Comment;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Page;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{

    public function about()
    {
        $page = Page::findOrFail(1);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.about')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function contact()
    {
        $page = Page::findOrFail(2);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.contact')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function support()
    {
        $page = Page::findOrFail(4);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.support')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function sitemap()
    {
        $page = Page::findOrFail(5);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.sitemap')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function terms()
    {
        $page = Page::findOrFail(6);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.terms')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function policy()
    {
        $page = Page::findOrFail(3);
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.pages.policy')->with(['page' => $page, 'whatsapp' => $whatsapp]);
    }

    public function blogs()
    {
        $allblogs = Blog::orderBy('id', 'DESC')->get();
        $info = GeneralInformation::where('type', 'blog')->firstOrFail();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.blogs')->with(['allblogs' => $allblogs, 'info' => $info, 'whatsapp' => $whatsapp]);
    }

    public function blog(Request $request, $symbol)
    {
        $blog = Blog::where('symbol', $symbol)->firstOrFail();
        $comments = Comment::where('blog_id', $blog->id)->where('status' , 1)->get();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.blog')->with(['blog' => $blog, 'comments' => $comments, 'whatsapp' => $whatsapp]);

    }

}
