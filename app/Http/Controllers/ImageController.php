<?php


namespace App\Http\Controllers;


use App\Country;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
public function getCountryImage($name){

    if($name == null){
        $path = '';
    }else{
        $path = Storage::url($name);
        $exists = Storage::exists($path);

        if(!$exists){
            $path = '';
        }
    }
    $image = Storage::get($path);
    $mimeType = Storage::mimeType($path);
//
    return response($image, 200)
        ->header('Content-Type', $mimeType);
//    var_dump(Storage::disk('public')->url($name));die();
     ;
//    return \Illuminate\Support\Facades\Storage::url($name);
}

}
