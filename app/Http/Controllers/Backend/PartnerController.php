<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    private $imagePath = "public/images/partner/";
    public function index()
    {
        $partners = Partner::orderBy('id', 'DESC')->get();
        return view('backend.partner.index')->with([
            'partners' => $partners
        ]);
    }

    public function create()
    {
        return view('backend.partner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);
        $dataUp = [];
        $dataIn = $request->all();

        $partner = Partner::create($dataIn);

        if ($request->has('image') != null) {
            $imageName = time() . '.partner_image' . $partner->id . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs($this->imagePath, $imageName);
            $dataUp['image'] = $imageName;
        }

        $partner->update($dataUp);
        return redirect('admin/partners');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('backend.partner.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $partner = Partner::findOrFail($id);

        if ($request->has('image') != null) {
            if (File::exists(storage_path('/public/images/partner/' . $partner->image))) {
                File::delete(storage_path('/public/images/partner/' . $partner->image));
            }
            $imageName = time() . '.image' . $partner->id . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs($this->imagePath, $imageName);
            $dataUp['image'] = $imageName;
        }

        $partner->update($dataUp);

        return redirect('admin/partners');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        try {
            $partner->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect('admin/partners');
    }
}
