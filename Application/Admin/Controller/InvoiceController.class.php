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
        $invoice = M('invoice');        //读取单位信息、总金额等
        $Form = M('v_invoice_detail');  //读取发票详细信息
        $wheresql['id']=$id;
        $details = $Form->where($wheresql)->select();
        $one = $invoice->find($id);

        $this->assign('invoice', $one);
        $this->assign('details',$details);
        $this->display('invoice/invoiceDetail');
    }
}
