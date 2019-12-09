//Prepend $ to table values

//$(document).on('knack-view-render.view_150', function(event, view, data) {
   
 //   $("#view_150 td.field_55").each(function() {  
      
 //      $(this).prepend("$");
      
       
   
//    })
  
//});

//Define the common Ajax function

function getInternalObjects(url,type,async,callback){
   $.ajax({
    url: url,
    type: type,
    async: async,
    headers: {
        'X-Knack-Application-Id': '5581495731641a283536f53c'
      , 'X-Knack-REST-API-Key': '6399e1d0-17ca-11e5-a5e8-9f27879d48f5'
    },
    success: callback
   });
  
}

//Get total existing days
function sumResourceExtDays(name){
      var extdays=0;
      $(name).find("span").each(function(){
 if($(this).text().trim() !== ""){
      extdays += parseInt($(this).text().trim());
  }
  });
      return extdays;
}

//Assign Ember status to month
function assignEmberStatus(monthlist){ 
    for(var i = 0; i < monthlist.length; i++) {
       if(monthlist[i][0]==monthlist[i][1]){
           $(monthlist[i][2]).css("background-color", "#FF9933");
     }
    }
}

//Validation on the available days
function validateAvaDays(monthlist){
      for(var i = 0; i < monthlist.length; i++) {
    if(monthlist[i][0] + parseInt($(monthlist[i][2]).val()) > monthlist[i][1]){
        alert("The allocation days of "+monthlist[i][3]+" is over the resource limit, please check it again!");
        $(monthlist[i][2]).css("border-color", "#CC0000");  
        return false;
    }
    else{
         $(monthlist[i][2]).css("border-color", "#bbb");   
    }
    }
    return true;
}

//Set new project available days value

$(document).on('knack-view-render.view_149', function(event, view, data) {

  //Sum of the existing allocated days
var extdaysJul=sumResourceExtDays("#view_149 td.field_37");
var extdaysAug=sumResourceExtDays("#view_149 td.field_38");
var extdaysSep=sumResourceExtDays("#view_149 td.field_39");
var extdaysOct=sumResourceExtDays("#view_149 td.field_40");
var extdaysNov=sumResourceExtDays("#view_149 td.field_41");
var extdaysDec=sumResourceExtDays("#view_149 td.field_42");
var extdaysJan=sumResourceExtDays("#view_149 td.field_5");
var extdaysFeb=sumResourceExtDays("#view_149 td.field_32");
var extdaysMar=sumResourceExtDays("#view_149 td.field_33");
var extdaysApr=sumResourceExtDays("#view_149 td.field_34");
var extdaysMay=sumResourceExtDays("#view_149 td.field_35");
var extdaysJun=sumResourceExtDays("#view_149 td.field_36");
  
var grouppeoplecount=$("#view_149 tr.kn-table-group.kn-group-level-1").length;  
  
var groupyearcount=$("#view_149 tr.kn-table-group.kn-group-level-2").length;    

//retrieve the group resource 
var peopleid= $("#view_149 tr.kn-table-group.kn-group-level-1").find('span').children().attr('class');  
  
var yearid= $("#view_149 tr.kn-table-group.kn-group-level-2").find('span').children().attr('class');  


  //Only change color for one group resource filter and one financial year result
  if(typeof peopleid !== "undefined" && typeof yearid !=="undefined" && grouppeoplecount==1 && groupyearcount==1){  
    
    
  // api 
  var api_url_Max = 'https://api.knackhq.com/v1/objects/object_46/records';

  // preparing filters
    var filtersMax = [
  {
    field: 'field_327',
    operator: 'is',
    value: peopleid
  },
  {
    field: 'field_343',
    operator: 'is',
    value: yearid
  }
  ]
    
  // add to URL
  api_url_Max += '?filters='+encodeURIComponent(JSON.stringify(filtersMax));    
    
    //Retrieve the Max limit value of availabilities days
    
    getInternalObjects(api_url_Max, 'Get', false, function(response){
       $.each(response['records'], function(index, obj) {
    
      var maxdaysJul= obj.field_328;
      var maxdaysAug= obj.field_329;
      var maxdaysSep= obj.field_330;
      var maxdaysOct= obj.field_331;
      var maxdaysNov= obj.field_332;
      var maxdaysDec= obj.field_333;
      var maxdaysJan= obj.field_334;
      var maxdaysFeb= obj.field_335;
      var maxdaysMar= obj.field_336;
      var maxdaysApr= obj.field_337;
      var maxdaysMay= obj.field_338;
      var maxdaysJun= obj.field_339; 
      
      $(obj.field_327_raw).each(function(key, val){
      
      if(peopleid==val.id){ 
      
        var params = [ [extdaysJul, maxdaysJul, "#view_149 th.field_37"], [extdaysAug, maxdaysAug, "#view_149 th.field_38"],[extdaysSep, maxdaysSep, "#view_149 th.field_39"],
                       [extdaysOct, maxdaysOct, "#view_149 th.field_40"], [extdaysNov, maxdaysNov, "#view_149 th.field_41"],[extdaysDec, maxdaysDec, "#view_149 th.field_42"],
                       [extdaysJan, maxdaysJan, "#view_149 th.field_5"], [extdaysFeb, maxdaysFeb, "#view_149 th.field_32"],[extdaysMar, maxdaysMar, "#view_149 th.field_33"],
                       [extdaysApr, maxdaysApr, "#view_149 th.field_34"], [extdaysMay, maxdaysMay, "#view_149 th.field_35"],[extdaysJun, maxdaysJun, "#view_149 th.field_36"]];
        assignEmberStatus(params); 

       } 
                   
      })        
   })
  });    
 }
});

//Validation on the available days editing
$(document).on('knack-view-render.view_176', function(event, view, data) {
  // api 
  var api_url_Exist = 'https://api.knackhq.com/v1/objects/object_2/records';
  
  var api_url_Max = 'https://api.knackhq.com/v1/objects/object_46/records';
 
  // preparing filters
    var filtersExist = [
  {
    field: 'field_89',
    operator: 'is',
    value: $("#view_176-field_89").val()
  },
  {
    field: 'field_56',
    operator: 'is',
    value: $("#view_176-field_56").val()
  }
  ]
    
    var filtersMax = [
  {
    field: 'field_327',
    operator: 'is',
    value: $("#view_176-field_89").val()
  },
  {
    field: 'field_343',
    operator: 'is',
    value: $("#view_176-field_56").val()
  }
  ]
    
  // add to URL
   api_url_Exist += '?filters='+encodeURIComponent(JSON.stringify(filtersExist));
  
   api_url_Max += '?filters='+encodeURIComponent(JSON.stringify(filtersMax));
   
  //Initial the values
  var maxdaysJul=0;
  var maxdaysAug=0;
  var maxdaysSep=0;
  var maxdaysOct=0;
  var maxdaysNov=0;
  var maxdaysDec=0;
  var maxdaysJan=0;
  var maxdaysFeb=0;
  var maxdaysMar=0;
  var maxdaysApr=0;
  var maxdaysMay=0;
  var maxdaysJun=0;
  
  var sumdaysJul=0;  
  var sumdaysAug=0; 
  var sumdaysSep=0; 
  var sumdaysOct=0; 
  var sumdaysNov=0; 
  var sumdaysDec=0; 
  var sumdaysJan=0;  
  var sumdaysFeb=0; 
  var sumdaysMar=0; 
  var sumdaysApr=0; 
  var sumdaysMay=0; 
  var sumdaysJun=0; 
  
  var tolsumdaysJul=0;  
  var tolsumdaysAug=0; 
  var tolsumdaysSep=0; 
  var tolsumdaysOct=0; 
  var tolsumdaysNov=0; 
  var tolsumdaysDec=0; 
  var tolsumdaysJan=0;  
  var tolsumdaysFeb=0; 
  var tolsumdaysMar=0; 
  var tolsumdaysApr=0; 
  var tolsumdaysMay=0; 
  var tolsumdaysJun=0;
  
  //Get Existing total
  getInternalObjects(api_url_Exist, 'Get', false, function(response){ 
      
    $.each(response['records'], function(index, obj) { 
      
      tolsumdaysJul+= parseInt(obj.field_37);
      tolsumdaysAug+= parseInt(obj.field_38);
      tolsumdaysSep+= parseInt(obj.field_39);
      tolsumdaysOct+= parseInt(obj.field_40);
      tolsumdaysNov+= parseInt(obj.field_41);
      tolsumdaysDec+= parseInt(obj.field_42);
      tolsumdaysJan+= parseInt(obj.field_5);
      tolsumdaysFeb+= parseInt(obj.field_32);
      tolsumdaysMar+= parseInt(obj.field_33);
      tolsumdaysApr+= parseInt(obj.field_34);
      tolsumdaysMay+= parseInt(obj.field_35);
      tolsumdaysJun+= parseInt(obj.field_36);

      if($("[name=id]").val() != obj.id){
          if(obj.field_37 !== "" ){ sumdaysJul+= parseInt(obj.field_37);}
          if(obj.field_38 !== "" ){ sumdaysAug+= parseInt(obj.field_38);}
          if(obj.field_39 !== "" ){ sumdaysSep+= parseInt(obj.field_39);}
          if(obj.field_40 !== "" ){ sumdaysOct+= parseInt(obj.field_40);}
          if(obj.field_41 !== "" ){ sumdaysNov+= parseInt(obj.field_41);}
          if(obj.field_42 !== "" ){ sumdaysDec+= parseInt(obj.field_42);}
          if(obj.field_5 !== "" ){ sumdaysJan+= parseInt(obj.field_5);}
          if(obj.field_32 !== "" ){ sumdaysFeb+= parseInt(obj.field_32);}
          if(obj.field_33 !== "" ){ sumdaysMar+= parseInt(obj.field_33);}
          if(obj.field_34 !== "" ){ sumdaysApr+= parseInt(obj.field_34);}
          if(obj.field_35 !== "" ){ sumdaysMay+= parseInt(obj.field_35);}
          if(obj.field_36 !== "" ){ sumdaysJun+= parseInt(obj.field_36);}
  }
      
    })
  });
  
  //Get Maximum value of Available days  
    getInternalObjects(api_url_Max, 'Get', false, function(response){ 

    $.each(response['records'], function(index, obj) { 
      maxdaysJul= parseInt(obj.field_328);
      maxdaysAug= parseInt(obj.field_329);
      maxdaysSep= parseInt(obj.field_330);
      maxdaysOct= parseInt(obj.field_331);
      maxdaysNov= parseInt(obj.field_332);
      maxdaysDec= parseInt(obj.field_333);
      maxdaysJan= parseInt(obj.field_334);
      maxdaysFeb= parseInt(obj.field_335);
      maxdaysMar= parseInt(obj.field_336);
      maxdaysApr= parseInt(obj.field_337);
      maxdaysMay= parseInt(obj.field_338);
      maxdaysJun= parseInt(obj.field_339);
      
    })
  });
  
  //End Ajax Call
  
  //Attach the available days to the month label
  $("#view_176 div#kn-input-field_37").find("span").append(" ("+(maxdaysJul-tolsumdaysJul)+"/"+maxdaysJul+")");
  $("#view_176 div#kn-input-field_38").find("span").append(" ("+(maxdaysAug-tolsumdaysAug)+"/"+maxdaysAug+")"); 
  $("#view_176 div#kn-input-field_39").find("span").append(" ("+(maxdaysSep-tolsumdaysSep)+"/"+maxdaysSep+")");
  $("#view_176 div#kn-input-field_40").find("span").append(" ("+(maxdaysOct-tolsumdaysOct)+"/"+maxdaysOct+")"); 
  $("#view_176 div#kn-input-field_41").find("span").append(" ("+(maxdaysNov-tolsumdaysNov)+"/"+maxdaysNov+")");  
  $("#view_176 div#kn-input-field_42").find("span").append(" ("+(maxdaysDec-tolsumdaysDec)+"/"+maxdaysDec+")");
  $("#view_176 div#kn-input-field_5").find("span").append(" ("+(maxdaysJan-tolsumdaysJan)+"/"+maxdaysJan+")");
  $("#view_176 div#kn-input-field_32").find("span").append(" ("+(maxdaysFeb-tolsumdaysFeb)+"/"+maxdaysFeb+")");  
  $("#view_176 div#kn-input-field_33").find("span").append(" ("+(maxdaysMar-tolsumdaysMar)+"/"+maxdaysMar+")");
  $("#view_176 div#kn-input-field_34").find("span").append(" ("+(maxdaysApr-tolsumdaysApr)+"/"+maxdaysApr+")");
  $("#view_176 div#kn-input-field_35").find("span").append(" ("+(maxdaysMay-tolsumdaysMay)+"/"+maxdaysMay+")");  
  $("#view_176 div#kn-input-field_36").find("span").append(" ("+(maxdaysJun-tolsumdaysJun)+"/"+maxdaysJun+")");  
  
  $("#view_176 .kn-submit input[type=submit]").on("click", function() {
    //Validation check on total available days
        var params = [ [sumdaysJul, maxdaysJul, "#view_176 input#field_37", "July"], [sumdaysAug, maxdaysAug, "#view_176 input#field_38","Augst"],[sumdaysSep, maxdaysSep, "#view_176 input#field_39","September"],
                       [sumdaysOct, maxdaysOct, "#view_176 input#field_40", "October"], [sumdaysNov, maxdaysNov, "#view_176 input#field_41", "November"],[sumdaysDec, maxdaysDec, "#view_176 input#field_42", "December"],
                       [sumdaysJan, maxdaysJan, "#view_176 input#field_5", "January"], [sumdaysFeb, maxdaysFeb, "#view_176 input#field_32", "Feburary"],[sumdaysMar, maxdaysMar, "#view_176 input#field_33", "March"],
                       [sumdaysApr, maxdaysApr, "#view_176 input#field_34", "April"], [sumdaysMay, maxdaysMay, "#view_176 input#field_35", "May"],[sumdaysJun, maxdaysJun, "#view_176 input#field_36", "June"]];
        return validateAvaDays(params);                   
});  
});


//Set Colours on Tables to Red Green or Amber

$(document).on('knack-view-render.view_150', function(event, view, data) {
   
   
  $("#view_150 td.field_5").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc"; 
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
    
 
  $("#view_150 td.field_32").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  
  
  $("#view_150 td.field_33").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  
  $("#view_150 td.field_34").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_35").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_36").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_37").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_38").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_39").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_40").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_41").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    }) 
  $("#view_150 td.field_42").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
  
  //-------------------
  
  
   $("#view_150 td.field_89").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
    $("#view_150 td.field_2").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
     $("#view_150 td.field_85").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
      $("#view_150 td.field_4").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
       $("#view_150 td.field_6").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
        $("#view_150 td.field_7").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
         $("#view_150 td.field_11").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
          $("#view_150 td.field_12").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
           $("#view_150 td.field_13").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
            $("#view_150 td.field_14").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
             $("#view_150 td.field_15").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
              $("#view_150 td.field_56").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
               $("#view_150 td.field_115").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
                $("#view_150 td.field_259").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
                 $("#view_150 td.field_300").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
   
                   $("#view_150 td.field_55").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
   



 //-------------------
  
  
   $("#view_165 td.field_89").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
    $("#view_165 td.field_2").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
     $("#view_165 td.field_85").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
      $("#view_165 td.field_4").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
       $("#view_165 td.field_6").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
        $("#view_165 td.field_7").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
         $("#view_165 td.field_11").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
          $("#view_165 td.field_12").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
           $("#view_165 td.field_13").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
            $("#view_165 td.field_14").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
             $("#view_165 td.field_15").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
              $("#view_165 td.field_56").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
               $("#view_165 td.field_115").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
                $("#view_165 td.field_259").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
                 $("#view_165 td.field_300").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
   
                   $("#view_165 td.field_55").each(function() {   
     
 
     var textColor = ($(this).find("span").text().trim() != "") ? "#f6fff6" : "#e0fffc";
     
 
             
    
        $(this).css("background-color", textColor);  
   
    })
   
});

