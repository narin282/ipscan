<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>test</title>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  </head>
  <body>
    <button id='2' type="button" name="button">submit</button>
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
      $("button#2").click(function(){
        alert('click');
        $.post( "insert_client.php", {ipaddr_id: '5', ipaddr_client_name: 'นรินทร์'})
          .done(function(data){
            if(data.status === 'success'){
              alert(data.message);
            }else if (data.status === 'fail') {
              alert(data.message);
            }
        }).fail(function(){
          alert('Submit Failed');
        });

      });
    });


  </script>
</html>
