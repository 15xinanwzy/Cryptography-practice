<?php
session_start();
require_once(realpath(dirname(__FILE__) . '/../html/passwordHash.php'));
    if(isset($_POST["submit"]) && $_POST["submit"] == "SIGN IN")
    {
        $user = $_POST["username"];
        $psw = $_POST["password"];

        if($user == "" || $psw == "")
        {
            echo "<script>alert('请输入用户名或密码！');history.go(-1);</script>";
        }
        else
        {
          $mysql_server_name="localhost";
          $mysql_username="root";
          $mysql_password="";
          $mysql_database="";

          $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);

          $crypsw=$pdo->prepare("SELECT password from user where username = '$_POST[username]'");

          $crypsw->execute();
          $crypsw=$crypsw->fetch(PDO::FETCH_ASSOC);


            if($crypsw)
          {

              if(validate_password($psw,(string)$crypsw['password'])){
                echo "<script>alert('登录成功！');parent.location.href='upload.php';</script>";
                $_SESSION['username'] = $_POST[username];
                $_SESSION['logged in']=true;
              }

              else{
                echo "<script>alert('密码错误！');history.go(-1);</script>";
              }

          }
            else
          {
                echo "<script>alert('用户名不存在！');history.go(-1);</script>";
          }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！');history.go(-1);</script>";
    }

?>
