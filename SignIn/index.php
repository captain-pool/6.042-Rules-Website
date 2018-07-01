<?php 
session_start();
if(isset($_SESSION['six_oh_four_two_id'])&&($_SESSION['six_oh_four_two_id']!=NULL))
    {
      header("location:/dashboard/");
      die();
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign In | 6.042 Rules! </title>
<meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=1000, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet">
<meta property="og:title" content="6.042 Rules!| SignIn">
<meta property="og:url" content="https://www.6042rules.ml/SignIn">
<meta property="og:description" content="MOOC on Discrete Mathematics for Computer Science">
<meta property="og:image" content="/Resources/logo.png">
  <link rel="Shortcut Icon" href="/Resources/favicon.ico" type="image/x-icon" />
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" />
  <script src="./scripts/mainscript.js" type="text/javascript"></script>
  <script src="./scripts/md5.js" type="text/javascript"></script>
  <script src="scripts/particles.min.js" type="text/javascript"></script>
  <script src="./scripts/jquery-3.2.1.min.js" type="text/javascript"></script>

  <style>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100|Work+Sans:100');
    @import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
  </style>
</head>
<body style="margin:0;background-color:#052251" id="particles-js">
<div class="page-wrap">
      <div class="header">
        <table>
          <tr>
            <td>
              <a href="/" title="Free Online Course for Mathematics for Computer Science">
                <img src="/Resources/icon.png" height="100px" width="100px" />
              </a>
            </td>
            <td><h1>6.042 Rules!</h1></td>
          </tr>
          <tr style="width:100%">
            <table>
              <tr>
                <td>
                  <a class="head_anchors" href="/">Home</a>
                </td>
                <div width="10px"></div>
                <td>
                  <a class="head_anchors" href="/dashboard/"> Dashboard</a>
                </td>
                <div width="10px"></div>
                <td>
                  <a class="head_anchors" href="/AboutUs/">Who are We?</a>
                </td>
                <div width="10px"></div>
              </tr>
            </table>
          </tr>
        </table>
      </div><br/><font color="white">
<div id="container" style="position:absolute;margin-left:25%">
<div style="background-color:rgba(255,255,255,0);margin:0px 28%; height:530px; border:2px solid #9e9e9e; box-shadow:11px 10px 10px #9e9e9e;width:500px;position:inherit;">
        
          <div class="contents">
          <form id="signup-form" method="POST" action="signin.php">
            <p style="font-family:'Comfortaa',cursive; font-size:25px;color:#00c1ed;">Login to your 6.042 Account!</p><font style="color:#9ee5dc;"><b>After Typing the password click outside to get the <br> Sign In button <br> (This is done to prevent XSS attacks)</b></font><br><br>
            <input id="email" class="texts noerr imp" placeholder="What's Your Email?" onkeyup="key_up(this);" onblur="key_up(this);" style="border-bottom: 3px solid red;" type="email"><div id="notif" title="Email Cannot be Empty!"><img src="/SignIn/Resources/exc.png"></div>
            <br><br>
            <input id="pwd" autocomplete="off" name="pwd" class="err" placeholder="Password" onblur="check_validity()" type="password">
            <br><br><br>
            <input id="rem" type="checkbox">Remember Me, I Really don't wanna type my<br> Credentials in everytime.<br><br>
            <input name="pwd_hash" id="hsh" style="display:none;" type="text">
            <b>New Here?</b><a href="/SignUp" style="color:#9ee5dc"> Sign Up!</a>            
            <input value="Sign In!" onclick="post(this)" id="sub" type="button">
          </form>
          </div>
      </div>
</div></font>
</div>
<br/><br/><br/>
  <script>
particlesJS('particles-js',
  
  {
    "particles": {
      "number": {
        "value": 180,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#ffffff"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#000000"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "value": 5,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onclick": {
          "enable": true,
          "mode": "repulse"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 400,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 40,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true,
    "config_demo": {
      "hide_card": false,
      "background_color": "#b61924",
      "background_image": "",
      "background_position": "50% 50%",
      "background_repeat": "no-repeat",
      "background_size": "cover"
    }
  }

);
  </script>
</body>
</html>
