<?php

if(isset($_FILES['UP']) && $_FILES['UP']!=NULL)
{
$dir="/var/www/html/uploaded_files/";
$v=0;
foreach($_FILES['UP']['name'] as $key=>$val)
{
  $fn=$dir.basename($_FILES['UP']['name'][$key]);
  if(!copy($_FILES['UP']['tmp_name'][$key],$fn))
  echo $v+1;
  $v++;
  unlink($_FILES['UP']['tmp_name'][$key]);
}
if($v>0)
  echo 'True';
die();
}

?>
<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="XHR2FUP.js" type="text/javascript"></script>
<title>FUP 1.0</title>
<script>
function upload()
{
$("#prg").val(0);
$("#file_selector").upload("index.php",function(data)
{
if(data=="True")
{
window.alert("Success!");
}
else
{
window.alert("Error!");
}
},$("#prg"));
}
</script>
</head>
<body>
<form>
<input type="file" id="file_selector" name="UP[]" multiple></input>
</form>
<br/><br/>
<progress id="prg" max="100" min="0" value="0" style="width:100%"></progress>
<br/><br/>
<input type="button" style="cursor:pointer;border:none;border-radius:20px;height:60px;width:180px;font-size:20px;color:white;background-color:rgba(100,100,200,1);" onclick="upload()" value="Upload"></input>
</body>
</html>
