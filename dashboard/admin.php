<?php
session_start();
if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
require_once 'connect.inc.php';
    $query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
    $stmt1=$conn->prepare($query1);
    $stmt1->bindvalue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt1->execute();
    }catch(Excpeption $e)
    {
      die();
    }
    $result=$stmt1->fetch(PDO::FETCH_ASSOC);
if($result['AUTH_TYPE']!=0)
{
  header("location:/dashboard");
  die();
}
   if((isset($_POST['Q'])&&$_POST['Q']!=NULL)&&(isset($_POST['UNum'])&&$_POST['UNum']!=NULL))
    {
      $query_="SELECT FINGER_EXERCISES_JSON FROM COURSE METAS WHERE UNIT_NUM=?";
      $stmt_=$conn->prepare($query_);
      $stmt_->bindValue($_POST['UNum']);
      try
      {
        $stmt_->execute();
      }catch(Exception $e)
      {
        echo $e;
        die();
      }
      $r_=$stmt_->fetch(PDO::FETCH_ASSOC);
      echo $r_['FINGER_EXERCISES_JSON'];$val=true;
      die();
    }
  if((isset($_POST['QJson'])&&$_POST['QJson']!=NULL)&&(isset($_POST['UNum'])&&$_POST['Unum']!=NULL))
  { 
    echo 'here!';
    die();
    $query2="UPDATE COURSE_METAS SET FINGER_EXERCISES_JSON=? WHERE ID=?";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_POST['QJson']);
    $stmt2->bindValue(2,$_POST['UNum']);
    try
    {
      $stmt2->execute();
    }catch(Exception $e){echo $e;die();}
    echo 'True';$val=true;
    die();
  }
  if((isset($_POST['RJson'])&&$_POST['RJson']!=NULL)&&(isset($_POST['UNum'])&&$_POST['Unum']!=NULL))
  {
    $query3="UPDATE COURSE_METAS SET FINGER_EXERCISES_JSON=? WHERE ID=?";
    $stmt3=$conn->prepare($query3);
    $stmt3->bindValue(1,$_POST['RJson']);
    $stmt3->bindValue(2,$_POST['UNum']);
    try
    {
      $stmt3->execute();
    }catch(Exception $e){echo $e;die();}
    echo 'True';$val=true;
    die();
  }
?>
<!DOCTYPE html>
<html>
<head>
        <link href="/Resources/favicon.ico" rel="shortcut icon">
        <title>Admin Dashboard | 6.042 Rules!</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script src="Resources/moment.js" type="text/javascript"></script>

    </head>
    <body>

    <nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner">
                    <a href="/" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png" style="margin:-30px 0px 0px 0px" width="100px"> </a>
                    <h1 class="header1" id="title"> 6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav" style="padding: 15px;">

                    <li> <a href="/" class="nav-links"> Home</a> </li>
                    <li> <a href="/dashboard/" class="nav-links"> Dashboard </a> </li>
                    <li> <a href="/AboutUs" class="nav-links"> Who Are We? </a> </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="margin:-60px 0px 0px 0px">
                    <li> 
                    <table>
                    <tr><td><a class="navbar-right nav navbar-nav" href="/Profile/"> <img src="./Images/sign_up.png" style="padding:0px 0px 0px -10px"width="100px"> </a></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result['FNAME'].' '.$result['LNAME']?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
    <style>
      #Question-Table td
      {
        border:1px solid silver;
      }
      #Question-Table input[type=text]
      {
        width:200px;
        font-size:20px;
      }
      #reading-table td
      {

        border:1px solid silver;
      }
      #reading-table input[type=text]
      {
        width:200px;
        font-size:20px;
      }
      .bdy
      {
        margin:20px;
        border:1px solid silver;
        border-radius:10px;
        height:auto;
        padding:20px;
      }
      .but
      {
        border:none;
        width:150px;
        height:50px;
        background-color:Green;
        font-size:20px;
        color:white;
      }
      #Question-Table
      {
        width:500px;
        font-size:30px;
      }
      .but:hover
      {
        color:#006400;
      }
      #err
      {
        font-size:30px;
        background-color:#16996b;
        color:white;
        width:100%;
        padding:10px;
        border-top-left-radius:10px;
        border-top-right-radius:10px;
        border-bottom-left-radius:10px;
        border-bottom-right-radius:10px;
      }
     .ans
     {
        width:30px;
     }
     #AddResc td
     {
        border:1px solid black;
     }
    </style>
    <script>
    var curr_row_count=0;
    var stat_count=0;
    var reading_row_count=0;
    var rowCount=0;
    var AddRescRowCount=0;
    function ValidURL(str) {
  var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
    '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
    '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
    '(\:\d+)?(\/[-a-z\d%_.~+]*)*'+ // port and path
    '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
    '(\#[-a-z\d_]*)?$','i'); // fragment locater
    if(!pattern.test(str)) {
      return false;
    } else {
      return true;
     }
   }
      function getdata()
      {
        if(($("#unit_n").val()).length!=0)
          $.post("admin_controls.php",{'Q':1,'UNum':$("#unit_n").val()},function(data,status,jsXHR)
          {
          if(data.length>0)
          {
            try
            {
            var jsondata=JSON.parse(data);
            console.log(data);
            $("#Question-Table").empty();
            curr_row_count=0;
            window.alert("Success!");
            $("#err").append((stat_count++)+".)Success!<br/>");
            $("#Question-Table").append("<tr><td>Question</td><td>Option 1</td><td>Option 2</td><td>Option 3</td><td>Option 4</td></tr>");
            $.each(jsondata,function(i,item)
            {
              var htm="<tr><td><input type='text' id='Ques"+(i+1).toString()+"'value='"+item.Question+"'></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_1'value='"+item.Opt1+"'></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_2'value='"+item.Opt2+"'></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_3'value='"+item.Opt3+"'></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_4'value='"+item.Opt4+"'></input></td></tr>";
              $("#Question-Table").append(htm);
              curr_row_count+=1;
            });
            }
            catch(e)
            {
              $("#err").append((stat_count++)+".)"+e.message+"<br/>");
              $("#err").append((statcount++)+".)data:"+data+"<br/>");
            }
            
          }
          else
          $("#err").append((stat_count++)+".)No Such Data to show!<br/>");
          });
      }
      
      function addRow()
      {
       var i=curr_row_count;
        var htm="<tr><td><input type='text' id='Ques"+(i+1).toString()+"'value=''></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_1'value=''></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_2'value=''></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_3'value=''></input></td><td><input type='text' id='Opt"+(i+1).toString()+"_4'value=''></input></td><td><input type='text'  class='ans' id='Ans"+(i+1).toString()+"'value=''></input></td><td><input type='text' id='MAC"+(i+1).toString()+"'value=''></input></td></tr>";
        $("#Question-Table").append(htm);
        curr_row_count+=1;
      }
      function send()
      {
        jdata=[];
        ans=[];
        var item={};
        var item2={};
        for(var idx=0;idx<curr_row_count;idx++)
        {
           item={};
           item2={};
          item.Question=$("#Ques"+(idx+1)).val();
          item.Opt1=$("#Opt"+(idx+1)+"_1").val();
          item.Opt2=$("#Opt"+(idx+1)+"_2").val();
          item.Opt3=$("#Opt"+(idx+1)+"_3").val();
          item.Opt4=$("#Opt"+(idx+1)+"_4").val();
          item.MAC=$("#MAC"+(idx+1)).val();
          jdata.push(item);
          item2.ID="F"+$("#unit_n").val()+"_Q"+(idx+1);
          item2.Ans=$("#Ans"+(idx+1)).val();
          ans.push(item2);
        }
        if(($("#unit_n").val()).length!=0)
        {
          $.post("admin_controls.php",{'QJson':JSON.stringify(jdata),'UNum':$("#unit_n").val(),'RD':(moment().format('MMMM Do YYYY, h:mm:ss a'))},function(data,status,jsXHR)
          {
            stat_count++;
            if(data== 'True')
              $("#err").append((stat_count)+".)Success! Uploading Questions<br/>");
            else
              $("#err").append((stat_count)+".)ERROR:  data="+data+"<br/>");
          });
          $.post("admin_controls.php",{'Ans':JSON.stringify(ans)},function(data,status,jsXHR)
          {
            stat_count+=1;
            if(data=='True')
              $("#err").append((stat_count)+".)Success! Uploading Answers<br/>");
            else
              $("#err").append((stat_count)+".) ERROR: data="+data+"<br/>");
          });
        }
      }
      function removeRow()
      {
        if(curr_row_count>0)
        {
          curr_row_count-=1;
          $("#Question-Table tr").remove("tr:last-child");
        }
      }
      function addReadingRow()
      {
        var htm="<tr><td><input id='Read"+(reading_row_count+1)+"' type='text' value=''></input></td></tr>";
        $("#reading-table").append(htm);
        reading_row_count+=1;
      }
      function removeReadingRow()
      {
        if(reading_row_count>0)
        {
          reading_row_count-=1;
          $("reading-table tr").remove("tr:last-child");
        }
      }
      function get_set_pset_link()
      {
        
        if(($("#unit_n").val()).length!=0)
        {
          if($("#PSET").val().length==0)
          {
            $.post("admin_controls.php",{'get':1,'UNum':$("#unit_n").val()},function(data,status,jsXHR)
            {
            stat_count+=1;
              if(validURL(data))
                {
                  $("#PSET").val(data);
                  $("#err").append(stat_count+".)Success!<br/>");
                }
              else
                {
                  $("#err").append(stat_count+".)ERROR: data="+data+"<br/>");
                }
               
            });
         }
         else
            {
              $.post("admin_controls.php",{'set':$("#PSET").val(),'UNum':$("#unit_n").val()},function(data,status,jsXHR)
              {
                stat_count+=1;
                if(data=='True')
                {
                  $("#err").append(stat_count+".)Success!<br/>");
                }
                else
                {
                  $("#err").append(stat_count+".) ERROR:  data="+data+"<br/>");
                }
              });
            }
        }
      }
      function set_update()
      {
        if($("#course-update").val().length!=0)
        $.post("admin_controls.php",{"CourseUpdate":$("#course-update").val(),"date":(moment().format('MMMM Do YYYY, h:mm:ss a'))},function(data,status,jsXHR)
        {
          if(data=='True')
          {
            stat_count+=1;
            if(data=='True')
              $("#err").append(stat_count+".)"+"Success Updating Course-Update<br/>");
            else
              $("#err").append(stat_count+".) ERROR: data="+data+"<br/>");
          }
        });
      }
      function send_reading()
      { 
        var jsondata=[];
        var item={};
        for(var idx=0;idx<reading_row_count;idx++)
        {
          item.Link=$("#Read"+(idx+1)).val();
          jsondata.push(item);
          item={};
        }
        if(($("#unit_n").val()).length!=0)
        {
          
          $.post("admin_controls.php",{'RJson':JSON.stringify(jsondata),'UNum':$("#unit_n").val()},function(data,status,jsXHR)
          {
            stat_count+=1;
            if(data=='True')
              $("#err").append(stat_count+".)"+"Success<br/>");
            else
              $("#err").append(stat_count+".)ERROR Data="+data+"<br/>");
          });
        }
      }
      function get_Submitted_Psets()
      {
        $.post("admin_controls.php",{"getPsetSubmissions":1},function(data,status,jsXHR)
        {
          if(status.trim()=="success")
          {
            if(data!=null)
            {
              try{
                  var jsondata=JSON.parse(data);
                  
                  $.each(jsondata,function(idx1,item1)
                  {
                    var submissions=JSON.parse(item1.Submissions);
                    $("#Psets").append("<tr colspan='1' style='border:1px solid black;'><td><h3> Problem Set "+item1.PsetNum+"</h3></td><td style='border:1px solid black;'><input type='text' id='Soln"+item1.PsetNum+"' value='No Value'></input></td></tr>");
                    rowCount=parseInt(item1.PsetNum);
                    $.each(submissions,function(idx2,sub){
                      var str="<tr><td style='border:1px solid black;'>"+idx2+"</td><td style='border:1px solid black;' class='P"+item1.PsetNum+"'><input class='"+idx2+" score' type='text' value='0'></input></td><td class='P"+item1.PsetNum+"' style='border:1px solid black;'><input type='text' class='ImpS"+idx2+" impsheet'></input></td></tr>";
                      $("#Psets").append(str);
                    try{
                    var checked=JSON.parse(item1.Checked);
                    $(".P"+item1.PsetNum+">."+idx2).val(checked[idx2].SCORES);
                    }
                    
                     catch(e){}
                   });
                   try{
                    var soln=JSON.parse(item1.SOLN);
                    $("#Soln"+(item1.PsetNum-1)).val(soln[item1.PsetNum-1]);
                    }catch(e){}
                  });
              $("#err").append(++stat_count+") SUCCESS!");
              }catch(e)
              {
                 $('#err').append(++stat_count+') ERROR: message='+e.message+'\nDATA='+data);
              }
           }
         }
        });
       }
       function parsePOSTString(arr)
       {
        var str=null;
        var len=0;
        try{
        if(arr instanceof Array)
        len=arr.length;
        else if (arr instanceof Object)
        len=Object.keys(arr).length;
        if(len>0)
          str=JSON.stringify(arr);
        else
        throw 'Error Parsing!';
        }catch(e)
        {}
        return str;
       }
      function sendPsetData(obj)
      {
        var array=[],array2={};
        var impArray={};
        var solnArray=[];var item1={};
        /* Scores Array { */
        for(var i=0;i<rowCount;i++)
        {
          var arr=$(".P"+(i+1)+">.score").map(function(){return $(this);});
          if(arr.length!=0){
          $.each(arr,function(idx,item)
          {
            var class_=$(item).attr('class');
            class_=class_.substring(0,class_.indexOf(' '));
            if($(item).val().length!=0)
            {
              item1={};
              item1['SCORES']=$(item).val();
              array2[class_]=item1;
            }
          });
          array.push(array2);
          array2={};
          }}
        /* } Scores Array */
        /* Impression Sheet Array {*/
        var impArray={};
          for( var  i=0;i<rowCount;i++)
          {
            var arr=$(".P"+(i+1)+">.impsheet").map(function(){return $(this);});
            $.each(arr,function(idx,item)
            {
              var class_=$(item).attr('class');
              class_=class_.substring(0,class_.indexOf(' '));
              class_=class_.substring(class_.indexOf('S')+1);
              if($(item).val().length>0)
              {
                if(impArray[class_]===undefined)
                {
                  impArray[class_]={};
                }
                if($(item).val().length>0)
                    impArray[class_][i+1]=$(item).val();
              }
            });
          }
        /* } Impression Sheet Array */
        /* Soln Array{ */
        for(var i=0;i<rowCount;i++)
        {
          var soln=$("#Soln"+(i+1)).val();
          if(soln!='No Value' && soln.length!=0)
            solnArray.push(soln);
        }
        /* } Soln Array */
        var arr=parsePOSTString(array);
        var imparr=parsePOSTString(impArray);
        var solnarr=parsePOSTString(solnArray);
      $.post("admin_controls.php",{"setScores":arr,'ImpSheet':imparr,'Soln':solnarr},function(data,status,jsXHR)
      {
        stat_count++;
        if(data.includes('True'))
          $("#err").append(stat_count+".)Successfully Uploaded the Marks!");
        else if(data.includes('error'))
          $("#err").append(stat_count+".) Error Uploding Answers");
        else
          console.log(data);
      });
    }
    function addRescRow()
    {
      if($("#unit_n").val().length==0)
        return;
      var unit_num=$("#unit_n").val();
      AddRescRowCount+=1;
      $("#AddResc").append("<tr><td><input type='text' id='RescName"+unit_num+"_"+AddRescRowCount+"'></input></td><td><input type='text' id='RescLink"+unit_num+"_"+AddRescRowCount+"'></input></td><td><input type='text' id='RescDesc"+unit_num+"_"+AddRescRowCount+"'></input></td></tr>");
    }
    function removeRescRow()
    {
      if(AddRescRowCount>0)
      {
        $("#AddResc tr").remove("tr:last-child");
        AddRescRowCount-=1;
      }
    }
    function TxRxResc(param)
    {
      if($("#unit_n").val().length==0)
        return;
        var unit_num=$("#unit_n").val();
      if(param=='Tx')
      {
        var array=[];
        for(var i=1;i<=AddRescRowCount;i++)
        {
          item={};
          item.Link=$("#RescLink"+unit_num+"_"+i).val();
          item.Name=$("#RescName"+unit_num+"_"+i).val();
          item.Description=$("#RescDesc"+unit_num+"_"+i).val();
          array.push(item);
        }
        $.post("admin_controls.php",{'rescInsert':JSON.stringify(array),'UNum':$("#unit_n").val()},function(data,status,jsXHR)
        {
          if(status=='success')
          {
            $("#err").append(++stat_count+")"+data);
          }
          else
          {
            $("#err").append(++stat_count+") Got status !(success)");
          }
        });
      }
      else if(param=='Rx')
      {
        $.post("admin_controls.php",{'rescGet':1,'UNum':$("#unit_n").val()},function(data,status,jsXHR)
        {
          if(status=='success')
          {
            var unit_num=$("#unit_n").val();
            if(data=='False')
            {
              $("#err").append(++stat_count+") No Resources Found");
              return;
            }
            var jdata=JSON.parse(data);
            $.each(jdata,function(idx,item){
              if((idx+1)>AddRescRowCount)
                addRescRow();
              $("#RescLink"+unit_num+"_"+(idx+1)).val(item.Link);
              $("#RescName"+unit_num+"_"+(idx+1)).val(item.Name);
              $("#RescDesc"+unit_num+"_"+(idx+1)).val(item.Description);
            });
          }
          else
          {
            $("#err").append(++stat_count+") Got status (!success)");
          }
        });
      }
    }
    </script>
    <div class="bdy">
    <input type="text" id="unit_n" placeholder="Unit Number.." style="border:none;border-bottom:1px solid #43cdef;width:300px;height:50px;font-size:20px"></input>
    <br/>
    <h1 class="header1">Set and Get finger Exercise Questions</h1><br/>
    <button id="get" class="but" onclick="getdata()">get Data</button>
      <table id="Question-Table" style="border:1px solid silver;border-radius:2em">
        <tr>
        <td>Question</td>
        <td>Option 1</td>
        <td>Option 2</td>
        <td>Option 3</td>
        <td>Option 4</td>
        <td>Answer  </td>
        <td>Max. Attempts</td>
        </tr>
      </table>
      <button id="add" class="but" onclick="addRow();" style="width:50px;height:50px;" title="Add A Row">+</button>
      <button id="remove" class="but" onclick="removeRow();" style="width:50px;height:50px;" title="Remove A Row">&minus;</button>
      <button id="sub" class="but" onclick="send();">Submit Data</button>
      <br/><br/>
      <h1 class="header1">Set Reading Links</h1>
      <table id="reading-table" style="border:1px solid silver;border-radius:2em">
        <tr>
        <td> Links </td>
        </tr>
      </table>
      <button id="add_row_reading" class="but" onclick="addReadingRow();" style="width:50px;height:50px;" title="Add Reading Row">+</button>
      <button id="remove_row_reading" class="but" onclick="removeReadingRow();" style="width:50px;height:50px;" title="Remove Reading Row">&minus;</button>
      <button id="sub2" class="but" onclick="send_reading();">Submit Data</button>
      <br/><br/>
      <h1 class="header1"> Problem Set Link</h1>
      <input type="text" id="PSET" placeholder="Problem Set Link..." style="border:none;border-bottom:1px solid #43cdef;width:500px;height:50px;font-size:20px"></input>
      <button id="sub_get" class="but" style="width:200px"onclick="get_set_pset_link()">Get/Set PSET Link</button>
      <br/><br/>
      <div>
      <h1 class="header1">Get/Set Additional Resources</h1>
      <table id="AddResc">
      <tr><td>Name</td><td>Link</td><td>Description</td>
      </table>
      <button id="add_row_addResc" class="but" onclick="addRescRow();" style="width:50px;height:50px;" title="Add Additional Resources">+</button>
      <button id="remove_row_addResc" class="but" onclick="removeRescRow();" style="width:50px;height:50px;" title="Remove Additional Resources">&minus;</button><br/><br/><br/>
      <button id="getResc" class="but" onclick="TxRxResc('Rx');" style="width:50px;height:50px;" title="Get Additional Resources">Get</button>
      <button id="sendaddResc" class="but" onclick="TxRxResc('Tx');" style="width:50px;height:50px;" title="Send Additional Resources">Send</button>
      </div>
      <div>
      <h1 class="header1">Problem Set Submissions</h1>
      <a href="/dashboard/tex" target="_Blank">Click To got the TeX editor. (in the editor Write the LaTeX, Compile it, And Copy the Compiled Code)</a><br/><br/>
        <table id="Psets">
          <tr><td style='border:1px solid black;'>ID</td><td style='border:1px solid black;'>Marks</td><td style='border:1px solid black;'>Imp Sheet</td></tr>
        </table>
        <button class="but" onclick="get_Submitted_Psets()">Get Pset Scores</button>
        <button class="but" onclick="sendPsetData(this)">Submit Pset Scores</button>
      </div>
      <br/><br/>
      <textarea id="course-update" rows="20" cols="80"></textarea>
      <button class="but" style="width:200px" onclick="set_update()">SET Update</button>
    </div>
    <p id="err">Stats & Errs:<br/><br/></p>
</body>
</html>
