$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "SelectPHP",
      "method": "GET"
    }
    $.ajax(settings).done(function (response) {
      console.log(response);
      createTable(response);
      invite(response);
    });
  }
} );

function createTable(items) {
  var d = "<section style='margin-right:300px; margin-left:300px;'>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Name</th><th></th><th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length-1; i+=2) {
      d += '<tr>';
      d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
      d += '<td style="padding-right: 15px;"><input type="checkbox" id="'+ items[i]['uniqueId'] +
            '" name="' + items[i+1]['uniqueId'] +
            +'" value="'+ items[i]['name'] + '"></input></td>';
      d += '<td style="padding-right: 15px;">' + items[i+1]['name'] + '</td>';
      d += '<td style="padding-right: 15px;"><input type="checkbox" id="'+ items[i+1]['uniqueId'] + 
            '" name="' + items[i+1]['uniqueId'] +
            +'" value="'+ items[i+1]['name'] + '"></input></td>';
      d += '</tr>';
  }
  d += "</table><br></section>";
  $('#table').html(d);
}

function invite(items) {
  $("#invite").click(function(event){
    var student;
    var d = '<p>You invited: </p><p style="margin-left:300px; margin-right:300px;">';
    for (var i = 0; i < items.length; i++) {
    if(document.getElementById(items[i]['uniqueId']).checked) {
      d += items[i]['name'] + ', ';
      student = items[i]['uniqueId'];
    }
    }
    d = d.substring(0,d.length-2);
    d += '</p>';
    $('#student').html(d);
    inv(student);
  });
}

function inv(student){
  event.preventDefault();
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "invitePHP",
    "method": "POST",
    "data": JSON.stringify({
      student: student 
  })
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}
