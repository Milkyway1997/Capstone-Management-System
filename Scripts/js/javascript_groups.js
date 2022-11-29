$(document).ready(function() {
  window.onload=function(){
    event.preventDefault();
    groups();
    members();
    //bids();
    invitations();
    getGroup();
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
  $('#groupTable').html(d);
}

function createMemTable(items) {
  var d = "<section>" +
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

function invitations() {
  $("#invitations").click(function(event){
    showInvitations();
  });
}

function showInvitations(){
  event.preventDefault();
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "groupInvitations",
    "method": "POST"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    createInvitationsTable(response);
    // Accept(response);
    // Refuse();
  });
}

function createInvitationsTable(items) {
  var sender;
  var d = "<section>" +
   "<table class='table table-hover' id='t'>" +
   "<thead class='thead-light'><tr><th>Invitations</th><th></th><th></th>"
            + "<th></th></tr><tr><th>Sender</th><th>GroupID</th><th></th><th></th></tr></thead>";
  for (var i = 0; i < items.length; i++) {
    sender = items[i]['name'];
    d += '<tr>';
    d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
    d += '<td style="padding-right: 15px;">' + items[i]['group_id'] + '</td>';
    d += '<td style="padding-right: 15px;"><button type="button" id="Accept" class="btn btn-success">Accept</button></td>';
    d += '<td style="padding-right: 15px;"><button type="button" id="Refuse" class="btn btn-danger">Refuse</button></td>';
    d += '</tr>';
  }
  d += "</table><br></section>";
  $('#groupInvitations').html(d);
  Accept(sender);
  Refuse();
}

function Accept(sender) {
  $("#Accept").click(function(event){
    AcceptAjax(sender);
    document.getElementById("print").innerHTML = "Accepted";
  });
}
function AcceptAjax(sender){
  event.preventDefault();
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "accept",
    "method": "POST",
    "data": JSON.stringify({
      sender: sender
  })
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}

function Refuse() {
  $("#Refuse").click(function(event){
    RefuseAjax();
    document.getElementById("print").innerHTML = "Refused";
  });
}

function RefuseAjax(){
  event.preventDefault();
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "refuse",
    "method": "POST"
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}