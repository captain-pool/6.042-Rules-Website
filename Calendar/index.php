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
if(isset($_SESSION['six_oh_four_two_id'])&&($_SESSION['six_oh_four_two_id']!=NULL))
{
    require_once 'connect.inc.php';
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
    $query2="SELECT COUNT(*) AS C FROM Progress WHERE ID=?";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt2->execute();
    }
    catch(Exception $e)
    {
      die();
    }
    $res=$stmt2->fetch(PDO::FETCH_ASSOC);
    $v='Start Course';
    if($res['C']!=0)
    {
      $v='Resume Course';
    } 
    $query3="SELECT * FROM COURSE_UPDATES";
    $stmt3=$conn->prepare($query3);
    try{$v2=$stmt3->execute();if($v2==false){throw new Exception("Error Executing Statement!~False");}}catch(Excpetion $e){echo $e;die();}
    $res=$stmt3->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
      <title>Calendar | 6.042 Rules!</title>
      <!-- Latest compiled and minified CSS -->
<meta property="og:title" content="6.042 Rules!| Course Calendar">
<meta property="og:url" content="https://www.6042rules.ml/Calendar">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
      <link rel="Shortcut Icon" href="/Resources/favicon.ico" type="image/x-icon"/>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">
      <style>
      @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      
</head>
<body>
<nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner">
                    <a href="/"  style="margin:2% 0px" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png"  width="100px"> </a>
                    <h1 id="title"  style="margin:5% 0px" class="navbar-brand"> 6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav navbar-right">
                    <li> 
                    <table>
                    <tr><td><img class="navbar-right nav navbar-nav" src="./Images/sign_up.png" style="padding:0px 0px 0px -10px"width="100px"></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result['FNAME'].' '.$result['LNAME']?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    </table>
                </li>
              </ul>
          </div>
      </nav>
    <ol class="breadcrumb" style="margin:0px 40px;font-family:'comfortaa',sans-serif;font-size:20px;">
      <li class="breadcrumb-item"><a href="/dashboard/">Dashboard</a></li>
      <li class="breadcrumb-item active">Calendar</li>
    </ol>
  </body>
<div style="margin:20px;border:1px solid silver; border-radius:20px;">
<p style="margin:8% 0px 10px 8%;font-size:40px;font-family:'comfortaa',sans-serif"> 6.042 Rules! Calendar</p>
<br/>
<hr/>
<p style="margin:8%;font-size:20px;"> This Calendar might change! The Date and Times Given Here Might differ. We will do our best not to cause any inconvenience. In particular, the Release of any material or new weeks will be on 10 AM IST or 10:00 IST. and the deadlines are 11:30 PM IST or 23:30 IST. <b>All the Times here are in IST (GMT +5:30) Please Convert it to your respective time zone.</b>. We have provided all the important dates in this<a href=""> iCal Link</a></p>
<hr style="height:8px;"/>
<iframe  style="margin:3% 4%;cursor:pointer;border:1px solid silver;border-radius:10px" src="https://calendar.google.com/calendar/embed?title=6.042%20Rules%20-%20Class%20of%20July%202017&amp;showCalendars=0&amp;height=800&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=avfi4j5l5qdpge8luva5dmf5hc%40group.calendar.google.com&amp;color=%23B1440E&amp;ctz=Asia%2FCalcutta" style="border:solid 1px #777" width="90%" height="800" frameborder="0" scrolling="no"></iframe>
</div>
</html>
           
<?php 

}
else
{
  header("location:/SignIn/");
}
?>
