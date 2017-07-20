<?php
    if(isset($_POST["submit"]) && $_POST["submit"] == "登录")
    {
        $user = $_POST["username"];
        $psw = $_POST["password"];
        if($user == "" || $psw == "")
        {
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
        }
        else
        {
          $mysql_server_name="localhost";
          $mysql_username="root";
          $mysql_password="110928";
          $mysql_database="filesys";

          $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);
          $statement =$pdo->query("SELECT (username,password) from user where username = '$_POST[username]' and password = '$_POST[password]'");
          $row=$statement->fetch(PDO::FETCH_ASSOC);


          $num = mysql_num_rows($statement);
            if($num)
            {
                $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中
                echo $row[0];
            }
            else
            {
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }

?>
