<?php
session_start();
if(!isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']==NULL)
 header("location:/SignIn");
try {
      $conn=new PDO("sqlsrv:server=instance-id-1.cmsfb8qecsks.us-east-2.rds.amazonaws.com,1433;database=master_database","s6042_rules_db_1","6.042_Rocks!");
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
    catch (PDOException $e) {
      echo ('Error connecting to SQL Server.');
      die();
    }
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
        if((int)$key==(int)$_POST['unitNum'])
        {
          $i=0;
          foreach($value as $val)
          {
            $i++;
            if($i==(int)$_POST['noteNum'])
            {
              $note_json[$key][$i-1]=$_POST['edit'];
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
    if(isset($_POST['delete'])&& $_POST['delete']!=NULL && isset($_POST['noteNum']) && $_POST['noteNum']!=NULL && isset($_POST['unitNum']) && $_POST['unitNum']!=NULL)
    {echo 'hi';die();
      $query1="SELECT * FROM Notes WHERE ID=?";
      $stmt1=$conn->prepare($query1);
      $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
      try{$val=$stmt1->execute();if(!$val) throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
      $result=$stmt1->fetch(PDO::FETCH_ASSOC);
      $unset=False;
      $note_json=json_decode($result['Notes_JSON'],True);
      foreach($notes_json as $key=>$value)
      {
        if((int)$key==(int)$_POST['unitNum'])
        {
          $i=0;
          foreach($value as $val)
          {
            $i++;
            if($i==(int)$_POST['noteNum'])
            {echo 'hi';die();
              unset($note_json[$key][$i-1]);
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
          $stmt2->bindValue(1,$jdata);
          $stmt2->bindValue(2,$_SESSION['six_oh_four_two_id']);
          try{$val=$stmt2->execute();if(!$val)throw new Exception("Execution Error");}catch(Exception $e){echo 'error';die();}
          echo 'True';
          die();
        }
    }
?>
