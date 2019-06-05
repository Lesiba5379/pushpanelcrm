@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>Order</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">
                
                {!! Form::open(['action' => 'FirebaseController@NewOrder', 'method' => 'POST']) !!}
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        {{Form::text('Quantity', '', ['class' => 'form-text'])}}
                        <span class="bar"></span>
                        {{Form::label('Quantity', 'Quantity')}}
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        
                        <!--{{Form::label('BeaconType', 'Beacon Type')}}-->
                        <span class="bar"></span>
                        {{Form::select('BeaconType',['Gateways' => ['gateway200' => 'Gateways 200', 'gateway300' => 'Gateways 300'],
                        'Beacons' => ['SB-12' => 'Smart Beacon SB-12', 'SB-13' => 'Smart Beacon SB-13', 'SC-00' => 'Smart Card' ]])}}
                    </div>
                    {{Form::submit('Submit', ['class'=>'btn btn-danger'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection