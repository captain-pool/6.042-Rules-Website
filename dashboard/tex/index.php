<?php 
session_start();
if((!isset($_SESSION['six_oh_four_two_id']))||($_SESSION['six_oh_four_two_id']==NULL))
    {
      header("location:/SignIn/");
      die();
    }
require_once './connect.inc.php';
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
else
{
if(isset($_POST['temp_name'])&& $_POST['temp_name']!=NULL&&isset($_POST['text'])&&$_POST['text']!=NULL)
{
  $query="INSERT INTO LaTeXTemplates (Name,TeX) VALUES(?,?)";
  $stmt=$conn->prepare($query);
  $stmt->bindValue(1,$_POST['temp_name']);
  $stmt->bindValue(2,$_POST['text']);
  try{$errchk=$stmt->execute();if(!$errchk){echo 'P';die();}}catch(Exception $e){echo 'error';die();}
  echo 'True';die();
}
if(isset($_POST['fetchName'])&&$_POST['fetchName']!=NULL)
{
  $query11="SELECT TeX FROM LaTeXTemplates WHERE Name=?";
  $stmt11=$conn->prepare($query11);
  $stmt11->bindValue(1,$_POST['fetchName']);
  try{$errchk=$stmt11->execute();if(!$errchk)throw new Exception('Error Executing Query ~False!');}catch(Exception $e){echo 'error';die();}
  $res=$stmt11->fetch(PDO::FETCH_ASSOC);
  if(isset($res['TeX']) && $res['TeX']!=NULL)
    echo $res['TeX'];
  else
    echo 'ABS';
  die();
}
?>

<!doctype html>
<html>
  <head>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Comfortaa');
      html {
        font-family: Arial;
      }
      textarea {
        font-family: monospace;
        width: 100%;
      }
      .templates
      {
        text-decoration:none;
        font-size:20px;
        font-family:Comfortaa,sans-serif;
        border:none;
        background-color:transparent;
        color:#6d1cdd;
        cursor:pointer;
      }
    </style>
    <script>
    function save_template()
    {
      var temp_name=$("#template_name").val();
      if(temp_name.length!=0)
      {
        var text=$("#input").val();
        if(text.length<5)
        return;
        $.post("index.php",{"temp_name":temp_name,"text":text},function(data,status,jsXHR)
        {
          if(status=='success')
          {
            if(data.trim()=='True')
            {
              $("#templates").append("<li style='display:inline;float:left;background-color:rgba(210,210,210,1);'><input type='button' class='templates' onclick='load(this)' value='"+temp_name+"'></input></li>");
              window.alert('Saved Successfully!');
            }
            else if(data.trim()=='P')
            {
              window.alert('Oops! That template name is already in use! Use a different one.');
            }
            else
            {
              window.alert('Oops! Some Error Occurred!');
            }
          }
        });
      }else window.alert("Enter a Template Name!");
    }
    function load(obj)
    {
      $.post("index.php",{'fetchName':$(obj).val()},function(data,status,jsXHR)
      {
        if(status=='success')
        {
          if(data.trim()=='ABS')
          {
            window.alert('Oops! that template is unavailable');
          }
          else if(data.trim()=='error')
          {
            window.alert('Oops! Some Error Occurred!');
          }
          else
          {
            $("#input").val(data);
            window.alert('Loaded Template Successfully!');
          }
        }
      });
    }
    </script>
    <title> Compile LaTeX to PDF</title>
    <link rel="shortcut icon" href="/Resources/favicon.ico"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <script src="promisejs/promise.js"></script>
    <script src="pdftex.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div id="tabs">
    <div style="width:100%;overflow:auto;background-color:rgba(250,250,250,1);">
    <h2 style="font-family:comfortaa,sans-serif">Available templates</h2>
    <ul id="templates" style="overflow:auto;">
    <?php
    $query="SELECT * FROM LaTeXTemplates";
    $stmt=$conn->prepare($query);
    try{$errchk=$stmt->execute();if(!$errchk)throw new Exception("Error Occurred Executing Query ~ False!");}catch(Exception $e){echo 'error!';die();}
    $result=$stmt->fetchAll();
      foreach($result as $r)
      {
      echo "<li style='display:inline;float:left;background-color:rgba(210,210,210,1);'><input type='button' class='templates' onclick='load(this)' value='".$r['Name']."'></input></li>"; 
      }
    ?>
    </ul></div><br/>
      <div class="tab" id="tab_input">
        <button id="compile" autofocus>Compile this LaTeX code to a PDF</button>
        <button onclick="save_template()" autofocus>Save This as Template</button>
        <input type="text" placeholder="Template Name.." id="template_name" style="width:180px;"></input><br/><br/>
        <textarea rows="30" id="input">
        </textarea>
      </div>


      <div class="tab" id="tab_output">
        <h3>Console Output</h3>

        <pre id="output" style="overflow: scroll; max-height: 300px">
        Click "Compile this LaTeX code to PDF" at the top of this page and watch the console output here.
        </pre>

        <a name="running" id="running" style="display: none">
          Compiling…
          <img src="loading.gif" />
        </a>
      </div>

      <div class="tab" id="tab_open_pdf" style="display: none">
        <h3>View your PDF</h3>

        <button id="open_pdf_btn">Open your PDF</button>
        <textarea rows="30" id="CompiledCode" placeholder="Compiled LaTeX code..." style="width:80%"></textarea>
        <a name="open_pdf"></a>
      </div>

    </div>
    <script>
      var visibilityChanger = function(element_id) {
        return function(visible) {
          document.getElementById(element_id).style.display = visible ? 'block' : 'none';
        }
      }

      var showLoadingIndicator = visibilityChanger("running")
      var showOpenButton = visibilityChanger("tab_open_pdf")

      var appendOutput = function(msg) {
        var output = document.getElementById("output");

        var content = output.textContent;

        output.textContent = content + "\r\n" + msg;

        output.scrollTop = 999999;
        console.log(msg);
      }

      var pdf_dataurl = undefined;
      var compile = function(source_code) {
        document.getElementById("output").textContent = "";
        showLoadingIndicator(true);
        window.location.href = "#running";

        var pdftex = new PDFTeX();
        pdftex.set_TOTAL_MEMORY(80*1024*1024).then(function() {
          pdftex.on_stdout = appendOutput;
          pdftex.on_stderr = appendOutput;

          console.time("Execution time");

          pdftex.compile(source_code).then(function(pdf_dataurl) {
            console.timeEnd("Execution time");

            showLoadingIndicator(false);

            if (pdf_dataurl === false)
              return;

            showOpenButton(true);
            window.location.href = "#open_pdf";
            document.getElementById("open_pdf_btn").focus();
            document.getElementById("CompiledCode").value=pdf_dataurl;
          });
        });
      }

      document.getElementById("compile").addEventListener("click", function(e) {
        var source_code = document.getElementById("input").value;
        compile(source_code);
        
      });

      document.getElementById("open_pdf_btn").addEventListener("click", function(e) {
        window.open(pdf_dataurl);
        
        e.preventDefault();
      });

      var pdftex_preload = new PDFTeX("pdftex-worker.js");
      pdftex_preload = undefined;
    </script>
  </body>
</html>
<?php }?>
