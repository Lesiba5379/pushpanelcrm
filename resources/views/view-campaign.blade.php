@extends('layouts.layout')

@section('content')
<div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>View Campaign:</h4>
            </div>
            <div id="imgContainer" class="col-md-12 panel-body">
               <a href="/listCampaign" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>
                @if(isset($img))
                    <div  align="center">
                      <img src="{{($img)}}" />
                    </div>
                  @else
                    no data 
                  @endif
                    
            </div>    
        </div>
</div>
@endsection