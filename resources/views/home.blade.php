@extends('layouts.layout')

@section('content')

<style>
    input[type="checkbox"][readonly] {
        pointer-events: none;
    }
</style>
<!--Cards-->
<div class="col-md-12 padding-0">
    @role(['administrator','superadministrator'])
    <div class="col-md-3">
        <div class="panel box-v1">
            <div class="panel-heading bg-white border-none">
                <div class="col-md-3 col-sm-3 col-xs-3 text-left padding-0">
                    <h4>Active Users</h4>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <h4>
                        <span class="icon-user icons icon text-right"></span>
                   </h4>
                </div>                      
            </div>
            <div class="panel-body text-center">
                <h1>@if( count($activeUsers)>0 )
                    {{count($activeUsers)}}
                @else
                    0
                @endif
               </h1>
                    <p>Active Accounts</p>
                    <hr/>
                </div>
            </div>
    </div>
    @endrole
    <div class="col-md-3">
    <div class="panel box-v1">
            <div class="panel-heading bg-white border-none">
                <div class="col-md-3 col-sm-3 col-xs-3 text-left padding-0">
                    <h4 class="text-left">Orders</h4>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <h4>
                        <span class="icon-basket-loaded icons icon text-right"></span>
                    </h4>
                </div>
            </div>
            <div class="panel-body text-center">
                <h1>50</h1>
                    <p>New Orders</p>
                <hr/>
            </div>
        </div>
    </div>
    @role(['administrator','superadministrator'])
    <div class="col-md-3">
        <div class="panel box-v1">
            <div class="panel-heading bg-white border-none">
                <div class="col-md-3 col-sm-3 col-xs-3 text-left padding-0">
                    <h4 class="text-left">Blocked Users</h4>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <h4>
                        <span class="icon-user icons icon text-right"></span>
                   </h4>
                </div>                      
            </div>
            <div class="panel-body text-center">
                <h1>
                    @if (count($blockedUsers)>0)
                         {{count($blockedUsers)}}
                    @else
                        0
                    @endif
                </h1>
                    <p>Blocked Users</p>
                    <hr/>
                </div>
            </div>
    </div>
    @endrole
    @role('client')
    <div class="col-md-3">
        <div class="panel box-v1">
            <div class="panel-heading bg-white border-none">
                <div class="col-md-3 col-sm-3 col-xs-3 text-left padding-0">
                    <h4 class="text-left">Campaigns</h4>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <h4>
                        <span class="icon-user icons icon text-right"></span>
                   </h4>
                </div>                      
            </div>
            <div class="panel-body text-center">
                <h1>
                    @if (count($blockedUsers)>0)
                         {{count($blockedUsers)}}
                    @else
                        0
                    @endif
                </h1>
                    <p>Blocked Users</p>
                    <hr/>
                </div>
            </div>
    </div>
    @endrole
    <div class="col-md-3">
    <div class="panel box-v1">
            <div class="panel-heading bg-white border-none">
                <div class="col-md-3 col-sm-3 col-xs-3 text-left padding-0">
                    <h4 class="text-left">Beacons</h4>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <h4>
                        <span class="icon-basket-loaded icons icon text-right"></span>
                    </h4>
                </div>
            </div>
            <div class="panel-body text-center">
                <h1>@if(count($beacons)>0)
                        {{count($beacons)}}
                    @else
                    0
                    @endif
                </h1>
                    <p>beacons</p>
                <hr/>
            </div>
        </div>
    </div>
</div>
<!--End of Cards-->


<!--Tables-->
@role(['superadministrator'])
<div class="panel">
        <div class="panel-heading">
            <h3> 
                Users
                <a href="/createAdmin" class="btn btn-primary mb-2" style="margin-left:900px"><i class="fa fa-plus"></i></a>
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12 responsive-table">
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
                  
                    
    
                    <table class="table table-hover" id="appTable">
                        <thead>
                               <tr> 
                                  <th>Name</th>       
                                  <th>Email</th>
                                  <th>Admin</th>
                                  <th>Super-admin</th>
                                  <th>Employee</th>
                                  <th>Active / Blocked</th>
                                  <th>Edit / Remove</th>
                                </tr>
                        </thead>
                        <tbody> 
                             @if (count($users) > 0)
                                 @foreach ($users as $user)
                                     <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <div class="checkbox checkbox-info checkbox-circle col-md-4">
                                                <input id="check8Te1" type="checkbox" name="role" class="styled" {{$user->roles->pluck('name')[0] == 'administrator' ? 'checked': ''}} disabled readonly>
                                                <label for="check8Te1" ></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox checkbox-info checkbox-circle col-md-4">
                                                <input id="check8Te2" type="checkbox" name="role" class="styled"  {{$user->roles->pluck('name')[0] == 'superadministrator' ? 'checked': ''}} disabled readonly/>
                                                <label for="check8Te2" ></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox checkbox-info checkbox-circle col-md-4">
                                                <input id="check8Temp1" type="checkbox" name="role" class="styled"  {{$user->roles->pluck('name')[0] == 'client' ? 'checked': ''}} disabled readonly/>
                                                <label for="check8Temp1" ></label>
                                            </div>
                                        </td>
                                        <td>
                                                <label class="switch">
                                                <input type="checkbox" onclick="setStatus('{{$user->id}}')" {{$user->status == '-1' ? 'checked':''}}/>
                                                  <span class="slider round"></span>
                                                </label>
                                        </td>
                                        <td>
                                                <a href="/editUser/{{$user->id}}" class="btn btn-success mb-2" data-toggle="tooltip" title="edit user">                            
                                                    <i class="fa fa-edit"></i> 
                                                </a>
                                                <button onclick = "deleteUser('{{$user->id}}','{{$user->roles->pluck('name')[0]}}')" class="btn btn-danger mb-2"
                                                        data-toggle="tooltip" title="delete user">                            
                                                        <i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                       
                                     </tr>
                                 @endforeach
                             @endif
                        </tbody>
                      </table>
            </div>
        </div>
</div>
@endrole

@role(['superadministrator','administrator'])

<div class="panel">
        <div class="panel-heading">
           <h3>
                Company Profile
                <a href="/createCompany" class="btn btn-primary mb-2" style="margin-left:850px"><i class="fa fa-plus"></i></a>
           </h3>
        </div>
        <div class="panel-body">
            
           

            <table class="table table-hover" id="tblCustomer">
                    <thead>
                        <tr> 
                            <th>Company Name</th>       
                            <th>Email Address</th>
                            <th>Employee(s)</th>
                            <th>Beacons</th>
                            <th>View Details</th>
                            <th>Remove</th>
                         </tr>
                     </thead>
                     <tbody>
                        @if (count($companies) > 0)
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>
                                    @php
                                        $count=0;
                                         
                                        foreach ($employees as $e) {
                                            if($e->user_id == $company->id){
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    @endphp

                                  
                                </td>
                                <td>
                                    @php
                                       
                                        $count = 0;

                                        foreach($beacons as $x){
                                            if($x->user_id == $company->id){
                                                $count++;
                                            }else{
                                                
                                            }
                                        }

                                        echo $count;

                                    @endphp
                                    
                                </td>
                                <td>
                                        <a href="/viewCompany/{{$company->id}}" class="btn btn-success mb-2"
                                            data-toggle="tooltip" title="view all detalis">                            
                                            <i class="fa fa-eye"></i> 
                                        </a>
                                </td> 
                                <td>
                                            <button onclick = "deleteCompany('{{$company->id}}')" class="btn btn-danger mb-2"
                                                    data-toggle="tooltip" title="delete customer">                            
                                                    <i class="fa fa-trash"></i>
                                            </button>
                                </td>
                            </tr>
                            @endforeach         
                        @endif
                       
                     </tbody>   
            </table>
        </div>
</div>
@endrole
<!--End of tables--> 

@role('client')
<div class="panel">
    <div class="panel-heading">
        <h4>Beacons</h4>
                
    </div>
    <div class="panel-body">
       <div class="col-md-12 responsive-table">
              <table class="table table-hover">
                    <thead>
                       <tr> 
                          <th>Uuid</th>       
                          <th>Product</th>
                        </tr>
                    </thead>
                    <tbody> 
                          <tr>
                              <td>test</td>
                              <td>test</td>
                          </tr>  
                    </tbody>
              </table>
              <div class="btn-group" role="group" aria-label="..." style="margin-top:20px;">
                    <button type="button" class="btn">
                        <span class="icon-arrow-left icons"></span>
                    </button>
                    <button type="button" class="btn active">1</button>
                    <button type="button" class="btn">2</button>
                    <button type="button" class="btn">
                        <span class="icon-arrow-right icons"></span>
                    </button>
              </div>
       </div>
    </div>    
</div>
@endrole
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>


        // responsible for blocking and unblocking users.

        var d = false;

        function getStatus(id){

                $.ajax({
                    type: "POST",
                    url: "/getStatus",
                    data: {
                            'id':id,
                            "_token": "{{ csrf_token() }}",
                    },
                 })
                .done(function(data){

                    if(data == '-1'){
                       d = true;   
                    }
                })
                .fail(function(data){
                    console.log(data);
                });
        }

        function setStatus(id){

            //retrieves user status from the db (via ajax call).
            getStatus(id);

            if(!d){
                $.ajax({
                        type: "POST",
                        url: "/setStatus",
                        data: {
                                'id':id,
                                "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data){
                            if(data == '1'){
                                swal({
                                    title: "Success",
                                    text: "User blocked!",
                                    icon: "success",
                                    button: "Ok",
                                });
                            }else{

                            }
                    })
                    .fail(function(data){
                                console.log(data);
                    });    
            }else{
                unblockUser(id);
            }               
        }


        function unblockUser(id){
            $.ajax({
                        type: "POST",
                        url: "/unblockUser",
                        data: {
                                'id':id,
                                "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data){
                            if(data == '1'){
                                swal({
                                    title: "Success",
                                    text: "User unblocked!",
                                    icon: "success",
                                    button: "Ok",
                                });
                            }else{

                            }
                    })
                    .fail(function(data){
                                console.log(data);
                    });  
        }
        //end of blocking and unblocking of the user.

        function deleteUser(id,role){
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        type: "POST",
                        url: "/deleteUser",
                        data: {
                            'id':id,
                            'role':role,
                            "_token": "{{ csrf_token() }}",
                        },
                    })
                    .done(function(data){
                        
                        console.log(data);
        
                        if(data === '1'){
                            swal("Poof! user has been deleted!", {
                               icon: "success",
                            });
                        }
                    })
                    .fail(function(data){
                            console.log(data);
                    });
                
            } else {
                swal("Your user is safe!");
            }
            });
            
        }
        </script>
<script>
  
  function deleteProfile(id){
        
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this profle!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
       if (willDelete) {
           $.ajax({
                    type: "POST",
                    url: "/deleteProfile",
                    data: {
                        'id':id,
                        "_token": "{{ csrf_token() }}",
                    },
                })
                .done(function(data){
                    if(data == '1'){
                    swal("Poof! Profile has been deleted!", {
                         icon: "success",
                     });
                    }
                    console.log(data);
                })
                .fail(function(data){
                    console.log(data);
                });
            
        } else {
            swal("Profile is safe!");
        }
    });            
  }
  
  function deleteCompany(id){
      
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this company!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
            $.ajax({
                    type: "POST",
                    url: "/deleteCompany",
                    data: {
                        'id':id,
                        "_token": "{{ csrf_token() }}",
                    },
                })
                .done(function(data){
                    if(data == '1'){
                        swal("Poof! company has been deleted!", {
                          icon: "success",
                        });
                    }
                    console.log(data);
                })
                .fail(function(data){
                    console.log(data);
                });
        
    } else {
        swal("company is safe!");
    }
    });
  
  }
  function dbBlock(id){
     
      $.LoadingOverlay("show");
     
      $.ajax({
          type: "POST",
          url: "/blockUser",
          data: {
              'id':id,
              "_token": "{{ csrf_token() }}",
          },
      })
      .done(function(data){

          $.LoadingOverlay("hide");
          location.reload();

          console.log(data);
      })
      .fail(function(data){
          console.log(data);
      });
  }


  function getAllUsers(){

    
    var xhttp = new XMLHttpRequest();

    var table = document.getElementById('test');
    var count = table.rows.length;


    var row = document.getElementById('tblProfile');
    var cells = row.getElementsByTagName("td");
    var id = cells[0].innerText;
    var btn = document.getElementById('btnStatus');

    xhttp.onreadystatechange = function() {

     if (this.readyState == 4 && this.status == 200) {

        var users = JSON.parse(this.responseText).map(b => {return {id: b.id, active: (b.active == '0') ? '0' : '1'} });
        
      // for(var i=0;i < count;i++){

        //var objCells = table.rows.item(i).cells;

        for(var i=0;i < count;i++){
             var objCells = table.rows.item(i).cells;

             objCells[6].firstChild.innerHTML='New Name';

            console.log(objCells[6].firstChild.innerHTML='New Name');

            console.log(objCells[6].parentElement);

        }

        for(const v of users.values()){
           
          // console.log(objCells[0].innerText);

           
           //console.log(objCells);
          /*for(var i=0;i < count;i++){
             console.log(i);
             var objCells = table.rows.item(i).cells;

             if(v['id'] == objCells[0] && v['active'] == '1'){
                btn.value =  "blocked";
             }

          } */        
        }
     // }
     }

    };

    xhttp.open("GET", "http://panel.update/getAllUsers", true);
    xhttp.send();
  }
 
</script>
@endsection