<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    private $imagePath = "public/images/service/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:services.create.en|services.create.ar')->only(['create', 'store']);
        $this->middleware('permission:services.edit.en|services.edit.ar')->only(['edit', 'update']);
        $this->middleware('permission:services.delete')->only('destroy');
    }

    public function index()
    {
        $services = Service::orderBy('id', 'DESC')->get();

        return view('backend.service.index')->with(['services' => $services]);
    }

    public function create()
    {
        return view('backend.service.create');
    }

    public function store(Request $request)
    {
        $service = Service::create($request->all());
        if ($request->has('icon') != null) {
            $imageName = time() . '.icon' . $service->id . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->storeAs($this->imagePath, $imageName);
            $service->update(['icon' => $imageName]);
        }

        return redirect()->route('admin.services.index');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('backend.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $dataUp = $request->all();
        if ($request->has('icon') != null) {
            if (File::exists(storage_path('/public/images/service/' . $service->icon))) {
                File::delete(storage_path('/public/images/service/' . $service->icon));
            }
            $imageName = time() . '.icon' . $service->id . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->storeAs($this->imagePath, $imageName);
            $dataUp['icon'] = $imageName;
        }

        $service->update($dataUp);
        return redirect()->route('admin.services.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services.index');
    }
    public function showOrderForm()
    {
        $services = Service::all();
        return view('backend.service.order', compact('services'));
    }

    public function saveOrder(Request $request)
    {
        if (isset($request->service)) {
            $services = $request->service;
            foreach ($services as $id => $order) {
                $service = Service::findOrFail($id);
                $service->update(['service_order' => $order]);
            }
        }
        return redirect()->route('admin.services.order');
    }
}
