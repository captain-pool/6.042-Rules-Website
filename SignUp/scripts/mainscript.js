var name1_validated=false;
var name2_validated=false;
function pausecomp(millis)
{
    var date = new Date();
    var curDate = null;
    do { curDate = new Date(); }
    while(curDate-date < millis);
}
function check_empty(obj)
{
  if(obj.value.length==0)
    {window.alert("Cannot be Empty!");name1_validated=false;}
  else
    name1_validated=true;
}
function check_empty_(obj)
{
  if(obj.value.length==0)
    {window.alert("Cannot be Empty!");name2_validated=false;}
  else
    name2_validated=true;
}
function check_equality()
{
  $("#pwd").css("border-bottom","3px solid black");
  $("#cpwd").css("border-bottom","3px solid black");
  if($("#pwd").val().length<8 && email_validated)
  {
    if($("#pwd").val().length==0)
    {
      window.alert("Enter a pasword of atleast 8 characters!");
      $("#pwd").val("");
      $("#cpwd").val("");
      return;
    }
  }
  if($("#pwd").val().localeCompare($("#cpwd").val())==0)
  {
    $("#pwd").css("border-bottom","3px solid #07c603");
    $("#cpwd").css("border-bottom","3px solid #07c603");
    if(email_validated&&name1_validated&&name2_validated)
      $("#sub").css("display","block");
    $("#hsh").val(calcMD5($("#pwd").val()).toString());
  }
  else
  {
    window.alert("Passwords Doesn't Match!");
    $("#pwd").val("");
    $("#cpwd").val("");
    $("#pwd").css("border-bottom","3px solid red");
    $("#cpwd").css("border-bottom","3px solid red");
  }
   
  return false;
}

function post(obj)
{
  $(obj).prop("disabled",true);
  if($("#hsh").val().length>=8)
  $.post("signup.php",{'fname':$("#fname").val(),'lname':$("#lname").val(),'email':$("#email").val(),'pwd_hash':$("#hsh").val(),'rem':$("rem").val(),'pwd':$("#pwd").val()},function(data,status,jsXHR)
  {
    if(data=="False")
      {
        window.alert("Email Already Registered!");
        $("#pwd").val("");
        $("#cpwd").val("");
        $("hsh").val("");
        $("#email").css("border-bottom","3px solid red");
       }
       else
       {
       if(data=="True")
          window.location="/dashboard";
       else if(data=='FalsePWD')
       {
        window.alert('please set the password at least 8 characters!');
        $("#pwd").val("");
        $("#cpwd").val("");
        $("hsh").val("");
        $("#pwd").css("border-bottom","3px solid red");
        $("#cpwd").css("border-bottom","3px solid red");
       }
       else
        window.alert(data);
       }
       $(obj).prop("disabled",false);
  });
}
var email_validated=false;
function key_up(obj)
{
  email_validated=false;
  var str=obj.value;
  if(str.length!=0)
  {
    if(!(str.includes("@") || str.includes(".")))
    {
      $(obj).css("border-bottom","3px solid red");
      $("#notif").attr("title","Invalid Email");
      $("#notif img").attr("src","/SignUp/Resources/exc.png");
    }
    else if((str.includes("@") && str.includes(".")))
    {
      $(obj).css("border-bottom","3px solid #07c603");
      $($("#notif").attr("title","Valid Email!"));
      $("#notif>img").attr("src","/SignUp/Resources/tick.png");
      email_validated=true;
    }
  }
  else
  {
    $($("#notif").attr("title","Email Cannot be Empty!"));
    $("#notif>img").attr("src","/SignUp/Resources/exc.png");
    $(obj).css("border-bottom","3px solid red");
  }
}
