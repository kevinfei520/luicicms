<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * LuiciCMS Welcome index
 *
 *
 * @property menu     $menu
 * @property user     $user
 * @property category $category
 * @property product  $product
 * @property adminLog $adminLog
 */
class Welcome extends Base_Controller {

    private $_count = 0;  // 数据总数

    private $_admin_count;

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $modelArr = [
            "menu", "user", "product", "category", "adminLog"
        ];
        $this->load->model($modelArr, "", true);
        $this->_count       = $this->user->get_count_users();
        $this->_admin_count = $this->admin->get_admin_list_count();
    }

    // 主页
    public function index() {
        $this->load->view('/welcome/index');
    }

    // 控制台
    public function home() {
        $categoryCount         = $this->category->getCountCategory();
        $productCount          = $this->product->get_product_list_count();
        $data['userscount']    = $this->_count;
        $data['productCount']  = $productCount;
        $data['categorycount'] = $categoryCount;
        $this->hulk_template->parse('/welcome/google', $data);
    }

    public function getmenu() {
        $menuList['homeInfo']['title']     = "首页";
        $menuList['homeInfo']['icon']      = "fa fa-home";
        $menuList['homeInfo']['href']      = "/welcome/home.html?mpi=m-p-i-0";
        $menuList['logoInfo']['title']     = "LuiciCMS";
        $menuList['logoInfo']['image']     = "/resource/images/logo.png";
        $menuList['logoInfo']['href']      = "/";
        $menuList['clearInfo']['clearUrl'] = "/welcome/clearruntime";
        $menuList['menuInfo']              = $this->getMenuList();
        sendSuccess('获取列表', $menuList, $this->_count);
    }

    //获取菜单
    public function getMenuList() {
        $result = $this->menu->get_menu_list($this->_page, $this->_limit, $this->search_params);
        $reply  = array();
        foreach ($result as $key => $value) {
            if ($value['pid'] == 0) {
                $reply[$value['nickname']]['icon']  = $value['icon'];
                $reply[$value['nickname']]['title'] = $value['title'];
                foreach ($result as $k => $val) {
                    if ($val['pid'] == $value['id']) {
                        if (in_array($val['href'], $this->checkMenu())) {
                            $childArr[] = $val;
                        } else {
                            unset($val);
                        }
                    }
                }
                if (!empty($childArr)) {
                    $reply[$value['nickname']]['child'] = $childArr;
                    $childArr                           = array();
                } else {
                    unset($reply[$value['nickname']]);
                }
            }
        }
        return $reply;
    }

    // 登出
    public function loginout() {
        $this->session->unset_userdata('admin_auth');
        $this->adminLog->auto_admin_log("登出成功");
        sendSuccess('登出成功', 'loginOut', $this->_admin_count);
    }

    // 基本信息
    public function setting() {
        $data = $this->input->post('data');
        if ($data) {
            $adminInfo = $this->admin->get_admin_info($this->session->admin_auth);
            if ($adminInfo) {
                $result = $this->admin->update_entry($adminInfo['id'], $data);
                sendSuccess('数据修改成功', $result);
            }
        } else {
            $result = $this->admin->get_admin_info($this->session->admin_auth);
            $this->load->view('/welcome/userSetting', $result);
        }
    }

    // 修改密码
    public function uppass() {
        $param = $this->input->post('data');
        if ($param) {
            $old_password   = $param['old_password'];
            $new_password   = $param['new_password'];
            $again_password = $param['again_password'];
            $result         = $this->admin->get_admin_info($this->session->admin_auth);
            if (md5($old_password) === $result['password'] && $new_password === $again_password) {
                $newpass = array('password' => md5($new_password));
                $result  = $this->admin->update_entry($result['id'], $newpass);
                sendSuccess('数据修改成功', $result);
            } else {
                sendError('密码错误或新密码不一致');
            }
        } else {
            $this->load->view('/welcome/userPassword');
        }
    }

    //清除浏览器缓存
    public function clearRuntime() {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        echo json_encode(array('code' => 1, 'msg' => '服务端清理缓存成功!'));
    }

}
