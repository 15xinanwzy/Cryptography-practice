<?php
function encrypt($str,$key){
  $method = "aes-256-cbc"; // print_r(openssl_get_cipher_methods());
  //$enc_key = bin2hex(openssl_random_pseudo_bytes(32)); // 对称加密秘钥，应妥善保存
  $enc_options = 0;
  $iv_length = openssl_cipher_iv_length($method);
  $iv = openssl_random_pseudo_bytes($iv_length);
  $ciphertext = openssl_encrypt($str, $method, $key, $enc_options, $iv);
  // 定义我们“私有”的密文结构
  $saved_ciphertext = sprintf('%s$%d$%s$%s', $method, $enc_options, bin2hex($iv), $ciphertext);

  return $saved_ciphertext;
}

function decrypt($str,$key){
  if(preg_match('/.*$.*$.*$.*/', $str) !== 1) {
    fprintf(STDERR, "无法解密的密文格式\n");
    exit(1);
  }
  $enc_options = 0;
  // 解析密文结构，提取解密所需各个字段
  list($extracted_method, $extracted_enc_options, $extracted_iv, $extracted_ciphertext) = explode('$', $str);
  $decryptedtext = openssl_decrypt($extracted_ciphertext, $extracted_method, $key, $enc_options, hex2bin($extracted_iv));

  return $decryptedtext;
}
?>
