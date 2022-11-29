$(document).ready(function() {

  $('#submitButton').click(function() {
    submitBids();
  });

  //Will trigger an alert with the project description when the button is clicked
  $('.trigger_popup').click(function() {
    alert($(this).attr("value"));
  });


  //Code that allows table rows to be dragged between the two tables
  var $tabs = $('#bid_table');
  $("tbody.t_sortable").sortable({
    connectWith: ".t_sortable",
    items: ">*:not(.sort-disabled)",
    appendTo: $tabs,
    helper:"clone",
    zIndex: 999990
  }).disableSelection();
  
  var $tab_items = $(".nav-tabs > li", $tabs).droppable({
    accept: ".t_sortable tr",
    hoverClass: "ui-state-hover",
    drop: function( event, ui ) { return false; }
  });



});

/*
Will loop through the data in the bid_table and will submit a SQL insert statement for each row
*/
function submitBids() {
  var groupID = parseInt($('#groupID').val());
  var priority = 0;
  //drop is a php page that will drop all bids in the bid table given a groupID
  $.post("drop", {groupID: groupID});

  //Loops through each row of the bid table
  $('#bid_table tbody tr.toSubmit').each(function(){
    priority++;
    var projectID = $(this).find(".projectID").html();
    //submit is a php page that will send a SQL insert statement to the database
    $.post("submit", {groupID: groupID, projectID: projectID, priority: priority, timestamp: 0});
  });

  //Refreshes page
  setTimeout(function() {
    location.reload(true);
  }, 1000);

}

