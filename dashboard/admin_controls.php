<?php
session_start();
if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
require_once 'connect.inc.php';
$query="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
$stmt=$conn->prepare($query);
$stmt->bindValue(1,$_SESSION['six_oh_four_two_id']);
try
{
$stmt->execute();
}
catch(Exception $e)
{
  echo 'Oops Some Error Occurred! Contact Adrish!';
  die();
}
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if($result['AUTH_TYPE']!=0)
{
  header("location:/dashboard/");
  die();
}
   if(isset($_POST['getPsetSubmissions'])&&$_POST['getPsetSubmissions']!=NULL)
  {
    $query1="SELECT * FROM Pset";
    $stmt1=$conn->prepare($query1);
    try{
    $v=$stmt1->execute();
    if($v==false)
    {
      throw new Exception("Error Fetching Values from DB");
    }
    }catch(Exception $e)
    {
     echo $e;
     die();
    }
    $result=json_encode($stmt1->fetchAll());
    echo $result;
    die();
  }else if((isset($_POST['rescInsert'])&&$_POST['rescInsert']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
  {
    $query1="SELECT COUNT(*) AS C FROM Additional_Resources WHERE UNIT=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$_POST['UNum']);
    try{$errchk=$stmt1->execute();if(!$errchk)throw new Exception("Error Executing Query!");}catch(Exception $e){echo $e;die();}
    $r=$stmt1->fetch(PDO::FETCH_ASSOC);
    $query2="INSERT INTO Additional_Resources (RESOURCES_JSON,UNIT) VALUES(?,?)";
    if(((int)$r['C'])!=0)
    {
      $query2="UPDATE Additional_Resources SET RESOURCES_JSON=? WHERE UNIT=?";
    }
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_POST['rescInsert']);
    $stmt2->bindValue(2,$_POST['UNum']);
    try{$errchk=$stmt2->execute();if(!$errchk)throw new Exception("Oops! Error executing Query!");}catch(Exception $e){echo $e;die();}
    $query3="UPDATE COURSE_METAS SET AdditionalResources='True' WHERE UNIT_NUM=?";
    $stmt3=$conn->prepare($query3);
    $stmt3->bindValue(1,$_POST['UNum']);
    try{$errchk=$stmt3->execute();if(!$errchk)throw new Exception("Oops! Error executing Query!");}catch(Exception $e){echo $e;die();}
    echo 'True';die();
  }else if((isset($_POST['rescGet'])&&$_POST['rescGet']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
  {
    $query1="SELECT * FROM Additional_Resources WHERE UNIT=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$_POST['UNum']);
    try{$errchk=$stmt1->execute();if(!$errchk)throw new Exception("Oops! Error Executing Query!");}catch(Exception $e){echo $e;die();}
    $r=$stmt1->fetch(PDO::FETCH_ASSOC);
    if($r['RESOURCES_JSON']!=NULL)
      echo $r['RESOURCES_JSON'];
    else
      echo 'False';
    die();
  }
 else if((isset($_POST['Q'])&&$_POST['Q']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
    {
      
      $query11="SELECT FINGER_EXERCISES_JSON FROM COURSE_METAS WHERE UNIT_NUM=?";
      $stmt11=$conn->prepare($query11);
      $stmt11->bindValue(1,$_POST['UNum']);
      try
      {
        $v=$stmt11->execute();
        if($v==false)
        throw new Exception("Error executing query");
      }catch(Exception $e)
      {
        echo $e;
        die();
      }
      $r1=$stmt11->fetch(PDO::FETCH_ASSOC);
      echo $r1['FINGER_EXERCISES_JSON'];
      die();
    }else
  if((isset($_POST['QJson'])&&$_POST['QJson']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
  { 
    $query2="UPDATE COURSE_METAS SET FINGER_EXERCISES_JSON=?,RELEASE_DATE=? WHERE UNIT_NUM=?";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_POST['QJson']);
    $stmt2->bindValue(2,$_POST['RD']);
    $stmt2->bindValue(3,$_POST['UNum']);
    try
    {
      $v=$stmt2->execute();if($v==False)throw new Exception("Error Executing Query!");
    }catch(Exception $e){echo $e;die();}
    echo 'True';
    die();
  }else
  if(isset($_POST['CourseUpdate'])&&($_POST['CourseUpdate']!=NULL)&&isset($_POST['date'])&&($_POST['date']!=NULL))
  {
    $q="INSERT INTO COURSE_Updates (_UPDATE,_DATE_STRING,CREATOR) VALUES(?,?,?)";
    $s=$conn->prepare($q);
    $s->bindValue(1,$_POST['CourseUpdate']);
    $s->bindValue(2,$_POST['date']);
    $s->bindValue(3,$result['FNAME'].' '.$result['LNAME']);
    try
    {
      $v=$s->execute();
      if($v==false)
       throw new Exception('Oops! Some Error Occurred!~Uploading Answers');
    }catch(Exception $e){echo $e;die();}
    echo 'True';
    die();
  }else
    if((isset($_POST['set'])&&$_POST['set']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
  {
    $query5="SELECT COUNT(*) AS C FROM COURSE_METAS WHERE UNIT_NUM=?";
    $stmt5=$conn->prepare($query5);
    $stmt5->bindValue(1,$_POST['UNum']);
    try{
      $v=$stmt5->execute();
      if($v==false)
        throw new Exception('Error Executing Query!');
    }catch(Exception $e)
    {
      echo $e;
      die();
    }
    $res=$stmt5->fetch(PDO::FETCH_ASSOC);
    if($res['C']!=0)
    {
      $query6="UPDATE COURSE_METAS SET PSET_LINK=? WHERE UNIT_NUM=?";
    }
    else
    {
      $query6="INSERT INTO COURSE_METAS (PSET_LINK,UNIT_NUM) VALUES(?,?)";
    }
    $stmt6=$conn->prepare($query6);
    $stmt6->bindValue(1,$_POST['set']);
    $stmt6->bindValue(2,$_POST['UNum']);
    try{
      $v1=$stmt6->execute(); 
      if($v1==false)
      {
        echo 'Error!';
        die();
      }
    }catch(Exception $e)
    {
      echo $e;
      die();
      }
    $query3="SELECT MAX(PSETNUM) AS P FROM PSET";
    $stmt3=$conn->prepare($query3);
    try{$errchk=$stmt3->execute();if(!$errchk) throw new Exception(" Error Executing Query ~ False!");}catch(Exception $e){echo $e;die();}
    $qresult1=$stmt3->fetch(PDO::FETCH_ASSOC);
    $maxps=(int)$qresult1['P'];
    $query3_sub="INSERT INTO PSET (PSETNUM) VALUES(?)";
    $stmt3_sub=$conn->prepare($query3_sub);
    $stmt3_sub->bindValue(1,$maxps+1);
    try{$errchk=$stmt3_sub->execute(); if(!$errchk)throw new Exception("Error Executing Query ~ False!");}catch(Exeception $e){echo $e;die();}
    $query3_sub="UPDATE COURSE_METAS SET PSNUM=? WHERE UNIT_NUM=?";
    $stmt3_sub=$conn->prepare($query3_sub);
    $stmt3_sub->bindValue(1,$maxps+1);
    $stmt3_sub->bindValue(2,$_POST['UNum']);
    try{$errchk=$stmt3_sub->execute(); if(!$errchk)throw new Exception("Error Executing Query ~ False!");}catch(Exeception $e){echo $e;die();}
    echo 'True';
    die();
  }else
  if((isset($_POST['RJson'])&&$_POST['RJson']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
  {
    
    $query3="UPDATE COURSE_METAS SET READING_LINKS_JSON=? WHERE UNIT_NUM=?";
    $stmt3=$conn->prepare($query3);
    $stmt3->bindValue(1,$_POST['RJson']);
    $stmt3->bindValue(2,$_POST['UNum']);
    try
    {
      $v=$stmt3->execute();
      if($v!=true) 
        throw new Exception('Error Occurred Executing Query');
    }catch(Exception $e){echo $e;die();}
    echo 'True';
    die();
  }else
  if((isset($_POST['Ans'])&&$_POST['Ans']!=NULL))
  {

  try
    {
    $query4="INSERT INTO Answers (UNIVQNUM,ANSWER) VALUES(?,?)";
    $stmt4=$conn->prepare($query4);
    $answerArray=json_decode($_POST['Ans'],true);
    foreach($answerArray as $item)
    {
      $stmt4->bindValue(1,$item['ID']);
      $stmt4->bindValue(2,$item['Ans']);
      try{$v=$stmt4->execute();}catch(Exception $e){echo $e; die();}
      $stmt4->closeCursor();
    }
    }catch(Exception $e)
    {
      echo $e;
      die();  
    }
    if($v)
    echo 'True';
    else
    echo 'False';
    die();
  }else
/* Changes to be made in this block { Need to Set handlers for ImpSheet and Soln*/
  if(isset($_POST['setScores'])&&($_POST['setScores']!=NULL)&& isset($_POST['ImpSheet'])&&isset($_POST['Soln']))
  { try{
    $query="UPDATE PSet SET CHECKED=? WHERE PSetNum=?";
    $stmt11=$conn->prepare($query);
    $jdata=json_decode($_POST['setScores'],True);
    foreach($jdata as $key=>$j)
    {
      $arr=json_encode($j);
      $stmt11->bindValue(1,$arr);
      $stmt11->bindValue(2,$key+1);
      try{$v=$stmt11->execute(); if($v==False)throw new Exception('Error Executing Query');}catch(Exception $e){echo $e;die();}
      $stmt11->closeCursor();
    }
    $query2="UPDATE PSet SET SOLN =? WHERE PSetNum=?";
    if($_POST['Soln']!=NULL)
    {
      $jdata=json_decode($_POST['Soln'],True);
      $stmt22=$conn->prepare($query2);
      foreach($jdata as $k=>$d)
      {
        $stmt22->bindValue(1,$d);
        $stmt22->bindValue(2,$k+1);
        try{$errchk=$stmt22->execute();if(!$errchk)throw new Exception("Error Occurred! ~False");}catch(Exception $e){echo $e;die();}
        $stmt22->closeCursor();
      }
    }
    if($_POST['ImpSheet']!=NULL)
    {
      $jdata=json_decode($_POST['ImpSheet'],True);
      $query33="UPDATE Progress SET ImpSheet=? WHERE ID=?";
      $stmt33=$conn->prepare($query33);
      foreach($jdata as $key=>$value)
      {
        $stmt33->bindValue(1,json_encode($value));
        $stmt33->bindValue(2,$key);
        try{$errchk=$stmt33->execute();if(!$errchk)throw new Exception("Error! ~ False!");}catch(Exception $e){echo $e;die();}
        $stmt33->closeCursor();
      }
    }
  echo 'True';
  die();
  }catch(Exception $e)
    {echo $e;}
  }
/*  } Changes to  be made in this block*/
?>
