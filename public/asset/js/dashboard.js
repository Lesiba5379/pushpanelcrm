function deleteProfile(id){
        
    if(confirm('Are you sure?')){
        $.ajax({
           type: "POST",
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           url: "/deleteProfile",
           data: {
               'id':id,
               //"_token": "{{ csrf_token() }}",
               _token : $('meta[name="csrf-token"]').attr('content')
           },
        }) 
        .done(function(data){
            if(data == '1'){
                alert('Profile removed');
                location.reload();
            }
            console.log(data);
        })
        .fail(function(data){
            console.log(data);
        });
       }
}

function dbBlock(id){
 
  $.LoadingOverlay("show");
 
  $.ajax({
    type: "POST",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/blockUser",
      data: {
          'id':id,
          //"_token": "{{ csrf_token() }}",
          _token : $('meta[name="csrf-token"]').attr('content'),
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

getAllUsers();