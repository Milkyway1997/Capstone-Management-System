$(document).ready(function() {

// generate a random number for the user    
var veri_num =  Math.floor(1000 + Math.random() * 9000);
var user_email = "";

$("#sent").hide();
$("#other").hide();
$("#final").hide();
$("#succeed").hide();
$("#verification").click(function(event){
    
      
     event.preventDefault();
    //get  the email    
     var email = $("#email").val();
     var back = "@miamioh.edu";
     user_email = email.concat(back); 
     email = user_email;
     $("#verification").hide();
     $("#sent").show();  
     $("#other").show(); 
     $("#fail").hide();
     //get  the email 
      
        

       
       
       //send to php




       wirteIn(email, veri_num);
    });

    $("#submit").click(function(event){
    
      
        event.preventDefault();
        var input = $("#code").val();
        
        //verify the code 
        
    
        if (input == veri_num){
        //successfully verified
        $("#sent").hide();  
        $("#other").hide();
        $("#succeed").show();
        $("#final").show();
        $("#different").hide();
        }else {
            $("#fail").show();
     
        }
   
       });
    


       $("#record").click(function(event){
    
      
        event.preventDefault();
        $("#succeed").hide();
        var pass1 = $("#pass1").val();
        var pass2 = $("#pass2").val();
        //verify the code 
        
    
        if (pass1 == pass2){
        //successfully verified

        recordUser(user_email,pass1);
        $("#different").hide();
        $("#record").hide();

     




        window.setTimeout(function(){
            alert("You successfully register an account!  ");
            // Move to a new location or you can do something else
            window.location.href = "http://ceclnx01.cec.miamioh.edu/~liul16/capstone-management-a/index.php/";
    
        }, 1000);

        }else {
            $("#different").show();

            
        }
          
     
   
       });



});



function wirteIn(email, num) {
    var api_url = '/~zhaic/cse448';
    $.ajax({
        url: api_url + '/mail.php',
        contentType: 'application/json',
        datatype: 'json',
        data: JSON.stringify({
            address: email ,
            random: num
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

  function recordUser(email, pass) {
    var api_url = '/~zhaic/cse448';
    $.ajax({
        url: api_url + '/register.php',
        contentType: 'application/json',
        datatype: 'json',
        data: JSON.stringify({
            address: email ,
            password: pass
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


    
    