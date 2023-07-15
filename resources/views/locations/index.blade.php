@extends('locations.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Test-App</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('locations.create') }}"> Create New Location</a>
                <a class="btn btn-success" href="{{ route('locations.distance') }}"> Distance Location</a>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($locations as $location)
        <tr>
            <td>{{ $location->id }}</td>
            <td>{{ $location->latitude }}</td>
            <td>{{ $location->longitude }}</td>
            <td>
                <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('locations.show',$location->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('locations.edit',$location->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      
@endsection