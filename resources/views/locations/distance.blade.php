@extends('locations.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Test-App</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('locations.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th width="280px">Check Distance</th>
        </tr>
        @foreach ($locations as $location)
        <tr>
            <td>{{ $location->id }}</td>
            <td>{{ $location->latitude }}</td>
            <td>{{ $location->longitude }}</td>
            <td><a class="btn btn-success" onclick="getLocation('{{$location->latitude}}', '{{$location->longitude}}', '{{$location->id}}')"> Check Distance</a> <p id="distance{{$location->id}}"></p></td>
        </tr>
        @endforeach
    </table>
    <input type="hidden" name="lat" id="lat"/>
    <input type="hidden" name="long" id="long"/>
    <input type="hidden" name="id" id="id"/>

<script>
    function getLocation(lat, long, id) {
        document.getElementsByName("lat")[0].value = lat;
        document.getElementsByName("long")[0].value = long;
        document.getElementsByName("id")[0].value = id;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            var x = document.getElementById("distance"+id);
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        var getDistance = getDistanceFromLatLonInKm(position.coords.latitude, position.coords.longitude, document.getElementById('lat').value, document.getElementById('long').value);
        var id = document.getElementById('id').value;
        var x = document.getElementById("distance"+id);
        console.log(x);
        x.innerHTML = getDistance;
    }

    function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        console.log(lat1, lon1, lat2, lon2);
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1); 
        var a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2)
            ; 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c; // Distance in km
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180)
    }
    
</script>
      
@endsection