<?php
session_start();
require_once 'connect.inc.php';
if(isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']!=NULL)
{
    if(isset($_POST['prev_unit_req'])&&$_POST['prev_unit_req']!=NULL)
    {
      $query0="UPDATE Progress SET CUR_UNIT_NUM=?,CUR_STAT='Lecture' WHERE ID=?";
      $stmt0=$conn->prepare($query0);
      $stmt0->bindValue(1,$_POST['prev_unit_req']);
      $stmt0->bindValue(2,$_SESSION['six_oh_four_two_id']);
      try
      {
        $v=$stmt0->execute();
        if($v==false)
        {
          echo 'error';
          die();
        }
      }
      catch(Exception $e)
      {
        echo $e;
        die();
      }
      echo 'True';
      die();
    }
    if(isset($_POST['next_unit_req'])&&$_POST['next_unit_req']!=NULL)
    {
      $query_5="SELECT MAX(UNIT_NUM) AS M FROM COURSE_METAS";
      $stmt_5=$conn->prepare($query_5);
      try
      {
        $v=$stmt_5->execute();
        if($v==false)
        {
          echo 'error';
          die();
        }
      }catch(Exception $e)
      {
        echo 'error';
        die();
      }
      $r_5=$stmt_5->fetch(PDO::FETCH_ASSOC);
      $max=(int)$r_5['M'];
      $nextunitreq=(int)$_POST['next_unit_req'];
      $query_5="SELECT LIVE FROM COURSE_METAS WHERE UNIT_NUM = ?";
      $stmt_5=$conn->prepare($query_5);
      $stmt_5->bindValue(1,$nextunitreq);
      try{$v=$stmt_5->execute();if($v==false){throw new Exception("Error!");}}catch(Exception $e){echo 'error';die();}
      $r__5=$stmt_5->fetch(PDO::FETCH_ASSOC);
      if($max>=$nextunitreq && (int)$r__5['LIVE'])
      {
        $query_0="UPDATE Progress SET CUR_UNIT_NUM=?, CUR_STAT='Lecture' WHERE ID=?";
        $stmt_0=$conn->prepare($query_0);
        $stmt_0->bindValue(1,$_POST['next_unit_req']);
        $stmt_0->bindValue(2,$_SESSION['six_oh_four_two_id']);
        try
        {
          $v=$stmt_0->execute();
          if($v==false)
          {
            echo 'error';
            die();
          }
        }
        catch(Exception $e)
        {
          echo 'error';
          die();
        }echo 'True';die();
      }
    }
   if(isset($_POST['getNotes'])&&($_POST['getNotes']!=NULL)&&isset($_POST['Unum'])&&($_POST['Unum']!=NULL))
   {
    $query10="SELECT Notes_JSON FROM Notes WHERE ID=?";
    $STMT=$conn->prepare($query10);
    $STMT->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $v=$STMT->execute();
      if($v==false)
      {
        echo 'error';
        die();
      }
    }catch(Exception $e)
    {
      echo 'error';
      die();
    }
    $result10=$STMT->fetch(PDO::FETCH_ASSOC);
    if($result10!=NULL)
      echo $result10['Notes_JSON'];
    else
      echo 'null';
    die();
   }
   if(isset($_POST['Resc'])&&$_POST['Resc']!=NULL&&isset($_POST['UNum'])&&$_POST['UNum']!=NULL)
   {
      $query23="UPDATE PROGRESS SET CUR_STAT='AdditionalResources' WHERE ID=?";
      $stmt23=$conn->prepare($query23);
      $stmt23->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$v=$stmt23->execute();if($v!=true) throw new Exception('Error Executing Query~Changing cur_stat');}catch(Exception $e){echo 'error';die();}
      $query="SELECT RESOURCES_JSON FROM Additional_Resources WHERE UNIT=?";
      $stmt=$conn->prepare($query);
      $stmt->bindValue(1,$_POST['UNum']);
      try{ $errchk=$stmt->execute();if(!$errchk) throw new Exception("Error Occurred during Execution!");}catch(Exception $e){echo 'False';die();}
      $result=$stmt->fetch(PDO::FETCH_ASSOC);
      if($result['RESOURCES_JSON']!=NULL)
        echo json_encode($result['RESOURCES_JSON']);
      else
        echo 'False';
      die();
   }
   if(isset($_POST['Notes'])&&$_POST['Notes']!=NULL&&isset($_POST['Unum'])&&$_POST['Unum']!=NULL)
   {
    $unum="U".$_POST['Unum'];
    $qu="SELECT COUNT(*) AS C FROM NOTES WHERE ID=?";
    $st=$conn->prepare($qu);
    $st->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $v=$st->execute();
      if($v==false)
      {
        echo 'False';
        die();
      }
    }catch(Exception $e)
    {
      echo $e;
      die();
    }
    $r=$st->fetch(PDO::FETCH_ASSOC);
    $que="INSERT INTO NOTES (Notes_JSON,ID) VALUES(?,?)";
    if(((int)$r['C'])!=0)
    {
      $que="UPDATE NOTES SET Notes_JSON=? WHERE ID=?";
      $q2="SELECT Notes_JSON FROM NOTES WHERE ID=?";
      $st2=$conn->prepare($q2);
      $st2->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$v=$st2->execute();if($v==false){echo 'False';die();}}catch(Exception $e){echo $e;die();}
      $r2=$st2->fetch(PDO::FETCH_ASSOC);
      $json=$r2['Notes_JSON'];
      if($json!=NULL)
      {
        $jsondata=json_decode($json,True);
        if(isset($jsondata[$unum]))
        {
          $lastkey=key(end($jsondata[$unum]));
          if($lastkey==NULL)
            $lastkey=key($jsondata[$unum]);
          $keynum=(int)substr($lastkey,1,strlen($lastkey)-1);
          $keynum++;
          $key="N".strval($keynum);
          $jsondata[$unum][$key]=$_POST['Notes'];
        }else
        array_push($jsondata,array($unum=>array("N1"=>$_POST['Notes'])));   
      }
      else
      {
        $jsondata=array($unum=>array("N1"=>$_POST['Notes']));
      }
    }
    else
    {
      $jsondata=array($unum=>array("N1"=>$_POST['Notes']));
    }
      if(isset($jsondata))
      {
        $stm=$conn->prepare($que);
        $jdata=json_encode($jsondata);
        $stm->bindValue(1,$jdata);
        $stm->bindValue(2,$_SESSION['six_oh_four_two_id']);
        try{$v=$stm->execute();if($v==false){echo 'False';die();}}catch(Exception $e){echo 'False';die();}echo 'True';die();
      }else
      {
        echo 'False';
        die();
      }echo 'False';die();
    
   }
   if(isset($_POST['UNum']) && $_POST['UNum']!=NULL)
   {
    $query1="SELECT * FROM COURSE_METAS WHERE UNIT_NUM=?";
    $stmt=$conn->prepare($query1);
    $stmt->bindValue(1,$_POST['UNum']);
   try
   {
      $v=$stmt->execute();
   }
   catch(Exception $e)
   {
      echo $e;
      die();
   }
   $result=$stmt->fetch(PDO::FETCH_ASSOC);
  }
  else
  {
  echo 'False';
   die();
  }
 if(isset($_POST['finger_request'])&&($_POST['finger_request']!=NULL))
 {
  $query23="UPDATE PROGRESS SET CUR_STAT='Lecture' WHERE ID=?";
  $stmt23=$conn->prepare($query23);
  $stmt23->bindValue(1,$_SESSION['six_oh_four_two_id']);
  try{$v=$stmt23->execute();if($v!=true) throw new Exception('Error Executing Query~Changing cur_stat');}catch(Exception $e){echo 'error';die();}
   if($result['FINGER_EXERCISES_JSON']!=NULL)
      $a=array("FEX"=>$result['FINGER_EXERCISES_JSON']);
   else
   {
      echo 'False';
      die();
   }
   $q="SELECT SCORES_JSON FROM Progress WHERE ID=?";
   $s=$conn->prepare($q);
   $s->bindValue(1,$_SESSION['six_oh_four_two_id']);
   try
   {
    $v= $s->execute();
    if($v==false)
    {
      echo 'Oops! Some Error Occurred!';
      die();
    }
   }catch(Exception $e){echo 'Oops! Some Error Occurred!';die();}
   $r=$s->fetch(PDO::FETCH_ASSOC);
   if(strlen($r['SCORES_JSON'])!=0)
   {
      $a["SCORES"]=$r['SCORES_JSON'];
   }
   else
     $a["SCORES"]="NULL";
   $j=json_encode($a);
   echo $j;
   die();
 }
 if(isset($_POST['PSET'])&&($_POST['PSET']!=NULL))
  {
    $query23="UPDATE PROGRESS SET CUR_STAT='PSet' WHERE ID=?";
    $stmt23=$conn->prepare($query23);
    $stmt23->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try{$v=$stmt23->execute();if($v!=true) throw new Exception('Error Executing Query~Changing cur_stat');}catch(Exception $e){echo 'error';die();}
    echo $result['PSET_LINK'];
    die();
  }
 if(isset($_POST['reading_link'])&&($_POST['reading_link']!=NULL))
 {
  $query23="UPDATE PROGRESS SET CUR_STAT='Readings' WHERE ID=?";
  $stmt23=$conn->prepare($query23);
  $stmt23->bindValue(1,$_SESSION['six_oh_four_two_id']);
  try{$v=$stmt23->execute();if($v!=true) throw new Exception('Error Executing Query~Changing cur_stat');}catch(Exception $e){echo 'error';die();}
    if($result['READING_LINKS_JSON']!=NULL)
   {
      echo $result['READING_LINKS_JSON'];
      die();
   }
   else
   {
      echo 'False';
      die();
   }
 }
if(isset($_FILES['PSet'])&&isset($_POST['UNum']))
{
  $query22_p="SELECT * FROM COURSE_METAS WHERE UNIT_NUM=?";
  $stmt22_p=$conn->prepare($query22_p);
  $stmt22_p->bindValue(1,$_POST['UNum']);
  try{$errchk=$stmt22_p->execute();if(!$errchk)throw new Exception("Error Executing Query!");}catch(Exception $e){echo 'error';die();}
  $res_p=$stmt22_p->fetch(PDO::FETCH_ASSOC);
  if($res_p['ACCEPT_PSET']!=1)
    {echo 'TO';die();}
  if($res_p['PSNum']==0)
    die();
  $query22="SELECT * FROM Pset WHERE PsetNum=?";
  $stmt22=$conn->prepare($query22);
  $stmt22->bindValue(1,$res_p['PSNum']);
  try{$stat=$stmt22->execute();if($stat==false) throw new Exception("Query Returned False");}catch(Exception $e){echo 'error';die();}
  $result22=$stmt22->fetch(PDO::FETCH_ASSOC);
  $submissionsjson=$result22['Submissions'];
  $submissions=array();
  try{
  $submissions=json_decode($submissionsjson,True);
  if(isset($submissions[$_SESSION['six_oh_four_two_id']]))
  {
    echo 'AS';
    die();
  }
  else
    throw new Exception('Add');
  }catch(Exception $e)
  {
    $submissions[$_SESSION['six_oh_four_two_id']]=1;
    $value=json_encode($submissions);
  }
  if(!isset($value))
  {
    echo 'AS';
    die();
  }
  if (!class_exists('S3')) require_once 's3.php';
  $name=$_FILES['PSet']['name'];
  $temp_name=$_FILES['PSet']['temp_name'];
  if ($_FILES['Pset']['error']!=0)
  {
    echo 'False';
    die();
  }
  $ext=strtolower(end(explode('.',$name)));
  $arr=array('jpg','png','pdf','doc','docx','tex','zip');
  if(!in_array($ext,$arr))
  {
    echo 'NoACC';
    die();
  }
  $key= 'ID '.$_SESSION['six_oh_four_two_id'].' Problem Set '.$res_p['PSNum'].'.'.$ext;
  $bucketName = '6042_rules_Pset_submissions'; 
  $temp_file_location=$_FILES['PSet']['tmp_name'];
  if($v==false)
   {echo 'False';die();}
  if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
	exit("\nERROR: CURL extension not loaded\n\n");
	$uploadFile = $temp_file_location;
  $bucketName = '6042_rules_Pset_submissions';
  $s3= new S3('AKIAIPJUDPTEGXRGUNZQ','wQmIexr9OBFscKSgy65x5GG648qkk68BzkEwzzvX');
  $v=$s3->putObjectFile($uploadFile, $bucketName, 'Uploads/'.$key, S3::ACL_PRIVATE);
  if($v)
  {
    $q2="UPDATE Pset SET Submissions=? WHERE PsetNum=?";
    $st2=$conn->prepare($q2);
    $st2->bindValue(1,$value);
    $st2->bindValue(2,$res_p['PSNum']);
    try{$val=$st2->execute(); if(!$val)throw new Exception('Error Executing Query');}catch(Exception $e){echo $e;die();}
    echo 'True';
  }
  else
    echo 'False';
  unlink($temp_file_location);
}
 else
 {
  header("location:/Course_v1_00/");
    die();
 }

}
else
{
header("location:/SignIn/");
}
?>
