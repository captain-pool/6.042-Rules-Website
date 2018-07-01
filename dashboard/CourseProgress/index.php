<?php
  session_start();
  function sanitize_xss($txt)
    {
      try{
      $txt=trim($txt);
      $txt=stripslashes($txt);
      $txt=htmlspecialchars($txt);
      return $txt;}
      catch(Exception $e)
      {
        echo "Error Occured! Please Contact Adrish!";
        die();
      }
    }
  if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
    require_once 'connect.inc.php';
    $query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
    $stmt=$conn->prepare($query1);
    $stmt->bindValue(1,$_SESSION['six_oh_four_two_id'],PDO::PARAM_STR);
    try
    {
      $v=$stmt->execute();
      if($v==false)
        {
          echo 'Oops! Some Error Occured!';
          die();
        }
    }
    catch(Exception $e)
    {
      echo 'Oops! Some Error Occured!';
      die();
    }
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    $query2="SELECT COUNT(*) AS C FROM Progress WHERE ID=?";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt2->execute();
    }
    catch(Exception $e)
    {
      die();
    }
    $res1=$stmt2->fetch(PDO::FETCH_ASSOC);
    $v='Start Course';
    if($res['C']!=0)
    {
      $v='Resume Course';
    } 
    $query3="SELECT * FROM COURSE_METAS";
    $stmt3=$conn->prepare($query3);
    $stmt3->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try{$v2=$stmt3->execute();if($v2==false){throw new Exception("Error Executing Statement!~False");}}catch(Excpetion $e){echo $e;die();}
    $res=$stmt3->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
	<meta property="og:title" content="6.042 Rules!| Course Progress">
<meta property="og:url" content="https://www.6042rules.ml/dashboard/CourseProgress">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
        <link rel="shortcut icon" href="/Resources/favicon.ico">
        <title>Course Progress | 6.042 Rules!</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">
        <link href="css/style.css" type="text/css" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="./scripts/highcharts.js" type="text/javascript"></script>
        <script src="./scripts/mainscript.js" type="text/javascript"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script>
        function hide_show(obj)
        {
          $(obj).find('div').slideToggle('slow');
        }
        </script>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
        #coursenav:hover
        {
          background-color:#2d52a8;
        }
          #navigation-bar a
          {
            font-size:20px;
            font-family:'Comfortaa',sans-serif;
          }
          .sln,.im
          {
            background-color:transparent;
            color:#4286f4;
            border:none;
            text-decoration:none;
            cursor:pointer;
          }
          .soln:hover,.imp:hover
          {
            text-decoration:underline;
            color:#2e76ea;
          }
        </style>

    </head>
    <body>

    <nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner" style="margin:3% 0px 0px 0px">
                    <a href="/" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="Images/icon.png" style="margin:-30px 0px 0px 0px" width="100px"> </a>
                    <h1 class="navbar-brand" id="title"> 6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav navbar-right" style="margin:-3% 0px 0px 0px">
                    <li> 
                    <table>
                    <tr><td><img src="./Images/sign_up.png" width="100px"></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result['FNAME'].' '.$result['LNAME']?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    <tr><td style="text-align:center;"><?php if($result['AUTH_TYPE']==0) { ?><a href="/dashboard/admin.php" title="Click Here to Open Admin Panel">Admin Controls</a><?php } ?></td></tr>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
    <div id="stat" style="width:100%;height:30px;margin-top:0px;color:white;background-color:#47aa2c;padding:0px 0px 0px 40%;font-size:20px;font-family:'Comfortaa',sans-serif;">Fetching Data and Calculating, Please Wait...</div>
    <div id="Progress" class="container">
    <ol class="breadcrumb" style="margin:30px 0px;width:100%;font-family:'comfortaa',sans-serif;font-size:20px;">
        <li class="breadcrumb-item"><a href="/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active"> Course Progress </li>
      </ol>
        <div id="graph" style="min-width: 300px; height: 400px; margin: 0 auto;border:1px solid silver;border-radius:10px">
          <script type="text/javascript">
$(document).ready(function()
{
  retrieve();
  //$("#stat").slideToggle('fast');
 
});
function drawGraph(list)
{
  Highcharts.chart('graph', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Current Course Progress'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'comfortaa,sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        max:100,
        title: {
            text: 'Scores(%)',
            fontFamily:'comfortaa,sans-serif'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Score: <b>{point.y:.1f} %</b>'
    },
    series: [{
        name: 'Population',
        data:list,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'comfortaa,sans-serif'
            }
        }
    }]
});
}
		</script>
        </div>
    </div>
   
    
    <div class="container" id="container">
     <br/>
    <br/>
    <br/>
    <div style="height:auto;width:100%;border-radius:10px;border:1px solid silver;"><br/><h1 style="margin:0px 20px">Released Units</h1><br/>
		 <ul id="Scores" type="none">
		 <?php 
       $last_unit_num=0;$ps=0;
       foreach($res as $key=>$r3)
       {
        echo "<li> <div style='font-family:Raleway'><h2> Unit ".$r3['UNIT_NUM']." ".$r3['COURSE_NAME']."</h2><h3>Released on:".$r3['RELEASE_DATE']."</h3><table cellspacing='10px'><tr>";
        if($r3['PSET_LINK']!='NOPS'){ $ps+=1;
          echo "<td>Problem Set ".$ps.": </td><td colspan='2' align='center'id='Pset".$ps."'></td>";
          echo "<td id='PSSoln".$ps."'></td><td id='PSImpS".$ps."'></td>";}
          echo "</tr></table></div></li>";
        $last_unit_num=$r3['UNIT_NUM'];

       }?></ul>
<?php if(24-$last_unit_num>0) echo "<div style='font-family:comfortaa,sans-serif;font-size:25px;'><i>".(24-$last_unit_num)." Units Left to be released!</i> (Please take a look at the Syllabus to know more)</div>"; ?>
    </div>

    </body>

</html>
