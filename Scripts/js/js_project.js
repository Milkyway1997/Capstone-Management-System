$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    projects();
  } 

  $("#submit").click(function(event){   
    event.preventDefault();

    var name = $("#name").val()
    var description = $.trim($("#des").val());
    var size = $("#sel1").val();
    
    if (name ==""){
      alert("The name cannot be empty.");
    }else{
        record(name,description,size);
        location.reload(true);
        alert("The new project is uploaded.");
    }
  });


  $("#uploadForm").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "bulkInsertProjects",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
        },
        error: function(){} 	        
        });
    }));

    $("#fileButton").click(function() {
      location.reload(true);
    });
} );




  function record(na,des,size){

    var cur =$(location).attr('href');
    var loc = cur.lastIndexOf("/");
    cur = cur.substring(0,loc);
    loc = cur.lastIndexOf("/");
    cur = cur.substring(0,loc);


    $.ajax({
        url: cur +'/routes/add_project.php',
        contentType: 'application/json',
        datatype: 'json',
        data: JSON.stringify({
            name: na ,
            description: des,
            num: size
        }),
  
        success: function(data) {
            console.log("hhhhhhh");
                
  
  
        },
        crossDomain: true,
        method: "POST",
        "headers": {
            "Access-Control-Allow-Origin": "*",
        },
  
    });



  }

  function projects(){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "pro_selectProjects",
      "method": "GET"
    }
    $.ajax(settings).done(function (response) {
      console.log(response);
      createProjectsTable(response);
    });
}






function createProjectsTable(items) {
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Project Name</th><th>Max Size</th><th>Description</th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['project_name'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['max_size'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['project_description'] + '</td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Projects').html(d);
}

