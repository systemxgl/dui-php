<?php
require 'printhelper.php';
//设备编号
$uuid="您的设备编号";

//实例化
$helper = new PrintHelper();

/*
 * 用户设备绑定
 * 返回数据格式：{"OpenUserId":1251,"Code":200,"Message":"成功"}
 */
echo $helper->userBind($uuid, '100');//100 您系统的用户编号（自己定义）最好是数字

/*
 * 获取设备状态
 * 返回数据格式："}{"State":0,"Code":200,"Message":"成功"}
 */
echo $helper->getDeviceState($uuid);

//要打印的内容
$content="测试打印\n测试换行";
//如果系统不是gbk编码，那么此处需要进行一次转换，下面的代码取消注释即可。
//$content=iconv("UTF-8", "GBK//IGNORE", $content);
$base64Str= base64_encode($content);
//格式详见 http://www.mstching.com/home/openapi
$jsonContent="[{\"Alignment\":0,\"BaseText\":\"".$base64Str."\",\"Bold\":0,\"FontSize\":0,\"PrintType\":0}]";
/*
 * 打印信息
 * 返回数据格式：{"TaskId":1,"Code":200,"Message":"成功"}
 */
echo $helper->printContent($uuid, $jsonContent, "0");//0改成用户设备绑定返回的OpenUserId
/*
 * 打印网页信息
 * 返回数据格式：{"TaskId":1,"Code":200,"Message":"成功"}
 */
$printUrl="您要打印的网页地址"; //例：http://www.open.mstching.com/print-demo.html
echo $helper->printHtmlContent($uuid, $printUrl, "0");//0改成用户设备绑定返回的OpenUserId
/*
 * 查询任务状态
 * 返回数据格式 {"State":1,"Code":200,"Message":"成功"}
 */
echo $helper->getPrintTaskState("0");//0改成任务编号
?>
