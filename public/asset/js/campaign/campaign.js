 

 //Show Hide Function
$(document).ready(function() {
	$('.nav-toggle').click(function(){
	//get collapse content selector
	var collapse_content_selector = $(this).attr('href');

	//make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function(){
            if($(this).css('display')=='none'){
                //change the button label to be 'Show'
                toggle_switch.html('Show');
            }else{
                //change the button label to be 'Hide'
                toggle_switch.html('Hide');
            }
        });
	});
});
        
//Select a Template & Set it as a pamphlet background
function setTemplate(element){

    $('#clock').css('backgroundImage','url(' + element.src + ')', 'height: 400px','width:350px');
        console.log(element.src);
   
}

//Move Text Around
$( function() {
    $( "#draggable" ).draggable();
    $("#drag").draggable();
    $("#draggie").draggable();
    
});

 //Publish Function
 function publishAd(){
            
    var campaignName = $("#campaignName").val();
    var beacon = $("#beaconUUID").val();
    var elm = $('#clock').get(0);
    var hght = "600";
    var wdth = "450";
    var type = "jpg";
    var filename = "digitalPoster";

    html2canvas(elm).then(function(canvas){
        var img = Canvas2Image.convertToImage(canvas);

           //sends' data to FirebaseController
           sendDataToController(img);//campaignName,beacon,img);
          //... console.log(img);
    });
} 
    
//prepares to send data to firebase
function sendDataToController(img){//campaignName,beacon, img){

    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/createCampaign', // This is the url we gave in the route
        data:{
            'name': campaignName,
            'img': img.src,
             _token : $('meta[name="csrf-token"]').attr('content')
        }, // a JSON object to send back
        success: function(response){ 
            // What to do if we succeed
            if(response == '1'){
               // $('#donePublish').trigger('click');
                $.LoadingOverlay("hide");
            }
        },error: function(jqXHR, textStatus, errorThrown) { 
            // What to do if we fail
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}

