@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>Add Beacons</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif            
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
               @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                         {{session('error')}}
                    </div>
                @endif
                
                <a href="/addBeacon" class="btn btn-danger mb-2"><i class="fa fa-arrow-circle-left"></i></a><br/><br/>

                {!! Form::open(['action' => 'BeaconsController@store','method' => 'POST']) !!}
                <div class="row" style="margin-bottom: -55px">
                    <div class="form-group form-animate-text col-lg-6" style="margin-top:40px !important;">
                        <input type="text" name="IBeaconUUID" class="form-text" id="IBeaconUUID" required>  
                            <span class="bar"></span>
                        <label for="beaconID">IBeacon UUID:</label>
                    </div>
                    <div class="form-group form-animate-text col-lg-6" style="margin-top:40px !important;">
                        <input type="text" name="EddystoneNamespace" class="form-text" id="EddystoneNamespace" required>  
                            <span class="bar"></span>
                        <label for="beaconID">Eddystone Namespace:</label>
                    </div>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="uuid" class="form-text" id="uuid" required>  
                        <span class="bar"></span>
                    <label for="email">Beacon UUID:</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <label for="product" style="margin-top:-40px !important;">Type product:</label>
                    <select class="form-control" name="selectProduct[]" required>
                        <option value="Smart Beacon SB16-2">Smart Beacon SB16-2</option>
                        <option value="Tough Beacon TB15-1">Tough Beacon TB15-1</option>
                        <option value="USB Beacon UB16-2">USB Beacon UB16-2</option>
                        <option value="Card Tag CT16-2">Card Tag CT16-2</option>
                        <option value="Beacon Pro BP16-3">Beacon Pro BP16-3</option>
                        <option value="Asset Tag S18-3">Asset Tag S18-3</option>
                        <option value="Beacon HD18-3">Beacon HD18-3</option> 
                        <option value="Gateway GW16-2">Gateway GW16-2</option>
                  </select>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                     <label for="assign" style="margin-top:-40px !important;">Assign to:</label>
                     <select id="select" class="selectpicker form-control" name="assignTo[]" required>
                        @foreach($companies as $x)
                            <option value="{{ $x->id }}">{{ $x->name}}</option>
                        @endforeach 
                    </select>
                </div>
                <button type="submit" class="btn btn-danger mb-2" style="width: 120px">add beacon</button>
              {!! Form::close() !!}
            
            </div>
            
        </div>
    </div>
</div>
@endsection