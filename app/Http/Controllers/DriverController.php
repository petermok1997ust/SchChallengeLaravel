<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver as Driver;

class DriverController extends Controller
{
    function getDriver(){
      $drivers = Driver::orderBy('created_at', 'desc')->get();
      return view('driver')->with(['drivers' => $drivers]);
    }

    function register(Request $request){
      $last_name = $request->input('last_name');
      $first_name = $request->input('first_name');
      $identity = $request->input('identity');
      $phone = $request->input('phone');
      $car_liscene = $request->input('car_liscene');
      $country_of_liscene = $request->input('country_of_liscene');
      $company = $request->input('company');
      $driver = Driver::create(['last_name' => $last_name, 'first_name' => $first_name, 'phone' => $phone, "identity" => $identity, 'car_liscene' => $car_liscene, 'country_of_liscene' => $country_of_liscene, 'company' => $company]);
      return redirect()->route('driver')->with('success', 'Registered Successfully');
    }

    function deleteDriver(Request $request){
      $id = $request->input('id', null);
      if($id != null){
        $deleted_driver = Driver::where('id', $id)->delete();
      }
      return redirect()->route('driver')->with('success', 'Deleted Successfully');
    }
}
