<?php

namespace App\Http\Controllers\Backend;

use App\GeneralInformation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralInformationController extends Controller
{
    private $imagePathInfo = "public/images/info/";

    public function showInfoForm()
    {
        $service_image = GeneralInformation::where('type', 'service-image')->firstOrFail();
        $about_image = GeneralInformation::where('type', 'about-image')->firstOrFail();
        $journey_section = GeneralInformation::where('type', 'journey-section')->firstOrFail();
        $feature_section = GeneralInformation::where('type', 'feature-section')->firstOrFail();
        $newsletter_section = GeneralInformation::where('type', 'newsletter-section')->firstOrFail();

        return view('backend.home.images', compact('service_image', 'about_image','journey_section' ,'feature_section' ,'newsletter_section'));
    }

    public function saveInfo(Request $request)
    {

        $dataIn = $request->all();

        //video section
        $service_image = GeneralInformation::where('type', 'service-image')->firstOrFail();
        $service_image_data = [];
        if (isset($dataIn['is_image']) && $dataIn['is_image'] == 1) {
            if ($request->has('service_image') != null) {
                if (File::exists(storage_path($this->imagePathInfo . $service_image->header_image_en))) {
                    File::delete(storage_path($this->imagePathInfo . $service_image->header_image_en));
                }
                $imageName = time() . '.homeserviceimage' . $service_image->id . '.' . $request->service_image->getClientOriginalExtension();
                $request->service_image->storeAs($this->imagePathInfo, $imageName);
                $service_image_data['header_image_en'] = $imageName;
                $service_image_data['header_image_ar'] = $imageName;
                $service_image_data['is_image'] = 1;

            }
        } else {
            $service_image_data['header_image_en'] = $dataIn['service_video'];
            $service_image_data['header_image_ar'] = $dataIn['service_video'];
            $service_image_data['is_image'] = 0;
        }
        $service_image_data['intro_en'] = $dataIn['video_text_en'];
        $service_image_data['intro_ar'] = $dataIn['video_text_ar'];
        $service_image_data['title_section_1_en'] = $dataIn['video_title_en'];
        $service_image_data['title_section_1_ar'] = $dataIn['video_title_ar'];

        $service_image->update($service_image_data);

        // about section
        $about_image = GeneralInformation::where('type', 'about-image')->firstOrFail();
        $about_image_data = [];
        if ($request->has('about_image_en') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $about_image->header_image_en))) {
                File::delete(storage_path($this->imagePathInfo . $about_image->header_image_en));
            }
            $imageName = time() . '.homeaboutimageen' . $about_image->id . '.' . $request->about_image_en->getClientOriginalExtension();
            $request->about_image_en->storeAs($this->imagePathInfo, $imageName);
            $about_image_data['header_image_en'] = $imageName;
        }
        if ($request->has('about_image_ar') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $about_image->header_image_ar))) {
                File::delete(storage_path($this->imagePathInfo . $about_image->header_image_ar));
            }
            $imageName = time() . '.homeaboutimage' . $about_image->id . '.' . $request->about_image_ar->getClientOriginalExtension();
            $request->about_image_ar->storeAs($this->imagePathInfo, $imageName);
            $about_image_data['header_image_ar'] = $imageName;
        }
        $about_image_data['intro_en'] = $dataIn['about_text_en'];
        $about_image_data['intro_ar'] = $dataIn['about_text_ar'];
        $about_image_data['title_section_1_en'] = $dataIn['about_title_en'];
        $about_image_data['title_section_1_ar'] = $dataIn['about_title_ar'];
        $about_image->update($about_image_data);

        $journey_section = GeneralInformation::where('type', 'journey-section')->firstOrFail();
        $journey_section_data['intro_en'] = $dataIn['journey_text_en'];
        $journey_section_data['intro_ar'] = $dataIn['journey_text_ar'];
        $journey_section_data['title_section_1_en'] = $dataIn['journey_title_en'];
        $journey_section_data['title_section_1_ar'] = $dataIn['journey_title_ar'];
        $journey_section->update($journey_section_data);

        $feature_section = GeneralInformation::where('type', 'feature-section')->firstOrFail();
        $feature_section_data['intro_en'] = $dataIn['feature_text_en'];
        $feature_section_data['intro_ar'] = $dataIn['feature_text_ar'];
        $feature_section_data['title_section_1_en'] = $dataIn['feature_title_en'];
        $feature_section_data['title_section_1_ar'] = $dataIn['feature_title_ar'];
        $feature_section->update($feature_section_data);

        $newsletter_section = GeneralInformation::where('type', 'newsletter-section')->firstOrFail();
        $newsletter_section_data['intro_en'] = $dataIn['newsletter_text_en'];
        $newsletter_section_data['intro_ar'] = $dataIn['newsletter_text_ar'];
        $newsletter_section_data['title_section_1_en'] = $dataIn['newsletter_title_en'];
        $newsletter_section_data['title_section_1_ar'] = $dataIn['newsletter_title_ar'];
        $newsletter_section->update($newsletter_section_data);

        return redirect()->route('admin.home.info');
    }

    public function showPackagesInfoForm()
    {
        $info = GeneralInformation::where('type', 'packages')->firstOrFail();
        return view('backend.home.info', compact('info'));
    }

    public function savePackagesInfo(Request $request)
    {
        $info = GeneralInformation::where('type', 'packages')->firstOrFail();
        $dataUp = $request->all();
        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_en))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_en));
            }
            $imageName = time() . '.visainfoheaderimageen' . $info->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_ar))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_ar));
            }
            $imageName = time() . '.visainfoheaderimagear' . $info->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $info->update($dataUp);
        return redirect()->route('admin.packages.info');
    }

}
