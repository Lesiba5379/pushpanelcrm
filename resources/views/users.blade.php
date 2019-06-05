@extends('layouts.layout')

@section('content')

<div class="panel">
    <div class="panel-heading">

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
                <a href="/createAdmin" class="btn btn-primary mb-2" style="margin-bottom: 15px"><i class="fa fa-plus"></i></a>

                <table class="table table-hover" id="appTable">
                    <thead>
                           <tr> 
                              <th>Name</th>       
                              <th>Email</th>
                              <th>Admin</th>
                              <th>Super-admin</th>
                              <th>Employee(s)</th>
                              <th>Inactive / Active</th>
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
                                      <input type="checkbox" name="role" 
                                          {{$user->roles->pluck('name')[0] == 'administrator' ? 'checked': ''}}/>
                                    </td>
                                    <td>
                                      <input type="checkbox" name="role" 
                                          {{$user->roles->pluck('name')[0] == 'superadministrator' ? 'checked': ''}}/>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="role"
                                        {{$user->roles->pluck('name')[0] == 'client' ? 'checked': ''}}/> 
                                    </td>
                                    <td>
                                            <label class="switch">
                                              <input type="checkbox" onclick="setStatus()"/>
                                              <span class="slider round"></span>
                                            </label>
                                          </td>
                                    <td>
                                            <a href="/editUser/{{$user->id}}" class="btn btn-success mb-2">                            
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <button onclick = "deleteUser('{{$user->id}}','{{$user->roles->pluck('name')[0]}}')" class="btn btn-danger mb-2">                            
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
<script>

function setStatus(){
     alert('Hello world');
}

function deleteUser(id,role){
     
    if(confirm('Are you sure?')){
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
                   alert('user deleted.');
                   location.reload();
                }
            })
            .fail(function(data){
                    console.log(data);
            });
    }
}
</script>
{!! Form::close() !!} 
@endsection