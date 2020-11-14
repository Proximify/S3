<?php
require_once(__DIR__ . '../../../../vendor/autoload.php');

use Proximify\S3;

$testBucket = 'uniqueBucketName'; 
$credentials = [
    'key' => 'AWS_KEY',
    'secret' => 'AWS_SECRET'
];
$path = 'PATH_TO_DOWNLOAD';

S3::init($credentials);
$res = S3::downloadBucket($testBucket, 'YOUR_LOCAL_DIR', $path);