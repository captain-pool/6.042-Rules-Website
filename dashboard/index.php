<?php
  session_start();
  require_once 'connect.inc.php';
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
    $res=$stmt2->fetch(PDO::FETCH_ASSOC);
    $v='Start Course';
    if($res['C']!=0)
    {
      $v='Resume Course';
    } 
    $query3="SELECT * FROM COURSE_UPDATES";
    $stmt3=$conn->prepare($query3);
    try{$v2=$stmt3->execute();if($v2==false){throw new Exception("Error Executing Statement!~False");}}catch(Excpetion $e){echo $e;die();}
    $res=$stmt3->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=1000,initial-scale=1.0"></meta>
        <meta name="description" content="Mathematics for Computer Science - Dashboard"></meta>
        <meta property="og:title" content="6.042 Rules!| Dashboard">
<meta property="og:url" content="https://www.6042rules.ml/dashboard">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
        <link rel="shortcut icon" href="/Resources/favicon.ico">
        <title>Dashboard | 6.042 Rules!</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="/Course_v1_00/scripts/MathJax.js?config=TeX-AMS_HTML-full"></script>
        <script type="text/x-mathjax-config">
          MathJax.Hub.Config({
          tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
          });
        </script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script>
        function hide_show(obj)
        {
          $(obj).find('div').slideToggle('slow');
        }
        $(document).ready(function(){$(".hide_show").find("div").slideUp();});
        </script>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Caveat');
		@import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
        @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
			#navigation-bar a
				{
					font-size:20px;
				}
		</style>

    </head>
 

  <body>
	<nav class="navbar navbar-wrapper">
      <div class="container" style="width:105%;margin:-6px 0px 0px -20px;background-color:#474745;position:fixed;z-index:9999">
        <table>
          <tr style="width=100%;">
		  	<td style="width:2%">
			</td>
		  <div style="width:auto">
			<td style="float:left">
				<img src="/Resources/icon.png" height="50px" width="50px" style="margin:5px"><a width="300px" style="font-family:'Caveat',cursive;font-size:40px;text-decoration:none;margin:0;" href="/"> 6.042 Rules!</a>
			</td>
		  <div style="width:auto">
		  	<td style="width:10%">
			</td>
		  <div style="width:auto">
			<td style="float:left">
				<a class="head_anchors" href="/"style="text-decoration:none;" title="Course homepage">Home</a>
			</td>
		  <div style="width:auto">
			<td style="float:left">
				<a class="head_anchors present" href="javascript:void(0);" style="text-decoration:none;" title="You have signed in to your dashboard.">Dashboard</a>
			</td>
		  <div style="width:auto">
			<td style="float:left">
				<a class="head_anchors" href="/AboutUs/" style="text-decoration:none;" title="We're here to help you!">Contact Us</a>
			</td>
		  <div style="width:auto">
			<td style="float:right">
				<a class="head_anchors" href="/SignIn/logout.php" style="text-decoration:none;" title="Logout from your account">Logout</a>
			</td>
		  <div style="width:auto">
			<td style="float:right">
				<a class="head_anchors" href="/feedback/" style="text-decoration:none;" title="We would love to hear from you!">Feedback</a>
			</td>
		  <div style="width:auto">
-		  <?php if($result['AUTH_TYPE']==0) { ?>
		  	<td style="float:right">
				<a class="head_anchors" href="admin.php" style="text-decoration:none;" title="Access available for course administrators.">Admin Panel<a>
			</td><?php } ?>
		  <div style="width:auto">
			<td style="float:right">
				<a class="head_anchors" style="text-decoration:none;" href="/Profile/" id="prof" title="Profile"><img src="./Images/sign_up.png" height="30px" width="30px" style="padding:0px;margin:0px 10px 0px 10px;"><?php echo $result['FNAME'].' '.$result['LNAME'];?></a>
			</td>
		  </tr>
        </table>
	  </div>
    </nav>
  <table>
    <tr><td style="width:100%;height:100%;">
    <div id="course-updates" class="container" style="width:90%; margin:2% 1% 0% 5%;border:1px solid silver;padding:0px 15px 0px 20px;border-radius:10px">
      <h2 style="font-size:28px;font-family:'Caveat',sans-serif;padding:0px 10px 0px 10px;">Hello <b><?php echo $result['FNAME'];?></b>,
		<br/>Welcome to <b>6.042 Rules!</b></h2>
		<hr/>
			<h2 style="font-size:25px;padding:0px 15px 0px 20px;"> Course Updates </h2>
			<?php  for($i=0;$i<count($res)-1;$i++){  ?>
        <div onclick='hide_show(this)' class='hide_show' style="padding:10px 10px 10px 10px;height:auto;border:1px solid silver;border-radius:5px;box-shadow:2px 2px 2px silver;padding:10px;">
        <h2 style="font-size:25px;"> Course Update  on <font style="font-size:15px"> <?php echo $res[$i]['_DATE_STRING']; ?> </font> </h2>
        <br/>
	<p style="text-align:right;font-family:Comfortaa,sans-serif;"><i>~Posted By - <?php echo $res[$i]['CREATOR'];?></i></p><br/>
        <div style='height:auto;width:100%'>
          <p style="font-family:'comfortaa',sans-serif;word-break:normal;word-space:normal;border:1px solid silver;background-color:#f2f2f2;border-radius:10px;sans-serif;font-size:18px;"> <?php echo $res[$i]['_UPDATE']; ?> </p></div>
        </div>
        <br/>
        <?php } if(strlen($res[count($res)-1]['_DATE_STRING'])!=0){ ?>
        <div style="border:1px solid silver;border-top:none;border-radius:20px;box-shadow:2px 2px 2px silver">
          <h2 style="font-size:25px;width:40%"> Course Update <font style="font-size:15px">on <?php echo $res[count($res)-1]['_DATE_STRING']; ?> </font> </h2>
          <br/>
          <p style="text-align:right;font-family:Comfortaa,sans-serif;"><i>~Posted By - <?php echo $res[count($res)-1]['CREATOR'];?>&nbsp;</i></p><br/>
          <div style='height:auto;width:100%'>
            <p style="font-family:'comfortaa',sans-serif;word-break:normal;word-space:normal;border:1px solid silver;background-color:#f2f2f2;border-radius:10px;sans-serif;font-size:18px"> <?php echo $res[count($res)-1]['_UPDATE']; ?> </p>
          </div>
        </div>
        <?php }else{echo 'Oops! No Course Updates Found!';} ?>
				</div></td>
					<td style="width:100%;height:100%;">
						<div style="width:250px;margin:0px 30px 0px 0px;border:1px solid silver;padding:15px 15px 15px 15px;border-radius:10px">
							<h3> Documents</h3>
								<ul>
									<li><a href="./Resources/Course_Syllabus.pdf">Syllabus</a></li>
									<li><a href="./Resources/MIT6_042JF10_notes.pdf">Textbook</a></li>
									<li><i>Notes attached chapter-wise in reading section</i></li>
								</ul><br/>
							<h3> Social Media</h3>
								<ul>
									<li><a href="https://www.facebook.com/groups/120060535242562/" target="_Blank">Official Facebook Group</a></li>
									<li><a href="https://www.facebook.com/6042-Rules-124218004803320/" target="_Blank">Facebook Page</a></li><br/>
								</ul>
						</div>
					</td>
			</table>
   
    
    <div class="container">
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-6">
          <button id="coursenav" onclick="window.location='/Course_v1_00/'" ><?php echo $v; ?></button>
        </div>
      </div>
      <br/>
        <br/>
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="./Images/course.png" title="Course Progress">
                    <div class="caption">
                        <h3>Course Progress</h3>
                        <p>Track the current status of your progress.</p>
                        <p><a href="./CourseProgress/" class="btn btn-primary" role="button">More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="./Images/calendar.jpg" style="height:230px;width:100%;" title="Course Calendar">
                    <div class="caption">
                        <h3>Course Calendar</h3>
                        <p>View lesson schedule and assignment due dates.</p>
                        <p><a href="/Calendar/" class="btn btn-primary " role="button ">More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
					<img src="./Images/notes.png" style="height:230px;width:60%;" title="Notes">
                    <div class="caption">
                        <h3>Notes and Flashcards</h3>
                        <p>Manage the notes you created.</p>
                        <p><a href="/Notes_and_FlashCards/" class="btn btn-primary " role="button ">More</a></p>
			        </div>
                </div>
            </div>
        </div>
        <br/><br/>
    </div>
    </body>

</html>
