
// This would update the text on every single view across the app
$(document).on('knack-scene-render.any', function(event, scene) {
  
// Rename Go back button

$(".kn-back-link a").html("Go Back");
$('a.ang-link:contains("Back to Administration")').html("Back to Home");
  
// Display the view records button based on the user role
  if(Knack.getUserRoles('object_2')==true){
    if($('.kn-link-2 span').text()=="Review Existing Baptcare Assets"){  
 
  $(".kn-link-2").empty();

    }
  }
  else{
    if($('.kn-link-2 span').text()=="Review Existing Baptcare Assets"){

  $(".kn-link-3").empty();   
    }
  }
     
    $(".kn-submit input[type=submit]").attr("value", "Save me");   
  
    $("label[for='zip']").html("Postcode");
  
  // Change the position of account settings link
    $(".kn-scenes").prepend($(".kn-view.kn-info.clearfix"));
  
  // Dollar Sign to form fields
  $('.kn-input-currency .input').each(function() {
    $(this).prepend('<span class="currency">$</span>');
});
  
  // Hard code dollar sign to reports data
    $('.kn-report-row-2 .kn-report-1 tspan').each(function() {
    $(this).prepend('$');
});
  
  // Change Logo Banner Image
  if(typeof($('.kn-current_user').attr("id")) != "undefined" && $('.kn-current_user').attr("id") !== null) {
    $(".logo-img").find("img").attr("src","http://www.sentric.com.au/wp-content/uploads/2015/06/Baptcare_Logo.png");
   }
  else{
       $(".logo-img").find("img").attr("src","http://www.sentric.com.au/wp-content/uploads/2015/06/Isecure_Logo.png");
  }

});

// Add footer //
 
$(document).on('knack-scene-render.any', function(event, page) {
 
$('<div style="color:#666;background-color:none !important" id="myfooter" ></div>').insertAfter($("#knack-body"));
 
});




