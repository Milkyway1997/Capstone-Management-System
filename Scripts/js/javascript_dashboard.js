$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    members();
    bids();
    getGroup();
  }
} );

//Sends an ajax request to the getUserGroup php page, which will return a group ID given the user ID
function getGroup(group) {
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "getUserGroup",
    "method": "GET"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    var groupId = JSON.parse(response);
    $('#group').html("CSE 448/449 Group " + groupId);
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

  function bids(){
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "SelectBids",
      "method": "GET"
    }
    $.ajax(settings).done(function (response) {
      console.log(response);
      createBidsTable(response);
    });
}


function createMemTable(items) {
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Team Members</th><th></th><th></th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Member').html(d);
}

function createBidsTable(items) {
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Priority</th><th>Current Project Bids</th><th></th>"
            + "<th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['priority'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['project_name'] + '</td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#Bids').html(d);
}