<?php
namespace Admin\Controller;
use Think\Controller;
class ContractController extends Controller {
    public function _initialize()
    {
        $this->assign('hetong', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：展示合同信息列表
     * 输入：request
     * 输出：合同信息列表
     */
    public function index(){
        $Form = M('contract');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $rs = $Form->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('contracts', $rs);
        $this->assign('page',$show);
        $this->display('contract/contractManager');
    }

    /*
     * 方法作用：查看合同信息列表,用于手机查看
     * 输入：request
     * 输出：合同信息列表
     */
    public function mobileView($flag,$c_date){
        $Form = M('contract');
        $c_status = '已回款';
        $NEQ = 'NEQ';
        if($flag){
            $NEQ = 'EQ';
        }
        $wheresql['c_status'] = array($NEQ,$c_status);//设置未回款查询条件
        $wheresql['c_date'] = array('like','%'.$c_date.'%');

        $count = $Form->where($wheresql)->order('id DESC')->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $rs = $Form->where($wheresql)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('contracts', $rs);
        $this->assign('page',$show);
        $this->display('contract/contractView');

    }

    /*
     * 方法作用：按照公司名字查询用于手机
     * 输入：公司名字
     * 输出：模糊查询的记录
     */
    public function viewSearch(){
        $Form = M('contract');
        $c_name = I('p_name');
        if($c_name!=''){
            $wheresql['p_name'] = array('like','%'.$c_name.'%');
            $rs = $Form->where($wheresql)->order('id DESC')->select();
        }else{
            $rs = $Form->order('id DESC')->select();
        }
        if($rs) {
            $this->assign('contracts', $rs);
            $this->display('contract/contractView');
        }else{
            $this->assign('contracts', $rs);
            $this->display('contract/contractView');
        }
    }

    /*
     * 方法作用：按照公司名字查询
     * 输入：公司名字
     * 输出：模糊查询的记录
     */
    public function recordSearch(){
        $Form = M('contract');
        $c_name = I('p_name');
        if($c_name!=''){
            $wheresql['p_name'] = array('like','%'.$c_name.'%');
            $rs = $Form->where($wheresql)->order('id DESC')->select();
        }else{
            $rs = $Form->order('id DESC')->select();
        }
        if($rs) {
            $this->assign('contracts', $rs);
            $this->display('contract/contractManager');
        }else{
            $this->assign('contracts', $rs);
            $this->display('contract/contractManager');
        }
    }

    /*
     * 方法作用：删除客户记录
     * 输入：客户id
     * 输出：删除记录
     */
    public function recordDelete($id){
        $Form = M('contract');
        if($Form->delete($id)){
            $this->redirect('contract/Index');
        }
    }

    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew(){
        $this->display('contract/contractAdd');
    }

    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('contract');
        $contract = $Form->find($id);
        if($contract){
            $this->assign('contract', $contract);
            $this->display('contract/contractEdit');
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
        $Form = D('contract');
        if($Form->create()){
            $result = $Form->add();
            if ($result) {
                $this->redirect('contract/Index');
            } else {
                $this->error('合同信息添加错误！');
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
        $Form = D('contract');
        if($Form->create()){
            $result = $Form->save();
            if ($result) {
                $this->redirect('contract/Index');
            } else {
                $this->error('合同信息修改错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    /*
     * 方法作用：修改合同状态字段
     * 输入：需要修改的状态字段值$status，需要修改的记录表单form数据
     * 输出：修改记录
     */
    public function recordChange($status){
        $Form = D('contract');
        $records = I('sid');
        $map['id'] = array('in',$records);
        $Form->where($map)->setField('c_status',$status);
        $this->redirect('contract/Index');
    }

    /*
     * 方法作用：展示关联报价单的页面
     * 输入：需要关联报价单的记录id
     * 输出：关联页面
     */
    public function relationShow(){
        $records = I('sid');

    }

    /*
     * 方法作用：导出数据到
     * @param $data    一个二维数组,结构如同从数据库查出来的数组
     * @param $title   excel的第一行标题,一个数组,如果为空则没有标题
     * @param $filename 下载的文件名
     * 输出：Excel文件
     */
    public function toExcel(){
        $Form = M('contract');
        $title = array('采购单位名称','合同签订日期','合同金额','合同状态');
        $filename = '合同情况列表';
        $exportData = $Form->field('p_name,c_date,c_price,c_status')->select();
        $exportExcel = new DataToExcel();
        $exportExcel->exportexcel($exportData,$title,$filename);
    }
}