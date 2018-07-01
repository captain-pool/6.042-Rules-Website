function isset (strVariableName ) { 

    try { 
        eval( strVariableName );
    } catch( err ) { 
        if ( err instanceof ReferenceError ) 
           return false;
    }

    return true;

 }
function pset_arr_init(arr)
{
  for(var i=0;i<24;i++)
  {
    arr[i]=[('PSet '+(i+1)),0];
  }
}
function isArrayInArray(x,check) {
  var result = x.find(function(ele) {
    return (ele[0] === check[0]);
  }) 
  return result !=null;
}
var Solutions=0;
var ImpSheets=0;
$(document).ready(function(){
$.post("retrieveScores.php",{'Soln_Imp':1},function(data,status,jsXHR)
{
  if(data!=null && status.indexOf('success')!=-1)
  {
    var d=JSON.parse(data);
    if(d.SOLN!=null)
    {
      try{
      Solutions=JSON.parse(d.SOLN);
      }catch(e)
      {
        console.log('Error!');
      }
    }
    if(d.ImpSheet!=null)
    {
      try{
        ImpSheets=JSON.parse(d.ImpSheet);
      }catch(e)
      {
        console.log('Error!');
      }
    }
  }
});
});
function retrieve()
{
  $.post("retrieveScores.php",{'getScores':1},function(data,status,jsXHR)
  {
    if(status=='success')
    {
      if(data!=null)
      {var scoresArray=[];
      pset_arr_init(scoresArray);
        try
        {
          var jsondata=JSON.parse(data);
          $("#stat").html("Fetched Your Scores! Let's Calculate Your Graph!");
          var count=0;
          var fex_num=1;
          $.each(jsondata,function(idx,item)
          {
            if(item.Question[0]=='F')
            {
              var FingerNumber1=parseInt(item.Question.substring(1,item.Question.indexOf('_')));
              var arr=[('FEX '+fex_num),0];
              count=0;fex_num++;
              if(!isArrayInArray(scoresArray,arr))
              {
                $.each(jsondata,function(idx1,item1)
                {
                  if(item1.Question[0]=='F')
                  {
                    var FingerNumber2=parseInt(item1.Question.substring(1,item1.Question.indexOf('_')));
                    if(FingerNumber1==FingerNumber2)
                    {
                      count++;
                      if(item1.stat)
                      arr[1]+=1;
                    }
                  }
                });
                arr[1]=(arr[1]/count)*100;
                scoresArray.push(arr);}
          }
          else if(item.Question[0]=='P')
          {
            var PSETNum=parseInt(item.Question.substring(1,item.length));
            var PSETStr='PSet '+PSETNum;
            for(var i=0;i<scoresArray.length;i++)
            {
              if(scoresArray[i][0]==PSETStr)
              {
                scoresArray[i][1]=parseInt(item.stat);break;
              }
            }
          }
         });
          $("#stat").slideToggle('slow');
          drawGraph(scoresArray);
        }catch(e)
        {
          if(data=='error')
          {
            window.alert('Error Occurred fetching data!');
          }
          else if(data.includes('No'))
          {
            $("#graph").html("<p style='font-size:40px;font-family:comfortaa,sans-serif;margin:12% 15%'>Oops! No Scores to Graph!<br/>Go Ahead and get your hands dirty!</p>");
          }
          else
          {
            console.log(e.message+"\n"+data);
          }
          return;
        }
        retrieve_p2(scoresArray);
      }
    }
    else
    {
      window.alert("Oops! Error Occurred Fetching data!");
    }
  });
  
}
function retrieve_p2(scoresArray)
{
  
  $.post("retrieveScores.php",{getInfo:1},function(data,status,jsXHR)
  {
    if(status=='success')
    {
      if(data!=null)
      {
        try
        {
          var info=JSON.parse(data);
          createTable(scoresArray,info);
        }catch(e)
        {
          if(data=='error')
          {
            window.alert('Oops! Error Occurred While Fetching data!');
          }
          return;
        }
      }
    }
  });
}
function openLink(obj)
{
  var v=$(obj).find("p").text();
  window.open(v);
}
function createTable(scoresArray,info)
{
  try{
  $.each(scoresArray,function(idx,item)
  {
    if(item[0][0]=='P')
    {
      var psnum=item[0].substring(item[0].indexOf(' ')+1,item[0].length);
      $("#Pset"+psnum).html("<p style='font-size:30px;font-weight:bold'>&nbsp;&nbsp;"+item[1]+"/100</p>");
      if(Solutions[parseInt(psnum)]!==undefined)
        $("#PSSoln"+psnum).html("<div style='font-size:20px;font-weight:bold'><button class='sln' onclick='openLink(this)'>Solution<p style='display:none'>"+Solutions[parseInt(psnum)]+"</p></button></div>");
      if(ImpSheets[parseInt(psnum)]!==undefined)
        $("#PSImpS"+psnum).html("<div style='font-size:20px;font-weight:bold'><button class='im' onclick='openLink(this)'>Impression Sheet<p style='display:none'>"+ImpSheets[parseInt(psnum)]+"</p></button></div>");
    }
  });
  }catch(e){console.log('Error!');}
}
