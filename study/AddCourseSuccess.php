<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tạo khóa học thành công</title>
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
            <h4>Tạo khóa học thành công</h4>
            <p>Nhấn <a href="index.php">vào đây</a> để đến trang chủ, hoặc trang web sẽ tự động chuyển hướng sau <span class="text-danger" id="count">10</span> giây nữa.</p>
            <button class="btn btn-dark px-5" id="index">Trang chủ</button>
        </div>
      </div>
    </div>
    <script>
      const login = document.getElementById('index')
      let count = document.getElementById('count')

      let countdown = 10;
      setInterval(function() {
        count.innerHTML = "" + --countdown
        if (countdown === 0) {
          loadLogin();
        }
      }, 1000)
      
      function loadLogin() {
        window.location.assign("index.php")
      }

      login.addEventListener('click', () => {
        window.location.assign("index.php"  )
      })
      
    </script>
  </body>
</html>
