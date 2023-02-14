<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function createCourte(Request $request)
    {

        if (!$request->isJson()) {
            return response()->json(array('status' => false, 'data' => null, 'errors' => array("Invalid Request")), 400);
        }

        $validator = Validator::make($request->all(), [
            "courtename" => "required|string|min:3",
            "address" => "required|string|min:3",
            "city" => "required|string|min:3",
        ]);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'data' => null, 'errors' => $validator->errors()->all()), 400);
        } else {
            $court = new court;
            $court->court_name = $request->input('courtename');
            $court->address = $request->input('address');
            $court->city = $request->input('city');
            if ($court->save()) {
                event(new SendMail($court->id));
                return response()->json(array('status' => true, 'data' => $court, 'errors' => array()));
            }
            return response()->json(array('status' => true, 'data' => $court, 'errors' => array("Fail to create court")));
        }
    }

    public function getCourte($id)
    {
        $getcourt = court::find($id);
        return response()->json(array('status' => true, 'data' => $getcourt, 'errors' => array()));
    }
}
