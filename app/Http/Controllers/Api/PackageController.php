<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Package\ListPackageResource;
use App\Http\Resources\Package\PackageResource;
use App\Package;
use App\PackageHotel;
use App\Hotel;
use App\Enquiry;
use App\Room;
use App\PackageSlider;
use App\PackageHotelPricingDetail;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Mail\UserEnquiry;


class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = new Package();

        if (isset($request->month) && $request->month != '' && $request->month != '0' && $request->month != 'Month') {
            $query->whereMonth('publish_date', '<=', $request->month)
            ->WhereMonth('suppress_date', '>=', $request->month);
        }

        try {
            $results = $query->whereHas('packageHotels')
            ->where('country', $request->country_id)
            ->Active()->NotDraft()->Publish()
            ->orderBy('packages.package_order', 'ASC')
            ->paginate(10);
            return new ListPackageResource($results);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function view(Request $request)
    {
        $data = $request->all();
        $validatedData = Validator::make($data, [
            'package_id' => ['required', 'integer',
                Rule::exists('packages', 'id')
            ],
            'hotel_id' => ['required', 'integer',
                Rule::exists('hotels', 'id')
            ],
        ]);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                "message" => trans('exception.Validation-Error'),
                'data' => $validatedData->errors(),
                "count" => count($validatedData->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }

        try {
            $result = Package::findOrFail($data['package_id']);
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new PackageResource($result),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function sendEnquiry(Request $request){

        if (isset($request->form)) {

            $formData = $request->input('form');
            $decodedFormData = urldecode($formData);
            parse_str($decodedFormData, $formArray);

            $dataEnquiry['package_hotel_id'] = $formArray['hotel_package_id'];            
            $dataEnquiry['package_id'] = $formArray['package_id'];
            $dataEnquiry['hotel_id'] = $formArray['hotel_id'];
            $dataEnquiry['cost'] = $formArray['cost'];
            $dataEnquiry['num_room'] = $formArray['room-counter'];

            
            // if(isset($formArray['is_booking']) && $formArray['is_booking'] === '0')
            //     $dataEnquiry['is_enquiry'] = 0;
            
            $enquiry = new Enquiry();
            $enquiry->package_hotel_id = $dataEnquiry['package_hotel_id'];
            $enquiry->package_id = $dataEnquiry['package_id'];
            $enquiry->hotel_id = $dataEnquiry['hotel_id'];
            $enquiry->cost = $dataEnquiry['cost'];
            $enquiry->num_room = $dataEnquiry['num_room'];
               
            if ($request->member_id !== null && $request->member_id !== "0") {
                $enquiry->member_id = intval($request->member_id);
            }

            if (isset($formArray['is_booking']) && $formArray['is_booking'] === '0')
                $enquiry->is_enquiry = 0;
        
            $enquiry->complete = '1';
            
            $enquiry->name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->phone = $request->phone;
            $enquiry->address = $request->address;
            $enquiry->message = $request->message;

            $enquiry->save();

            $all_person = 0;
            if ($enquiry) {
                $dataRoom['package_id'] = intval($dataEnquiry['package_id']);
                $dataRoom['enquiry_id'] = $enquiry->id;
                $dataRoom['member_id'] = intval($enquiry->member_id);

                for ($i = 0; $i < $dataEnquiry['num_room']; $i++) {

                    $dataRoom['num_adult'] = $request->input('num-adult-' . $i);
                    $all_person = $all_person + $dataRoom['num_adult'];
                    $num_child_0_n = $request->input('num-Child-0-' . $i);
                    $num_child_1_n = $request->input('num-Child-1-' . $i);

                    if (isset($num_child_0_n) && isset($num_child_1_n)) {
                        $dataRoom['num_child'] = $request->input('num-child-' . $i);
                        $dataRoom['age_child_1'] = $request->input('num-Child-0-' . $i);
                        $dataRoom['age_child_2'] = $request->input('num-Child-1-' . $i);
                    } else {
                        $dataRoom['num_child'] = 0;
                        $dataRoom['age_child_1'] = 0;
                        $dataRoom['age_child_2'] = 0;
                    }
                    $all_person = $all_person + $dataRoom['num_child'];
                    $dataRoom['room_cost'] = $request->input('room-cost-' . $i);
                    Room::create($dataRoom);
                }
            }
        }

        try {
            DB::beginTransaction();
            $package = Package::findOrFail($enquiry->package_id);
            $package->update(['used' => ($package->used + $all_person)]);

            Mail::to($enquiry->enquiry_email())->send(new UserEnquiry($enquiry));
            Mail::to(config("app.to.address"))->send(new \App\Mail\Enquiry($enquiry));
    
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    "success" => false,
                    "message" => "Enquiry has not been sent",
                    "status" => 422,
                ], 422);
        }

        return response()->json(
            [
                "success" => true,
                "message" => "Enquiry has been sent successfully",
                "data" => $enquiry,
                "total" => 1,
                "status" => 200,
            ], 200);
    }
}
