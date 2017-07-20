<html>
<head>
    <meta charset="UTF-8">
    <style type="text/css">
 #passStrength{height:12px;width:150px;border:1px solid #ccc;padding:2px;}
 .strengthLv1{background:red;height:12px;width:50px;}
 .strengthLv2{background:orange;height:12px;width:100px;}
 .strengthLv3{background:green;height:12px;width:150px;}
 </style>
</head>
<body style="width:1000px;margin:0 auto;padding-top:50px ;font-family:Arial,STKaiti,KaiTi,sans-serif;">
    <div style="width:100%;height:510px;">
        <img src="http://resource.haorenao.cn/back.jpg">
        <div style="font-size:30px;position:absolute;top:250px;width:1000px;color:white;">
            <form action="regcheck.php" method="post">
                <div style="position:absolute;left:360px;">
                用户名：
                <input type="text" name="username" />
                </div>
                <br/>
                <div style="position:absolute;left:410px;">
                密码:
                <input type="password" name="password" id="pass" maxlength="36"/>
              </div>
              <br/>
              <div style="position:absolute;left:340px;top:70px">
              口令強度:
              <div style="position:absolute;left:180px;top:-15px"><p id="passStrength"></p></div>
              </div>
                <br/>
                <div style="position:absolute;left:340px;top:160px">
                确认密码：<input type="password" name="confirm"/>
                <br/>
                </div>
                <div style="font-size:20px;position:absolute;top:200px;left:560px;ext-align:center;width:1000px;color:white;">
                    <input type="Submit" name="Submit" value="注册" id="rg"/>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
<script type="text/javascript" src="passwordStrength.js"></script>
<script type="text/javascript">
new PasswordStrength('pass','passStrength');
</script>
