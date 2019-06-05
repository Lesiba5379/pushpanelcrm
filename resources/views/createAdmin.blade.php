@extends('layouts.layout')

@section('content')

{!! Form::open(['action' => 'ManageAccounts@createAdministrator','method' => 'POST']) !!}



@if ($errors->any())

  <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
          <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
          </ul>  
    </div>
  </div>
@endif



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



       <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>User Details:</h4>
        </div>



        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">

                    <a href="/home" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>

                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" name="name" class="form-text" id="name" required>  
                          <span class="bar"></span>
                          <label for="address_1">Name:</label>
                    </div>
                        
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" name="email" class="form-text" id="email" required>  
                        <span class="bar"></span>
                        <label for="town_city">Email Address:</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                         <select name="superType">
                             <option value ="0">Super-Administrator</option>
                             <option value ="1">Administrator</option>
                             <option value ="2">Employee</option>
                         </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Create Account</button> 
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}
@endsection