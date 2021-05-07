
<?php
  session_start();
  unset($_SESSION["name"]);
  unset($_SESSION["email"]);
  unset($_SESSION["password"]);
  unset($_SESSION["position"]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Đăng xuất</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
            <h3>Đăng xuất thành công</h3>
            <span class="text-danger" id="count">
            
        </div>
      </div>
    </div>
    <script>
      const index = document.getElementById('index')
      let count = document.getElementById('count')

      let countdown = 2;
      setInterval(function() {
        // count.innerHTML = "" + 
        --countdown
        if (countdown === 0) {
          loadIndex();
        }
      }, 1000)
      
      function loadIndex() {
        window.location.assign("index.php")
      }
      
    </script>
  </body>
</html>
