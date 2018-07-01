<?php 
session_start();
require_once 'connect.inc.php';
try
{
  if(!(isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']!=NULL))
  {
    header("location:/SignIn/");
    die();
  }
}
catch(Exception $e)
{
  echo "Error Occured!Please Contact Adrish!";
  die();
}
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
require_once 'connect.inc.php';
  if(isset($_POST['email']))
  {
    $email=$_POST['email'];
    $email=sanitize_xss($email);
    $email=escapeshellarg($email);
    $query1="UPDATE AhEvuse2edy7urAtehutanu7YtysU3U7 SET EMAIL=? WHERE ID=?";
    $query2="SELECT COUNT(*) AS C FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE EMAIL=?";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$email);
    try
    {
      $stmt2->execute();
    }
    catch(Exception $e)
    {
      echo 'Oops! Some Error Occurred! Please Contact Adrish!';
      die();
    }
    $r=$stmt2->fetch(PDO::FETCH_ASSOC);
    if($r['C']!=0)
    {
      echo 'reg';
      die();
    }
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$email);
    $stmt1->bindValue(2,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt1->execute();
    }catch(Exception $e)
    {
      echo 'Some Error Occured!';
      die();
    }
      echo 'True';
      die();
 }
 else if(isset($_POST['fname'])&&isset($_POST['lname']))
 {
 
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $fname=sanitize_xss($fname);
    $lname=sanitize_xss($lname);
    $query1="UPDATE AhEvuse2edy7urAtehutanu7YtysU3U7 SET FNAME=?,LNAME=? WHERE ID=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$fname);
    $stmt1->bindValue(2,$lname);
    $stmt1->bindValue(3,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt1->execute();
    }catch(Exception $e)
    {
      echo 'Some Error Occured!';
      die();
    }
      echo 'True';
      die();
    
 }
else if(isset($_POST['about']))
{
  if($_POST['about']==NULL)
    return 'False';
  else
  {
    $about=$_POST['about'];
    $about=sanitize_xss($about);
    $query1="UPDATE AhEvuse2edy7urAtehutanu7YtysU3U7 SET ABOUT=? WHERE ID=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$about);
    $stmt1->bindvalue(2,$_SESSION['six_oh_four_two_id']);
    try
    {
      $v=$stmt1->execute();
      if($v==false)
        {
          echo 'Error Occurred!';
          die();
        }
    }
    catch(Exception $e)
    {
      echo 'Oops Some Error Occured! Please Contact Adrish!';
      die();
    }
    echo 'True';
    die();
  }
}
?>
