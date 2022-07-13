<?php
define("IV", randomByte(16));
define("MT", time());
// 메인 함수
function hanbitEncrypt(String $fileName, Array $hosts, String $date, String $licenseServer=''){
    $miiKey = substr(md5(time().'k3j24lk3j4elkasdjklwqj4klkqeklkqwejlwakd'),5,16);
    $key = randomByte(16);
    $encKey = base64_encode($key);
    $source = file_get_contents($fileName);
    $source = str_replace(["\r", "\t"], " ", $source);
    $source = str_replace(["  ", "    ", "     "], " ", str_replace(["  ", "    ", "     "], " ", str_replace(["  ", "    ", "     "], " ", $source)));
    $source = str_replace(" <", "<", $source);
    $source = str_replace("\n\n", "\n", $source);

    $encryptString = base64_encode(openssl_encrypt($source, "AES-256-CBC", $key, true, IV));
    $splitString = str_split($encryptString, 60);
    $metadata = base64_encode(llillill(json_encode([
        'date'=>strtotime($date),
        'hosts'=>$hosts,
        'licenseServer'=>$licenseServer,
        'licenseFile'=>'.hanbitLicense.bin'
    ]),"illiilliillliilil"));
    $txt = base64_encode(gzdeflate('$metadata=<<<DATA
'.$metadata.'
DATA;
if(!isset($__FILE__))exit;function llillill($llllil,$lilli){global $__FILE__; $lilli=@call_user_func("filemtime",$__FILE__).$lilli;for($ll=0;$ll<@strlen($llllil);$ll++)$llllil[$ll]=($llllil[$ll]^$lilli[$ll%@strlen($lilli)]);return($llllil);}$illili=@fopen("{$__FILE__}","r");
$ilillli=@call_user_func("fread",$illili,@call_user_func("f"."iles"."ize","{$__FILE__}"));@fclose($illili);$ilIlliIlI=llillill(@base64_decode(@trim(@explode("# REF : ", $ilillli)[1])),"lilliliiliIlliIlliIllI");
echo(@eval(@openssl_decrypt(@base64_decode("'.implode(PHP_EOL, $splitString).'"), "AES-256-CBC", @call_user_func("base64_decode","'.$encKey.'"), true, "{$ilIlliIlI}")));

', 9));
    $fp = fopen('save.php', "w");
    $txt = implode("\n", str_split($txt, 80));
    fwrite($fp, "<"."?php\r\n/**\r\n * HanbitGaram Encrypt\r\n * 이 파일을 수정하지 마세요\r\n * 이 파일을 수정하면 파일은 동작하지 않습니다.\r\n */\r\n\$__FILE__=__FILE__; \$_MII_KEY=\"{$miiKey}\";\r\necho eval(base64_decode(<<<HANBITGARAMGUARD\r\n".
        implode(
            "\r\n",
            str_split(
                base64_encode(
                    "try{echo(@eval(@gzinflate(@base64_decode(<<<HANBITGARAMLAYER\r\n".$txt."\r\nHANBITGARAMLAYER\r\n))));}catch(Exception \$_e){exit(\"Error!\r\nFilename : {\$__FILE__}\"); unset(\$_e);}"
                ), 80
            )
        )."\r\nHANBITGARAMGUARD\r\n)); \r\nunset(\$__FILE__, \$_MII_KEY);\r\n# REF : ".base64_encode(llillill(IV, 'lilliliiliIlliIlliIllI')));
    fclose($fp);
    touch('save.php', MT);
}

/**
 * 랜덤 바이트(암호키) 생성기
 * @param Int $length   키 길이
 * @return string       바이너리 키 데이터
 */
function randomByte(Int $length=0){
    $dic = str_split('abcdef0123456789');
    $rtn = '';
    for($i=0; $i<$length; $i++){
        shuffle($dic);
        $rtn .= hex2bin($dic[0].$dic[1]);
    }
    return $rtn;
}

function llillill($llllil,$lilli){$lilli=MT.$lilli;for($ll=0;$ll<strlen($llllil);$ll++)$llllil[$ll]=($llllil[$ll]^$lilli[$ll%strlen($lilli)]);return($llllil);}

echo hanbitEncrypt('./testcode.php',['naver.com', 'daum.net'],'');
