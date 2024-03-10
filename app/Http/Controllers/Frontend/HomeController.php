<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityCard;
use App\Blog;
use App\Country;
use App\GeneralInformation;
use App\Hotel;
// use App\Flight;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Offer;
use App\OrderTour;
use App\Package;
use App\PackageHotel;
use App\PackageHotelPricingDetail;
use App\PackageHotelSegment;
use App\PackageSlider;
use App\Partner;
use App\Service;
use App\SiteSetting;
use App\Slider;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
//    public function index()
//    {
//        $sliders = Slider::orderBy('id', 'DESC')->get();
//        $partners = Partner::all();
//        $services = Service::all();
//        $countries = Country::where('add_to_home',1)->orderBy('country_order', 'ASC')->get();
//        $service_image = GeneralInformation::where('type', 'service-image')->firstOrFail();
//        $footer_image = GeneralInformation::where('type', 'footer-image')->firstOrFail();
//        $reasons = GeneralInformation::where('type', 'home-reason')->get();
//        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();
//
//        return view('frontend.home', compact('service_image', 'footer_image', 'sliders', 'countries', 'partners', 'services', 'reasons', 'whatsapp'));
//    }

    public function index()
    {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        $partners = Partner::all();
        $services = Service::all();
        $countries = Country::where('add_to_home', 1)->orderBy('country_order', 'ASC')->get();
        $service_image = GeneralInformation::where('type', 'service-image')->firstOrFail();
        $about_image = GeneralInformation::where('type', 'about-image')->firstOrFail();
        $journey_section = GeneralInformation::where('type', 'journey-section')->firstOrFail();
        $feature_section = GeneralInformation::where('type', 'feature-section')->firstOrFail();
        $newsletter_section = GeneralInformation::where('type', 'newsletter-section')->firstOrFail();

        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();
        $featured_packages = Package::where('is_featured', 1)->get();

        return view('frontend.home2', compact('service_image', 'about_image', 'sliders', 'countries', 'partners', 'services', 'whatsapp',
            'journey_section', 'feature_section', 'newsletter_section','featured_packages'));
    }

    public function countries()
    {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        $countries = Country::WhereHas('packagesHome')->orderBy('country_order', 'ASC')->get();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();
        $info = GeneralInformation::where('type', 'packages')->first();

        return view('frontend.packages-all', compact('sliders', 'countries', 'whatsapp', 'info'));
    }

    public function search(Request $request)
    {
        $model = Package::orderBy('packages.package_order', 'ASC');
        $country = null;
        if (isset($request->country) && $request->country != '') {
            $country = Country::where('symbol', $request->country)->first();
            $model->where('country', $country->id);
        } else {
            return redirect()->route('packages.countries');
        }
        if (isset($request->month) && $request->month != '' && $request->month != '0' && $request->month != 'Month') {
            // $model->whereMonth('date', $request->month);
//            $model->where(function ($q) use ($request) {
//                $q->whereMonth('publish_date', '<=', $request->month)
//                    ->orWhereMonth('suppress_date', '>=', $request->month);
//            });
            $model->whereMonth('publish_date', '<=', $request->month)
                ->WhereMonth('suppress_date', '>=', $request->month);
        } else {
            $selected_month = null;
        }

        if ($country && isset($country->header_image) && $country->header_image != '') {
            $countyPageBack = url('storage/images/country/' . $country->header_image);
        } else {
            $countyPageBack = '';
        }
        if (isset($request->type) && $request->type != '') {
            $model->whereHas('types', function ($query) use ($request) {
                $query->whereIn('type_id', $request->type);
            });
        }

        if (isset($request->offer) && $request->offer != '') {
            $model->whereHas('offers', function ($query) use ($request) {
                $query->whereIn('offer_id', $request->offer);
            });
        }

        $price_from = 0;
        $price_to = 450;
        if (isset($request->price)) {
            $price = explode(',', $request->price);
            if (isset($price[0]))
                $price_from = $price[0];
            if (isset($price[1]))
                $price_to = $price[1];
        }


        $date_from = 1;
        $date_to = 12;
        if (isset($request->date)) {
            $date = explode(',', $request->date);
            if ($date[0] != '' && $date[1] != '') {
                $model->whereMonth('date', '>=', $date[0]);
                $model->whereMonth('date', '<=', $date[1]);
                $date_from = $date[0];
                $date_to = $date[1];
            }
        }
        $packages = $model->whereHas('packageHotels')->Active()->NotDraft()->Publish()->get();

        $sliders = Slider::orderBy('id', 'DESC')->get();
        $countries = Country::WhereHas('packagesHome')->orderBy('country_order', 'ASC')->get();
        $types = Type::orderBy('id', 'ASC')->get();
        $offers = Offer::orderBy('id', 'ASC')->get();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.packages')->with([
            'sliders' => $sliders,
            'countries' => $countries,
            'packages' => $packages,
            'country' => $country,
            'countyPageBack' => $countyPageBack,
            'types' => $types,
            'offers' => $offers,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'whatsapp' => $whatsapp]);
    }

    public function details(Request $request, $symbol, $hotel)
    {
        OrderTour::where('session_id', Session::getId())->delete();
        $package = Package::where('symbol', $symbol)->firstOrFail();
        $Hotel = Hotel::where('symbol', $hotel)->firstOrFail();
        $slider_photos = PackageSlider::where('package_id', $package->id)->get();
        $hotelPackage = PackageHotel::where('package_id', $package->id)->where('hotel_id', $Hotel->id)->firstOrFail();
        $hotelPricings = PackageHotelPricingDetail::where('package_hotel_id', $hotelPackage->id)->get();
        $segments = PackageHotelSegment::where('package_id', $package->id)->where('main_hotel_id', $Hotel->id)->where('package_hotel_id', $hotelPackage->id)->get();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.details')->with(['package' => $package, 'slider_photos' => $slider_photos, 'hotel' => $Hotel,
            'hotelPackage' => $hotelPackage, 'segments' => $segments,
            'hotelPricings' => $hotelPricings, 'whatsapp' => $whatsapp]);
    }

    public function blogs()
    {
        $allblogs = Blog::orderBy('id', 'DESC')->get();
        $info = GeneralInformation::where('type', 'blog')->firstOrFail();
        $whatsapp = SiteSetting::where('name', 'whatsapp')->first();

        return view('frontend.blogs')->with(['allblogs' => $allblogs, 'info' => $info, 'whatsapp' => $whatsapp]);
    }

    public function addNewsletter(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptchav3:newsletter,0.5'
        ]);
        $data = $request->all();
        $old = Newsletter::where('email', $data['email'])->first();

        if (!$old)
            Newsletter::create($data);

        Alert::success('', trans('alert.success-add-newsletter'))->showConfirmButton(trans('alert.confirmButtonOk'));
        return redirect()->route('home');
    }
}
