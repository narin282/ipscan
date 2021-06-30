<?php
  include 'db/db-config.php';
 ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <?php include 'head.php'; ?>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php include 'header.php';?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include 'leftside.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        สแกนเครือข่าย
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">สแกนเครือข่าย</li>
      </ol>
    </section>

    <!-- Main content ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <section class="content">

      <div class="row justify-content-md-center">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="online"></h3>

              <p>Online</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-circled"></i>
            </div>
            <br><br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="offline"></h3>

              <p>Offline</p>
            </div>
            <div class="icon">
              <i class="ion ion-close-circled"></i>
            </div>
            <br><br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="timeout"></h3>

              <p>Time Out</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <br><br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3 id="scanning"></h3>

              <p>Scanning</p>
            </div>
            <div class="icon">
              <i class="ion ion-load-a"></i>
            </div>
            <br><br>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <?php
        $sql = "SELECT *
                FROM tb_ip_address
                ORDER BY ipaddr_id ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
       ?>

        <div class="box box-info" style="background-color: Gainsboro">
          <div class="box-header with-border">
            <h3 class="box-title">IP Address Usage</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead style="background-color: SandyBrown">
                <tr>
                  <th><center>IP Address</center></th>
                  <th><center>ชื่อผู้ใช้</center></th>
                  <th><center>ชื่ออุปกรณ์</center></th>
                  <th><center>สถานะ</center></th>
                  <th><center>อัพเดตล่าสุด</center></th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $num = 1;
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 ?>
                <tr id="result<?=$num?>">
                  <td align="center"><?=$row['ipaddr_ip']?></td>
                  <td id="user<?=$num?>">
                    <?php
                      if ($row['ipaddr_client_name'] == NULL) {
                        echo '-';
                      }else {
                        echo $row['ipaddr_client_name'];
                      }
                    ?>
                    <div id="<?=$num?>" class="pull-right">
                      <i id="<?=$num?>" class="fa fa-edit"></i>&nbsp;
                      <i id="<?=$num?>" class="fa fa-trash"></i>
                    </div>
                  </td>
                  <td id="hname<?=$num?>"></td>
                  <td align="center">
                    <span id="status<?=$num?>"></span>
                  </td>
                  <td id="lscan<?=$num?>" align="center"></td>
                </tr>
                <?php
                  $num +=1;
                  }
                 ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body
          <div class="box-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
          </div>
           /.box-footer -->
        </div>





    </section>
    <!-- /.content ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include 'footer.php';?>

</div>
  <?php include 'foot.php';?>
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
  var ipaddr = readTextFile('ipscan/ipconfig.txt');

  function pharsejson(i){
    $.getJSON("ipscan/"+ipaddr+i+".json")
    .done(function(data) {
        if (data.hostname=="null") {
          $('#hname'+i).text('-');
        }else {
          $('#hname'+i).text(data.hostname);
        }
        $('#lscan'+i).text(data.date+" | "+data.time);
        if(data.status==0){
          var resOffline = document.getElementById('offline').innerHTML;
          document.getElementById('offline').innerHTML = parseInt(resOffline)+1;
          document.getElementById("result"+i).setAttribute("bgcolor","#F08080");
          document.getElementById("status"+i).setAttribute("class","label label-danger");
          $('#status'+i).text("Offline");
        }else if (data.status==1) {
          var resOnline = document.getElementById('online').innerHTML;
          document.getElementById('online').innerHTML = parseInt(resOnline)+1;
          document.getElementById("result"+i).setAttribute("bgcolor","#ABFFB9");
          document.getElementById("status"+i).setAttribute("class","label label-success");
          $('#status'+i).text("Online");
        }else if (data.status==2) {
          var resTimeout = document.getElementById('timeout').innerHTML;
          document.getElementById('timeout').innerHTML = parseInt(resTimeout)+1;
          document.getElementById("result"+i).setAttribute("bgcolor","#F3F781");
          document.getElementById("status"+i).setAttribute("class","label label-warning");
          $('#status'+i).text("Time Out");
        }
    })
    .fail(function() {
      var resScanning = document.getElementById('scanning').innerHTML;
      document.getElementById('scanning').innerHTML = parseInt(resScanning)+1;
      document.getElementById("result"+i).setAttribute("bgcolor","#AFEEEE");
      document.getElementById("status"+i).setAttribute("class","label label-primary");

      $("i.fa-edit").css({"cursor":"pointer","color":"black"});
      $("i.fa-trash").css({"cursor":"pointer","color":"black"});
      $("i.fa-edit").hover(function() {
        $(this).css("color","blue")
      },function(){
        $(this).css("color","black")
      });
      $("i.fa-trash").hover(function() {
        $(this).css("color","blue")
      },function(){
        $(this).css("color","black")
      });

      $('#status'+i).text("Scanning");
      $('#lscan'+i).text('Scanning');
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

    $("i.fa-edit").css({"cursor":"pointer","color":"black"});
    $("i.fa-trash").css({"cursor":"pointer","color":"black"});
    $("i.fa-edit").hover(function() {
      $(this).css("color","blue")
    },function(){
      $(this).css("color","black")
    });
    $("i.fa-trash").hover(function() {
      $(this).css("color","blue")
    },function(){
      $(this).css("color","black")
    });
  });

  $(document).on("click", "i.fa-edit", function(){
      var ids = $(this).attr('id');
      $("div#"+ids).remove();
      var userText = $('#user'+ids).text();
      var userText = userText.trim();
      $('#user'+ids).html("");
      $('#user'+ids).append("<form class='pull-left'><input id='input"+ids+"' type='text' value='"+userText+"' size='35'></input></form>");
      $('#user'+ids).append("<div id='"+ids+"' class='pull-right'></div>");
      $('div#'+ids).append("<i id='"+ids+"' class='fa fa-check-circle fa-lg'></i>");
      $('#input'+ids).focus();
      $('i#'+ids+".fa-check-circle").css({"cursor":"pointer","color":"black"});
      $('i#'+ids+".fa-check-circle").hover(function() {
        $(this).css("color","blue")
      },function(){
        $(this).css("color","black")
      });

      $("i#"+ids+".fa-check-circle").click(function(){
        var inputValue = $('#input'+ids).val();
        $.post( "update_client.php", {ipaddr_id: ids, ipaddr_client_name: inputValue})
          .done(function(data){
            if(data.status === 'success'){
              $('#user'+ids).html("");
              if (data.value == '') {
                data.value = '-';
              }
              $('#user'+ids).text(data.value);
              $('#user'+ids).append("<div id='"+ids+"' class='pull-right'></div>");
              $('div#'+ids).append("<i id='"+ids+"' class='fa fa-edit'></i>&nbsp; ");
              $('div#'+ids).append("<i id='"+ids+"' class='fa fa-trash'></i>");
              $("i.fa-edit").css({"cursor":"pointer","color":"black"});
              $("i.fa-trash").css({"cursor":"pointer","color":"black"});
              $("i.fa-edit").hover(function() {
                $(this).css("color","blue")
              },function(){
                $(this).css("color","black")
              });
              $("i.fa-trash").hover(function() {
                $(this).css("color","blue")
              },function(){
                $(this).css("color","black")
              });
              alert(data.message);
            }else if (data.status === 'fail') {
              $('#user'+ids).html("");
              $('#user'+ids).text(userText);
              $('#user'+ids).append("<div id='"+ids+"' class='pull-right'></div>");
              $('div#'+ids).append("<i id='"+ids+"' class='fa fa-edit'></i>&nbsp; ");
              $('div#'+ids).append("<i id='"+ids+"' class='fa fa-trash'></i>");
              $("i.fa-edit").css({"cursor":"pointer","color":"black"});
              $("i.fa-trash").css({"cursor":"pointer","color":"black"});
              $("i.fa-edit").hover(function() {
                $(this).css("color","blue")
              },function(){
                $(this).css("color","black")
              });
              $("i.fa-trash").hover(function() {
                $(this).css("color","blue")
              },function(){
                $(this).css("color","black")
              });
              alert(data.message);
            }
        }).fail(function(){
          alert('Submit Failed');
        });
      });

  });

  $(document).on("click", "i.fa-trash", function(){
    var ids = $(this).attr('id');
    if (confirm("คุณต้องการลบชื่อผู้ใช้หมายเลข IP 10.20.132."+ids+" หรือไม่")) {
      $.post("del_client.php", {ipaddr_id: ids})
        .done(function(data){
          if (data.status == 'success') {
            $('#user'+ids).html("");
            $('#user'+ids).text(data.value);
            $('#user'+ids).append("<div id='"+ids+"' class='pull-right'></div>");
            $('div#'+ids).append("<i id='"+ids+"' class='fa fa-edit'></i>&nbsp; ");
            $('div#'+ids).append("<i id='"+ids+"' class='fa fa-trash'></i>");
            $("i.fa-edit").css({"cursor":"pointer","color":"black"});
            $("i.fa-trash").css({"cursor":"pointer","color":"black"});
            $("i.fa-edit").hover(function() {
              $(this).css("color","blue")
            },function(){
              $(this).css("color","black")
            });
            $("i.fa-trash").hover(function() {
              $(this).css("color","blue")
            },function(){
              $(this).css("color","black")
            });
            alert(data.message);
          }
        }).fail(function(){
          alert('Delete Failed');
        });
    }
  });
</script>
</html>
