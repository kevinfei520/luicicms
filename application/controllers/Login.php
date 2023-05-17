<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Login  登陆管理
 *
 * @property  Admin              $admin
 * @property  AdminLog           $adminLog
 * @property  CI_Input           $input
 * @property  Ci_Session         $session
 * @property  CI_Form_validation $form_validation
 */
class Login extends CI_Controller {

    /**
     * 定义
     *
     * @var array
     */
    private $captcha_config = array(
        'seKey'    => 'LuiciCMS', // 验证码加密密钥
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', // 验证码字符集合
        'expire'   => 1800, // 验证码过期时间（s）
        'useZh'    => false, // 使用中文验证码
        'useImgBg' => false, // 使用背景图片
        'fontSize' => 16, // 验证码字体大小(px)
        'useCurve' => false, // 是否画混淆曲线
        'useNoise' => true, // 是否添加杂点
        'imageW'   => 0, // 验证码图片宽度
        'imageH'   => 40, // 验证码图片高度
        'length'   => 4, // 验证码位数
        'fontttf'  => '', // 验证码字体，不设置随机获取
        'bg'       => array(243, 251, 254), // 背景颜色
        'reset'    => true, // 验证成功后是否重置
    );

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("form", "url", "common"));
        $this->load->library(array("session", "captcha", "form_validation"));
        $this->load->model(array("admin", "adminLog"), "", true);
    }

    /**
     * 登陆首页
     */
    public function index() {
        // 检查用户是否已经登录
        $userdata        = $this->session->get_userdata();
        $currentUserAuth = $userdata['admin_auth'] ?? "";
        if (!$currentUserAuth) {
            $this->load->view('/login/login');
        }

        if ($this->admin->get_where_admin_info(['id' => $currentUserAuth])) {
            $this->load->view('/welcome/index');
        }
    }

    /**
     * 获取验证码
     *
     */
    public function generate_captcha() {
        $captcha = new Captcha($this->captcha_config);
        $captcha->generate();
        $this->adminLog->auto_admin_log("获取验证码");
    }

    /**
     * 检查用户信息是否存在
     *
     * @param string $username
     * @return bool
     */
    public function checkUserNameIsset($username = '') {
        $where['username'] = $username;
        $usr_result        = $this->admin->get_where_admin_info($where);
        if (!$usr_result) {
            $this->adminLog->auto_admin_log("没有账户信息，请联系管理员。");
            sendError("no userinfo, please contact the administrator. 没有账户信息，请联系管理员。");
        }
        return true;
    }

    /**
     * 检查用户权限，账户是否禁用
     *
     * @param string $username
     * @return bool
     */
    public function checkUserPermissions($username = '') {
        $where['status']   = 1;
        $where['username'] = $username;
        //检查权限
        $auth_result = $this->admin->get_where_admin_info($where);
        if (!$auth_result) {
            $this->adminLog->auto_admin_log("暂无权限，请联系管理员");
            sendError("no permission, please contact the administrator. 暂无权限，请联系管理员。");
        }
        return true;
    }

    /**
     * 用户信息写入session
     *
     * @param  $userinfo
     */
    public function userInfoWrittenSession($userinfo = '') {
        if ($userinfo) {
            $udata['admin_name']      = $userinfo['username'];
            $udata['admin_auth']      = $userinfo['id'];
            $udata['admin_auth_sign'] = data_auth_sign($userinfo['id']);
            $this->session->set_userdata($udata);
        }
    }

    /**
     * 检查验证码是否正确
     *
     * @param string $captchacode
     * @return bool
     */
    public function checkValidationCode($captchacode = '') {
        if (!empty($captchacode)) {
            $captcha = new Captcha($this->captcha_config);
            $result  = $captcha->validate($captchacode); // 验证
            if (!$result) {
                $this->adminLog->auto_admin_log("验证码错误，请重新输入");
                sendError("Captcha error, Please re-enter. 验证码错误，请重新输入。");
            }
            return true;
        }
    }

    /**
     *   验证登陆
     */
    public function checkLogin() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post('data');
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_rules('captcha', 'captcha', 'trim|required');
            if ($this->form_validation->run() == false) {
                sendError("Vul alle velden in");
            } else {
                !$this->checkUserNameIsset($data['username']); //check if username and password is correct
                !$this->checkValidationCode($data['captcha']); //validation captcha
                !$this->checkUserPermissions($data['username']); //check user permissions

                //check user info isset
                $where['status']   = 1;
                $where['username'] = $data['username'];
                $where['password'] = md5($data['password']);
                $usr_result        = $this->admin->get_where_admin_info($where);
                if (!$usr_result) {
                    sendError("password error, Please re-enter. 密码错误，请重新输入。");
                }

                $this->userInfoWrittenSession($usr_result); // user information written to session
                $this->adminLog->auto_admin_log("登陆成功");
                sendSuccess("登陆成功", $usr_result);
            }
        }
    }
}
