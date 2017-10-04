<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function _initialize()
    {
        $this->assign('xitong', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：展示用户信息列表
     * 输入：request
     * 输出：用户信息列表
     */
    public function index(){
        $Form = M('user');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $rs = $Form->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('users', $rs);
        $this->assign('page',$show);
        $this->display('user/userManager');

    }

    /*
         * 方法作用：删除用户记录
         * 输入：用户id
         * 输出：删除记录
         */
    public function recordDelete($id){
        $Form = M('user');
        if($Form->delete($id)){
            $this->redirect('user/Index');
        }
    }

    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew(){
        $this->display('user/userAdd');
    }

    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('user');
        $user = $Form->find($id);
        if($user){
            $this->assign('user', $user);
            $this->display('user/userEdit');
        }else{
            $this->error('用户资料信息读取错误！');
        }
    }
    /*
     * 方法作用：增加一条记录到数据库
     * 输入：用户信息
     * 输出：增加一条记录
     */
    public function recordInsert(){
        $Form = D('user');
        if($Form->create()){
            $result = $Form->add();
            if ($result) {
                $this->redirect('user/Index');
            } else {
                $this->error('用户信息添加错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    /*
     * 方法作用：修改一条记录信息
     * 输入：form
     * 输出：修改记录
     */
    public function recordUpdate(){
        $Form = D('user');
        if($Form->create()){
            $Form->save();
            $this->redirect('user/Index');
        }else{
            $this->error($Form->getError());
        }
    }
}