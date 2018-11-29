<?php

namespace Admin\Controller;

use Think\Controller;

class GoodsController extends Controller {
    public function _initialize(){
        $this->assign('shangpin', 'active');
        if (! session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }
    
    /*
     * 方法作用：展示产品信息列表
     * 输入：request
     * 输出：产品信息列表
     */
    public function index(){
        $Form = M('goods');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count, 25);
        
        $show = $Page->show();
        $list = $Form->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('goodses', $list);
        $this->assign('page', $show);
        $this->display('goods/goodsManager');
    }
    
    /*
     * 方法作用：按照产品规格查询
     * 输入：产品规格
     * 输出：模糊查询的记录
     */
    public function recordSearch($p_guige){
        $Form = M('goods');
        if ($p_guige != '') {
            $wheresql['p_guige'] = array(
                    'like',
                    '%' . $p_guige . '%'
            );
            $rs = $Form->where($wheresql)->order('id DESC')->select();
        } else {
            $rs = $Form->order('id DESC')->select();
        }
        $this->assign('goodses', $rs);
        $this->display('goods/goodsManager');
    }
    
    /*
     * 方法作用：删除产品记录
     * 输入：产品id
     * 输出：删除记录
     */
    public function recordDelete($id){
        $Form = M('goods');
        if ($Form->delete($id)) {
            $this->redirect('Goods/Index');
        }
    }
    
    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew(){
        $this->display('goods/goodsAdd');
    }
    
    /*
     * 方法作用：增加一条记录到数据库
     * 输入：产品信息
     * 输出：增加一条记录
     */
    public function recordInsert(){
        $Form = D('goods');
        if ($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->redirect('Goods/Index');
            } else {
                $this->error('产品信息添加错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
    
    /*
     * 方法作用：从模具库中导入产品库
     * 输入：模具库的所有规格模具
     * 限制要求：以规格作为关键联系字段，规格重复的不进行导入。
     */
    public function impFromMoulds(){
        $mouldsForm = M('moulds');
        $goodsForm = M('goods');
        
        $moulds = $mouldsForm->select();
        $goods = $goodsForm->select();
        
        for($j = 0; $j < count($moulds); $j ++) {
            if (count($goods) == 0) {
                $dataList[] = array(
                        'p_name'=>$moulds[$j]['m_name'],
                        'p_guige'=>$moulds[$j]['m_guige']
                );
            } else {
                for($i = 0; $i < count($goods); $i ++) {
                    if ($moulds[$j]['m_guige'] != $goods['$i']['p_guige']) {
                        $dataList[] = array(
                                'p_name'=>$moulds[$j]['m_name'],
                                'p_guige'=>$moulds[$j]['m_guige']
                        );
                    }
                }
            }
        }
        $goodsForm->addAll($dataList);
        $this->redirect('Goods/Index', '从模具库导入产品成功！');
    }
    
    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('goods');
        $goods = $Form->find($id);
        if ($goods) {
            $this->assign('goods', $goods);
            $this->display('goods/goodsEdit');
        } else {
            $this->error('产品资料信息读取错误！');
        }
    }
    
    /*
     * 方法作用：修改一条记录信息
     * 输入：form
     * 输出：修改记录
     */
    public function recordUpdate(){
        $Form = D('goods');
        if ($Form->create()) {
            $result = $Form->save();
            if ($result) {
                $this->redirect('Goods/Index');
            } else {
                $this->error('客户信息修改错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
    
    /*
     * 方法作用：检查规格是否在产品库中存在
     * 输入：模具规格
     * 输出：产品库中是否存在
     */
    private function uniqueP_guige($guige){
    }
    
    /*
     * 方法作用：Aja请求返回整个产品，并以表格形式展现
     * 输入：ajax请求的产品名称可以为空
     * 输出：table格式的字符串
     */
    public function listForAjax($c_guige){
        $Form = M('v_search_product');
        if ($c_guige != '') {
            $wheresql['c_guige'] = array(
                    'like',
                    '%' . $c_guige . '%'
            );
            $rs = $Form->where($wheresql)->field('id,p_name,c_guige,c_price')->order('id DESC')->select();
        } else {
            $rs = $Form->field('id,p_name,c_guige,c_price')->order('id DESC')->select();
        }
        if ($rs) {
            $this->ajaxReturn($rs);
        } else {
            $this->ajaxReturn(0, '无数据', 0);
        }
    }
}