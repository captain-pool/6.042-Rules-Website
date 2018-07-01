function ValidURL(str) {
  var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
    '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
    '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
    '(\:\d+)?(\/[-a-z\d%_.~+]*)*'+ // port and path
    '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
    '(\#[-a-z\d_]*)?$','i'); // fragment locater
  if(!pattern.test(str)) {
    alert("Please enter a valid URL.");
    return false;
  } else {
    return true;
  }
}
function isset (strVariableName ) { 

    try { 
        eval( strVariableName );
    } catch( err ) { 
        if ( err instanceof ReferenceError ) 
           return false;
    }

    return true;

 } 
function sleep(seconds) 
{
  var e = new Date().getTime() + (seconds*1000);
  while (new Date().getTime()<=e){}
}
arr=['Lecture','Readings','AdditionalResources','PSet'];
curr_nav_idx=0;
  function navigate_prev(obj, navigate_prev=false)
  {
     if(curr_nav_idx>0&&curr_nav_idx<arr.length && !navigate_prev)
     {
       fetch_load(arr[--curr_nav_idx],'click');
       $(".next").removeClass('disableAnchor');
       
     }if(curr_nav_idx<=0){
        if(parseInt($("#unit_num").text())==1 && !navigate_prev)
        {
          $(".prev").addClass('disableAnchor');
        }
        else
        {
          $.post("retrieve.php",{'prev_unit_req':(parseInt($("#unit_num").text())-1)},function(data,status,jsXHR)
          {
            if(status=='success')
            {
              if(data=='True')
              {
                window.location.reload(true);
              }
              else
              {
                window.alert(data);
              }
            }
          });
        }
     }
  }
  function navigate_next(obj,next_unit=false)
  {
     
     if(curr_nav_idx>=0&& curr_nav_idx<arr.length-1&& !next_unit)
     {
       fetch_load(arr[++curr_nav_idx],'click');
       $(".prev").removeClass('disableAnchor');console.log(curr_nav_idx);return;
     }else{
        if($("#unit_num").text()==$("#max_unit_num").text() && !next_unit)
        {
          $(".next").addClass('disableAnchor');
        }
        else
        {
          if(parseInt($("#max_unit_num").text())>=(parseInt($("#unit_num").text())+1))
          {
            $.post("retrieve.php",{'next_unit_req':(parseInt($("#unit_num").text())+1)},function(data,status,jsXHR)
            {
              if(status=='success')
              {
                if(data=='True')
                {
                  window.location.reload(true);
                }
                else
                {
                  window.alert("Oops! that Unit is non-existent!");
                }
              }
            });
          }
        }
     }
  }
  var eventAdded=false;
function fetch_load_pset()
{
fetch_load('PSet','click');
}
function fetch_load_Lect()
{
fetch_load('Lecture','click');
}
function fetch_load_Readings()
{
  fetch_load('Readings','click');
}
function fetch_load_AddEx()
{
  navigate_Additional_Resources('AdditionalResources','click');
}
function fetch_load(param,type)
{
  if(param=='Lecture')
  {
    $.post("retrieve.php",{'finger_request':'set','UNum':parseInt($("#unit_num").text())},function(data,status,jsXHR)
    {
      if(status=='success')
      { 
        curr_nav_idx=arr.indexOf(param);
        $(".unit_nav").removeClass("curr").removeClass("item").removeClass("items").addClass("items");
        $("#video").addClass("curr").removeClass("items").addClass("item");
        $("#container1").show();
        $("#container2").hide();
        $("#container3").hide();
        $("#container4").hide();
        $(".next").removeClass('disableAnchor');
        
        eventAdded=true;
        if(type=='click')
        {
          $("#container1").find("iframe").attr("src",'https://www.youtube.com/embed/'+$("#txt").text()+'?color=white&amp;autoplay=0&amp;rel=0&amp;controls=0&amp;showinfo=0&amp;cc_load_policy=1&amp;cc_lang_pref=en&amp;enablejsapi=1&amp;widgetid=1');
          
        }if(data=='False')
          return;
        try{
        var jsondata=JSON.parse(data);}catch(e){window.alert(e);}
        if(parseInt($("#unit_num").text())==1)
        {
          $(".prev").addClass('disableAnchor');
        }
        try{var FEX=JSON.parse(jsondata.FEX);}catch(e){window.alert('Oops! Some Error occurred!');return;};
        var SCORES=jsondata.SCORES;
        if(SCORES!="NULL")
          try{var SCORESj=JSON.parse(SCORES);}catch(e){window.alert('Oops! Some Error Occurred! Decoding Scores');};
        $.each(FEX,function(idx,item)
        {
          var UnivQNUM='F'+$("#unit_num").text().trim()+'_Q'+(idx+1);
          var html="<li><div class='finger-exercise' id='Q"+(idx+1).toString()+"'><p>"+item.Question+"</p><ul type='none'><li><div class='option'><label style='width:100%;height:100%'><input type='radio' name='answer"+UnivQNUM+"' id='A_1'>"+item.Opt1+"</input></label></div></li><br/><li><div class='option'><label style='width:100%;height:100%'><input type='radio' name='answer"+UnivQNUM+"' id='A_2'>"+item.Opt2+"</input></label></div></li><br/><li><div class='option'><label style='width:100%;height:100%'><input type='radio' name='answer"+UnivQNUM+"' id='A_3'>"+item.Opt3+"</input></label></div></li><br/><li><div class='option'><label style='width:100%;height:100%'><input type='radio' name='answer"+UnivQNUM+"' id='A_4'>"+item.Opt4+"</input></label></div></li><br/></ul><input type='button' name='answer' id='S"+(idx+1).toString()+"' class='Answer-Submit' onclick='check(this)' value='Submit' style='display:inline'></input><img id='Stat"+(idx+1).toString()+"' width='20px' height='20px' src='Resources/none.png' style='display:inline'/><p style='margin:0px 20%' style='display:inline' id='acc"+(idx+1).toString()+"'></p><p style='font-size:15px;font-family:comfortaa,cursive;background-color:#fffb93;width:100%;height:auto;display:none;padding:1% 2%;' id='err"+(idx+1).toString()+"'></p></div></li><br/><br/>";
          $("#exercises").append(html);
        });MathJax.Hub.Typeset();
        if(isset(SCORESj))
        {
          $.each(SCORESj,function(idx,item)
          {
            var Qnum=item.Question.toString();
            if(Qnum[0]=='F')
            {
              var unitnum=Qnum.substring(Qnum.indexOf('F')+1,Qnum.indexOf('_'));
              var qnum=Qnum.substring(Qnum.indexOf('Q')+1,Qnum.length);
              var num=item.Choice;
              if(unitnum==$("#unit_num").text())
              {
                $("#Q"+qnum).find("#A_"+num).prop("checked",true);
                if(item.stat)
                {
                  $("#Q"+qnum).css("border","2px solid green");
                  $("#Q"+qnum).css("border-bottom","4px solid green");
                  $("#Stat"+qnum).prop("src","./Resources/tick.png");
                  
                }
                else
                {
                  $("#Q"+qnum).css("border","2px solid Red");
                  $("#Q"+qnum).css("border-bottom","4px solid Red");
                  $("#Stat"+qnum).prop("src","./Resources/cross.png");
                }
                if(parseInt(item.MAC)==parseInt(item.AC))
                  $("S"+qnum).prop("disabled",true);
                  $("#acc"+qnum).html(item.AC+" out of "+item.MAC+" attempts");
              }
            }
          });
        }
      }
    });
  }
  else if (param=='PSet')
  {
    navigate_PSET(param,type);
  }
  else if(param=='AdditionalResources')
  {
    navigate_Additional_Resources(param,type);
  }
  else if (param=='Readings')
  {
    $.post("retrieve.php",{'reading_link':'set','UNum':parseInt($("#unit_num").text())},function(data,status,jsXHR)
    {
      if(status=='success')
      {
        curr_nav_idx=arr.indexOf(param);
        if(type=='click')
        {
          $("#container1").find('iframe').attr('src','');
          
        }eventAdded=false;
        $(".unit_nav").removeClass("curr").removeClass("item").removeClass("items").addClass("items");
        $("#readings").addClass("curr").removeClass("items").addClass("item");
        $("#container1").hide();
        $("#container2").show();
        $("#container3").hide();
        $("#container4").hide();
        $(".next").removeClass('disableAnchor');
        $(".prev").removeClass('disableAnchor');
        try
        {
          var jsondata=JSON.parse(data);
          $("#container2").html("<br/><br/><h1 style='font-family:comfortaa,cursive;margin:0px 10%'>Readings </h1><p style='font-family:Quicksand,sans-serif;font-size:20px;margin:0px 13%'> Welcome to the Reading Section! Download these PDFs or read 'em right here! but do read them! They will introduce some great new concepts and brush up the skills you learned in the class</p><br/><br/>");
          $.each(jsondata,function(idx,item)
        {
          $("#container2").append("<div onclick='hide_show(this)' class='hide_show' style='border:1px solid silver;border-top:none;border-radius:20px;box-shadow:2px 2px 2px silver'><h2>Chapter "+(idx+1)+"</h2><br/><div style='height:auto;width:100%'><iframe src='PDF_viewer/viewer.html?file="+item.Link+"' height='600px' width='98%' style='margin:10px;'></iframe><br/><br/><br/></div></div>");
        });
        $('.hide_show').find('div').hide();
        }
        catch(e)
        {
        }
      }
        else
          window.alert('Some Error Occured! Please Contact Adrish');
    });
  }  
}
function navigate_Additional_Resources(param,type)
{
  $.post("retrieve.php",{'Resc':1,'UNum':$("#unit_num").text()},function(data,status,jsXHR)
  {
    if(status=='success')
    {
      if(data!='False')
      {
        curr_nav_idx=arr.indexOf(param);
        if(type=='click')
        {
          $("#container1").find('iframe').attr('src','');
        }eventAdded=false;
        $(".unit_nav").removeClass("curr").removeClass("item").removeClass("items").addClass("items");
        $("#Additional-Resources").addClass("curr").removeClass("items").addClass("item");
        $("#container1").hide();
        $("#container2").hide();
        $("#container3").hide();
        $("#container4").show();
        $(".next").removeClass('disableAnchor');
        $(".prev").removeClass('disableAnchor');
        try{
          var jdata=JSON.parse(JSON.parse(data));
          var html="<br/><br/><div style='margin:0px 30px;border:1px solid black;background-color:#cccccc;'><div style='margin:0px;display:flex;order:1;background-color:#78b70c'><h2 style='color:White;margin:0px 35%;min-height:50px;'>Additional Resources</h2></div><div style='vertical-align:bottom;display:flex;order:2;border:none;background-color:#eeeeee;margin:10px;bottom:0px'><ul type='disc' id='Resources'>";
          var final="";
          $.each(jdata,function(idx,item){
          html+="<li><a href='"+item.Link+"' target='_Blank'>"+item.Name+"</a> "+item.Description+"</li>";
          });
          html+="</ul></div>";
          $("#container4").html(html);
        }catch(e)
        {
          console.log(jdata);
        }
      }else {window.alert("Oops! There might be some server error or you might not have Additional Resources for this section");}
    }
  });
}
function navigate_PSET(param,type)
{
  $.post("retrieve.php",{'PSET':1,'UNum':$("#unit_num").text()},function(data,status,jsXHR)
  {
    if(status=='success')
    {
      curr_nav_idx=arr.indexOf(param);
      $(".unit_nav").removeClass("curr").removeClass("item").removeClass("items").addClass("items");
      $("#Psets").addClass("curr").removeClass("items").addClass("item");
      $("#container1").hide();
      $("#container2").hide();
      $("#container3").show();
      $("#container4").hide();
      $(".prev").removeClass('disableAnchor');
      $("#container3").html("<div style='border:1px solid silver;border-radius:20px;width:99%;margin:5px;height:auto;'><table style='height:auto;width:100%;border-spacing:4px;'><tr style='width:100%;height:100%;'><td id='pset' style='width:55%;height:auto'></td><td id='pset_upload' style='width:30%;height:auto'><div style='border:5px dashed #7da3e0;border-radius:10px;width:90%;height:50%;margin:0px 10px 0px 20px;'><p style='font-family:Quicksand,sans-serif;margin:15px;text-align:justify;text-justify:inter-word;'>Upload the solved Answers. As a PDF or as JPG Image. Just solve the PSet take pictures and Send it through this Portal!<br/><br/><i>You may add a little joke at the end of the solutions. You might get some bonuses for that!<b> Who knows!</b></i></p><br/><input type='file' id='PS' name='PSet'></input><br/><button id='upload' onclick='upload()'><table><tr><td><img id='up-img' src='Resources/upload.png' style='width:30px;height:30px'></img></td><td>Upload Solved PSet</td></tr></table></Button><progress id='uploadProgress' style='margin:2%;width:90%;height:20px;margin-bottom:30px;' min='0' max='100' value='0'></progress><div id='upload-stat' style='color:white;width:90%;margin:0px 2%;box-shadow:5px 5px 5px #dddddd;border-radius:10px;padding:8px;'></div></div></td></tr></table></div>");
      if(type=='click')
      {
        $("#container1").find('iframe').attr('src','');
        
      }eventAdded=false;
      if(data!=null && data.trim()!='NOPS')
      {
        var html="<br/><br/><iframe src='./PDF_viewer/viewer.html?file="+data+"' height='700px' width='100%' style='margin:10px;'></iframe> <br/><br/>";
        $("#pset").append(html);
        if($("#unit_num").text()==$("#max_unit_num").text())
        {
          $(".next").addClass('disableAnchor');
        }
      }
     else if(data.trim()=='NOPS')
     {
       $("#container3>div").html("<p style='margin:30%;font-family:Comfortaa,sans-serif;font-size:40px'>Wohoo! No PSet For this Unit! Grab an ice cream or so and celebrate!</p>");
     }
  
  else
    window.alert('Oops! Some Error Occured! Please Contact Adrish');
   }
  });
}
function upload()
{
  $("#uploadProgress").val(0);
  if($("#PS").val().length!=0)
  {
    $("#upload").css("background-color","#efefef");
    $("#upload").prop("disabled",true);
    $("#upload td:last-child").css("color","black");
    $("#upload td:last-child").html("Uploading...");
    $("#PS").upload("retrieve.php",{'UNum':$("#unit_num").text()},function(data)
    {
      if($.trim(data)=='True')
      {
        $("#upload td:last-child").html("Uploaded");
        $("#upload-stat").css("background-color","#2bb71f");
        $("#upload-stat").html("<b>Successfully Uploaded your PSet</b><br/><i>Keep an eye on the Course Progress to get your scores and solution after evaluation</i>");
        $("#up-img").prop("src","./Resources/check.png");
      }else
      {
        if($.trim(data)=='error')
        {
          $("#upload").prop("disabled",false);
          $("#upload").css("background-color","#6496e5");
          $("#upload td:last-child").css("color","white");
          $("#upload td:last-child").html("Retry");
          $("#upload-stat").css("background-color","#f22318");
          $("#upload-stat").html("Error in database! Try Again Later.");
          $("#up-img").prop("src","./Resources/retry.png");
        }
        if($.trim(data)=='False')
        {
          $("#upload").prop("disabled",false);
          $("#upload").css("background-color","#6496e5");
          $("#upload td:last-child").css("color","white");
          $("#upload td:last-child").html("Retry");
          $("#upload-stat").css("background-color","#f22318");
          $("#upload-stat").html("Error Uploading File! Retry!");
          $("#up-img").prop("src","./Resources/retry.png");
        }else if($.trim(data)=='NoACC')
        {
          $("#upload").prop("disabled",false);
          $("#upload-stat").css("background-color","#f22318");
          $("#upload-stat").html("The File Format You provided is not accepted! The valid file extensions are .jpg, .zip, .png, .pdf, .doc, .docx or .tex");
          $("#upload td:last-child").css("color","white");
          $("#upload td:last-child").html("Upload Solved PSet");
          $("#upload").css("background-color","#6496e5");
        }
        else if($.trim(data)=='AS')
        {
          $("#upload td:last-child").html("It's Already with us!");
          $("#upload-stat").css("background-color","#2bb71f");
          $("#upload-stat").html("It seems you have already uploaded your Solution. Please contact Adrish, if it was not you.");
          $("#up-img").prop("src","Resources/check.png");
        }
        else if($.trim(data)=='TO')
        {
          $("#upload td:last-child").html("Submission Date Passed!");
          $("#upload-stat").css("background-color","#f22318");
          $("#upload-stat").html("Submission Dates are over! If you face any trouble solving the problem please contact the TA team on facebook.");
          $("#up-img").prop("src","Resources/err.png");

        }
        else{console.log(data);}
          
      }
    },$("#uploadProgress"));
  }
}
function fetch_notes()
{
  $.post("retrieve.php",{'getNotes':1,"Unum":$("#unit_num").text()},function(data,status,jsXHR)
  {
    if(status=='success')
    {
      try
      {
        jsondata=JSON.parse(data);
        j2=jsondata["U"+$("#unit_num").text()];
        $.each(j2,function(idx,item)
        {
          $("#notes-div ul").append("<li>"+item+"</li>");
        });
      }catch(e)
      {
        if(data=='error')
        {
          window.alert("Oops! Some Error Occurred Fetching Your Notes From Server!");
        }
        else if(data!='null')
        {
          console.log(data);
        }
      }
    }
  });
}
function hide_show(obj)
{
  $(obj).find('div').slideToggle('slow');
}
var notes_hidden=true;
function show_hide_notes()
{
  if(notes_hidden)
  {
    $("#notes-div").show(600,'swing');
    notes_hidden=false;Mathjax.Hub.Typeset();
  }
  else
  {
    $("#notes-div").hide(600,'swing');
    notes_hidden=true;
  }
}
function check(obj)
{
  obj.disabled=true;
  obj.value="Submitting...";
  var num=obj.id.substring(1,obj.id.length);
  var UnivQNUM='F'+$("#unit_num").text().trim()+'_Q'+num;
  var IDlen=($("#Q"+num+" input[type=radio]:checked").attr('id')).trim().length;
  var Ans=($("#Q"+num+" input[type=radio]:checked").attr('id')).substring(2,IDlen).trim();
  var json=0;
  $.post("check.php",{'Qnum':UnivQNUM,'Ans':parseInt(Ans)},function(data,status,jsXHR)
  {
    obj.value="Submit";
      obj.disabled=false;
    try
    {
      json=JSON.parse(data);
      
    }
    catch(e)
    {
      if(data=='Count_Error')
        $("#err"+num).css("display","block").html("<b>Oops! the Maximum allowed Attempt is over! Please Refresh the Page!</b><br/>Please Don't Reverse Engineer the scripts and HTMLs!<br/> <i>Hacking is good, but Hacking Marks is not!</i><br/>")
      return;
    }
    if(json.stat=='True')
      {
        $("#Q"+num).css("border","2px solid green");
        $("#Q"+num).css("border-bottom","4px solid green");
        $("#Stat"+num).attr("src","./Resources/tick.png");
      }
      else if(json.stat=='False')
      {
        $("#Q"+num).css("border","2px solid Red");
        $("#Q"+num).css("border-bottom","4px solid Red");
        $("#Stat"+num).attr("src","./Resources/cross.png");
        
      }
      else
      {
        window.alert(data);
      }
      if(parseInt(json.MAC)==parseInt(json.countl))
        obj.disabled=true;
      $("#acc"+num).html(json.countl+" out of "+json.MAC+" attempts");
  });
}
function addNote()
{
  var txt=$("#notes").val();
  if(txt.length==0)
    return window.alert("Oops! found no Note to Add! did you forget to Add the notes?");
  $.post("retrieve.php",{"Notes":txt,"Unum":$("#unit_num").text()},function(data,status,jsXHR)
  {
    if(data=='True')
    {
      $("#notes-div ul").append("<li>"+txt+"</li>");
      $("#notes").val("");
      MathJax.Hub.Typeset();
    }else if(data=='False')
    {
      window.alert("Oops! Some Error Occurred!");
    }
    else
    {
      window.alert(data);
    }
  });
}
