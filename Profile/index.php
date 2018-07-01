<!DOCYYPE html>
<?php
session_start();
require_once 'connect.inc.php';
if(isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']!=NULL)
{
  $query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
  $stmt1=$conn->prepare($query1);
  $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
  try
  {
    $stmt1->execute();
  }
  catch(Exception $e)
  {
    header("location:javascript:window.alert('Oops! Some Error Occured! Please Contact Adrish!')");
    die();
  }
  $result=$stmt1->fetch(PDO::FETCH_ASSOC);

?>
<html>
  <head>
    <title>Edit Profile | 6.042 Rules!</title>
    <meta name="viewport" content="width=1000, initial-scale=1.0">
    <meta property="og:title" content="6.042 Rules!| Profile">
<meta property="og:url" content="https://www.6042rules.ml/Profile">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
    <link rel="shortcut icon" href="/Resources/favicon.ico" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
      @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
      .popover
      {
        max-width:100%;
      }
    </style>
    <script src="./scripts/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#edit_name").popover({html:true,content:"<form><input type='text' id='fname' placeholder='Enter New First Name' onblur='key_up_blur(this)'/><br/><input type='text' id='lname' placeholder='Enter New Last Name' onblur='key_up_blur(this)'/><br/><input type='button' id='name_button' value='Submit' onclick='send(this);' style='border-width:0px;color:white;background-color:#2159b2;border-radius:10%;'/></form>"}); 
        $("#edit_email").popover({html:true,content:
"<form><input type='text' id='email' placeholder='Enter New Email'onkeyup='key_up_blur(this)'/><br/><input type='button' id='email_button' value='Submit' onclick='send(this);' style='border-width:0px;color:white;background-color:#2159b2;border-radius:10%;'/></form>"});
 $("#edit_about").popover({html:true,content:
"<form><textarea class='form-control' rows='4' cols='50'style='width:150px;' id='about' placeholder='Hi! You got something to tell about yourself? We would love to hear!'/><br/><input type='button' id='about_button' value='Submit' onclick='send(this);' style='width:150px;height:50px;border-width:0px;color:white;background-color:#2159b2;border-radius:20%;'/></form>"});
      });
      
      function send(obj)
      {
        if(obj.id.toString()=="email_button" && email_validated)
          $.post('edit.php',{'email':$('#email').val()},function(data,status,jsXHR)
          {
            if(data=='False')
              window.alert("Oops! Some Error Occured");
            else
              if(data=='True')
                window.alert('Yay! We got your new email!');
              else if(data=='reg')
                window.alert('Oops! This Email is already registered! Please Correct it!');
                else
                  window.alert(data);
           $("#edit_email").popover('destroy');
          });
          else if(obj.id.toString()=="name_button" &&fname_validated && lname_validated)
            $.post('edit.php',{'fname':$('#fname').val(),'lname':$("#lname").val()},function(data,status,jsXHR)
          {
            if(data=='False')
              window.alert("Oops! Some Error Occured");
            else
              if(data=='True')
                window.alert('Success!');
              else
                  window.alert(data);
            $("#edit_name").popover('destroy');
          });
          else if(obj.id.toString()=="about_button")
            $.post('edit.php',{'about':$('#about').val()},function(data,status,jsXHR)
          {
            if(data=='False')
              window.alert("There's nothing new about you, I guess.Please Inform us as soon as you have something to tell new!");
            else
              if(data=='True')
                window.alert("Wow! It was great to hear from you!");
                else
                  window.alert(data);
           $("#edit_about").popover('destroy');
          });
          
      }
      var email_validated=false;
      var fname_validated=false;
      var lname_validated=false;
      function key_up_blur(obj)
      {

        if(obj.id.toString()=="email")
          {
            email_validated=false;
            var str=obj.value;
            if(str.length!=0)
            {
              if(!(str.includes("@") || str.includes(".")))
              {
                email_validated=false;
              }
              else if((str.includes("@") && str.includes(".")))
              {
                email_validated=true;
              }
            }
          }
          else if(obj.id.toString()=="fname")
          {
            if(obj.value.length!=0)
              fname_validated=true;
            else
              fname_validated=false;
          }
          else if(obj.id.toString()=="lname")
          {
            if(obj.value.length!=0)
              lname_validated=true;
            else
              lname_validated=false;
          }
      }
    </script>
  </head>
  <body>
  <div class="page-wrap">
  <nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner">
                    <a href="/" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png" style="margin:-30px 0px 0px 0px" width="100px"> </a>
                    <h1 id="title"> 6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav" style="padding: 15px;">

                    <li> <a href="/" class="nav-links"> Home</a> </li>
                    <li> <a href="/dashboard/" class="nav-links"> Dashboard </a> </li>
                    <li> <a href="/AboutUs/" class="nav-links"> Who Are We? </a> </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="margin:-60px 0px 0px 0px">
                    <li> 
                    <table>
                    <tr><td><a class="navbar-right nav navbar-nav" href="index.html"> <img src="./Resources/sign_up.png" style="padding:0px 0px 0px -10px"width="100px"> </a></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="#" id="prof" ><?php echo $result['FNAME'].' '. $result['LNAME'];?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
    </div>
    <div class="bdy">
    <ul class="list-inline" type="none">
    <li><img src="./Resources/sign_up.png" style="margin-top:-100px;width:200px;height:200px;"/></li>
    <li><br/><ul>
      <li class="list-group-item"><?php echo $result['FNAME'].' '.$result['LNAME'];?><ul class="list-inline pull-right"><li><button class="edit" data-toggle="popover" id="edit_name" title="Edit Your Name"><img src="./Resources/edit.png" style="width:15px;height:15px;"/></button></li></ul></li>
      <br/>
      <li class="list-group-item"><?php echo substr($result['EMAIL'],1,strlen($result['EMAIL'])-2);?><ul class="list-inline pull-right"><li><button class="edit" data-toggle="popover" id="edit_email" title="Edit Your Email"><img src="./Resources/edit.png" style="width:15px;height:15px;" /></button></li></ul></li>
      <br/>
      <li class="list-group-item"><?php echo $result['ABOUT'];?><ul class="list-inline pull-right"><li><button class="edit" data-toggle="popover" id="edit_about" title="Edit About"><img src="./Resources/edit.png" style="width:15px;height:15px;" /></button></li></ul></li>
    </ul>
    </li>
    </ul>
    </div>
    <p>Please refresh the page to see the changes you made</p>
  </body>  
</html>
<?php }
else
{
header("location:/SignIn");
}?>
