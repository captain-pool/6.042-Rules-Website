<?php 
session_start();
require_once 'connect.inc.php';
try
{
if(isset($_COOKIE['six_oh_four_two_id']) && ($_COOKIE['six_oh_four_two_id']!=NULL))
{
  //$_SESSION['six_oh_four_two_id']=$_COOKIE['six_oh_four_two_id'];
  //header("location:/dashboard/");
}
}
catch(Exception $e)
{
echo "Error Occured!Please Contact Adrish!";
die();
}
  if(isset($_POST['email'])&&isset($_POST['pwd_hash']))
  {
    if(!isset($_POST['pwd'])&&strlen($_POST['pwd'])<8)
      {
        echo 'FalsePWD';
        die();
      }
    $pwd2=$_POST['pwd_hash'];
    $email=$_POST['email'];
    $pwd=md5($_POST['pwd']);
    if($pwd!=$pwd2)
    {echo 'False';die();}
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    $email=escapeshellarg($email);
    $pwd=filter_var($pwd,FILTER_SANITIZE_STRING);
    $pwd=filter_var($pwd,FILTER_SANITIZE_STRING);
    $query= "SELECT COUNT(*) AS C FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE EMAIL=? AND PWD=?";
    $query2="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE EMAIL=? AND PWD=?";
    $stmt=$conn->prepare($query);
    $stmt->bindValue(1,$email);
    $stmt->bindValue(2,$pwd);
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$email,PDO::PARAM_STR);
    $stmt2->bindValue(2,$pwd,PDO::PARAM_STR);
    try
    {
    $stmt->execute();
    }
    catch(Exception $e)
    {
    echo ('Oops, Some Error Occurred! Please Contact Adrish');
    die();
    }
    $r1=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$r1['C'];
    if($count>0)
    {
    try{
      $stmt2->execute();
      $result=$stmt2->fetch(PDO::FETCH_ASSOC);
      $_SESSION['six_oh_four_two_id']=$result['ID'];
      if(isset($_POST['rem']))
      {
        if($_POST['rem']=='true'|| $_POST['rem']=='True')
        {
          setcookie('six_oh_four_two_id',$result['ID'],time()*365*24*60*60,"/");
        }
      }
      echo 'True';
      die();
     }
      catch(Exception $e)
      {
        echo "Error Occurred, Please Contact Adrish!";
        die();
      }
    }else
      {
       echo 'False';
       die();
      }
}
else
  header("location:/SignIn/");
?>
