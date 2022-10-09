<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PakRe Insurance Company Ltd.</title>

    <!-- vendor css -->
    <link href="<?php echo $includes_dir;?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php echo $includes_dir;?>css/bracket.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center login_bg ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center"><img src="<?php echo $includes_dir;?>img/login-logo.png" alt="" class="img-fluid"></div>
        <h5 class="tx-center mg-b-60">Prudent</h5>

        <div class="form-group form-validate">
          <input type="text" class="form-control" placeholder="Enter your username">
        </div><!-- form-group form-validate -->
        <div class="form-group form-validate">
          <input type="password" class="form-control" placeholder="Enter your password">
          <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
        </div><!-- form-group form-validate -->
        <button onClick="window.location.href = 'index.html';" type="submit" class="btn btn-info btn-block">Sign In</button>
		

        <div class="mg-t-60 tx-center">Not yet a member? <a href="signup-simple.html" class="tx-info">Sign Up</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="<?php echo $includes_dir;?>lib/jquery/jquery.js"></script>
    <script src="<?php echo $includes_dir;?>lib/popper.js/popper.js"></script>
    <script src="<?php echo $includes_dir;?>lib/bootstrap/bootstrap.js"></script>

  </body>
</html>
