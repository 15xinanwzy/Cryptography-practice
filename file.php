<?php

session_cache_limiter('private');
session_start();

require_once(realpath(dirname(__FILE__) . '/../html/xcrypt.php'));

$allowedExts = array("gif", "jpeg", "jpg",
"png","doc","docx","xls","xlsx","ppt","pptx","txt","pdf");
$temp = explode(".", $_FILES["file"]["name"]);

$extension = end($temp);

    // 获取文件后缀名

    if(isset($_POST["submit"] )&& $_POST["submit"] == "UPLOAD"&&$_FILES["file"]["name"]=="")
    {
      echo"请选择上传的文件"."</br>";
    }


if(($_SESSION[username]==""||$_SESSION['logged in']!= true )&&isset($_POST["submit"] )&& $_POST["submit"] == "UPLOAD")
{
  echo"匿名用户禁止上传文件！"."</br>";
}
elseif(isset($_POST["submit"] )&& $_POST["submit"] == "Sign Out")
{

  echo "<script>alert('Sign Out');parent.location.href='login.php';</script>";
  $_SESSION[username]=="";
  $_SESSION['logged in']= false;
}
/*else{*/
elseif(isset($_POST["submit"] )&& $_POST["submit"] == "UPLOAD"&&$_FILES["file"]["name"])
{
if(!(($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "application/msword")//doc
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
|| ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")//ppt
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")//pptx
|| ($_FILES["file"]["type"] == "text/plain")//txt
|| ($_FILES["file"]["type"] == "application/pdf")//pdf
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")//xlsx
|| ($_FILES["file"]["type"] == "application/vnd.ms-excel")))//xls
{
  echo "非法的文件格式"."</br>";
}
if($_FILES["file"]["size"] >= 10485760){
  echo "限制文件大小：< 10MB "."</br>";
}
if( !in_array($extension, $allowedExts)){
  echo "非法的文件后缀名！"."</br>";
}
else
{

	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		echo "上传文件名: " . $_FILES["file"]["name"]."<br>";
		echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . "kB<br>";
		echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

		// 判断当期目录下的 upload 目录是否存在该文件
		if (file_exists(getcwd(). $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " 文件已经存在。 "."</br>";
		}
		else
		{
      $filename=$_FILES["file"]["name"];
      $tmp=file_get_contents($_FILES["file"]["tmp_name"]);

      //sign
      $privkey = openssl_pkey_get_private("file://server.key");

      openssl_sign($tmp, $signature, $privkey, OPENSSL_ALGO_SHA256);

      //存入签名
      $fname=explode(".", $filename)[0]."Sig.dat";
      //$cwd= "/var/www/";
      file_put_contents($fname, $signature);

      //encode file
      $key=generate_key();
      $cyberfile=encrypt($tmp,$key);


      if(file_put_contents($_FILES["file"]["tmp_name"],$cyberfile))
      {
        //ok
        if(move_uploaded_file($_FILES["file"]["tmp_name"], getcwd().$_FILES["file"]["name"]))
        {
            echo "文件存储在: " . "var/www/" . $_FILES["file"]["name"];

           //put key into database
            $sharecode=generate_key(4);
            $share4=str_repeat($sharecode, 4);
            $cyberkey=encrypt($key,$share4);

            if($cyberkey){

              $mysql_server_name="localhost";
              $mysql_username="root";
              $mysql_password="";
              $mysql_database="";

              $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);

              $res_insert = $pdo->query("INSERT INTO file(filename,filepswd,sharecode)VALUES('$filename','$cyberkey','$sharecode')");
              if($res_insert){

                echo "</br>Upload success! Your share code for this file is '".$sharecode."'.";
                $_SESSION[filename]=$filename;
              }
              else{
                echo "insert fail";
              }
       		}

        }

        else{
          echo "false";
        }
      }
	}
	}
}
}
?>
