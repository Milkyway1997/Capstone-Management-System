$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    groups();
    users();
  }
} );

function groups(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "pro_selectGroups",
    "method": "GET"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    createGroupsTable(response);
  });
}

  function users(){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "pro_selectUsers",
      "method": "GET"
    }
    $.ajax(settings).done(function (response) {
      console.log(response);
      createUsersTable(response);
    });
}

function createGroupsTable(items) {
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Group Id</th><th>Bidding project</th><th>Group Leader</th><th></th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['group_id'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['m6'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['leader_name'] + '</td>';
    if(items[i]['m1']){
    d += '<td style="padding-right: 15px;">' + items[i]['m1'] + '</td>';
    }
    if(items[i]['m2']){
      d += '<td style="padding-right: 15px;">' + items[i]['m2'] + '</td>';
    }
    if(items[i]['m3']){
      d += '<td style="padding-right: 15px;">' + items[i]['m3'] + '</td>';
    }
    if(items[i]['m4']){
      d += '<td style="padding-right: 15px;">' + items[i]['m4'] + '</td>';
    }
    if(items[i]['m5']){
      d += '<td style="padding-right: 15px;">' + items[i]['m5'] + '</td>';
    }
    

    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Groups').html(d);
}

function createUsersTable(items) {
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Name</th><th>Unique Id</th><th></th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['unique_id'] + '</td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Students').html(d);
}