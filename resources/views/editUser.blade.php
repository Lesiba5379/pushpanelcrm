@extends('layouts.layout')

@section('content')

{!! Form::open(['action' => ['ManageAccounts@updateAccount',$user->id],'method' => 'POST']) !!}

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
            <h4>user details:</h4>
        </div>



        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <div class="col-md-12">

                    <a href="/home" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>

                <form>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                         <input type="text" name="name" class="form-text" id="name" value="{{$user->name}}" required>  
                          <span class="bar"></span>
                          <label for="address_1">Name:</label>
                    </div>
                        
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" name="email" class="form-text" id="email" value="{{$user->email}}"required>  
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
                    <input name="_method" type="hidden" value="PATCH">
                    <button type="submit" class="btn btn-danger">Update Record</button>
                </form>                                            
            </div>
        </div>
    </div>
</div> 


{!! Form::close() !!}
@endsection