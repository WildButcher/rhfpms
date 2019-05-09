<?php

namespace Admin\Controller;

use Think\Controller;

class BidController extends Controller {
    public function _initialize(){
        $this->assign('hetong', 'active');
        if (! session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /**
     * 投标报价
     * @return 默认成本计算页面
     */
    public function index(){

        $this->display('bid/bidManager');
    }

}
