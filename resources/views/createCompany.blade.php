@extends('layouts.layout')

@section('content')

{!! Form::open(['action' => 'ManageAccounts@createCompany','method' => 'POST']) !!}
<div class="col-md-12">

<div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
                <h4>Add Company:</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <a href="/home" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>
            
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                 <input type="text" name="name" class="form-text" id="name" required>  
                      <span class="bar"></span>
                      <label for="name">Company Name:</label>
            </div>

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="email"  class="form-text" id="email" required>  
                      <span class="bar"></span>
                      <label for="address">Email Address:</label>
            </div>
            <br/>
            <button type="submit" class="btn btn-danger">Create Company</button>

        </div>     
</div>
</div> 

{!! Form::close() !!}
@endsection