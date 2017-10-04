<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /*
     * 方法作用：展示首页登录页面
     * 输入：session
     * 输出：如果session里面保存有信息证明已登录，则跳转到系统界面，否则展示登录页面
     * */
    public function index(){
        if(session('uid')){
            redirect(U('/Admin/index'));
        }else{
            $this->display('/login');
        }
    }

    /*
     * 方法作用：登录验证
     * 输入：request
     * 输出：验证成功则登录系统，失败则给出提示！
     * */
    public function login(){
        if (IS_POST) {
            // 实例化Login对象
            $user_id = I('account');
            $password = I('password');
            $User = M('user');
            $flag = $this->user_check($user_id,$password);
            if (!$flag) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                //exit($login->getError());
                $this->error('登录失败,用户名或密码不正确!');
            }else {
                $this->success('登录成功,正跳转至系统首页...', U('/Admin/index'));
            }
        }else{
            $this->display();
        }
    }

    /*
     * 方法作用：比较数据库中的用户名和密码
     * 输入：
     *      user_id登录人员帐号
     *      password登录人员密码
     *
     * 输出：成功返回true，失败返回false
     * */
    private function user_check($user_id,$password){
        $flag = false;
        $pwd = MD5($password);
        $User = M('user');
        $wheresql['account']=$user_id;
//        $wheresql['password']=$password;
        $rs = $User->where($wheresql)->field('id,username,password')->find();
        if($rs['password']==$pwd){
            $flag = true;
            // 存储session
            session('uid',$rs['id']);        // 当前用户id
            session('username',$rs['username']);   // 当前用户名
        }
        return $flag;
    }

}