<?php
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
    {
        $user = $_POST["username"];
        $psw = $_POST["password"];
        $psw_confirm = $_POST["confirm"];
        if($user == "" || $psw == "" || $psw_confirm == "")
        {
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
        }
        elseif (!preg_match("/^[A-Za-z0-9_u4e00-u9fa5]+$/",$user)) {
            echo "<script>alert('用户名的合法字符集范围：中文、英文字母、数字！'); history.go(-1);</script>";
        }
        elseif (strlen($psw)>36) {
            echo "<script>alert('口令长度限制在36个字符之内 ！'); history.go(-1);</script>";
        }
        else
        {
           $mysql_server_name="localhost";
           $mysql_username="root";
           $mysql_password="110928";
           $mysql_database="filesys";

        if($psw == $psw_confirm)
            {
              $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);
              $statement=$pdo->query("SELECT username from filesys where username='$_POST[username]'");
              $row=$statement->fetch(PDO::FETCH_ASSOC);
                if($row)    //如果已经存在该用户
                {
                     echo "<script>alert('用户名已存在'); history.go(-1);</script>";
                }
                else    //不存在当前注册用户名称
                {

                    $res_insert = $pdo->query("INSERT INTO user (username,password)VALUES('$_POST[username]','$_POST[password]')");
                    //$num_insert = mysql_num_rows($res_insert);
                    if($res_insert)
                    {
                        echo "<script>alert('注册成功！'); history.go(-1);</script>";
                    }
                    else
                    {
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                    }
                }
            }
            else
            {
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
?>
