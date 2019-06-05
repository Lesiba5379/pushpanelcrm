@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>
                Select Beacon(s)
                <a href="/beacon_view" class="btn btn-primary mb-2" style="margin-left:850px"><i class="fa fa-plus"></i></a>
            </h4>
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
                
                

                <div class="col-md-12 responsive-table">

                  <table class="table table-hover" id="tblBeacon">
                    <thead>
                        <tr>
                            <th>UUID</th>       
                            <th>Product</th>
                            <th>Bought By</th>
                            <th>Edit  /  Remove</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                    @role(['client'])
                        @if(count($b) > 0)
                            @foreach($b as $x)
                            @if ($x->user_id == Auth::user()->id)
                                
                            
                               <tr>
                                    <td>{{$x->uuid}}</td>
                                    <td>
                                        @php
                                            $product = json_decode($x->product);
                                            echo $product[0];
                                        @endphp    
                                    </td>        
                                    <td>{{$x->name}}</td> 
                                    <td>
                                        <a href="" class="btn btn-success mb-2" 
                                            data-toggle="tooltip" title="edit beacon">                            
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <button onclick = "deleteBeacon('{{$x->id}}')" class="btn btn-danger mb-2"
                                                data-toggle="tooltip" title="delete beacon">                            
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                @else
                                
                              @endif
                            @endforeach
                        @endif
                        @endrole

                        @role(['superadministrator','administrator'])
                        @if(count($b) > 0)
                            @foreach($b as $x)                                
                            
                               <tr>
                                    <td>{{$x->uuid}}</td>
                                    <td>
                                        @php
                                            $product = json_decode($x->product);
                                            echo $product[0];
                                        @endphp    
                                    </td>        
                                    <td>{{$x->name}}</td> 
                                    <td>
                                        <a href="" class="btn btn-success mb-2" 
                                            data-toggle="tooltip" title="edit beacon">                            
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <button onclick = "deleteBeacon('{{$x->id}}')" class="btn btn-danger mb-2"
                                                data-toggle="tooltip" title="delete beacon">                            
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td><input type="checkbox" id="toAssignBeacon" value="{{$x->id}}"></td>

                                </tr>
                        
                            @endforeach
                        @endif
                        @endrole

                    </tbody>
                </table>
             
            </div>
            
            </div>
            
        </div>
        <div class="col-md-12 panel-footer">
            <button class="btn btn-primary" type="button" onclick="assignBeacon()">Assign Beacon(s) to Company</button>
        </div>
    </div>
</div>


<div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>Select A Company</h4>
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
                    
                    <div class="col-md-12 responsive-table">
    
                      <table class="table table-hover" id="tblBeacon">
                        <thead>
                            <tr>
                                <th>Name</th>       
                                <th>Email</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                        @role(['client'])
                            @if(count($b) > 0)
                                @foreach($b as $x)
                                @if ($x->user_id == Auth::user()->id)
                                    
                                
                                   <tr>
                                        <td>{{$x->uuid}}</td>
                                        <td>
                                            @php
                                                $product = json_decode($x->product);
                                                echo $product[0];
                                            @endphp    
                                        </td>        
                                        <td>
                                            <a href="" class="btn btn-success mb-2" 
                                                data-toggle="tooltip" title="edit beacon">                            
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <button onclick = "deleteBeacon('{{$x->id}}')" class="btn btn-danger mb-2"
                                                    data-toggle="tooltip" title="delete beacon">                            
                                                    <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    @else
                                    
                                  @endif
                                @endforeach
                            @endif
                            @endrole
    
                            @role(['superadministrator','administrator'])
                            @if(count($companies) > 0)
                                @foreach($companies as $x)                                
                                
                                   <tr>
                                        <td>{{$x->name}}</td>
                                        <td>{{$x->email}}</td>        
                                        <td><input type="radio" name="company" id="toAssign" value="{{$x->id}}"></td>
                                    </tr>
                            
                                @endforeach
                            @endif
                            @endrole
    
                        </tbody>
                    </table>
                 
                </div>
                
                </div>
                
            </div>
        </div>
    </div>




<script>


        function assignBeacon(){

            var arrBeacon = [];
            var company;

            company = $('#toAssign').val();

            $("#toAssignBeacon:checked").each(function(){
                arrBeacon.push($(this).val());
            });

            if(company == "" || arrBeacon.length < 1){
                alert('select company or beacon');
            }else{
                doAjaxCall(arrBeacon,company)
            }
            

            //alert('btn clicked..');
        }

        function doAjaxCall(beacons,company){
                $.ajax({
                        type: "POST",
                        url: "/companyAssignment",
                        data: {
                            'beacons':beacons,
                            'company':company,
                            "_token": "{{ csrf_token() }}",
                        },
                })
                .done(function(data){
                    if(data == '1'){
                        alert('Beacon(s) Assigned');
                    }
                    console.log(data);
                })
                .fail(function(data){
                    console.log(data);
                });
        }

        function deleteBeacon(id){
               
            if(confirm('Are you sure?')){
                $.ajax({
                            type: "POST",
                            url: "/deleteBeacon",
                            data: {
                                'id':id,
                                "_token": "{{ csrf_token() }}",
                            },
                })
                .done(function(data){
                    if(data == '1'){
                        alert('Beacon removed');
                        location.reload();
                    }
                    console.log(data);
                })
                .fail(function(data){
                    console.log(data);
                });
            }
               
        }
</script>
@endsection
