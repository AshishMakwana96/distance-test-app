@extends('locations.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show location</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('locations.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Latitude:</strong>
                {{ $location->latitude }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Longitude:</strong>
                {{ $location->longitude }}
            </div>
        </div>
    </div>
@endsection