<?php
  session_start();
  require_once 'connect.inc.php';
  function sanitize_xss($txt)
    {
      try{
      $txt=trim($txt);
      $txt=stripslashes($txt);
      $txt=htmlspecialchars($txt);
      return $txt;}
      catch(Exception $e)
      {
        echo "Error Occured! Please Contact Adrish!";
        die();
      }
    }
  if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
    $query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
    $stmt=$conn->prepare($query1);
    $stmt->bindValue(1,$_SESSION['six_oh_four_two_id'],PDO::PARAM_STR);
    try
    {
      $v=$stmt->execute();
      if($v==false)
        {
          echo 'Oops! Some Error Occured!';
          die();
        }
    }
    catch(Exception $e)
    {
      echo 'Oops! Some Error Occured!';
      die();
    }
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['email']) && isset($_POST['feedback'])&& $_POST['feedback']!=NULL)
    {
      $query1="INSERT INTO FEEDBACK (EMAIL,FEEDBACK) VALUES(?,?)";
      $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
      $feedback=filter_var($_POST['feedback'],FILTER_SANITIZE_STRING);
      $stmt2=$conn->prepare($query1);
      $stmt2->bindValue(1,$email);
      $stmt2->bindValue(2,$feedback);
      try{$errchk=$stmt2->execute();if(!$errchk)throw new Exception("Error Executing Query ~ False!");}catch(Exception $e){echo 'error';die();}
      echo 'True';die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=1000,initial-scale=1.0"></meta>
<meta property="og:title" content="6.042 Rules!| Feedback">
<meta property="og:url" content="https://www.6042rules.ml/feedback">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
        <link rel="shortcut icon" href="/Resources/favicon.ico">
        <title>Feedback | 6.042 Rules!</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script>
        function hide_show(obj)
        {
          $(obj).find('div').slideToggle('slow');
        }
        var divHTML="";
        function sendFeedback(obj)
        {
          var email=$(obj).parent().find("#email").val();
          var feedback=$(obj).parent().find("#feedback").val().trim();
          if(feedback.length<4)
          {
            window.alert('Enter Something having more than 4 characters!');
            return;
          }
          divHTML=$(obj).parent().html();
          $.post("index.php",{'email':email,'feedback':feedback},function(data,status,jsXHR)
          {
            if(data=='True'&& status.indexOf('success')!=-1)
            {
              $(obj).parent().html("<div class='alert alert-success dismissable fade in'><button onclick='restoreDiv();' class='close' aria-label='close' data-dismiss='alert'>&times;</button>Successfully Recieved Your Feedback!</div>");
            }
            else
            {
              $(obj).parent().html("<div class='alert alert-danger dismissable fade in'><button onclick='restoreDiv();' class='close' aria-label='close' data-dismiss='alert'>&times;</button>There was an error! Please Retry.</div>");
            }
            
          });
        }
        function restoreDiv()
        {
          $("#feedback-form").html(divHTML);
        }
        $(document).ready(function(){$(".hide_show").find("div").slideUp();});
        </script>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
        #coursenav:hover
        {
          background-color:#2d52a8;
        }
          #navigation-bar a
          {
            font-size:20px;
            font-family:'Comfortaa',sans-serif;
          }
        </style>

    </head>
    <body>

    <nav class="navbar navbar-wrapper" width="auto">
        <div class="container">
                <div class="navbar-inner" style="margin:3% 0px 0px 0px">
                    <a href="/" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png" style="margin:-30px 0px 0px 0px" width="100px"> </a>
                    <h1 id="title"> 6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav" id="navigation-bar" style="margin:3% 0px 0px 0px;">

                    <li> <a href="/" class="nav-links"> Home</a> </li>
                    <li> <a href="javascript:void(0)" class="nav-links"> Dashboard </a> </li>
                    <li> <a href="/AboutUs" class="nav-links"> Who Are We? </a> </li>
                </ul>
                <ul class="nav navbar-nav navbar-right"  style="margin:-7% 0px 0px 0px">
                    <li> 
                    <table>
                    <tr><td><img src="./Images/sign_up.png" width="100px"></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result['FNAME'].' '.$result['LNAME']?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    <tr><td style="text-align:center;"><?php if($result['AUTH_TYPE']==0) { ?><a href="/dashboard/admin.php" title="Click Here to Open Admin Panel">Admin Controls</a><?php } ?></td></tr>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
	<ol class="breadcrumb" style="margin:30px 0px;width:100%;font-family:'comfortaa',sans-serif;font-size:20px;">
        <li class="breadcrumb-item"><a href="/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active"> Feedback </li>
      </ol>
    <div style="margin:0px 10%">
    <h1 style="font-family:comfortaa,sans-serif">Feedback</h1>
    <br/>
    <div class="form-group" id="feedback-form">
    <input class="form-control" type="email" id="email" style="width:60%" placeholder="Enter Your Email, Keep Blank if you want to say something anonymously"></input><br/><br/>
    <textarea class="form-control" rows="10" id="feedback" style="width:60%" placeholder="Enter Your Feeback/Comment Here..."></textarea><br/><br/>
    <button type="button" class="btn btn-lg btn-primary" onclick="sendFeedback(this)">Post Your Feedback/Comment</button>
    </div>
    </div>
    <br/><br/><br/><br/>
    </body>

</html>
