
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Hahaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name= "description" content="">
    <meta name="author" content="leemataduo">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">

      body {
        opacity:0.8;
        padding-top: 0px;
        padding-bottom: 40px;
        background-image: url(back2.jpg);
        background-position:center;
        background-color:#f5f5f5;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
      }

      .btn-group{
        position:sticky;
        margin-left:950px;
        margin-top:0px;
      }

      .form-signin {

        max-width: 375px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        margin-top:100px;

        background-color: #fff;
        border: 1px solid #e5e5e5;


        -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
          -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
     .form-signin .form-signin-heading,
     .form-signin .checkbox {
       margin-bottom: 10px;
     }



    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <div class="btn-group">
      <form action="file.php" method="post">
        <input type="submit" name="submit" style="color:black;" value=<?php session_start();if($_SESSION['username']){echo $_SESSION['username'];} ?> >
        <!--<button type="button" class="btn btn-default" style="color:black;"></button>-->

          <form action="file.php" method="post">
          <!--<button type="button" class="btn btn-default" onclick="window.location='welcome.html';" style="color:black;">Sign Out</button>-->
          <button type="button" class="btn btn-default" onclick="window.location='upload.php';" style="color:black;">Upload</button>
            <input type="submit" name="submit" value="Sign Out" style="color:black;"/>
          </form>
      </form>
    </div>

      <form class="form-signin">
        <h2 class="form-signin-heading">Please Download File</h2>

          <form action="DownloadSupport.php" method="post">

            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][0]){$_SESSION['tmpfile']=$_SESSION["fn"][0]["filename"];echo $_SESSION['tmpfile'];}  ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][1]) {$_SESSION['tmpfile']=$_SESSION["fn"][1]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][2]){$_SESSION['tmpfile']=$_SESSION["fn"][2]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][3]){$_SESSION['tmpfile']=$_SESSION["fn"][3]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][4]){$_SESSION['tmpfile']=$_SESSION["fn"][4]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][5]){$_SESSION['tmpfile']=$_SESSION["fn"][5]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][6]){$_SESSION['tmpfile']=$_SESSION["fn"][6]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][7]){$_SESSION['tmpfile']=$_SESSION["fn"][7]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
            <a href="inputSharecode.php">
              <?php session_start(); if($_SESSION["fn"][8]){$_SESSION['tmpfile']=$_SESSION["fn"][8]["filename"];echo $_SESSION['tmpfile'];} ?>
            </a><br>
          </form>
      </form>

                        <!-- Le javascript
                        ================================================== -->
                        <!-- Placed at the end of the document so the pages load faster -->
                        <script src="../assets/js/jquery.js"></script>
                        <script src="../assets/js/bootstrap-transition.js"></script>
                        <script src="../assets/js/bootstrap-alert.js"></script>
                        <script src="../assets/js/bootstrap-modal.js"></script>
                        <script src="../assets/js/bootstrap-dropdown.js"></script>
                        <script src="../assets/js/bootstrap-scrollspy.js"></script>
                        <script src="../assets/js/bootstrap-tab.js"></script>
                        <script src="../assets/js/bootstrap-tooltip.js"></script>
                        <script src="../assets/js/bootstrap-popover.js"></script>
                        <script src="../assets/js/bootstrap-button.js"></script>
                        <script src="../assets/js/bootstrap-collapse.js"></script>
                        <script src="../assets/js/bootstrap-carousel.js"></script>
                        <script src="../assets/js/bootstrap-typeahead.js"></script>

     </body>
</html>
