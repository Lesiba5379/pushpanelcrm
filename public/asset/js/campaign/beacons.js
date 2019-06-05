/***
 * Author: Lesiba Nxumalo.
 * Desc: beacon management: assign and unassign beacon.
 *       there's two types of plugins involved,
 *       bootstrap multi-select and jquery multiselect. 
 */

$(document).ready(function(){

//plugin one.    
$('.assignBeacon').multiselect();

//plugin two.
$('#pre-selected-options').multiSelect({

afterDeselect: function(values){

console.log(values);




$.ajax({

type: "POST",

url: "/unassignBeacon",

data: {

'values': values,

"_token": "{{ csrf_token() }}",

},

})

.done(function(data){

console.log(data);



iziToast.success({

title: 'Message: ',

message: 'beacon removed successfully.',

position: 'center'

});



})

.fail(function(data){

console.log(data);

iziToast.error({

title: 'Message: ',

message: 'something went wrong while removing beacon.',

position: 'center'

});

});





}

});

});
