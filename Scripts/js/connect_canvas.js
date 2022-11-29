$(document).ready(function() {
    $("#submit").click(function(event){
        event.preventDefault();
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "../routes/canvas.php?api=api/v1/courses/10530000000119656/users&token=" + $("#key").val(),
            "method": "GET",
	        "dataType": "json"
        };
        $.ajax(settings).done(function (response) {
            console.log(response);
            var cleanedResponse = [];
            for (var i = 0; i < response.length; i++) {
                if (response[i]['sis_user_id'] != null && response[i]['sis_user_id'] != 'null') {
                    cleanedResponse.push(response[i]);
                }
            }
            $.ajax({
                url: "../routes/write_students.php",
                type: "POST",
                data: {"users": cleanedResponse}
            }).done(function (writeResponse) {
                $("#key").val('');
                $("#output").empty();
                var addedUsers = writeResponse.split(',');
                var n = 0;
                if (addedUsers != "") {
                    n = addedUsers.length;
                }
                console.log(addedUsers[0]);
                if (n > 0) {
                    $("#output").append("Success! ");
                }
                $("#output").append("Added " + n + " student(s) to the database.<br><br>")
                for (i = 0; i < n; i++) {
                    $("#output").append(addedUsers[i] + "<br>");
                }
                if (n > 0) {
                    $("#output").append("<br>These students can now register on the website.<br><br>")
                }

                // function createTable(items) {
                //     var d = "<section>" +
                //      "<table class='table table-hover' id='t'>" +
                //      "<thead class='thead-light'><tr><th>Students</th><th>Unique Id</th></tr></thead>";
                //     for (var i = 0; i < items.length; i++) {
                //       d += '<tr>';
                //       d += '<td style="padding-right: 15px;">' + items[i]['name'] + '</td>';
                //       d += '<td style="padding-right: 15px;">' + items[i]['sis_user_id'] + '</td>';
                //       d += '</tr>';
                //     }
                //     d += "</table><br></section>";
                //     $('#print').html(d);
                //     $('#announcement').html("You successfully added students to database.");
                //   }
            });
        });
    });
});

// function writeOut(){
//     var api_url = '/~liul16/CSE448/CanvasTest';
//     $.ajax({
//         url: api_url + '/writePHP.php',
//         contentType: 'application/json',
//         datatype: 'json',
//         data: JSON.stringify({
//             uniqueID: id ,
//             name: na
//         }),
//         success: function(data) {
//             console.log("wwwwwwwwww");
//         },
//         crossDomain: true,
//         method: "POST",
//         "headers": {
//             "Access-Control-Allow-Origin": "*",
//         },
//     });
// }

// function writeIn(id, na) {
//   var api_url = '/~liul16/CSE448/CanvasTest';
//   $.ajax({
//       url: api_url + '/InsertPHP.php',
//       contentType: 'application/json',
//       datatype: 'json',
//       data: JSON.stringify({
//           uniqueID: id ,
//           name: na
//       }),
//       success: function(data) {
//           console.log("hhhhhhh");
//       },
//       crossDomain: true,
//       method: "POST",
//       "headers": {
//           "Access-Control-Allow-Origin": "*",
//       },

//   });
// }







// var settings = {
//     "async": true,
//     "crossDomain": true,
//     "url": "https://canvas.instructure.com/api/v1/courses/10530000000119656/users",
//     "method": "GET",
//     "headers": {
//       "Authorization": "Bearer 1053~6RNOX3YapX23Q9tHiSSlD86ahbG0qZjlVyXS1Pcq1CZCwnUXWzlAIImhnfM9e0Qb",
//       "User-Agent": "PostmanRuntime/7.19.0",
//       "Accept": "*/*",
//       "Cache-Control": "no-cache",
//       "Postman-Token": "1b4ca928-46fa-41be-b509-14b524968fc2,fa69b245-b880-4725-9a5f-28b6825c7005",
//       "Host": "canvas.instructure.com",
//       "Accept-Encoding": "gzip, deflate",
//       "Cookie": "log_session_id=79012eaebb5bb03a0319f8e2f4ddef52; _csrf_token=qHOZctXievqEQoHLt1qc07oVaN7ue%2Fva4ut9N8BgzOvHB9Ak4asgn%2Bp2wKqGLfK6%2FFxDu6ZJsY%2B4vQtelBe4wA%3D%3D; canvas_session=kuXT-rY7SP93psdEtupjtw.u2zu1ABagcDlu38pwFVbn3qgMevDa8q9f7T4LhKivMPmZuG7Coag15QqhO7Kj_WUgU75WNCNHrs-YQP3giiZ2XzmG22DDOpnNZ6lQJj4_whMI8ezAM5ktqQhz-kUnaPT.1JCgWKC-xNpuiVRqeCdb_EMNkwU.XbsCLQ",
//       "Connection": "keep-alive",
//       "cache-control": "no-cache"
//     }
//   }
  
//   $.ajax(settings).done(function (response) {
//     console.log(response);
//   });

