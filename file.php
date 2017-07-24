<?php
require_once(realpath(dirname(__FILE__) . '/../html/xcrypt.php'));
$allowedExts = array("gif", "jpeg", "jpg", "png","doc","docx","xls","xlsx","ppt","pptx","txt","pdf");
$temp = explode(".", $_FILES["file"]["name"]);

$extension = end($temp);     // 获取文件后缀名
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
  echo "非法的文件格式";
}
if($_FILES["file"]["size"] >= 10485760){
  echo "限制文件大小：< 10MB ";
}
if( !in_array($extension, $allowedExts)){
  echo "非法的文件后缀名！";
}
else
{

	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
		echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

		// 判断当期目录下的 upload 目录是否存在该文件
		// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
		if (file_exists(getcwd(). $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " 文件已经存在。 ";
		}
		else
		{
      $tmp=file_get_contents($_FILES["file"]["tmp_name"]);
      $key=generate_key();
      $cyberfile=encrypt($tmp,$key);
      $filename=$_FILES["file"]["name"];
      
      if(file_put_contents($_FILES["file"]["tmp_name"],$cyberfile))
      {

        if(move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . $_FILES["file"]["name"]))
        {
            echo "文件存储在: " . "var/www/" . $_FILES["file"]["name"];
           //key in database

             $sharecode=generate_key(4);
              $share4=str_repeat($sharecode, 4);
              $cyberkey=encrypt($key,$share4);

              if($cyberkey){
                $mysql_server_name="localhost";
                $mysql_username="root";
                $mysql_password="";
                $mysql_database="";

                $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);
                $res_insert = $pdo->query("INSERT INTO file (filename,filepswd)VALUES('$filename','$cyberkey')");
                if($res_insert){
                  echo "Upload success! Your share code for this file is ".$sharecode;
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
?>
