<?php
  session_start();
  if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
require_once 'connect.inc.php';
 if(isset($_POST['getInfo'])&&$_POST['getInfo']!=NULL)
 {
    $query2="SELECT * FROM COURSE_METAS";
    $stmt2=$conn->prepare($query2);
    try{
      $v=$stmt2->execute();
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
    $result2=$stmt2->fetchAll();
    $json= json_encode($result2);
    echo $json;
    die();
  }
 if(isset($_POST['Soln_Imp'])&& $_POST['Soln_Imp']!=NULL)
{
    $query1="SELECT ImpSheet FROM Progress WHERE ID=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try{$errchk=$stmt1->execute();if(!$errchk)throw new Exception("Error Occurred! ~ False");}catch(Exception $e){echo 'error';die();}
    $result1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $ret_arr['ImpSheet']=$result1['ImpSheet'];
    $query1="SELECT SOLN FROM PSET";
    $stmt1=$conn->prepare($query1);
    try{$errchk=$stmt1->execute();if(!$errchk)throw new Exception("Error Occurred! ~ False");}catch(Exception $e){echo 'error';die();}
    $res=$stmt1->fetchAll();
    $i=1;
    foreach($res as $r)
    {
      if($r['SOLN']!=NULL)
      {
        $arr2[$i]=$r['SOLN'];
        $i++;
      }
    }
    $ret_arr['SOLN']=json_encode($arr2);
    
    echo json_encode($ret_arr);
    die();
}
 if(isset($_POST['getScores'])&&$_POST['getScores']!=NULL)
  {
    $query1="SELECT SCORES_JSON FROM Progress WHERE ID=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
    $query2="SELECT * FROM PSet";
    try{$v=$stmt1->execute();if($v==false){echo 'error';die();}}catch(Exception $e){echo 'error';die();}
    $stmt2=$conn->prepare($query2);
    try{$v=$stmt2->execute();if($v==false){echo 'error';die();}}catch(Exception $e){echo 'error';die();}
    $result=$stmt1->fetch(PDO::FETCH_ASSOC);
    $result1=$stmt2->fetchAll();
    if(strlen($result['SCORES_JSON'])!=0|| strlen($result1[0]['Checked'])!=0)
    { 
      if(strlen($result1[0]['Checked'])!=0)
      {
        $scores=json_decode($result['SCORES_JSON']);
        $countl=count($scores);
        foreach($result1 as $res)
        {
          try
          {
            $j=json_decode($res['Checked'],True); 
             if(isset($j[$_SESSION['six_oh_four_two_id']]))
              {
                $scores[$countl]['Question']='P'.((string)$res['PsetNum']);
                $scores[$countl]['stat']=(int)$j[$_SESSION['six_oh_four_two_id']]['SCORES'];
                $scores[$countl]['AC']=0;
                $scores[$countl]['MAC']=0;
                $scores[$countl]['Choice']=0;
              }
              $countl++;
          }catch(Excpetion $e)
          {
          }
        }
       $j3=json_encode($scores);
       echo $j3;
       die();
      }
      else
        echo $result['SCORES_JSON'];
    }
    else
    {
      echo 'No';
    }
 }
?>

