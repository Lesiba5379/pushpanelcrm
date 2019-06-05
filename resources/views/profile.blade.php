@extends('layouts.layout')

@section('content')
{!! Form::open(['action' => 'CreateProfilesController@store','method' => 'POST']) !!}

<div class="col-md-12">
    <div class="col-md-12 panel">
       <div class="col-md-12 panel-heading">
            <h4>client details:</h4>
       </div>
       <div class="col-md-12 panel-body">
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
                   <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="name" class="form-text" id="name" required>  
                                <span class="bar"></span>
                            <label for="name">Company Name:</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="email" class="form-text" id="email" required>  
                                <span class="bar"></span>
                            <label for="name">E-mail Address:</label>
                    </div> 


            </div>
       </div>
    </div>   
</div>


<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>address details:</h4>
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
    
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="address_1" class="form-text" id="address_1" required>  
                                <span class="bar"></span>
                            <label for="address_1">Address Line 1:</label>
                        </div>
                        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="town_city" class="form-text" id="town_city" required>  
                                <span class="bar"></span>
                            <label for="town_city">City/Town:</label>
                        </div>
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" name="province" class="form-text" id="province" required>  
                                <span class="bar"></span>
                            <label for="province">Province:</label>
                        </div>
                                            
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
        <div class="col-md-12 panel">
           <div class="col-md-12 panel-heading">
                <h4>contact information:</h4>
           </div>
           <div class="col-md-12 panel-body">
                <div class="col-md-12">
        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" name="postal_code" class="form-text" id="postal_code" required>  
                                    <span class="bar"></span>
                                <label for="postal_code">Postal Code:</label>
                         </div>
                            
                         <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" name="telephone" class="form-text" id="telephone" required>  
                                    <span class="bar"></span>
                                <label for="telephone">Telephone:</label>
                         </div>
                            
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" name="mobile" class="form-text" id="mobile" required>  
                                    <span class="bar"></span>
                                <label for="mobile">Mobile:</label>
                        </div>
                            
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" name="contact_person" class="form-text" id="contact_person" required>  
                                    <span class="bar"></span>
                                <label for="contact_person">Contact person:</label>
                        </div>               
                        
                </div>
           </div>
        </div>    
</div>
<div class="col-md-12">
        <div class="col-md-12 panel">
           <div class="col-md-12 panel-heading">
                <h4>more information:</h4>
           </div>
           <div class="col-md-12 panel-body">
                <div class="col-md-12">        
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" name="vat" class="form-text" id="vat" required>  
                                    <span class="bar"></span>
                                <label for="vat">VAT Number:</label>
                        </div> 
                        <!--button for creating user and accountw --->
                        <button type="submit" class="btn btn-danger mb-2" style="width: 85px">Create profile</button>
                </div>
           </div>
        </div>  
</div>
{!! Form::close() !!}

@endsection
