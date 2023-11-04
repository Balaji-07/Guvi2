<?php
   include("server.php");
   if (isset($_SESSION['unameG2'])) {
    header("Location: home.php");
    exit();
  }
  $notify = $_GET['notify'] ?? '';
   
  if ($notify === 'inSuccess') {
      echo '
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
      <script src="js/regtoast.js"></script>
      ';
  }

  if ($notify === 'outSuccess') {
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="js/outtoast.js"></script>
    ';
}
?>



<html>
    <head>
        <title>Login/SignUp</title>
        <link rel="icon" type="image/x-icon" href="https://cdn1.iconfinder.com/data/icons/tiny-iconz-line-vol-09/20/fingerprint_biometric_login_scan-512.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="css/style.css?v=<?php echo time()?>">
    </head>
    <body>
        <div class="container">
        <div class="display">
            <img src="https://asset.brandfetch.io/id3BHBKuok/idIoOmPqzs.png" height=30px width=64px>
            <p class="">Screening Project 2</p>   
        </div>
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="errors">
                <?php include('errors.php'); ?>
            </div>
            <div class="form-inner">
                <div class="col">
                    <form action="#" class="login" id="login" method="post">
                        <div class="mb-3">
                                <input type="email" class="form-control" name="uname" id="uname" placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                        </div>
                        <div class="btn">
                                <button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form action="#" class="register" id="register" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="runame" name="uname" placeholder="Enter Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password_1" placeholder="Enter Your Password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password_2" placeholder="Confirm your Password">
                        </div>
                        <div class="btn">
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                          $('#register').submit(function(event) {
                            event.preventDefault();
                            var formData = {
                              uname: $('#uname').val(),
                              email: $('#email').val(),
                              password_1: $('#password_1').val(),
                              password_2: $('#password_2').val(),
                            };
                          if (formData.uname === '')
                          {
                            <?php array_push($errors, "Username is required"); ?>
                            return;
                          }
                          else if(!/^[A-Za-z][A-Za-z0-9_]*$/.test(formData.uname))
                          {
                            <?php array_push($errors, "Username must start with an alphabet"); ?>
                            return;
                          }
                          else if (formData.email === '') {
                            <?php array_push($errors, "Email is required"); ?>
                            return;
                          }
                          else if (formData.password_1 === '')
                          {
                            <?php array_push($errors, "Password is required"); ?>
                            return;
                          }
                          else if (formData.password_1 !== formData.password_2) {
                            <?php array_push($errors, "The two passwords don't match"); ?>
                            return;
                          }

    $.ajax({
      type: 'POST',
      url: 'server.php',
      data: formData,
      success: function(response) {
        alert('Registration successful');
      },
      error: function(xhr, status, error) {
        alert('Registration failed. Error: ' + error);
      },
    });
  });
});
                        </script>
                </div>
            </div>
        </div>
        
        <script src="js/formnav.js?v=<?php echo time()?>"></script>
    </body>
</html>