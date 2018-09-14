<?php

namespace Admin\Controller;

use Think\Controller;

class ProductionplanController extends Controller {
    /**
     * 判断是否登录
     */
    public function _initialize(){
        $this->assign('shengchan', 'active');
        if (! session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }
    
    /**
     * 展示管理列表页面
     */
    public function index(){
        $Form = M('productionplan');
        $Page = new \Think\Page($count, 25);
        
        $show = $Page->show();
        $wheresql['p_status'] = '生产中';
        $list = $Form->where($wheresql)->order('p_factdate DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('plans', $list);
        $this->assign('page', $show);
        $this->display('productionplan/planManager');
    }
    
    /**
     * 计划已完成展示请求
     */
    public function planFinish(){
        $Form = M('productionplan');
        $Page = new \Think\Page($count, 25);
        
        $show = $Page->show();
        $wheresql['p_status'] = '已完成';
        $list = $Form->where($wheresql)->order('id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('plans', $list);
        $this->assign('page', $show);
        $this->display('productionplan/planFinish');
    }
    /**
     * 展示新增页面
     */
    public function recordNew(){
        $this->display('productionplan/planAdd');
    }
    
    /*
     * 方法作用：增加一条记录到数据库
     * 输入：产品信息
     * 输出：增加一条记录
     */
    public function recordInsert(){
        $Form = D('productionplan');
        if ($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->redirect('Productionplan/Index');
            } else {
                $this->error('计划信息添加错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
    
    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('productionplan');
        $plan = $Form->find($id);
        if ($plan) {
            $this->assign('plan', $plan);
            $this->display('productionplan/planEdit');
        } else {
            $this->error('计划信息读取错误！');
        }
    }
    
    /*
     * 方法作用：修改一条记录信息
     * 输入：form
     * 输出：修改记录
     */
    public function recordUpdate(){
        $Form = D('productionplan');
        if ($Form->create()) {
            $result = $Form->save();
            if ($result) {
                $this->redirect('Productionplan/Index');
            } else {
                $this->error('计划信息修改错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
    
    /*
     * 方法作用：删除计划记录
     * 输入：计划id
     * 输出：删除记录
     */
    public function recordDelete($id){
        $Form = M('productionplan');
        if ($Form->delete($id)) {
            $this->redirect('Productionplan/Index');
        }
    }
    
    /*
     * 方法作用：修改生产计划状态字段
     * 输入：需要修改的状态字段值$status，需要修改的记录表单form数据
     * 输出：修改记录
     */
    public function recordChange($status){
        $Form = D('productionplan');
        $records = I('sid');
        $map['id'] = array(
                'in',
                $records
        );
        $p_factdate = date("Y-m-d");
        $arr = array(
                'p_status'=>$status,
                'p_factdate'=>$p_factdate
        );
        $Form->where($map)->setField($arr);
        $this->redirect('Productionplan/Index');
    }
    
    /**
     * 根据用户名称模糊查询
     */
    public function recordSearch(){
        $Form = M('productionplan');
        $c_name = I('p_customer');
        $wcf = I('wcf');
        if ($c_name != '') {
            $wheresql['p_customer'] = array(
                    'like',
                    '%' . $c_name . '%'
            );
            $rs = $Form->where($wheresql)->order('id')->select();
        } else {
            $rs = $Form->order('id')->select();
        }
        if ($rs) {
            $this->assign('plans', $rs);
            $this->display('productionplan/' . $wcf);
        } else {
            $this->assign('plans', $rs);
            $this->display('productionplan/' . $wcf);
        }
    }
}