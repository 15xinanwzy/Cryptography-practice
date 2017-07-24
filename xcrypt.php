<?php


function generate_key( $length = 16 ) {
 // 密码字符集，可任意添加你需要的字符
     $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
     $key = "";
     for ( $i = 0; $i < $length; $i++ )
     {
 // 这里提供两种字符获取方式
 // 第一种是使用 substr 截取$chars中的任意一位字符；
 // 第二种是取字符数组 $chars 的任意元素
     $key .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
     }
     return $key;
}

 # --- 加密 ---

function encrypt($str,$key){
     # 显示 AES-128, 192, 256 对应的密钥长度：
     #16，24，32 字节。
     $key_size =  strlen($key);

     # 为 CBC 模式创建随机的初始向量
     $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
     $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);


     # 创建和 AES 兼容的密文（Rijndael 分组大小 = 128）
     # 仅适用于编码后的输入不是以 00h 结尾的
     # （因为默认是使用 0 来补齐数据）
     $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                  $str, MCRYPT_MODE_CBC, $iv);

     # 将初始向量附加在密文之后，以供解密时使用
     $ciphertext = $iv . $ciphertext;

     # 对密文进行 base64 编码
     $ciphertext_base64 = base64_encode($ciphertext);

     return $ciphertext_base64;
}
     # === 警告 ===

     # 密文并未进行完整性和可信度保护，
     # 所以可能遭受 Padding Oracle 攻击。

function decrypt($str){
     # --- 解密 ---

     $ciphertext_dec = base64_decode($str);

     # 初始向量大小，可以通过 mcrypt_get_iv_size() 来获得
     $iv_dec = substr($ciphertext_dec, 0, 16);

     # 获取除初始向量外的密文
     $ciphertext_dec = substr($ciphertext_dec, $iv_size);

     # 可能需要从明文末尾移除 0
     $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                     $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

     return $plaintext_dec;
}
?>
