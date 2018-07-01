<?php
session_start();
function sanitize_xss($txt)
    {
      try{
      $txt=trim($txt);
      $txt=stripslashes($txt);
      $txt=htmlspecialchars($txt);
      return $txt;}
      catch(Exception $e)
      {
        echo "Error Occurred! Please Contact Adrish!";
        die();
      }
    }
if(!isset($_SESSION['six_oh_four_two_id']))
  header('location:/SignIn/');
require_once 'connect.inc.php';
$query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
$stmt=$conn->prepare($query1);
$stmt->bindValue(1,$_SESSION['six_oh_four_two_id']);
try
{
$v=$stmt->execute();
if($v==false)
{
echo ('Oops!');
die();
}
}
catch(Exception $e)
{
echo $e;
die();
}
$result=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Notes and Flashcards | 6.042 Rules!</title>
    <meta name="viewport" content="width=1000, initial-scale=1.0">
<meta property="og:title" content="6.042 Rules!| Notes and FlashCards">
<meta property="og:url" content="https://www.6042rules.ml/Notes_and_FlashCards">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
    <link rel="Shortcut Icon" href="/Resources/favicon.ico" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous" type="text/css"></link>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="scripts/mainscript.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
      @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
    </style>
  </head>
  <body>
  <div class="page-wrap" style="height:auto;">
  <nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner">
                    <a href="/"  style="margin:2% 0px" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png"  width="100px"></a>
                    <h1 id="title"  style="margin:5% 0px" class="navbar-brand">6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav navbar-right">
                    <li> 
                    <table>
                    <tr><td><a class="navbar-right nav navbar-nav"> <img src="Resources/sign_up.png" width="100px"> </a></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result['FNAME'].' '.$result['LNAME'];?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
    </div>
    <div class="bdy">
      <br/>
      <br/>
      <ol class="breadcrumb" style="margin:0px 40px;font-family:'comfortaa',sans-serif;font-size:20px;">
        <li class="breadcrumb-item"><a href="/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Notes And Flash Cards </li>
      </ol>
      <br/>
      <br/>
      <ul type="none" id="note-list">
      <?php 
      $query2="SELECT * FROM Notes WHERE ID=?";$j=0;
      $stmt2=$conn->prepare($query2);
      $stmt2->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$value=$stmt2->execute();if(!$value)throw new Exception("Error Occured in Executing Query");}catch(Exception $e){echo 'Error';die();}
      $result2=$stmt2->fetch(PDO::FETCH_ASSOC);
      $json=json_decode($result2['Notes_JSON'],True);
      foreach($json as $key=>$value)
      {if(count($value)>0){$j+=1;
       ?>
        <li>
        <div style='margin:10px;'>
          <h2 style='font-family:comfortaa,sans-serif;'>Unit <?php echo substr($key,1,strlen($key)-1); ?></h2>
          <ul class='notes' style='margin:20px;'>
            <?php foreach($value as $k=>$note) {  ?>
            <li><p class="note-id" style="display:none;">Note_Id <?php echo $k;?></p>
              <div>
              <div class='note-div' style="width:60%;border:1px solid black">
                <ul type='none'>
                <li>
                    <div class='text'><?php echo $note; ?></div>
                    <div class='controls' style='height:50px;top:80%;'>
                      <ul style='display:inline;float:left;' type='none'>
                        <li class='edit' style='display:inline;float:left;height:50px;width:50px;text-align:center;'>
                          <button class='item-button' onclick="edit_notes(this)" title='Edit'><img src='./Resources/edit.png' alt='Edit' style='width:30px;height:30px;' /><p style='display:none;' class='num'><?php echo $key.'_'.$k; ?></p>
                          <div class='formhtml' style="display:none;">
                            <form><textarea placeholder="Enter New Note"></textarea><br/><input type='button' value='Submit' onclick='send(this);' style='border-width:0px;color:white;background-color:#2159b2;border-radius:10%;'></input></form>
                          </div>
                          </button>
                        </li>
                        <li class='delete' style='display:inline;float:left;height:50px;width:50px;text-align:center;'>
                          <button class='item-button' onclick="delete_notes(this)" title="Delete This Note"><img src='./Resources/delete.png' alt='Delete' style='width:30px;height:30px;' /><p style='display:none;' class='num'><?php echo $key.'_'.$k; ?></p></button>
                       </li>
                      </ul>
                    </div>
                  </li>
                  </ul>
                  </div></div>
                </li><br/>
                <?php } ?>
              </ul>
              </div>
            </li>
      <?php }} if($j==0){  ?>
         <div><h3 style="font-family:comfortaa;">Oops! No Notes to Display. Go Ahead and Create Some. They Are really great to keep stuffs in mind.</h3></div>
      <?php } ?>
      </ul>
    </div>
  </body>  
</html>	
