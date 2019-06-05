@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>Add Profile</h4>
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
                        <a href="/home" class="btn btn-primary pull-left" style="padding-bottom: 5px"><i class="fa fa-arrow-circle-left"></i></a>
    
                    {!! Form::open(['action' => ['ProfilesController@update'],'method' => 'POST']) !!}
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                           <input type="text" name="name" class="form-text" value="{{ $profile->company_name }}" id="name" required>  
                                <span class="bar"></span>
                            <label for="name">Company name:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="address_1" value="{{ $profile->address }}"  class="form-text" id="address_1" required>  
                                <span class="bar"></span>
                            <label for="address_1">Address Line 1:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="town_city" class="form-text" value="{{ $profile->town }}" id="town_city" required>  
                                <span class="bar"></span>
                            <label for="town_city">City/Town:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="province" class="form-text" value="{{ $profile->province }}" id="province" required>  
                                <span class="bar"></span>
                            <label for="province">Province:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="postal_code" class="form-text" value="{{ $profile->postal_code }}"  id="postal_code" required>  
                                <span class="bar"></span>
                            <label for="postal_code">Postal Code:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="telephone" class="form-text" value="{{ $profile->telephone }}" id="telephone" required>  
                                <span class="bar"></span>
                            <label for="telephone">Telephone:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="mobile" class="form-text" value="{{ $profile->mobile }}" id="mobile" required>  
                                <span class="bar"></span>
                            <label for="mobile">Mobile:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="contact_person" value="{{ $profile->contact_person }}" class="form-text" id="contact_person" required>  
                                <span class="bar"></span>
                            <label for="contact_person">Contact person:</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="vat" class="form-text" value="{{ $profile->vat }}" id="vat" required>  
                                <span class="bar"></span>
                            <label for="vat">VAT Number:</label>
                        </div>

                        <input name="id" type="hidden" value="{{$user->id}}"/>

                        <button type="submit" class="btn btn-danger mb-2">update profile</button>
                  {!! Form::close() !!}
            </div> 
        </div>
    </div>
</div>
@endsection