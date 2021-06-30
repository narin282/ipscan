<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>Local IP Scanning System v.0.5</title>
    <link rel="stylesheet" href="css/font-awesome.css">
    <script src="jquery-3.3.1.js"></script>
  </head>
  <body>
    <?php
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
    ?>
    <h1 align="center">Local IP Scanning System v.0.5</h1>
    <h3 align="center">Generate by Python, jQuery & PHP Language</h3>




    <table align="center">
      <tr>
        <td>&nbsp;<i class="fa fa-check-circle fa-lg" style="color:green;"></i> Online : </td>
        <td id="online" style="color:green;"></td>
        <td>&nbsp;<i class="fa fa-times-circle fa-lg" style="color:red;"></i> Offline : </td>
        <td id="offline" style="color:red;"></td>
        <td>&nbsp;<i class="fa fa-exclamation-triangle fa-lg" style="color:orange;"></i> Time out : </td>
        <td id="timeout"></td>
        <td>&nbsp;<i class="fa fa-spinner fa-spin fa-lg fa-fw"></i> Scanning : </td>
        <td id="scanning"></td>
      </tr>
    </table>

    <table border="1" id="table" style="border-collapse:collapse;" align="center">
      <tr>
        <th>IP Address</th>
        <th>Hostname</th>
        <th>Status</th>
        <th>Lastest Scan</th>
      </tr>
    <?php for ($i=1; $i < 255; $i++) { ?>
      <tr id='result<?=$i?>'>
        <td id="ip<?=$i?>" align="center"></td>
        <td id="hname<?=$i?>" align="center"></td>
        <td id="status<?=$i?>" align="center"></td>
        <td id="lscan<?=$i?>" align="center"></td>
      </tr>
    <?php } ?>
    </table>
  </body>
  <script type="text/javascript">

    function readTextFile(file)
    {
        var retval;
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function ()
        {
            if(rawFile.readyState === 4)
            {
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    var allText = rawFile.responseText;
                    retval = allText;
                }
            }
        }
        rawFile.send(null);
        return retval;
    }

    var ipaddr = readTextFile('ipconfig.txt');
    function pharsejson(i){
      $.getJSON(ipaddr+i+".json")
      .done(function(data) {
          $('#ip'+i).text(ipaddr+i);
          $('#hname'+i).text(data.hostname);
          $('#lscan'+i).text(data.date+" | "+data.time);
          if(data.status==0){
            var resOffline = document.getElementById('offline').innerHTML;
            document.getElementById('offline').innerHTML = parseInt(resOffline)+1;
            document.getElementById("result"+i).style.backgroundColor = "#ff8080";
            $('#status'+i).text("Offline");
          }else if (data.status==1) {
            var resOnline = document.getElementById('online').innerHTML;
            document.getElementById('online').innerHTML = parseInt(resOnline)+1;
            document.getElementById("result"+i).style.backgroundColor = "#80ff80";
            $('#status'+i).text("Online");
          }else if (data.status==2) {
            var resTimeout = document.getElementById('timeout').innerHTML;
            document.getElementById('timeout').innerHTML = parseInt(resTimeout)+1;
            document.getElementById("result"+i).style.backgroundColor = "#C0C0C0";
            $('#status'+i).text("Time Out");
          }
      })
      .fail(function() {
        var resScanning = document.getElementById('scanning').innerHTML;
        document.getElementById('scanning').innerHTML = parseInt(resScanning)+1;
        document.getElementById("result"+i).style.backgroundColor = "#ffff80";
        $('#status'+i).remove();
        $('#lscan'+i).remove();
        $('#ip'+i).text(ipaddr+i);
        $('#hname'+i).attr("colspan","3");
        $('#hname'+i).text('Scanning');
      });
    }

    $(document).ready(function(){
      document.getElementById('online').innerHTML = 0;
      document.getElementById('offline').innerHTML = 0;
      document.getElementById('timeout').innerHTML = 0;
      document.getElementById('scanning').innerHTML = 0;
      for (var i = 1; i < 255; i++) {
        pharsejson(i);
      }
    });

  </script>
</html>
