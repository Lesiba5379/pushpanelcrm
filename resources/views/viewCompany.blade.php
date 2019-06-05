@extends('layouts.layout')

@section('content')

{!! Form::open(['action' => 'ManageAccounts@updateCompany','method' => 'POST']) !!}
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
                <h4>Company Profile:</h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
            <a href="/home" class="btn btn-danger mb-2" style="margin-bottom: 15px"><i class="fa fa-arrow-circle-left"></i></a>
            
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="name" value="{{$company->name}}" class="form-text" id="name" required disabled>  
                      <span class="bar"></span>
            </div>

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="hidden" id="urlId" name="urlId" value="{{request()->id}}">
                    <input type="text" name="email" value="{{$company->email}}" class="form-text" id="email" required disabled>  
                      <span class="bar"></span>
            </div>
            <button type="submit" class="btn btn-success">Update</button> 

            <button type="button" class="btn btn-primary" onclick="enableEditText()">Edit</button> 

        </div>    
</div>
</div>
{!! Form::close() !!}


<div class="col-md-12">

        <div class="col-md-12 panel">
                <div class="col-md-12 panel-heading">
                        <h4>Employee(s)</h4>
                </div>
                <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                    <a href="/viewEmployee/{{request()->route('id')}}" class="btn btn-primary mb-2" style="margin-bottom: 15px"><i class="fa fa-plus"></i></a>
                    
                    <table class="table table-hover" id="tblEndUsers">
                            <thead>
                                    <tr> 
                                        <th>Employee Name</th>       
                                        <th>Email address</th>
                                        <th>Type</th>
                                        <th>Edit / Remove</th>
                                        <th>Assign Beacon</th>
                                        <th>Beacon(s)</th>
                                     </tr>
                            </thead>
                            <tbody>
                                 @if (count($emp) > 0)
                                     @foreach ($emp as $x)
                                      @if ($x->user_id == request()->id)
                                          
                                     
                                        <tr>
                                           <td>{{$x->name}}</td>
                                           <td>{{$x->email}}</td>
                                           <td>end-user</td>
                                           <td>
                                                <a href="" class="btn btn-success mb-2"
                                                           data-toggle="tooltip" title="edit end-user">                            
                                                    <i class="fa fa-edit"></i> 
                                                </a>
                                                <button onclick = "deleteEndUser('{{$company->id}}')" class="btn btn-danger mb-2"
                                                        data-toggle="tooltip" title="delete end-user">                            
                                                        <i class="fa fa-trash"></i>
                                                </button>
                                           </td>
                                           <td>
                                               <select name="beacon" id="a" class="assignBeacon" multiple>
                                                   @foreach ($beacons as $i)
                                                      <option value="{{$i->id}}" {{$i->emp_id == $x->id ? 'selected':''}}>{{$i->uuid}}</option>
                                                   @endforeach
                                               </select>
                                              <button class="btn btn-primary mb-2" onclick="assignBeacon('{{$x->id}}')" 
                                                data-toggle="tooltip" title="click to assign beacons">assign</button>
                                           </td>
                                           <td>

                                               
                                                @php
                                                    
                                                   //calculates how many beacons are
                                                   //assigned to end-users
                                                   $count = 0;

                                                   foreach ($beacons as $i) {
                                                        if($i->emp_id == $x->id){
                                                               $count++;
                                                        }
                                                   }

                                                   echo $count;
                                                @endphp
                                                                                   
                                          </td>
                                        </tr>
                                        @endif
                                     @endforeach
                                 @endif
                            </tbody>
                    </table>
                </div>     
        </div> 
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

function assignBeacon(id){
    
    var beacons = $('.assignBeacon').val();
    
    console.log(typeof beacons);

    if(beacons !=null){
        $.ajax({
         type: "POST",
         url: "/assignBeacon",
         data: {
                'id':id,
                'beacon':beacons,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){       

            if(data == '1'){
                //reload page to update UI.
                location.reload();

            }     
            console.log(data);
        })
        .fail(function(data){
            console.log(data);
        });
    }else{
        swal({
            icon: "error",
            text: "no beacon(s) selected."
        });
    }

}

function enableEditText(){

     $("#name").prop('disabled',false);   
     $("#email").prop('disabled',false);  

     $('#name').focus(); 
        //alert('works fine.');
}
function deleteEndUser(id){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this end-user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        type: "POST",
                        url: "/deleteEndUser",
                        data: {
                            'id':id,
                            "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data){
                        
                        console.log(data);
        
                        if(data === '1'){
                            swal("Poof! end-user has been deleted!", {
                               icon: "success",
                            });
                        }
                    })
                    .fail(function(data){
                            console.log(data);
                    });
                
            } else {
                swal("Your end-user is safe!");
            }
            });
}
</script>
@endsection