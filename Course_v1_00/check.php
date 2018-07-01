<?php
session_start();
require_once 'connect.inc.php';
function get_MAC($conn,$Qnum)
{
  $unit_num=(int)substr($Qnum,strpos($Qnum,'F')+1,strpos($Qnum,'_')-strpos($Qnum,'F')-1);
  $QNum=(int)substr($Qnum,strpos($Qnum,'Q')+1,strlen($Qnum));
  $query="SELECT FINGER_EXERCISES_JSON FROM COURSE_METAS WHERE UNIT_NUM=?";
  $stmt=$conn->prepare($query);
  $stmt->bindValue(1,$unit_num);
  try
  {
    $v=$stmt->execute();
    if($v==false)
      throw new Exception("Error Executing Query. In Finger_Exercise_JSON");  
  }catch(Exception $e)
  {
    echo 'error';
    die();
  }
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
  $json=$result["FINGER_EXERCISES_JSON"];
  if(strlen($json)!=0)
  {
    try
    {
      $json_array=json_decode($json);
      $MAC=$json_array[$QNum-1]->{'MAC'};
    }
    catch(Exception $e)
    {
      echo 'error';
      die();
    }
  }
  if(isset($MAC) && $MAC!=NULL)
    return (int)$MAC;
  else
    return 0;
}
if(isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']!=NULL)
{
if(isset($_POST['Qnum'])&&$_POST['Qnum']!=NULL)
{

  if(isset($_POST['Ans'])&&$_POST['Ans']!=NULL)
  {
    $q="SELECT SCORES_JSON FROM Progress WHERE ID=?";
    $stmt0=$conn->prepare($q);
    $stmt0->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $v=$stmt0->execute();
      if($v==false)
      {
        echo 'error';
        die();
      }
    }catch(Exception $e)
    {
      echo 'Oops Some Error Occurred!';
      die();
    }
    $res=$stmt0->fetch(PDO::FETCH_ASSOC);
    if($res['SCORES_JSON']!=null)
    {
      try
      {
        $json=json_decode($res['SCORES_JSON']);
        if($json==null)
          throw new Exception("JSON Parsing Error");
        
      }catch(Exception $e)
      {
        echo 'Oops Some Error Occurred!';
        die();
      }
    }
    $query="SELECT ANSWER FROM Answers WHERE UNIVQNUM=?";
    $stmt=$conn->prepare($query);
    $arr=array();
    $stmt->bindValue(1,$_POST['Qnum']);
    try
    {
      $v=$stmt->execute();
      if($v==false)
      {
        echo 'error';
        die();
      }
    }catch(Exception $e)
    {
      echo 'Oops Some Error Occurred!';
      die();
    }
    $MAC=get_MAC($conn,$_POST['Qnum']);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    $attempt_count=0;
    if(isset($json))
    {
      foreach($json as $obj)
      {
          if($obj->{"Question"}==$_POST['Qnum'])
            $attempt_count=(int)$obj->{"AC"};
      }
    }
    
    if($MAC==$attempt_count)
    {
      echo 'Count_Error';
      die();
    }
    if($result['ANSWER']==$_POST['Ans'])
    {
      array_push($arr,array("Question"=>$_POST['Qnum'],"stat"=>true,"AC"=>($attempt_count+1),"Choice"=>$_POST['Ans'],"MAC"=>$MAC));
    }
    else
    {
      array_push($arr,array("Question"=>$_POST['Qnum'],"stat"=>false,"AC"=>($attempt_count+1),"Choice"=>$_POST['Ans'],"MAC"=>$MAC));
    }
    if(!isset($arr))
    {echo 'not set';die();}
    $count=0;
   
    if(isset($json))
      {
        $flag=false;
       
        foreach($json as $obj)
        {
          if(!strcmp($obj->{"Question"},$arr[0]["Question"]))
            {
              $obj->{"stat"}=$arr[0]["stat"];
              $obj->{"AC"}=$arr[0]["AC"];
              $obj->{"Choice"}=$arr[0]["Choice"];
              $obj->{"MAC"}=$arr[0]["MAC"];
              $flag=true;
            }
            $count++;
        }
        
        if($flag==false)
        {
          $json[$count]['Question']=$arr[0]["Question"];
          $json[$count]['stat']=$arr[0]["stat"];
          $json[$count]['AC']=$arr[0]["AC"];
          $json[$count]['MAC']=$arr[0]["MAC"];
          $json[$count]['Choice']=$arr[0]["Choice"];
          
        }
        $val=$json;
      }
      else
      {
          $val[$count]['Question']=$arr[0]["Question"];
          $val[$count]['stat']=$arr[0]["stat"];
          $val[$count]['AC']=$arr[0]["AC"];
          $val[$count]['MAC']=$arr[0]["MAC"];
          $val[$count]['Choice']=$arr[0]["Choice"];
      }
      $val2=json_encode($val);
      $query1="UPDATE Progress SET SCORES_JSON=? WHERE ID=?";
      $stmt1=$conn->prepare($query1);
      $stmt1->bindValue(1,$val2);
      $stmt1->bindValue(2,$_SESSION['six_oh_four_two_id']);
      try
      {
        $v=$stmt1->execute();
        if($v==false)
        {
          throw new Exception('Error Executing Query');
        }
      }catch(Exception $e)
      {
        echo 'Oops Some Error Occurred!';
        die();
      }
      $ret=array("countl"=>($attempt_count+1));
      $ret["MAC"]=$MAC;
      if($arr[0]["stat"]==true)
        $ret["stat"]='True';
      else
        $ret["stat"]='False';
      echo(json_encode($ret));      
      die();
  }
}
}
else
{
  header("location:/SignIn/");
  die(); 
}
?>
