<?php

namespace App\Http\Controllers;
use App\Good as Good;

use Illuminate\Http\Request;

class GoodController extends Controller
{
  function register(Request $request){
    $driver_id = $request->input('driver_id');
    $description = $request->input('description');
    $status = $request->input('status', 'unloaded');
    $region_id = $request->input('region_id');
    $driver = Good::create(['driver_id' => $driver_id, 'description' => $description, 'status' => $status, "region_id" => $region_id]);
    return redirect()->route('home')->with('success', 'Added product successfully');
  }

  function getGood(Request $request){
    $status = $request->input('status', null);
    $goods = null;
    if($status != null){
      $goods = Good::orderBy('created_at', 'desc')->where('status', $status)->get();
    }else {
      $goods = Good::orderBy('created_at', 'desc')->get();
    }
    $unloaded = Good::where('status', 'unloaded')->get()->count();
    $buffer = Good::where('status', 'buffer')->get()->count();
    $delivered = Good::where('status', 'delivered')->get()->count();
    return view('welcome')->with(['goods' => $goods, 'unloaded' => $unloaded, 'buffer' => $buffer, 'delivered' => $delivered]);
  }

  function deleteGood(Request $request){
    $id = $request->input('id', null);
    if($id != null){
      $deleted_driver = Good::where('id', $id)->delete();
    }
    return redirect()->route('home')->with('success', 'Deleted successfully');
  }

  function changeStatus(Request $request){
    $status = $request->input('status', null);
    $id = $request->input('id', null);
    if($id != null && $status != null){
      $good = Good::where('id', $id)->first();
      $good->status = $status;
      $good->save();

      return redirect()->route('home')->with('success', 'Updated status successfully');
    }
  }
}
