<?php

namespace Admin\Controller;

use Think\Controller;

class InvoiceController extends Controller {
    public function _initialize(){
        $this->assign('fapiao', 'active');
        if (! session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }
    
    /**
     * 展示开票历史信息
     */
    public function index(){
        $Form = M('invoice');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count, 25);
        $show = $Page->show();
        $rs = $Form->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('invoices', $rs);
        $this->assign('page', $show);
        $this->display('invoice/invoiceManager');
    }
    
    /**
     * 显示具体发票信息
     */
    public function detail($id){
        $invoice = M('invoice'); // 读取单位信息、总金额等
        $Form = M('v_invoice_detail'); // 读取发票详细信息
        $wheresql['id'] = $id;
        $details = $Form->where($wheresql)->select();
        $one = $invoice->find($id);
        
        $this->assign('invoice', $one);
        $this->assign('details', $details);
        $this->display('invoice/invoiceDetail');
    }
    
    /**
     * 根据公司名称查询发票
     */
    public function recordSearch(){
        $Form = M('invoice');
        $c_name = I('p_name');
        if ($c_name != '') {
            $wheresql['p_name'] = array(
                    'like',
                    '%' . $c_name . '%'
            );
            $rs = $Form->where($wheresql)->order('id DESC')->select();
        } else {
            $rs = $Form->order('id DESC')->select();
        }
        if ($rs) {
            $this->assign('invoices', $rs);
            $this->assign('p_name', $c_name);
            $this->display('invoice/invoiceManager');
        } else {
            $this->assign('invoices', $rs);
            $this->assign('p_name', $c_name);
            $this->display('invoice/invoiceManager');
        }
    }
    
    /**
     * 显示发票对应的合同情况
     */
    public function invoiceUnionContract($cid){
        $Form = M('contract'); // 读取单位信息、总金额等
        $wheresql['id'] = array(
                'in',
                $cid
        );
        $rs = $Form->where($wheresql)->select();
        $this->assign('contracts', $rs);
        $this->display('invoice/contractDetail');
    }
    
    /*
     * 方法作用：修改合同状态字段
     * 输入：需要修改的状态字段值$status，需要修改的记录表单form数据
     * 输出：修改记录
     */
    public function recordChange($status){
        $Form = D('contract');
        $records = I('sid');
        $map['id'] = array(
                'in',
                $records
        );
        $Form->where($map)->setField('c_status', $status);
        $this->redirect(U('/Admin/Invoice/InvoiceUnionContract/cid/' . $records));
    }
    /*
     * 方法作用：导出数据到
     * @param $data 一个二维数组,结构如同从数据库查出来的数组
     * @param $title excel的第一行标题,一个数组,如果为空则没有标题
     * @param $filename 下载的文件名
     * 输出：Excel文件
     */
    public function toExcel(){
        $Form = M('invoice');
        $title = array(
                '单位名称',
                '开具日期',
                '发票金额',
                '发票编号'
        );
        $c_name = I('p_name');
        $exportData = array();
        if ($c_name != '') {
            $wheresql['p_name'] = array(
                    'like',
                    '%' . $c_name . '%'
            );
            $exportData = $Form->field('p_name,create_date,i_price,i_no')->where($wheresql)->order('id DESC')->select();
        } else {
            $exportData = $Form->field('p_name,create_date,i_price,i_no')->order('id DESC')->select();
        }
        $filename = '发票情况列表';
        $exportExcel = new DataToExcel();
        $exportExcel->exportexcel($exportData, $title, $filename);
    }
}
