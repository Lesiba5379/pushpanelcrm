@extends('layouts.layout')

@section('content')

<div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                    @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                    @endforeach
               </ul>
            </div>
        @endif
</div>

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
                <h4>add employee:</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <a href="/viewCompany/{{request()->route('id')}}" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>
        {!! Form::open(['action' => 'ManageAccounts@addEmployee','method' => 'POST']) !!}
        
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="name"  class="form-text" id="name" required>  
                      <span class="bar"></span>
                      <label for="name">Name:</label>
            </div>

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="email"  class="form-text" id="email" required>  
                      <span class="bar"></span>
                      <label for="address">Email Address:</label>
            </div>
            <input type="hidden" name="urlId" id="urlId" value="{{request()->route('id')}}"/>
            <button type="submit" class="btn btn-danger">Add Employee</button> 

        </div>     
</div>
</div>
{!! Form::close() !!}
@endsection
<script>
      function addEmployee(){

            //get data from the form
            var name = document.getElementById('name').value; 
            var email = document.getElementById('email').value;
            var urlId = document.getElementById('urlId').value;


            //simple validation
            if(name == "" || email == "" || urlId == ""){
                //do not sent data to the backend.
            }else{
                sendData(name,email,urlId);
            }

      }

      /**
       *@name { sendData }
       *@argument {name, email,urlId}
       *@function
       * sends arg to the backend to be written on the database, by Lesiba Nxumalo.
       */
      function sendData(name,email,urlId){
                $.ajax({
                    type: "POST",
                    url: "/addEmployee",
                    data: {
                            'id':urlId,
                            'name': name,
                            'email': email,
                            "_token": "{{ csrf_token() }}",
                    },
                 })
                .done(function(data){

                  if(data == '1'){
                       alert('success: data pushed');
                  }else{
                       alert('error: could not push data');
                  }
                   console.log('success: from send data function: ' + data);
                })
                .fail(function(data){
                    console.log('error: from send data function: ' + data);
                });
      }

</script>