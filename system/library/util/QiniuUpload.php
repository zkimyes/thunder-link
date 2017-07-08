<?php
//require_once DIR_VENDOR . '/autoload.php';
// use Qiniu\Auth;
// use Qiniu\Storage\BucketManager;

// class QiniuUpload {
//     private $auth;
//     private $bucketMgr;
//     public function __construct(){
//         // 用于签名的公钥和私钥
//         $accessKey = 'kj2iTGT8HSg2RSLooRr-sXPBMx4gWkj6-iSLlq2V';
//         $secretKey = 'vA3J5YoTgnCej7vhQPdcZ2Y4CCoAn_XdxQNj_NH_';
//         // 初始化签权对象
//         $this->auth = new Auth($accessKey, $secretKey);
//         $this->bucketMgr = new BucketManager($this->auth);
//     }


//     public function getBucket(){

//     }
// }


require_once DIR_VENDOR . '/autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

$accessKey = 'kj2iTGT8HSg2RSLooRr-sXPBMx4gWkj6-iSLlq2V';
$secretKey = 'vA3J5YoTgnCej7vhQPdcZ2Y4CCoAn_XdxQNj_NH_';

//初始化Auth状态
$auth = new Auth($accessKey, $secretKey);

//初始化BucketManager
$bucketMgr = new BucketManager($auth);

//你要测试的空间， 并且这个key在你空间中存在
$bucket = 'blog';
$key = 'FoBTJ9ClGTsVXWu4PxJ4i4r7z7cV';

//获取文件的状态信息
list($ret, $err) = $bucketMgr->stat($bucket, $key);
echo "\n====> $key stat : \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}