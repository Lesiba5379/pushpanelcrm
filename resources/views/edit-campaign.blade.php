@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
            <h4>Edit Campaign</h4>
        </div>
        <div class="col-md-12 panel-body">
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
            <a href="/listCampaign" class="btn btn-danger mb-2"><i class="fa fa-arrow-circle-left"></i></a><br/><br/>
            <div class="col-md-6">
                <!--Select template Section-->
                <div class="col-md-12">
                        
                    <p class="narrow text-center row">
                        <div class="form-group form-animate-text col-md-12" style="margin-top:40px !important;">  
                            <input type="text" name="name" class="form-text" id="campaignName" required/>  
                            <span class="bar"></span>
                            <label>Campaign Name: </label>
                        </div>
                    </p>
                    <div class="row">
                        <div class="checkbox checkbox-info checkbox-circle col-md-4" style="margin-top: -7px; ">
                            <input id="check8Temp1" type="checkbox" href="#collapse1" class="nav-toggle styled"/>
                            <label for="check8Temp1" style="margin-left: 25px; margin-top: -10px;">Template 1</label>
                        </div>  
                        <div class="checkbox checkbox-primary checkbox-circle col-md-4">
                            <input id="check8Temp2" type="checkbox" href="#collapse2" class="nav-toggle styled"/>
                            <label for="check8Temp2" style="margin-left: 25px; margin-top: -10px">Template 2</label>
                        </div>  
                        <div class="checkbox checkbox-success checkbox-circle col-md-4">
                            <input id="check8Temp3" type="checkbox" href="#collapse3" class="nav-toggle styled"/>
                            <label for="check8Temp3" style="margin-left: 25px; margin-top: -10px">Template 3</label>
                        </div>
                        <div id="collapse4" style="display:none;">
                            <div class="form-group form-animate-text col-md-12" style="margin-top:40px !important;">  
                                <input type="text" class="form-text" id="firstName" data-bind='firstName'/>  
                                <span class="bar"></span>
                                <label>Link: </label>
                            </div>
                        </div>
                    </div> 
                    <div class="narrow text-center row" id="imgopt">
                        <ol class="carousel-thumb-img carousel-indicator">
                            <li class="active carousel-thumb-img-li">
                                <img onclick="setTemplate(this)"  class="nav-toggle img-responsive" alt="PosterTemplate01" src="{{ URL::asset('asset/img/ems-template01.jpg') }}">
                            </li>
                            
                            <li class="carousel-thumb-img-li">
                                <img onclick="setTemplate(this)"  class="nav-toggle img-responsive" alt="PosterTemplate02" src="{{ URL::asset('asset/img/ems-template02.jpg') }}">
                            </li>
                            <li  class="carousel-thumb-img-li">
                                <img onclick="setTemplate(this)" class="img-responsive" alt="PosterTemplate03" src="{{ URL::asset('asset/img/ems-template03.jpg') }}">
                            </li>
                            <li  class="carousel-thumb-img-li">
                                <img href="#collapse6" class="nav-toggle img-responsive" alt="PosterUpload" src="{{ URL::asset('asset/img/ems-upload.png') }}">
                            </li>
                        </ol>
                    </div>
                    <!--Upload Button-->
                    <div class="row" id="collapse6" style="display:none; margin-left:15px !important;">
                        <div class="col-lg-12">
                            <div class="input-group fileupload-v1">
                                <input type="file" name="manualfile" id='getval' class="fileupload-v1-file hidden"/>
                                <input type="text" class="form-control fileupload-v1-path" placeholder="File Path..." disabled>
                                <span class="input-group-btn">
                                    <button class="btn fileupload-v1-btn" type="button" style="margin-top: 0px;height: 33px;"><i class="fa fa-folder"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row"  style="margin-left: 25px;">
                        <button type="submit" id="green" class="btn btn-success btn-round green" onclick="green();"> Green</button>
                        <button type="submit" id="blue" class="btn btn-primary btn-round blue" onclick="blue();"> Blue</button>
                        <button type="submit" id="red" class="btn btn-danger btn-round red" onclick="red();"> Red</button>
                        <button type="submit" id="yellow" class="btn btn-warning btn-round yellow" onclick="yellow();"> Yellow</button>
                        <button type="submit" id="skyblue" class="btn btn-info btn-round skyblue" onclick="skyblue();"> Sky-Blue</button>
                    </div><br />
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload a Logo/A Product Image</div>
                        <div class="panel-body" align="center">
                            <input type="file" name="upload_image" id="upload_image" />
                            <br />                    
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="designPoster" style="margin-left: -25px">
                <div class="col-sm-6 " id='clock'>
                    <dl>
                       
                        <!-- Template 1 -->
                        <div id="collapse1" style="display:none;">
                            <div id="example-one" contenteditable="true">
                                <style scoped>
                                     #example-one{
                                        margin-bottom: 10px; 
                                        margin-top: 10px;
                                        text-align: center;
                                        font-size: 20px;
                                        color: #fff;
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px;  
                                    } 
                                    [maxlength = 20]{
                                        max: 10;
                                    }
                                </style>

                                <p id="text-col">Top Text</p>
                            </div>
                            <div id="example-two" contenteditable="true">
                                <style scoped>
                                    #example-two { 
                                        margin-bottom: 10px;
                                        margin-top: 280px; 
                                        text-align: center;
                                        font-size: 20px;
                                        color: #FFF;
                                        
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px; 
                                        
                                    }
                                </style>
                                
                                <p id="text-col1"  data-input-length="10">Bottom Text</p>
                            </div>
                        </div>
                        <!-- Template 2 -->
                        <div class="col-md-12"id="collapse2" style="display:none">
                            <div id="example-three" contenteditable="true">
                                <style scoped>
                                    #example-three { 
                                        margin-bottom: 10px; 
                                        margin-top: 10px;
                                        text-align: center;
                                        font-size: 20px;
                                        color: #FFF;
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px;  
                                    }   
                                </style>

                                <p id="text-col2">Top Text</p>
                            </div>
                            <div id="example-four" contenteditable="true">
                                <style scoped>
                                    #example-four { 
                                        margin-bottom: 10px;
                                        margin-top: 270px; 
                                        text-align: left;
                                        font-size: 20px;
                                        color: #FFF;
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px; 
                                    }
                                </style>
                                
                                <p id="text-col3">Bottom Text</p>
                                <button type="submit" class="btn btn-success btn-round green" style="width:150px; margin-top: -70px; margin-left: 130px;"> Link Text <span style="margin-left: 10px;" class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>
                        <!-- Template 3 -->
                        <div class="col-md-12"id="collapse3" style="display:none">
                            <div id="example-three" contenteditable="true">
                                <style scoped>
                                    #example-three { 
                                        margin-bottom: 10px; 
                                        margin-top: 10px;
                                        text-align: center;
                                        font-size: 20px;
                                        color: #FFF;
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px;  
                                    }   
                                </style>

                                <p id="text-col4">Top Text</p>
                            </div>
                            <div id="example-four" contenteditable="true">
                                <style scoped>
                                    #example-four { 
                                        margin-bottom: 10px;
                                        margin-top: 270px; 
                                        text-align: left;
                                        font-size: 20px;
                                        color: #FFF;
                                    }
                                    [contenteditable="true"] { 
                                        padding: 10px; 
                                    }
                                </style>
                                
                                <button type="submit" class="btn btn-success btn-round" style="width:150px; margin-left: -25px;"> Link Text 1<span style="margin-left: 10px;" class="glyphicon glyphicon-send"></span></button>
                                <button type="submit" class="btn btn-success btn-round" style="width:150px; margin-top: -70px; margin-left: 150px;"> Link Text 2<span style="margin-left: 10px;" class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>
                        <div id="draggie">
                            <div id="uploaded_image">
                                @if(isset($img))
                                    <img id="img"  src="{{($img)}}" Style="margin-left:-16px" />
                                @else
                                    no data 
                                @endif
                            </div>
                            <canvas id="c"></canvas>
                        </div>
                        

                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-12 panel-footer">
                <button type="submit" id="publish" onclick="test()" class="btn btn-success btn-round green" style="width:150px"> Publish <span style="margin-left: 10px;" class="glyphicon glyphicon-send"></span></button>  
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">  

    function green() {
        //Note the lowercase first letter.
        x = document.getElementById("text-col");
            x.style.color = 'green';
        y = document.getElementById("text-col1");
            y.style.color = 'green';
        z = document.getElementById("text-col2");
            z.style.color = 'green';
        aa = document.getElementById("text-col3");
            aa.style.color = 'green';
        bb = document.getElementById("text-col4");
            bb.style.color = 'green';
    }
    function blue() {
        //Note the lowercase first letter.
        x = document.getElementById("text-col");
            x.style.color = 'blue';
        y = document.getElementById("text-col1");
            y.style.color = 'blue';
        z = document.getElementById("text-col2");
            z.style.color = 'blue';
        aa = document.getElementById("text-col3");
            aa.style.color = 'blue';
        bb = document.getElementById("text-col4");
            bb.style.color = 'blue';
    }
    function red() {
        //Note the lowercase first letter.
        x = document.getElementById("text-col");
            x.style.color = 'red';
        y = document.getElementById("text-col1");
            y.style.color = 'red';
        z = document.getElementById("text-col2");
            z.style.color = 'red';
        aa = document.getElementById("text-col3");
            aa.style.color = 'red';
        bb = document.getElementById("text-col4");
            bb.style.color = 'red';
    }
    function yellow() {
        //Note the lowercase first letter.
        x = document.getElementById("text-col");
            x.style.color = 'yellow';
        y = document.getElementById("text-col1");
            y.style.color = 'yellow';
        z = document.getElementById("text-col2");
            z.style.color = 'yellow';
        aa = document.getElementById("text-col3");
            aa.style.color = 'yellow';
        bb = document.getElementById("text-col4");
            bb.style.color = 'yellow';
    }
    function skyblue() {
        //Note the lowercase first letter.
        x = document.getElementById("text-col");
            x.style.color = 'skyblue';
        y = document.getElementById("text-col1");
            y.style.color = 'skyblue';
        z = document.getElementById("text-col2");
            z.style.color = 'skyblue';
        aa = document.getElementById("text-col3");
            aa.style.color = 'skyblue';
        bb = document.getElementById("text-col4");
            bb.style.color = 'skyblue';
    }

    $(document).ready(function(){

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
            width:150 ,
            height:150,
            type:'square' //circle, square
            },
            boundary:{
            width:300,
            height:300
            }
        });

        $('#upload_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function(response){
                $.ajax({
                    method: "POST",
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/ResizeLogo",
                    data:{
                        "image": response,
                        _token : $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data)
                    {
                    $('#uploadimageModal').modal('hide');
                    $('#uploaded_image').html(data);
                    }
                });
            })
        });

    });  
</script>

<script>

function test(){
       /* var campaignName = $("#campaignName").val();
        var beacon = $("#beaconUUID").val();
        var elm = $('#clock').get(0);
        var hght = "600";
        var wdth = "450";
        var type = "jpg";
        var filename = "digitalPoster";
        var img = null;*/

        var canvas = document.getElementById("c");
        var ctx = canvas.getContext("2d");

        var image = new Image();
        image.onload = function() {
        ctx.drawImage(image, 0, 0);
        };
        image.src =  $("#img").val();

        

} 


   
</script>
<!--Image Resize Model -->
<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-8 text-center">
						  <div id="image_demo" style="width:350px; margin-top:30px"></div>
  					</div>
  					<div class="col-md-4" style="padding-top:30px;">
  						<br />
  						<br />
  						<br/>
						  <button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>

@endsection