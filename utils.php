<?php
require 'printconfig.php';
//创建通用请求参数
function createParams(){
    $nonce= getNonce();
    $timeStamp=getTimestamp();
    $signStr = signatureString(APPSECRET, $timeStamp, $nonce);
    return "?appid=".APPID."&nonce=".$nonce."&"."timestamp=".$timeStamp."&signature=".$signStr; 
}
//获取请求url
function getUrl($action){
    $params = createParams();
    return BASEURL.$action.$params;
}
//获取随机数
function getNonce(){
    return ''.rand(100000000,999999999);
}
//获取时间戳
function getTimestamp(){    
    return ''.intval(time());
}
//sha1 加密
function signatureString($appSecret,$timestamp,$nonce){    
    $arrTmp = array($appSecret,$timestamp,$nonce);
    asort($arrTmp,SORT_LOCALE_STRING);
    $strTmp = implode('', $arrTmp);
    return strtolower(sha1($strTmp));
}
// //字符串转base64
// function strToBase64($data){   
//     echo '$data='.$data;
//     return base64_encode($data);
// }
//发送post请求
/**
 * PHP发送Json对象数据
 *
 * @param $url 请求url
 * @param $jsonStr 发送的json字符串
 * @return string
 */
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($jsonStr)
    )
        );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return $response;
}
?>