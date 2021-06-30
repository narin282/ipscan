<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IP Scanner v.1.0 | ลงทะเบียนขอใช้งาน</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>ลงทะเบียน</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">ลงทะเบียนเพื่อขอใช้งานระบบ IP Scanner</p>


      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="ชื่อ-นามสกุล">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="หมายเลขประจำตัว">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="อีเมล">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="กรอกรหัสผ่านซ้ำ">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"><br>
          <a href="login.php" class="text-center">กลับไปที่หน้าล็อกอิน</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">ลงทะเบียน</button>
        </div>
        <!-- /.col -->
      </div>



  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $(document).ready(function(){
    $("input[placeholder='ชื่อ-นามสกุล']").focus();
  });

  $(document).on("click","button:submit",function(){
    var name = $("input[placeholder='ชื่อ-นามสกุล']").val();
    var emp_id = $("input[placeholder='หมายเลขประจำตัว']").val();
    var email = $("input[placeholder='อีเมล']").val();
    var pass1 = $("input[placeholder='รหัสผ่าน']").val();
    var pass2 = $("input[placeholder='กรอกรหัสผ่านซ้ำ']").val();

    alert(emp_id);
    $.post("check_empid.php", {user_emp_id: emp_id})
      .done(function(data){
        if (data.status === 'fail') {
          alert(data.message);
          $("input[placeholder='หมายเลขประจำตัว']").focus();
        }else if (data.status === 'success') {
          alert(data.message);
        }
      }).fail(function(){
        alert('post failed');
      });
  });
</script>
</body>
</html>
