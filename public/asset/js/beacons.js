/**
 * @function
 * @param {beacon id} id 
 * @name deleteBeacon
 * @memberof BeaconsController
 * @since 0.0.1
 */
function deleteBeacon(id){
               
    if(confirm('Are you sure?')){
     $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/deleteBeacon",
        data: {
            'id':id,
            //"_token": "{{ csrf_token() }}",
            _token : $('meta[name="csrf-token"]').attr('content')
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