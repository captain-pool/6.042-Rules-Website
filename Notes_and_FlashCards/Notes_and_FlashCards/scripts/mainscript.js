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
  });
});
function delete_notes(obj)
{
  console.log($(obj));
  var unit_num=noteid.substring(0,noteid.indexOf('_'));
  var note_num=noteid.substring(noteid.indexOf('_')+1,noteid.length);
  $.post('exec.php',{'delete':1,'unitNum':unit_num,'noteNum':note_num},function(data,status,jsXHR)
  {  if(status=='success' && data=='True')
  {
    window.alert("Note deleted Successfully!");
    $("#note-list>li:nth-child("+unit_num+")").find(".notes").remove('li:nth-child('+note_num+')');
  }
  else
  {
    console.log(data);
    //window.alert("Oops! Some Error Occurred! Please Try Again Later!");
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
  $.post("exec.php",{'edit':value,'noteNum':notenum,'unitNum':unitnum},function(data,status,jsXHR)
  {
    $(obj).parent().parent().parent().popover('destroy');
    if(status=='success' && data=='True')
    {
      $("#note-list>li:nth-child("+unitnum+")").find(".notes").find("li:nth-child("+notenum+")").find(".text").text(value);
      $(obj).popover('destroy');
    }else
    {
      console.log(data);
    }
  });
}
