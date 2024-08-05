<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Utils {

    public static function uploadPic($blogUrl, $name, $pic,$type,$suffix){
        $DIRECTORY_SEPARATOR = "/";
        $childDir = $DIRECTORY_SEPARATOR.'usr'.$DIRECTORY_SEPARATOR.'uploads' . $DIRECTORY_SEPARATOR .'time' .$DIRECTORY_SEPARATOR;
        $dir = __TYPECHO_ROOT_DIR__ . $childDir;
        if (!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
        $fileName = $name. $suffix;
        $file = $dir .$fileName;
        //TODO:支持图片压缩
        if ($type == "web"){
            //开始捕捉
            $img = self::getDataFromWebUrl($pic);
        }else{
            $img = $pic;//本地图片直接就是二进制数据
        }
        $fp2 = fopen($file , "a");
        fwrite($fp2, $img);
        fclose($fp2);

        //压缩图片
        (new Imgcompress($file,1))->compressImg($file);

        return $blogUrl.$childDir.$fileName;
    }

    public function returnBlogUrl(){

    }

    public static  function getDataFromWebUrl($url){
        $file_contents = "";
        if (function_exists('file_get_contents')) {
            $file_contents = @file_get_contents($url);
        }
        if ($file_contents == "") {
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }
}