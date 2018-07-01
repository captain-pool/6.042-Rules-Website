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
        echo "Error Occurred! Please Contact Adrish!";
        die();
      }
    }

if((isset($_SESSION['six_oh_four_two_id']) && ($_SESSION['six_oh_four_two_id']!=NULL))||(isset($_COOKIE['six_oh_four_two_id']) && ($_COOKIE['six_oh_four_two_id']!=NULL)))
{
  if(isset($_COOKIE['six_oh_four_two_id']) && ($_COOKIE['six_oh_four_two_id']!=NULL))
    $_SESSION['six_oh_four_two_id']=$_COOKIE['six_oh_four_two_id'];
}
?>
<!DOCTYPE html>
<html class="js-enabled" lang="en">

<head>
  <title>6.042 Rules! | Mathematics for Computer Science</title>
  <meta name="description" content="Tutoring support for 6.042 Discrete Mathematics for Computer Science">
  <meta name="keyword" content="Discrete,Mathematics,6.042J,MIT,Computer Science,6.042,By Tom Leighton,Free,Course">
  <meta name="author" content="Adrish Dey">
  <meta name="viewport" content="width=1000, initial-scale=1.0">
<meta property="og:title" content="6.042 Rules!| Mathematics for Computer Science">
<meta property="og:url" content="https://www.6042rules.ml">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
  <link rel="shortcut icon" href="Resources/favicon.ico">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
    @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
    @import url('https://fonts.googleapis.com/css?family=Comfortaa');
  </style>
  <link href="css/style.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-7811524122264122",
    enable_page_level_ads: true
  });
</script>
</head>

<body>
  <div class="page-wrap">
    <div class="header">
      <table>
        <tr>
          <td>
            <a href="/" title="Mathematics for Computer Science">
              <img src="/Resources/icon.png" height="100px" width="100px" />
            </a>
          </td>
          <td>
            <h1>6.042 Rules!</h1></td>
        </tr>
        <tr style="width:100%">
          <table>
            <tr>
              <td>
                <a class="head_anchors present" style="text-decoration:none;" href="javascript:void(0);">Home</a>
              </td>
              <div width="10px"></div>
              <td>
                <a class="head_anchors" style="text-decoration:none;" href="/dashboard/"> Dashboard</a>
              </td>
              <div width="10px"></div>
              <td>
                <a class="head_anchors" style="text-decoration:none" href="/AboutUs/">About Us</a>
              </td>
              <div width="10px"></div>
              <td>
                <div class="drop_menu" onclick="$(this).trigger('onmouseover')">
                  <div class="more" style="width:35px;">
                    <a href="javascript:void(0);"><i></i></a>
                    <div class="dropdown-content">
                    <?php if(!(isset($_SESSION['six_oh_four_two_id']) && ($_SESSION['six_oh_four_two_id']!=NULL)))
                            {
                    ?>
                      <a class="dropdown-link" href="/SignIn/">Sign In</a>
                      <a class="dropdown-link" href="/SignUp/">Sign Up</a>
                      <a class="dropdown-link" href="javascript:void(0)"></a>
                      <?php }
                      else
                      {
                      require_once 'connect.inc.php';
                     $query1="SELECT * FROM AhEvuse2edy7urAtehutanu7YtysU3U7 WHERE ID=?";
                    $stmt=$conn->prepare($query1);
                    $stmt->bindValue(1,$_SESSION['six_oh_four_two_id'],PDO::PARAM_INT);
                    try
                     {
                       $v=$stmt->execute();
                       if($v==false)
                        {
                           die();
                        }
                      }
                    catch(Exception $e)
                    {
                      die();
                    }
                    $result=$stmt->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <div>
                          <table>
                            <tr>
                              <td style="width:80px;height:">
                                <img src="/Resources/sign_up.png" width="80px" height="80px"/>
                              </td>
                              <td align="left" >
                                <a style="text-decortation:none;color:#4286f4;" href="/Profile/"><p id="user_name" style="font-family:'Caveat';font-size:40px"><?php echo $result['FNAME'].' '.$result['LNAME'];?></p></a>
                              </td>
                            </tr>
                            <tr><td colspan="2"><a class="dropdown-link" href="/dashboard/">Dashboard</a></td></tr>
                            <tr><td colspan="2"><a class="dropdown-link" href="/SignIn/logout.php">Log Out</a></td></tr>
                          </table>
                        </div>
                        <?php } ?>
                    </div>
                  </div>
                </div>
                </div>
              </td>
            </tr>
          </table>
        </tr>
      </table>
    </div>
    <div class="bdy">
      <table>
        <tr>
         <div class="container" style="width:100%;margin:140px 0;padding-left:0;padding-right:0px;left:0;right:0;">
        <div id="Carousel1" style="" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
<?php $a=0;
for($i=0;$i<=3;$i++){ 
	if($i==$a)
	{
		echo("<li data-target='#Carousel1' data-slide-to='".$i."' class='active'></li>");
	}
	else
	{
		echo("<li data-target='#Carousel1' data-slide-to='".$i."'></li>");
	}
	}?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            <div class="item active">
                <img src="/Resources/img.png" class="images" style="height:690px;width:100%;"/>
                <div class="slide_content">
                  <p>
                    This course introduces discrete mathematics and its powerful applications in computer science. 
                  </p>
                </div>
            </div>
            <div class="item">
                <img src="/Resources/img3.jpg" class="images" style="height:690px;width:100%;"/>
                <div class="slide_content">
                  <p>
                    We provide online tutoring support for discrete mathematics in a modular, sequential manner. 
                  </p>
                </div>
            </div>
            <div class="item">
                <img src="/Resources/img2.jpg" class="images" style="height:690px;width:100%;"/>
                  <div class="slide_content">
				  <p>
					By the end of the course, you might be able to save the world by creating stronger Encrption Scheme. Sounds Interesting?
				  </p>
				</div>
            </div>
            <div class="item">
                <img src="/Resources/img1.jpg" class="images" style="height:690px;width:100%;"/>
                <div class="slide_content">
				   <p>
					Looks complicated? Our Mobile Phone Runs because of this. Imagine How our life would have been without it.
				   </p>
                </div>
            </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#Carousel1" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#Carousel1" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
        </tr>
      </table>
      <br />
      <table>
        <tr>
          <td valign="top">
            <div id="signup" style="margin:40px;border:1.5px solid #8eb3ed;width:240px;height:300px;">
              <a href="/SignUp" id="sign_up" Title="Click here to sign up">
                <table>
                  <tr>
                    <td style="text-align:center;">
                      <img src="/Resources/sign_up.png" style="width:50px;height:50px;" />
                    </td>
                    <td>
                      <p style="font-family:'Caveat',cursive;font-size:30px;">Sign up for
					  <br/>6.042 Rules!</p>
                    </td>
                  </tr> 
                  <tr>
                    <td colspan="2">
                      <p style="font-family:'Josefin sans',sans-serif;font-size:16px;font-weight:bold;text-align:justify;position:relative;margin:10px;"> 
						Sign up today and join a growing online learning community on an interesting journey of discrete mathematics for computer science.
                        <br/><p style="color: #3783fc;font-size:16px;font-weight:bold;font-family:'Josefin sans',sans-serif;margin:10px;">Already have an account? 
						<br/>Sign in here.</p>
                      </p>
                    </td>
                  </tr>
                </table>
              </a>
            </div>
          </td>
		<div id="content"> 
          <td class="body_content">
			<br/>
            <br/> Hi everyone! Welcome to the homepage of <b>6.042 Rules!</b> Here you can access course materials from MIT OpenCourseWare <a href="http://ocw.mit.edu" target="_blank">(OCW)</a> and obtain personalized tutoring support from our tutor team. 
            <br/>
			<br/>
			<br/> <b>Why did we create this website?</b>
			<br/>
            <br/> We have been impressed and inspired by MIT OCW and edX's initiatives in open learning. Having been through MIT OCW learning on our own, we had no one to turn to when we were stuck in problem sets. Independent learning turned out to be ineffective. We believe students elsewhere might be facing similar difficulties too. That is why we created a website to support and assist students in optimizing their learning experience from MIT OCW. 
			<br/>
			<br/>
			<br/> <b>What is 6.042?</b> 
            <br/>
			<br/> For many interested in computer science, 6.042 is an essential introductory course to discrete mathematics, probabilities and algorithms. MIT OCW courses are identified by number codes. Courses from Electrical Engineering and Computer Science Department have course codes starting with digit '6'. Mathematics for Computer Science is offered on OCW as part of the Course 6 curriculum, so it is numbered '6.042'. 
			<br/>
			<br/> 		
			<br/> <b>How will students learn?</b>
			<br/>			
			<br/> In addition to regular OCW video lectures, readings and problem sets, students can upload their solutions to 6.042 Rules website and receive personalized feedback from our tutors. Students will have access to supplementary notes, practice exercises and additional learning materials prepared by the tutor team. Our tutors typeset practice exercises for each unit to complement OCW course materials. Our tutors will respond to any course-related queries via email. We aim to reply email inquiries within 24 hours. 
			<br/> 
			<br/>
			<br/> <b>A personal message from the website creator, Adrish:</b>
			<br/>
			<br/> First of all, thank you for visiting the 6.042 Rules website. I am extremely passionate about computers and programming. As I started my journey into the world of algorithms, I have faced difficulties mainly on randomized algorithms. I needed discrete mathematics knowledge to understand algorithms. So I searched a lot of websites in search of a massive open online course. And voila! I found an open learning portal by MIT OpenCourseWare. I grew fascinated with MIT <a href="http://www.eecs.mit.edu/" target="_blank">Computer Science</a> after I started taking OCW 6.042 co-taught by Prof. Tom Leighton and Dr. Marten van Dijk. There are plenty of world-class problem sets designed by MIT teaching faculty for undergraduate students, all made freely accessible through OCW.
			<br/>
			<br/> 
            <br/> DISCLAIMER: Video lectures, problem sets and course notes are provided by MIT OCW with permission through <a href="https://ocw.mit.edu/terms/index.htm#cc" target="_blank">Creative Commons licence</a>. Our tutors manually mark each student assignment and provide personalized feedback to every student. No certificate will be issued upon course completion since OCW is not a distance-learning or credit-bearing course <a href="https://ocw.mit.edu/help/faq-using-ocw-materials/" target="_blank">(see FAQ)</a>. 
			<br/>
			<br/> 
			<br/> Tom Leighton, and Marten Dijk, <i>6.042J	Mathematics for Computer Science, Fall 2010.</i> (Massachusetts Institute of Technology: MIT OpenCouseWare), http://ocw.mit.edu (Accessed October 30, 2017). License: Creative Commons BY-NC-SA
			<br/>
			<br/> 
			<br/>
			<br/> 
			<br/>
			<br/> 
          </td>
		 </div>
		</div>
          <td class="ads" style="width:100px;">
          </td>
        </tr>
      </table>
      </div>
      </div>
      <!--<div style="background-color:Gray;width:100%; height:auto;vertical-align:botom;display:block;order:3;">
        <p style="font-family:'josefin sans',sans-serif;font-size:30px;text-align:center;color:Silver;height:auto">
          <b><i>Please donate!</i> <br/><br/>Donation is voluntary and optional. Your participation and support will make this project a successsful one!</b>
        </p>
      </div>-->
</body>
</html>
