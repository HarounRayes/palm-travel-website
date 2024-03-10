<?php

namespace App\Http\Controllers\Backend;

use App\GlobalModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlobalModelController extends Controller
{
    public function update(Request $request, $id)
    {
        $dataIn = $request->validate(['status' => 'required']);
        $model = GlobalModel::findOrFail($id);
        $model->update($dataIn);
        return redirect()->back();
    }
}
