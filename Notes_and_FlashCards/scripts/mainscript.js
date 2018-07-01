$(document).ready(function(){
  $(".note-div").each(function(idx,item)
  {
    var rgb=[255,0,0];
    rgb[0]=Math.round(Math.random()*255);
    rgb[1]=Math.round(Math.random()*255);
    rgb[2]=Math.round(Math.random()*255);
    var contrast=Math.round((parseInt(rgb[0])*299+parseInt(rgb[1])*587+parseInt(rgb[2])*114)/1000);
    var fore=(contrast>125)?'black':'white';
    var back='rgb('+rgb[0]+','+rgb[1]+','+rgb[2]+')';
    $(item).css('background-color',back);
    $(item).find('.text').css('color',fore);
  });
  $(".formhtml").each(function(idx,item)
  {
    var id=$(item).parent().find('.num').text();
    $(item).find("textarea").prop("id",id);
    $(item).parent().popover({html:true,content:function(){return $(item).html();}});
    $(item).parent().prop("title","Edit This Note");
  });
});
function delete_notes(obj)
{
  var noteid=$(obj).find('.num').text();
  var unit_num=noteid.substring(0,noteid.indexOf('_'));
  var note_num=noteid.substring(noteid.indexOf('_')+1,noteid.length);
  $.post('exec.php',{'delete':1,'unitNum':unit_num,'noteNum':note_num},function(data,status,jsXHR)
  {  if(status=='success' && data=='True')
  {
    window.alert("Note deleted Successfully!");
    $("#note-list>li:nth-child("+unit_num.substring(1)+")").find("p:contains('Note_Id "+note_num+"')").parent().remove();
    if($("#note-list>li:nth-child("+unit_num.substring(1)+")").find("p:contains('Note_Id')").parent().length==0)
    {
      $("#note-list>li").remove("li:nth-child("+unit_num.substring(1)+")");
    }
    if($("#note-list>li").length==0)
    {
      $("#note-list").html("<div><h1 style='font-family:comfortaa;'>Oops! No more notes to display. Go ahead and create some. They are really great to keep stuffs in mind.</h1></div>");
    }
  }
  else
  {
    window.alert("Oops! Some Error Occurred! Please Try Again Later!");
  }
  });
}
function edit_notes(obj)
{
  $(obj).popover('show');
}
function send(obj)
{
  var value=$(obj).parent().find("textarea").val();
  var str=$(obj).parent().find("textarea").prop('id');
  var notenum=str.substring(str.indexOf('_')+1,str.length);
  var unitnum=str.substring(0,str.indexOf('_'));
  var unit_num=unitnum.substring(1);
  var note_num=notenum.substring(1);
  $.post("exec.php",{'edit':value,'noteNum':notenum,'unitNum':unitnum},function(data,status,jsXHR)
  {
    $(obj).parent().parent().parent().popover('destroy');
    if(status=='success' && data=='True')
    {
      $("#note-list>li:nth-child("+unit_num+")").find(".notes>li:nth-child("+note_num+")").find(".text").text(value);
      $(obj).popover('destroy');
    }else
    {
      console.log(data);
    }
  });
}
