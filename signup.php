<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- Custom fonts for this template-->
    <link href="x/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <!-- <link href="x/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="x/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/test.css" type="text/css" media="all">
  </head>
  <body style="background-image: url(images/bglog.jpg);">
    <div id="snackbar"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-7 d-md-block d-none ">
          <img src="images/signup.png" width="100%">
        </div>
        <div class="col-md-5 ">
          <div class="d-md-flex justify-content-center align-items-center h-100">
            <div class="card shadow p-3 mt-5" style="border-radius: 20px; border:none;">
              <div class="card-body">
                <p class="display-4">Sign Up Here</p>
                <form>
                  <div class="form-group">
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your name">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" id="email1"  aria-describedby="emailHelp" placeholder="Your email">
                  </div>
                  <div class="form-group">
                    <input type="tel" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Your phone">
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="ref" aria-describedby="emailHelp" placeholder="Referrer ID(optional)">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="pass1" placeholder="password">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="pass2" placeholder="re-password">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" onclick="sign();return false;">Submit</button>
                    <a href="login.php" class="nav-link">Already Got an account? Login here</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="x/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/dili.js"></script>
  </body>
</html>