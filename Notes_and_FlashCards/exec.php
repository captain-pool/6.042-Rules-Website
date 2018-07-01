<?php
session_start();
if(!isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']==NULL)
 header("location:/SignIn");
require_once 'connect.inc.php';
    if(isset($_POST['edit'])&& $_POST['edit']!=NULL && isset($_POST['noteNum']) && $_POST['noteNum']!=NULL && isset($_POST['unitNum']) && $_POST['unitNum']!=NULL)
    {
      $query1="SELECT * FROM Notes WHERE ID=?";
      $stmt1=$conn->prepare($query1);
      $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$val=$stmt1->execute();if(!$val) throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
      $result=$stmt1->fetch(PDO::FETCH_ASSOC);
      $set=False;
      $note_json=json_decode($result['Notes_JSON'],True);
      foreach($note_json as $key=>$value)
      {
        if($key==$_POST['unitNum'])
        {
          foreach($value as $k=>$val)
          {
            if($k==$_POST['noteNum'])
            {
              $note_json[$key][$k]=$_POST['edit'];
              $set=True;
              break;
            }
          }
        }
      }
      if($set)
        {
          $query2="UPDATE Notes SET Notes_JSON=? WHERE ID=?";
          $stmt2=$conn->prepare($query2);
          $jdata=json_encode($note_json);
          $stmt2->bindValue(1,$jdata);
          $stmt2->bindValue(2,$_SESSION['six_oh_four_two_id']);
          try{$val=$stmt2->execute();if(!$val)throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
          echo 'True';
          die();
        }
    }
    if(isset($_POST['delete'])&& $_POST['delete']!=NULL)
    {
      $query1="SELECT * FROM Notes WHERE ID=?";
      $stmt1=$conn->prepare($query1);
      $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$val=$stmt1->execute();if(!$val) throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
      $result=$stmt1->fetch(PDO::FETCH_ASSOC);
      $unset=False;
      $note_json=json_decode($result['Notes_JSON'],True);
      foreach($note_json as $key=>$value)
      {
        if($key==$_POST['unitNum'])
        {
          foreach($value as $k=>$val)
          {
            
            if($k==$_POST['noteNum'])
            {
              unset($note_json[$key][$k]);
              if(count($note_json[$key])==0)
                unset($note_json[$key]);
              $unset=True;
              break;
            }
          }
        }
      }
      if($unset)
        {
          $query2="UPDATE Notes SET Notes_JSON=? WHERE ID=?";
          $stmt2=$conn->prepare($query2);
          $jdata=json_encode($note_json);
          if(count($note_json)==0)
            $jdata=NULL;
          $stmt2->bindValue(1,$jdata);
          $stmt2->bindValue(2,$_SESSION['six_oh_four_two_id']);
          try{$val=$stmt2->execute();if(!$val)throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
          echo 'True';
          die();
        }else echo 'False';
    }
?>
