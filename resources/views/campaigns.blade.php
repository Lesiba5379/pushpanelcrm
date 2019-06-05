@extends('layouts.layout')

@section('content')
<div class="col-md-12">
<div class="panel">
        <div class="panel-heading">
            <h4>
                Select A Campaign
                <a href="/ads" class="btn btn-primary mb-2" style="margin-left:850px"><i class="fa fa-plus"></i></a>       
            </h4>
        </div>
        <div class="panel-body">
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
           <!-- options for list campaigns table -->

           

           <div class="col-md-12 responsive-table">
                  <table class="table table-hover" id="tblCampaigns">
                        <thead>
                           <tr> 
                              <th>Campaign Name</th>       
                              <th>Beacons</th>
                              <th>Active / Blocked </th>
                              <th>Remove </th>
                              <th>View Campaign</th>
                              <th>More</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($test as $item)
            
                              <tr>
                                  <td>{{$item->name}}</td>
                                  <td>
                                      @if (isset($item->uuid))
                                            <a onclick="beaconDetails('{{$item->uuid}}','{{$item->product}}','{{$item->id}}')" id="btnUnassign" data-toggle="tooltip" title="Click for more details.">{{$item->uuid}}</a>
                                      @else
                                            <a>no beacon assigned</a>
                                      @endif
                                  </td>
                                  <td>
                                      <label class="switch">
                                                <input type="checkbox" {{$item->status == '-1'  ? 'checked' : ''}}
                                                onclick="blockCampaign('{{$item->id}}')"/>
                                                <span class="slider round"></span>
                                      </label>
                                  </td>
                                  <td>
                                        <!--a href="/edit-campaign/{{$item->id}}" class="btn btn-success mb-2"
                                           data-toggle="tooltip" title="edit campaign">                            
                                            <i class="fa fa-edit"></i> 
                                        </a-->
                                      <button onclick = "deleteCampaign('{{$item->id}}')" class="btn btn-danger mb-2"
                                           data-toggle="tooltip" title="delete campaign">                            
                                                <i class="fa fa-trash"></i>
                                        </button>
                                  </td>
                                  <td>
                                    <a href="/view-campaign/{{$item->id}}" class="btn btn-success mb-2"
                                           data-toggle="tooltip" title="view campaign">                            
                                                <i class="fa fa-eye"></i>
                                        </a>
                                  </td>
                                <td><input type="radio" id = "selectedCampaign" name="campaign" value="{{$item->id}}" ></td>
                              </tr>  
                              @endforeach
                        </tbody>
                  </table>
           </div>
        </div>    
</div>
</div>
<div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>Select Beacon(s)</h4>
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
                                <th>Uuid</th>       
                                <th>Product</th>
                                <th>More</th>
                            </tr> 
                        </thead>
                        <tbody>
                            

                                @if (count($beacons) > 0)
                                
                                     @foreach ($beacons as $item)
                                     <tr>
                                        <td>{{$item->uuid}}</td>
                                        <td>{{$item->product}}</td>
                                        <td>
                                            <input type="checkbox" id="selectedBeacon" value="{{$item->id}}"
                                            {{$item->campaign_id == '16'  ? 'checked' : ''}}>
                                        </td>

                                    </tr>
                                     @endforeach
                                
                                @endif
                                
                        </tbody>
                    </table>
                 
                </div>
                
                </div>
                
            </div>
            <div class="col-md-12 panel-footer">
                <button type="button" class="btn btn-primary" id="beaconCampaign" onclick="btnAssignBeacons()">Assign Beacon(s) To Campaign</button>
            </div>
        </div>
    </div>

    
<div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Select beacon to assign to campaign.</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                    <select id='pre-selected-options' class="campaignBeacons" multiple='multiple'>
                      <optgroup label='Beacon list'>
                        @foreach ($beacon as $b)                                     
                        <option value="{{ $b->id }}" {{$b->campaign_id == '1'  ? 'selected' : ''}}>{{ $b->uuid}}</option>
                        @endforeach
                      </optgroup>
                    </select>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-primary mb-2" >assign beacons</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
</div>

<div id="details" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Beacons</h4>
            </div>
            <div class="modal-body">
        
                                <div class="form-group">
                                    <label for="uuid">UUID</label>
                                    <input type="text" class="form-control" id="uuid" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="product">Product:</label>
                                    <input type="product" class="form-control" id="product" disabled>
                                  </div>

                                  <input type="hidden" id="beaconId">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="unassign()">unassign</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
            </div>
          </div>
      
        </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

function unassign(){

    var id = $('#beaconId').val();

    //console.log('from click event: ' + id);
    //console.log('unassign clicked..');

    $.ajax({
         type: "POST",
         url: "/unassignBeaconCampaign",
         data: {
                'id': id,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){
            console.log(data);
        })
        .fail(function(data){
            console.log(data);
        });
}




function beaconDetails(uuid,product,id){

    /*console.log('uuid: ' + uuid);
    console.log('product: ' + product);
    console.log('id: ' + id);*/

    localStorage.setItem("uuid", uuid);
    localStorage.setItem("product", product);
    localStorage.setItem("id", id);


    var uuid = localStorage.getItem('uuid');
    var product = localStorage.getItem('product');
    var id = localStorage.getItem('id');

    console.log(id);


    $('#uuid').val(uuid);
    $('#product').val(product);
    $('#beaconId').val(id);

    $('#details').modal('show'); 
}

    function btnAssignBeacons(){

        //campaign to assign beacons to, lesiba nxumalo
        var campaignId = $('#selectedCampaign:checked').val();
        var beacons = [];

        $("#selectedBeacon:checked").each(function(){
            beacons.push($(this).val());
        });

        console.log(beacons);

        if(campaignId == null || beacons.length < 1){
             alert('Select campaign or beacons.');
        }else{

            ajaxCall(campaignId,beacons);

            //do a ajax call to assign campaign to beacon
            //console.log('campaign id: ' + campaignId);        
            //console.log('selected beacon: ' + beacons);        

        }
    }

    function ajaxCall(cmpId,arrBeacon){

        $.ajax({
         type: "POST",
         url: "/assigning",
         data: {
                'campaign_id': cmpId,
                'beacons':arrBeacon,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){
            console.log('ajax data: ' + data);

            if(data == 1){
                alert('success: beacons assigned to campaign');
            }else{
                alert('error: beacons not assigned to campaign');
            }
        })
        .fail(function(data){
            console.log(data);
        });
    }








    function _assignBeacon(id){

          console.log('id: ' + id);
    }


   //global variables declaration begins right here (@_@).
   var campId = null;

   /**
    *@name
    *@function
    *returns null
    */
   function openModal(id){
      $("#myModal").modal();
      campId = id;
   }

  /**
   *
   *@function
   *@name assign beacon
   *@param id unique identify enables us to read single record
   *@returns void
   */
   function assignBeacon(){

       var beacons = $('.campaignBeacons').val();
       var id = campId;
       
       $.ajax({
         type: "POST",
         url: "/assignCampaignBeacon",
         data: {
                'id': id,
                'beacon':beacons,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){
            console.log(data);

            if(data == '1'){
                iziToast.success({
                   title: 'Message: ',
                   message: 'beacons assigned successfully.',
                   position: 'center'
               });
            }else{
                iziToast.error({
                    title: 'Message: ',
                    message: 'Beacon(s) already assigned',
                    position: 'center'
                });
            }
        })
        .fail(function(data){
            console.log(data);
        });

   }

   /**
   *
   *@function
   *@name View Campaign
   *@param id unique identify enables us to read single record
   *@returns void
   */
  function viewCampaign(id){
    $.ajaxSetup({
        /*headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }*/
        type:'POST',
        url:'/view-campaign',
        data:{
            'id':id,
            "_token": "{{ csrf_token() }}",
        },
        success:function(data){
            alert(data.success);
        }
    });
   /* $.ajax({
        
    });

    /*console.log(id);
    
    $.ajax({
        type: 'POST',
        url: "/view-campaign",
        data: {
            'id': id,
            "_token": "{{ csrf_token() }}",
        },
        success: function (msg) {
            console.log("Success");
        },
        error: function (msg) {
            console.log(msg);
        }
    });
    /*.done(function(data){
        console.log(data);

        if(data == '1'){
            iziToast.success({
                title: 'Message: ',
                message: 'Campaign Collected successfully.',
                position: 'center'
            });
        }else{
            iziToast.error({
                title: 'Message: ',
                message: 'Please Ensure that the Campaign is Assigned to a Beacon',
                position: 'center'
            });
        }
    })
    .fail(function(data){
        console.log(data);
    });*/

    }
    
    
   /**
    * @name { deleteCampaign }
    * @function
    * @param { id } campaign unique identifier, allows us to delete campaign.
    */
   function deleteCampaign(id){
      
    swal({
       title: "Are you sure?",
       text: "Once deleted, you will not be able to recover this campaign",
       icon: "warning",
       buttons: true,
       dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
      
      $.ajax({
         type: "POST",
         url: "/deleteCampaign",
         data: {
                'id': id,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){
            console.log(data);
            if(data == '1'){
              swal("Poof! Your campaign has been deleted!", {
                 icon: "success",
              });
              //location.reload();
            }else{
                swal("Poof! Your campaign has been deleted!", {
                 icon: "error",
                });

               //location.reload();

            }
        })
        .fail(function(data){
            console.log(data);
        });

     } else {
       swal("Your campaign is safe!");
     }
     });
     
   }
   /**
    * @name { blockCampaign } 
    * @function
    * @param { id }
    */
   function blockCampaign(id){

      $.ajax({
         type: "POST",
         url: "/blockCampaign",
         data: {
                'id': id,
                "_token": "{{ csrf_token() }}",
            },
         })
        .done(function(data){
            console.log(data);

            if(data == '1'){

                iziToast.success({
                   title: 'success: ',
                   message: 'campaign blocked.',
                   position: 'center'
               });

            }else{

                iziToast.error({
                    title: 'error: ',
                    message: 'something went wrong while blocking campaign',
                    position: 'center'
                });

            }


        })
        .fail(function(data){
            console.log(data);
        });
    }

    /**
    * @name { viewCampaign } 
    * @function
    * @param { id }
    *
   function viewCampaign(id){
   // console.log('fuction is called');
        $.ajax({
        type: "POST",
        url: "viewCampaign",
        data: {
                'id': id,
                "_token": "{{ csrf_token() }}",
            },
        })
        .done(function(data){
            console.log(data);

            if(data == '1'){

                iziToast.success({
                    title: 'success: ',
                    message: 'campaign Loaded.',
                    position: 'center'
                });

            }else{

                iziToast.error({
                    title: 'error: ',
                    message: 'something went wrong while retrieving campaign',
                    position: 'center'
                });

            }


        })
        .fail(function(data){
            console.log(data);
        });
   }*/

</script>
@endsection