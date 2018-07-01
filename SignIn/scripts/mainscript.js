
function pausecomp(millis)
{
    var date = new Date();
    var curDate = null;
    do { curDate = new Date(); }
    while(curDate-date < millis);
}

function check_validity()
{
  $("#pwd").css("border-bottom","3px solid black");
  if($("#pwd").val().length<8 && email_validated)
  {
    if($("#pwd").val().length==0)
    {
      window.alert("Please Enter the password!");
      $("#pwd").val("");
      $("#pwd").css("border-bottom","3px solid red");
      return;
    }
    window.alert("HINT: Your Password is more than 8 characters!");
  }else
  {
    if(email_validated)
      $("#sub").css("display","block");
    $("#hsh").val(calcMD5($("#pwd").val()).toString());
    }
    return false;
}

function post(obj)
{
  $(obj).prop("disabled",true);
  $.post("signin.php",{'email':$("#email").val(),'pwd_hash':$("#hsh").val(),'rem':$("#rem").val(),'pwd':$("#pwd").val()},function(data,status,jsXHR)
  {
  if(status.includes("Success")|| status.includes("success"))
  {
    if(data=="False")
      {
        window.alert("It seems you provided your credentials incorrectly! The email or password seems a little off!");
        $("#hsh").val("");
        $("#email").val("");
        $("#pwd").val("");
        $("#pwd").css("border-bottom","3px solid red");
        $("#notif img").attr("src","/SignIn/Resources/exc.png");
        $("#email").css("border-bottom","3px solid red");
       }
       else
       {
        if(data=="True")
          window.location="/dashboard";
        else if(data=='FalsePWD')
        {
          window.alert('Please Enter a valid password (At least 8 characters!');
          $("#pwd").css("border-bottom","3px solid red");
          $("#hsh").val("");
          $("#pwd").val("");
        }
        else
          window.alert(data);
       }
       $(obj).prop("disabled",false);
  }
  else
  {
    window.alert("Oops Some Error Occured! Contact Adrish!");
  }
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
      $("#notif img").attr("src","/SignIn/Resources/exc.png");
    }
    else if((str.includes("@") && str.includes(".")))
    {
      $(obj).css("border-bottom","3px solid #07c603");
      $($("#notif").attr("title","Valid Email!"));
      $("#notif>img").attr("src","/SignIn/Resources/tick.png");
      email_validated=true;
    }
  }
  else
  {
    $($("#notif").attr("title","Email Cannot be Empty!"));
    $("#notif>img").attr("src","/SignIn/Resources/exc.png");
    $(obj).css("border-bottom","3px solid red");
  }
}
