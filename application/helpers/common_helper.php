<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license    https://opensource.org/licenses/MIT    MIT License
 * @link    https://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */



/**
 * CodeIgniter Common  Helpers
 *
 * @package       CodeIgniter
 * @subpackage    Helpers
 * @category      Helpers
 * @author        Ding Jingfei
 * @link          https://codeigniter.com/user_guide/helpers/array_helper.html
 */
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * 数据签名认证
 * @param  array $data 被认证的数据
 * @return string       签名
 */
if (!function_exists('data_auth_sign')) {
    function data_auth_sign($data)
    {
        // 数据类型检测
        if (!is_array($data)) {
            $data = (array) $data;
        }
        ksort($data); // 排序
        $code = http_build_query($data); // url编码并生成query字符串
        $sign = sha1($code); // 生成签名
        return $sign;
    }
}

/**
 * upload_file_qiniuyun   上传文件到七牛云
 */
if (!function_exists('upload_file_qiniuyun')) {
    function upload_file_qiniuyun($filedata = '')
    {
        $domain    = 'https://bucketpublic.kevinfei.com/'; //空间绑定的域名
        $bucket    = 'bucket_public';
        $accessKey = 'PJtpD3cbFLl-R1RhHx4EeiVNJjfQ1AFXdH4zWAN1';
        $secretKey = '_WB-JzPvRO2ZpIK_ooVZxmvYrWHCdOUHoeyeoAn8';
        $key       = substr(md5($filedata['file_name']), 0, 5) . date('YmdHis') . rand(0, 9999) . $filedata['file_ext'];
        require_once APPPATH . '../system/libraries/Qiniuyun/autoload.php';
        require_once APPPATH . '../system/libraries/Qiniuyun/src/Qiniu/Auth.php';
        require_once APPPATH . '../system/libraries/Qiniuyun/src/Qiniu/Storage/UploadManager.php';
        $auth            = new Auth($accessKey, $secretKey);
        $token           = $auth->uploadToken($bucket);
        $uploadMgr       = new Qiniu\Storage\UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filedata['full_path']);
        return $ret['key'] ? $domain . $ret['key'] : '';
    }
}

/**
 * generate_qr_code      生成二维码
 */
if (!function_exists('generate_qr_code')) {
    function generate_qr_code($id = '', $url)
    {
        require_once APPPATH . 'libraries/phpqrcode.php';
        $errorCorrectionLevel = 'L'; //容错级别
        $matrixPointSize      = 8; //生成图片大小
        $outfile              = APPPATH . '../public/uploads/qrcode' . $id . '.png';
        QRcode::png($url, $outfile, $errorCorrectionLevel, $matrixPointSize, 2); ////生成二维码图片
    }
}

/**
 * generate_qr_code      生成随机数
 */
if (!function_exists('generate_rand_code')) {
    function generate_rand_code()
    {
        return date('Ymd') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}

/**
 * generate_qr_code      生成随机float数
 */
if (!function_exists('randomFloat')) {
    function randomFloat($min = '', $max = '')
    {
        $rand = $min + mt_rand() / mt_getrandmax() * ($max - $min);
        return floatval(number_format($rand, 2));
    }
}

if(!function_exists('getHeaders'))
{
    function getHeaders(){
        return array(
            "Access-Control-Allow-Origin: * ",
            "Access-Control-Allow-Credentials: true",
            "Cache-Control: no-cache, must-revalidate",
            "Content-Type: application/json; charset=utf-8",
            "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"
        );
    }
}

/**
 * 成功响应
 *
 * @param  array  $data
 * @param  string  $message
 * @param  int  $code
 * @param  array  $headers
 */
if (!function_exists('sendSuccess')) {
    function sendSuccess($message = 'success', $data = [], $count = 0, $code = 200)
    {
        get_instance()->output->set_header(getHeaders()); //允许跨域
        $responseData['code']    = $code;
        $responseData['count']   = $count;
        $responseData['message'] = (string) $message;
        if (!empty($data)) {
            $responseData['data'] = $data;
        }
        exit(json_encode($responseData));
    }
}

/**
 * 失败响应
 *
 * @param int    $error
 * @param string $message
 * @param int    $code
 * @param array  $data
 * @param array  $headers
 */
if (!function_exists('sendError')) {
    function sendError($message = '未知错误', $data = [], $count = 0, $code = 400) {
        get_instance()->output->set_header(getHeaders()); //允许跨域
        $responseData['code']    = $code;
        $responseData['count']   = $count;
        $responseData['message'] = (string)$message;
        $responseData['data']    = $data ?? [];
        exit(json_encode($responseData));
    }
}

/**
 * 获取用户的访问ip
 *
 * @param array $ip
 */
if (!function_exists('getClientIp')) {
    function getClientIp($message = '未知错误', $data = [], $count = 0, $code = 400) {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] as $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        return $ip;
    }
}

