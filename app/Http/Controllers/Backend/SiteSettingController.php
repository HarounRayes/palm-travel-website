<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{

    private $imagePath = "public/images/settings/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:setting.edit.en|setting.edit.ar')->only(['edit', 'update']);
    }

    public function index()
    {
        $settings = SiteSetting::orderBy('id', 'DESC')->get();
        return view('backend.setting.index')->with(['settings' => $settings]);
    }

    public function edit($id)
    {
        $setting = SiteSetting::findOrFail($id);
        if (in_array($setting->type, ['link', 'phone', 'email']))
            return view('backend.setting.edit-without-lang')->with(['setting' => $setting]);
        elseif (in_array($setting->type, ['dropdown']))
            return view('backend.setting.edit-dropdown')->with(['setting' => $setting]);
        elseif ($setting->type == 'logo')
            return view('backend.setting.edit-logo')->with(['setting' => $setting]);
        else
            return view('backend.setting.edit-with-lang')->with(['setting' => $setting]);

    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->validate([
            'value_en' => 'nullable',
            'value_ar' => 'nullable'
        ]);
        $setting = SiteSetting::findOrFail($id);

        if (in_array($setting->type, ['link', 'phone', 'email']))
            $dataIn['value_ar'] = $dataIn['value_en'];

        if ($setting->type == 'logo')
        {
            if ($request->has('logo') != null) {
                if (File::exists(storage_path('/public/images/settings/' . $setting->value_ar))) {
                    File::delete(storage_path('/public/images/settings/' . $setting->value_ar));
                }
                $imageName = time() . '.logo' . $setting->id . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->storeAs($this->imagePath, $imageName);

                $dataIn['value_ar'] = $dataIn['value_en'] = $imageName;
            }
        }

        $setting->update($dataIn);
        return redirect()->route('admin.settings.index');

    }

}
