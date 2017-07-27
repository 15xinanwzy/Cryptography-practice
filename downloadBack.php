<?php
session_start();
require "DownloadAction.php";
require "DownloadSupport.php";
require "xcrypt.php";
require "passwordHash.php";
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$sharecode=$_POST["sharecode"];
$filename=$_SESSION['filename'];
//$sharecode="afe1";
//$filename="bootstrap.txt";
if(isset($_POST["submit"]) && $_POST["submit"] == "Sign Out"&&$_SESSION['username']&&  $_SESSION['logged in']==true)//已登录用户退出
{
  echo "<script>alert('Sign Out');parent.location.href='welcome.php';</script>";
  $_SESSION[username]="";
  $_SESSION['logged in']= false;
}
if(!$_SESSION['logged in']&&isset($_POST["submit"]) && $_POST["submit"] == "DOWNLOAD"){  //表示当前为匿名用户
  download($filename); //下载加密后的文件

  $Signame=explode(".", $filename)[0]."Sig.dat";
  download($Signame);//下载数字签名

}
else{   //表示当前为已登录用户，则直接下载解密后文件*/
  $mysql_server_name="localhost";
  $mysql_username="root";
  $mysql_password="";
  $mysql_database="";

  $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);

  $f=$pdo->prepare("SELECT sharecode,filepswd from file where filename = '$filename'");
  $f->execute();
  $f=$f->fetch(PDO::FETCH_ASSOC);

  if($f){
    if($sharecode==$f['sharecode']){
      $key=decrypt($f['filepswd'],str_repeat($sharecode, 8)); //将4字符的分享码扩充后，对加密后的对称密钥进行解密
      $tmmp=file_get_contents(SITE_ROOT.'/upload/'.$filename);
      file_put_contents(SITE_ROOT.'/upload/'."decoded".$filename,decrypt($tmmp,$key));

      download("decoded".$filename,0);
    }
    else{
      echo "分享码错误";
    }
  }
  else{
    echo "文件出错！";
  }
}

?>
