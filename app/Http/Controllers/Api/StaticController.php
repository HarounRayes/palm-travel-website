<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Support\Facades\Config;

class StaticController extends Controller
{
    public function general_info()
    {
        $IATA_Logo = SiteSetting::where('name', 'IATA_Logo')->first();

        return response()->json([
            "success" => true,
            "message" => "",
            "data" => [
                'site_name' => Config::get('site_settings.site_name'),
                'phone' => Config::get('site_settings.office'),
                'email' => Config::get('site_settings.email'),
                'facebook' => Config::get('site_settings.facebook'),
                'twitter' => Config::get('site_settings.twitter'),
                'youtube' => Config::get('site_settings.youtube'),
                'instagram' => Config::get('site_settings.instagram'),
                'main_office' => Config::get('site_settings.main_office'),
                'whatsapp' => Config::get('site_settings.whatsapp'),
                'apple_store' => Config::get('site_settings.apple'),
                'google_play' => Config::get('site_settings.google'),
                'active_activity' => (Config::get('global_models.activity') == "1") ? 1 : 0,
                'active_outbound_isa' => (Config::get('global_models.outboundVisa') == "1") ? 1 : 0,
                'active_use_visa' => (Config::get('global_models.uaeVisa') == "1") ? 1 : 0,
                'intro_title' => Config::get('intro_title'),
                'intro_value' => Config::get('intro_value'),
                'master_card_img' => asset('img/master-card.png'),
                'visa_img' => asset('img/visa.png'),
                'iata_logo' => ($IATA_Logo->value != '') ? url('storage/app/public/images/settings/' . $IATA_Logo->value) : "",
                'messenger_id' => '105961591242843',
                'whit_logo' => asset('img/logo-white.png'),
                'logo' => asset('img/logo.png')

            ],
            "total" => 1,
            "status" => 200
        ]);
    }
}
