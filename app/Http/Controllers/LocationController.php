<?php

namespace App\Http\Controllers;

use App\Models\GeoLocation;
use Illuminate\Http\Request;
use DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = DB::select('call get_sp()');
        return view('locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);
        $getData = GeoLocation::where(['latitude' => $request->lat, 'longitude' => $request->long])->first();
        if(!empty($getData)){
            return redirect()->back()->withErrors('Location details already exist.');
        }
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = date('Y-m-d H:i:s', time());
        // GeoLocation::create($request->all());
        DB::select('call insert_sp(?, ?, ?, ?)',[$request->lat, $request->long, $created_at, $updated_at]);
   
        return redirect()->route('locations.index')->with('success','Location details created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GeoLocation $location)
    {
        $locationId = $location->id;
        $location = DB::select("call show_sp($locationId)");
        $location = $location[0];
        return view('locations.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeoLocation $location)
    {
        $locationId = $location->id;
        $location = DB::select("call show_sp($locationId)");
        $location = $location[0];
        return view('locations.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeoLocation $location)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);

        $getData = GeoLocation::where(['latitude' => $request->lat, 'longitude' => $request->long])->where('id' , '!=', $location->id)->first();
        if(!empty($getData)){
            return redirect()->back()->withErrors('Location details already exist.');
        }
        $latitude = $request->lat;
        $longitude = $request->long;
        $updated_at = date('Y-m-d H:i:s', time());
        $locationId = $location->id;
        // $location->update($request->all());
        DB::select("call update_sp($latitude, $longitude, '$updated_at', $locationId)");
  
        return redirect()->route('locations.index')->with('success','Location details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeoLocation $location)
    {
        // $location->delete();
        $locationId = $location->id;
        $deleted_at = date('Y-m-d H:i:s', time());
        DB::select("call delete_sp('$deleted_at', $locationId)");
        return redirect()->route('locations.index')->with('success','Location details deleted successfully');
    }

    /**
     * Display a distance with co-ordinates.
     */
    public function distance()
    {
        $locations = DB::select('call get_sp()');
        return view('locations.distance',compact('locations'));
    }

    /**
     * Find distance between two co-ordinates.
     */
    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
