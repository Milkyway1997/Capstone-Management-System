function myYes() {
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "leavePHP",
    "method": "POST"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
  document.getElementById("leave_succ").innerHTML = "You left the group.";
}

function myNo() {
  window.location.href = "dashboard";
}

$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    groups();
    members();
  }
} );

function groups(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "SelectGroupsPHP",
    "method": "GET"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    createGroupTable(response);
  });
}

function members(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "SelectMember",
    "method": "GET"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    createMemTable(response);
  });
}

function createGroupTable(items) {
  var d = "<table class='table table-hover' id='t'><thead class='thead-light'><tr><th>Groups</th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
      d += '<tr>';
      d += '<td style="padding-right: 15px;">' + items[i]['group_id'] + '</td>';
      d += '<td style="padding-right: 15px;"><button type="button" id="'+ items[i]['group_id']
            +'" value="'+ items[i]['group_id'] + '">Join</button></td>';
      d += '</tr>';
  }
  d += "</table><br>";
  //$('#groupTable').html(d);
}

function createMemTable(items) {
  var d = "<section style='margin-right:500px; margin-left:500px;'>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Team Members</th><th></th><th></th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    //d += '<td style="padding-right: 15px;">' + items[i]['id'] + '</td>';
    //d += '<td style="padding-right: 15px;">' + items[i]['unique_id'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Member').html(d);
}

// function createBidsTable(items) {
//   var d = "<section>" +
//    "<table class='table table-hover' id='t'>" +
//    "<thead class='thead-light'><tr><th>Priority</th><th>Current Project Bids</th><th></th>"
//             + "<th></th><th></th></tr></thead>";
//   for (var i = 0; i < items.length; i++) {
//     d += '<tr>';
//     d += '<td style="padding-right: 15px;">' + items[i]['priority'] + '</td>';
//     d += '<td style="padding-right: 15px;">' + items[i]['project_name'] + '</td>';
//     d += '</tr>';
//   }
//   d += "</table><br></section>";
//   $('#Bids').html(d);
// }