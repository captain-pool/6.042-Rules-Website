<?php 
session_start();
require_once 'connect.inc.php';
  if(isset($_POST['fname'])&&isset($_POST['pwd'])&&isset($_POST['lname'])&&isset($_POST['pwd_hash']))
  {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $pwd2=$_POST['pwd_hash'];
    $pwd=md5($_POST['pwd']);
    if($pwd!=$pwd2)
    {echo 'False';die();}
    $email=$_POST['email'];
    if(!isset($_POST['pwd']))
    {
      echo 'FalsePWD';
      die();
    }
    if(strlen($_POST['pwd'])<8)
    {
      echo 'FalsePWD';
      die();
    }
    $fname=filter_var($fname,FILTER_SANITIZE_STRING);
    $lname=filter_var($lname,FILTER_SANITIZE_STRING);
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    $email=escapeshellarg($email);
    $pwd=filter_var($pwd,FILTER_SANITIZE_STRING);
    $query1= "SELECT COUNT(*) AS C FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE EMAIL=?";
    $query1_5="SELECT MAX(ID) AS I FROM AhEvuse2edy7urAtehutanu7YtysU3U7";
    $query2="INSERT INTO AhEvuse2edy7urAtehutanu7YtysU3U7 (ID,FNAME,LNAME,EMAIL,AUTH_TYPE,PWD) VALUES(?,?,?,?,?,?)";
    $query3="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE EMAIL=? AND PWD=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$email,PDO::PARAM_STR);
    try
    {
    $stmt1->execute();
    }
    catch(Exception $e)
    {
    echo "Error Occured, Please Contact Adrish!";
    die();
    }
    $r=$stmt1->fetch(PDO::FETCH_ASSOC);
    $count=$r['C'];
  try{  $stmt1_5=$conn->prepare($query1_5);}catch(Exception $e){echo "Error Occured, Please Contact Adrish!";die();}
    try
    {
    $stmt1_5->execute();
    }
    catch(Exception $e)
    {
      echo "3.Error Occured, Please Contact Adrish!";
      die();
    }
    $r2=$stmt1_5->fetch(PDO::FETCH_ASSOC);
    $id_val=$r2['I'];
    $id_val=((int)$id_val)+1;
    $stmt2=$conn->prepare($query2);
    $stmt2->bindvalue(1,$id_val);
    $stmt2->bindValue(2,$fname,PDO::PARAM_STR);
    $stmt2->bindValue(3,$lname,PDO::PARAM_STR);
    $stmt2->bindValue(4,$email,PDO::PARAM_STR);
    $stmt2->bindValue(5,1,PDO::PARAM_INT);
    $stmt2->bindValue(6,$pwd,PDO::PARAM_STR);
    if($count==0)
    {
    try{
       $v=$stmt2->execute();
       if($v==false)
        {
          echo '4.Error Occured!, Please Contact Adrish!';
          die();
        }
        
      }
    catch(Exception $e)
     {
      echo'Error Occurred Please Contact Adrish!';
      die();
     }
     $stmt3=$conn->prepare($query3);
     $stmt3->bindValue(1,$email,PDO::PARAM_STR);
     $stmt3->bindvalue(2,$pwd,PDO::PARAM_STR);
    try{
      $stmt3->execute();
      $result=$stmt3->fetch(PDO::FETCH_ASSOC);
      }
      catch(Exception $e)
      {
        echo '6.Error Occured Please Contact Adrish!';
        die();
      }
      if(isset($_POST['rem']))
      {
      if($_POST['rem']=='true'|| $_POST['rem']=='True')
      {
        
        setcookie('six_oh_four_two_id',$result['ID'],time()*365*24*60*60,"/");
      }
      }
      $_SESSION['six_oh_four_two_id']=$result['ID'];
      echo "True";
      die();
    }
    else
    {
      echo "False";
      die();
    }
    
    
}
else
  header("location:/SignUp/");
?>
