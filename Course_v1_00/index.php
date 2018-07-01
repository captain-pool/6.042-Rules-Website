<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['six_oh_four_two_id'])&&$_SESSION['six_oh_four_two_id']!=NULL)
{
  require_once 'connect.inc.php';
  $query1="SELECT COUNT(*) AS C FROM Progress WHERE ID=?";
  $stmt1=$conn->prepare($query1);
  $stmt1->bindValue(1,$_SESSION['six_oh_four_two_id']);
  try
  {
    $stmt1->execute();
  }
  catch(Exception $e)
  {
    header("location:javascript:window.alert('Oops! Some Error Occured! Please Contact Adrish!')");
    die();
  }
  $r1=$stmt1->fetch(PDO::FETCH_ASSOC);
  if($r1['C']==0)
  {
    $query2="INSERT INTO Progress (ID,CUR_UNIT_NUM,CUR_STAT,LAST_VIDEO_POS,SCORES_JSON,LAST_PSET_NO) VALUES(?,?,?,?,?,?)";
    $stmt2=$conn->prepare($query2);
    $stmt2->bindValue(1,$_SESSION['six_oh_four_two_id']);
    $stmt2->bindValue(2,1);
    $stmt2->bindValue(3,"Lecture");
    $stmt2->bindValue(4,0);
    $stmt2->bindValue(5,"");
    $stmt2->bindValue(6,0);
    try
    {
      $v=$stmt2->execute();
      if($v==false)
        die();
    }
    catch(Exeception $e)
    {
      die();
    }
  }
    $query3="SELECT AhEvuse2edy7urAtehutanu7YtysU3U7.FNAME AS FNAME ,AhEvuse2edy7urAtehutanu7YtysU3U7.LNAME AS LNAME,CUR_UNIT_NUM,CUR_STAT,LAST_VIDEO_POS,SCORES_JSON,LAST_PSET_NO FROM AhEvuse2edy7urAtehutanu7YtysU3U7,Progress WHERE AhEvuse2edy7urAtehutanu7YtysU3U7.ID=Progress.ID AND AhEvuse2edy7urAtehutanu7YtysU3U7.ID=?";
    $stmt3=$conn->prepare($query3);
    $stmt3->bindValue(1,$_SESSION['six_oh_four_two_id']);
    try
    {
      $stmt3->execute();
    }
    catch(Exception $e)
    {
      die();
    }
 $result1=$stmt3->fetch(PDO::FETCH_ASSOC);
 $query4="SELECT * FROM COURSE_METAS WHERE UNIT_NUM =?";
 $stmt4=$conn->prepare($query4);
 $stmt4->bindValue(1,$result1['CUR_UNIT_NUM']);
 
 try
 {
    $stmt4->execute();
 }
 catch(Exception $e)
 {
    die();
 }
 $result2=$stmt4->fetch(PDO::FETCH_ASSOC);
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
      }catch(Excpetion $e)
      {
        echo 'error';
        die();
      }
      $r_5=$stmt_5->fetch(PDO::FETCH_ASSOC);
?>

<html>
  <head>
    <title>Unit <?php echo $result1['CUR_UNIT_NUM'].' | '.$result2['COURSE_NAME'];?> | 6.042 Rules!</title>
    <meta name="viewport" content="width=1000, initial-scale=1.0">
<meta property="og:url" content="https://www.6042rules.ml/Course_v1_00">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
    <link rel="shortcut icon" href="/Resources/favicon.ico" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" />
    <link href="css/seekbar.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/spacelab/bootstrap.min.css" rel="stylesheet" integrity="sha384-PpvUDg6Tgcp6nh5chOo8teebMjoOXeU/PVfbPIRL4dymXdX1LuGS8ZpBUUqjDZ0d" crossorigin="anonymous" type="text/css"></link>
	<script src='https://www.youtube.com/iframe_api'></script><?php sleep(2); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="scripts/seekbar.js" text="text/javascript"></script>
        <script src="scripts/mainscript.js" type="text/javascript"></script>
        <script src="scripts/XHR2FUP.js"></script>
        <script type="text/javascript" src="scripts/MathJax.js?config=TeX-AMS_HTML-full"></script>
        <script type="text/x-mathjax-config">
          MathJax.Hub.Config({
          tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
          });
        </script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
      @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
    </style>
  </head><p style="display:none" id="curr-stat"><?php echo $result1['CUR_STAT']; ?></p>
  <body>
  <div class="page-wrap">
  <nav class="navbar navbar-wrapper">
        <div class="container">
                <div class="navbar-inner">
                    <a href="/"  style="margin:2% 0px" class="navbar-brand" title="Free Online Course for Mathematics for Computer Science"><img src="/Resources/icon.png"  width="100px"></a>
                    <h1 id="title"  style="margin:5% 0px" class="navbar-brand">6.042 Rules!</h1>
                </div>
                <br/>
                <ul class="nav navbar-nav navbar-right">
                    <li> 
                    <table>
                    <tr><td><a class="navbar-right nav navbar-nav"> <img src="Resources/sign_up.png" width="100px"> </a></td></tr>
                    <tr><td style="text-align:center;">Signed In As</td></tr>
                    <tr><td style="text-align:center;"><a href="/Profile/" id="prof" ><?php echo $result1['FNAME'].' '.$result1['LNAME'];?></a>
                    </td></tr>
                    <tr><td style="text-align:center;"><a href="/SignIn/logout.php" title="click here to logout">Logout</a></td></tr>
                    </table>
                    </li>
                </ul>
            </div>
    </nav>
    </div>
    <div class="bdy">
      <br/>
      <br/>
      <ol class="breadcrumb" style="margin:0px 40px;font-family:'comfortaa',sans-serif;font-size:20px;">
        <li class="breadcrumb-item"><a href="/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item active">Unit <?php echo $result1['CUR_UNIT_NUM'].' :'.$result2['COURSE_NAME'];?> </li>
      </ol>
      <br/>
      <br/>
    <h1 id='chap'>Unit <?php echo $result1['CUR_UNIT_NUM'].' :'.$result2['COURSE_NAME'];?></h1>
      <div style="border-top-left-radius:30px;border-top-right-radius:30px;border-bottom-left-radius:30px;border-bottom-right-radius:30px;height:70px;border:3px solid #a5c7ff; width:99%;background-color:White;padding:7px 25px;margin:0px 5px;">
        <ul class="list-inline navig" id="navigation-list" style="width:100%">
        <li class="items_a"><p style="display:none">navig$item</p><a href="javascript:navigate_prev(this)" class="prev" style="height:100%;width:100%"><div style="height:100%;width:100%">< Previous</div></a></li>
        <li><a style="border:2px solid black;height:60px"></a></li>
          &nbsp;<li class="item curr unit_nav" id="video"><p style="display:none">navig$item</p><a href='javascript:fetch_load_Lect()' title='Video Lecture and Finger Exercises' style='height:100%;width:100%'><div style='height:100%;width:100%'><img src='Resources/video_lectures.png' style='height:50px;width:60px;'></img></div></a></li>
          <li><a style='border:2px solid black;height:60px'></a></li>
          <li class='items unit_nav' id='readings'><p style="display:none">navig$item</p><a href='javascript:fetch_load_Readings()' style='height:100%;width:100%' title='Readings'><div style='height:100%;width:100%'><img src='Resources/reading.png' style='height:50px;width:60px;'></img></div></a></li>
          <li><a style='border:2px solid black;height:60px'></a></li><?php if($result2['AdditionalResources']!='False'){ ?>
           <li class='items unit_nav' id='Additional-Resources'><p style="display:none">navig$item</p><a href='javascript:fetch_load_AddEx()' title="Additional Resources" style='height:100%;width:100%'><div style='height:100%;width:100%'><img src='Resources/Resources.png' style='height:60px;width:60px;'></img></div></a></li>
<li><a style='border:2px solid black;height:60px'></a></li><?php } ?>
          <li class='items unit_nav' id='Psets'><p style="display:none">navig$item</p><a href='javascript:fetch_load_pset()' title='Exercises' style='height:100%;width:100%'><div style='height:100%;width:100%'><img src='Resources/exercises.png' style='height:50px;width:60px;'></img></div></a></li>
          <li><a style='border:2px solid black;height:60px'></a></li>
          <li class='items_a'><p style="display:none">navig$item</p><a href='javascript:navigate_next(this)' class='next' style='height:100%;width:100%'><div style='height:100%;width:100%'> Next ></div></a></li>
        </ul>
      </div>
      <div id="container1" style="height:auto;width:95%;">
      <div id="video-container" style="margin:30px;height:80vh;width:100%">
      <table style="height:100%;width:100%">
        <tr style="height:100%;width:100%"><td style="height:100%;width:100%"><div id="video-placeholder" style="width:100%;height:100%;background-color:Black;"></div></td></tr>
        <tr style="height:100%;width:100%"><td style="height:100%;width:100%"><div  id="control-box" style="text-align:center;width:100%;margin:-4px 0px;">
        <table height="50px" style="width:100%">
          <tr style="margin:0px 20px;">
            <td><button id="play_pause" style="height:50px;width:80px"><span class="glyphicon glyphicon-play"></span></button></td>
            <td> <p id="current-time" style="font-size:20px; color:black;">Start_Time</p></td>
            <td style="width:100%;"><div id="seek" style="width:auto;height:50px"></div></td>
            <td><p id="duration" style="font-size:20px; color:black;">End_Time</p></td>
            <td><button id="full_sc" style="height:50px;width:80px"><span class="glyphicon glyphicon-resize-full"></span></button></td>
          </tr>
        </table>
       </div></td></tr>
       </table>
       </div>
      <p id="txt"style="display:none"><?php echo $result2['LECTURE_LINK'];?></p><p style="display:none" id="unit_num"><?php echo $result1['CUR_UNIT_NUM'];?></p><p id="pdflink"></p><p id="max_unit_num" style="display:none;"><?php echo $r_5['M']; ?></p>
      <br/>
      <br/>
        <div id="finger-exercise-container">
          <h1 style="margin:20px;">Test Your Skills!</h1>
          <ul id="exercises" type="none">
          </ul>
        </div>
        <div style='margin-right:0px;width:300px;height:auto;bottom:0px;right:0px;position:fixed;'>
          <div class="notes" id="take-notes" title="Take Down Notes" onclick="show_hide_notes();">
          <img src='Resources/notes.png' style="width:30px;height:30px;margin:12% 23%"></img></div>
          <div id="notes-div" style="min-width:270px;width:90%;max-height:500px; margin:0px 0px -10px 0px; text-align:left;display:none;bottom:0px;color:white;border-color:Silver;background-color:rgba(0,0,0,.6);">
            <ul style='min-width:100%;' type='square'>
            </ul>
            <input type='text' id="notes" style="width:100%;height:50px;border:none;border-bottom:2px solid silver;background-color:transparent;color:white;font-family:'Gloria Hallelujah',cursive;font-size:20px;" placeholder="Enter Your Notes Here..."></input>
            <button id="submit-note" style="border-color:transparent;font-family:comfortaa;border-radius:20px;margin-bottom:10px;width:70px;height:30px;background-color:#42adf4;" onclick="addNote()">Submit</button>
          </div>
        </div>
        </div>
        <div id="container2" width="100%" height="auto">
      </div>
      <div id="container3" width="100%" height="auto">
      </div>
      <div id="container4" width="100%" height="auto">
     </div><br/><br/>
	<hr style="width:90%"/>
        <div style="width:100%;padding:0px 40%">
          <font face="Comfortaa" size="5px"> Unit Navigation</font><br/><br/>
          <ul class="list-inline" id="navigation" style="height:40px;font-size:20px;">
            <li class="i" style="border:1px solid silver;border-radius:10px;width:40%;height:50px;padding:10px 7%;"><a href="javascript:navigate_prev(this,true)" title="Previous Unit" class="prev" style="text-decoration:none;height:100%;width:100%;"><div style="height:100%;width:100%;">Previous</div></a></li>
            &nbsp;<li  class="i" style="border:1px solid silver;border-radius:10px;width:40%;height:50px;padding:10px 10%;"><a style="text-decoration:none;height:100%;width:100%;" class="next" href="javascript:navigate_next(this,true)" title="Next Unit"><div style="height:100%;width:100%;">Next</div></a></li>
          </ul>
        </div>
      
      <br/>
      <br/>
      <script>

var player;
var link=$("#txt").text();
$(document).ready(function(){
$("#container1").hide();
onYouTubeIframeAPIReady();
/*$(document).keydown(function(e){
var state=document.fullscreenElement||document.webkitFullscreenElement||document.mozFulScreenElement;
if(e.keyCode==27 && !state)
{
      $("#video-container").css("width","100vw");
    $("#video-container").css("height",'55vw');
    $("#full_sc>span").removeClass("glyphicon-resize-small").addClass("glyphicon-resize-full");

}
});*/
fetch_notes();
fetch_load($('#curr-stat').text(),'doc');
if(parseInt($("#unit_num").text())<=1)
{
  $(".prev").addClass('disableAnchor');
}
num_of_elems=$("#navigation-list>li>p:contains('navig$item')").length;
var val=(90-(num_of_elems-1)*0.433)/num_of_elems;
$("#navigation-list>li>p:contains('navig$item')").parent().css("width",val+"%");
});
function onYouTubeIframeAPIReady() {
    player = new YT.Player('video-placeholder', {
        videoId: link,
        height:640,
        width:1280,
        playerVars: {
            color: 'white',
            autoplay:0,
            rel:0,
            controls:0,
            showinfo:0,
            cc_load_policy:1,
            cc_lang_pref:'en',
        },
        events: {
            onReady: init,
        }
    });
    
}
var is_full=false;

$.fn.redraw = function() {
$(this).each(function() {
var redraw = this.offsetHeight;
});
return $(this);
};

$('#full_sc').on('click', function(){
  // if already full screen; exit
  // else go fullscreen
  if (
    document.fullscreenElement ||
    document.webkitFullscreenElement ||
    document.mozFullScreenElement ||
    document.msFullscreenElement
  ) {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
    $("#video-container").css("width",'100%');
    $("#video-container").css("height",'80vh');
  $("#full_sc>span").removeClass("glyphicon-resize-full").addClass("glyphicon-resize-small");

  } else {
    element = $('#video-container').get(0);
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
    $("#video-container").css("width","100vw");
    $("#video-container").css("height",'55vw');
    $("#full_sc>span").removeClass("glyphicon-resize-small").addClass("glyphicon-resize-full");

  }
});



function stateChanged(event)
{
  if(player.getPlayerState()==YT.PlayerState.PLAYING)
  {
    paused=false;
    $('#play_pause>span').removeClass('glyphicon-play').addClass('glyphicon-pause');
  }
  else if(player.getPlayerState()==YT.PlayerState.PAUSED)
  {
    paused=true;
    $('#play_pause>span').removeClass('glyphicon-pause').addClass('glyphicon-play');
  }
}



function init()
{
    updateTimerDisplay();
    updateProgressBar();
    
    time_update_interval = setInterval(function () {
        updateTimerDisplay();
        updateProgressBar();
        stateChanged();
    }, 500)
}
function updateProgressBar(){
    seek.setValue((player.getCurrentTime() / player.getDuration()) * 100);
}
var seek = new Seekbar.Seekbar({
        renderTo: "#seek",
        minValue: 0, maxValue: 100,
        valueListener: function (value) {
        var newTime = player.getDuration() * (value / 100);
        player.seekTo(newTime);
        },
        barSize:15,
        needleSize:0.3,
        thumbColor: 'rgba(58, 136, 232,0.6)',
        negativeColor: '#8ec1ff',
        positiveColor: '#CCC',
        value: 0
    });
function formatTime(time){
    time = Math.round(time);

    var minutes = Math.floor(time / 60),
    seconds = time - minutes * 60;

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return minutes + ":" + seconds;
}

function updateTimerDisplay()
{
  $('#current-time').text(formatTime( player.getCurrentTime() ));
  $('#duration').text(formatTime( player.getDuration() ));
}
var paused=true;
function updateProgressBar(){
    seek.setValue((player.getCurrentTime() / player.getDuration()) * 100);
}
$('#play_pause').on('click', function () {
    if(paused)
    {
    player.playVideo();
    paused=false;
    $('#play_pause>span').removeClass('glyphicon-play').addClass('glyphicon-pause');
    }
    else
    {
      paused=true;
      player.pauseVideo();
      $('#play_pause>span').removeClass('glyphicon-pause').addClass('glyphicon-play');
    }
});

</script>
</div>
</div>
  </body>  
</html>
<?php 
}
else
{
header("location:/SignIn");
}?>
