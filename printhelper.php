<?php
require 'utils.php';

class PrintHelper{
    /*
     * 用户设备绑定
     * $uuid 设备编号
     * $userId 与对对机平台关联的用户唯一标示（你自己系统定义的）
     */
    function userBind($uuid,$userId){
        $url = getUrl("/home/userbind");
        $jsonStr = json_encode(array('Uuid' => $uuid, 'UserId' => $userId));
        return http_post_json($url, $jsonStr); 
    }
    /*
     * 获取设备状态
     * $uuid 设备编号
     */
    function getDeviceState($uuid){
        $url = getUrl("/home/getdevicestate");
        $jsonStr = json_encode(array('Uuid' => $uuid));
        return http_post_json($url, $jsonStr);
    }
    /*
     * 打印信息
     * $uuid 设备编号
     * $content 打印的内容
     * $OpenUserId 调用 userBind函数返回的openUserId
     */
    function printContent($uuid,$content,$openUserId){
        $url = getUrl("/home/printcontent2");
        $jsonStr = json_encode(array('Uuid' => $uuid,'PrintContent'=>' '.$content,'OpenUserId'=>$openUserId));
        return http_post_json($url, $jsonStr);
    }
    /*
     * 查询任务状态
     * $taskId 任务编号
     */
    function getPrintTaskState($taskId){
        $url = getUrl("/home/getprinttaskstate");
        $jsonStr = json_encode(array('TaskId' => $taskId));
        return http_post_json($url, $jsonStr);
    }
}
?>