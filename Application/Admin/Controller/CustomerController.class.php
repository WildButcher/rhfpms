<?php
namespace Admin\Controller;
use Think\Controller;

class CustomerController extends Controller {
    public function _initialize()
    {
        $this->assign('kehu', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：展示客户信息列表
     * 输入：request
     * 输出：客户信息列表
     */
    public function index(){
        $Form = M('customer');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();

        $rs = $Form->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('customers', $rs);
        $this->assign('page',$show);
        $this->display('customer/customerManager');

    }

    /*
     * 方法作用：按照公司名字查询
     * 输入：公司名字
     * 输出：模糊查询的记录
     */
    public function recordSearch($c_name){
        $Form = M('customer');
        if($c_name!=''){
            $wheresql['c_name'] = array('like','%'.$c_name.'%');
            $rs = $Form->where($wheresql)->order('id DESC')->select();
        }else{
            $rs = $Form->order('id DESC')->select();
        }
        if($rs) {
            $this->assign('customers', $rs);
            $this->display('customer/customerManager');
        }else{
            $this->error('查询的rs出问题了');
        }
    }

    /*
     * 方法作用：删除客户记录
     * 输入：客户id
     * 输出：删除记录
     */
    public function recordDelete($id){
        $Form = M('customer');
        if($Form->delete($id)){
            $this->redirect('Customer/Index');
        }
    }

    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew(){
        $this->display('customer/customerAdd');
    }

    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('customer');
        $customer = $Form->find($id);
        if($customer){
            $this->assign('customer', $customer);
            $this->display('customer/customerEdit');
        }else{
            $this->error('客户资料信息读取错误！');
        }
    }
    /*
     * 方法作用：增加一条记录到数据库
     * 输入：客户信息
     * 输出：增加一条记录
     */
    public function recordInsert(){
        $Form = D('customer');
        if($Form->create()){
            $result = $Form->add();
            if ($result) {
                $this->redirect('Customer/Index');
            } else {
                $this->error('客户信息添加错误！');
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
        $Form = D('customer');
        if($Form->create()){
            $result = $Form->save();
            if ($result) {
                $this->redirect('Customer/Index');
            } else {
                $this->error('客户信息修改错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }


    /*
     * 方法作用：Aja请求返回整个用户资料，并以表格形式展现
     * 输入：ajax请求的单位名称可以为空
     * 输出：table格式的字符串
     */
    public function listForAjax($c_name){
        $Form = M('customer');
        if($c_name!=''){
            $wheresql['c_name'] = array('like','%'.$c_name.'%');
            $rs = $Form->where($wheresql)->field('id,c_name')->order('id DESC')->select();
        }else{
            $rs = $Form->field('id,c_name')->order('id DESC')->select();
        }
        if($rs) {
            $this->ajaxReturn($rs);
        }else{
            $this->ajaxReturn(0,'无数据',0);
        }
    }
}