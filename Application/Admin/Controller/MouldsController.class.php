<?php
namespace Admin\Controller;
use Think\Controller;
class MouldsController extends Controller
{
    public function _initialize()
    {
        $this->assign('shangpin', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：每次进入模具管理时执行的方法
     * 输入：厂家的id
     * 输出：所属厂家的模具列表及厂家的机构树
     */
    public function index($cid)
    {
        $username = session('username');
        $this->assign('username', $username);

        //获取厂家机构树
        $customers = M('customer');
        $crs = $customers->select();
        if($cid==-1){
            $cname['c_name'] = '全部';
        }else{
            $cname = $customers->field('c_name')->find($cid);
        }
        $this->assign('c_name', $cname);
        $this->assign('customers', $crs);
        $this->assign('cid', $cid);
        //end


        //获取点击厂家机构后，对应厂家的模具
        $wheresql['cid'] = $cid;
        $moulds = M('moulds');


        if($cid==-1){
            $mouldsCount = $moulds->count();
            $count = $moulds->order('id DESC')->count();
            $Page = new \Think\Page($count,25);
            $mrs = $moulds->limit($Page->firstRow.','.$Page->listRows)->select();
            $show = $Page->show();
        }else{
            $mouldsCount = $moulds->where($wheresql)->count();
            $count = $moulds->where($wheresql)->count();
            $Page = new \Think\Page($count,25);
            $mrs = $moulds->where($wheresql)->limit($Page->firstRow.','.$Page->listRows)->select();
            $show = $Page->show();
        }

        $this->assign('mouldsCount', $mouldsCount);
        $this->assign('moulds', $mrs);
        //end

        $this->assign('page',$show);
        $this->display('moulds/mouldsManager');
    }

    /*
     * 方法作用：输出模具新增页面
     * 输入：厂家的id
     * 输出：展示模具新增页面
     */
    public function mouldsAdd($cid)
    {
        //
        $this->assign('cid', $cid);
        $this->display('moulds/mouldsAdd');
    }

    /*
     * 方法作用：保存一个模具记录
     * 输入：request，from
     * 输出：保存成功返回列表界面
     */
    public function mouldsSave()
    {
        $Form = D('moulds');
        $cid = I('cid');
        if($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->redirect('Admin/Moulds/Index/cid/' . $cid);
            } else {
                $this->error('模具添加错误！');
            }
        }else{
            $this->error($Form->getError());
        }

    }

    /*
     * 方法作用：删除一个模具记录
     * 输入：模具id,厂家id
     * 输出：删除成功后返回列表界面
     */
    public function mouldsDel($i,$cid)
    {
        $Form = M('moulds');
        $this->assign('cid', $cid);
        if($Form->delete($i)){
            $this->redirect('Admin/Moulds/Index/cid/'.$cid);
        };
    }

    /*
     * 方法作用：输出模具编辑页面
     * 输入：模具id,厂家id
     * 输出：在页面上展示模具所有字段信息
     */
    public function mouldsShow($i,$cid)
    {
        $Form = M('moulds');
        $this->assign('cid', $cid);
        $moulds = $Form->find($i);
        $this->assign('moulds', $moulds);
        $this->display('moulds/mouldsEdit');
    }

    /*
     * 方法作用：更新一个模具记录
     * 输入：request，form
     * 输出：更新成功返回列表界面
     */
    public function mouldsUpdate()
    {
        $Form = D('moulds');
        $cid = I('cid');
        if($Form->create()){
            $result = $Form->save();
            if ($result) {
                $this->redirect('Admin/Moulds/Index/cid/'.$cid);
            } else {
                $this->error('模具信息修改错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    /*
     * 方法作用：导出数据到
     * @param $data    一个二维数组,结构如同从数据库查出来的数组
     * @param $title   excel的第一行标题,一个数组,如果为空则没有标题
     * @param $filename 下载的文件名
     * 输出：Excel文件
     */
    public function toExcel(){
        $Form = M('moulds');
        $title = array('模具规格','开模时间','模具价格');
        $filename = '模具情况列表';
        $exportData = $Form->field('m_guige,m_date,m_price')->select();
        $exportExcel = new DataToExcel();
        $exportExcel->exportexcel2($exportData,$title,$filename);
    }


    /*
     * 方法作用：通过参数查询模具信息
     * @param $guige    模具规格中的某一个数值，用于模糊查询
     * 输出：模具信息列表
     */
    public function mouldsViewList($m_guige){
        $Form = M('moulds');
        $wheresql['m_guige'] = array('like','%'.$m_guige.'%');
        $moulds = $Form->where($wheresql)->order('id DESC')->select();
        $this->assign('moulds', $moulds);
        $this->display('moulds/mouldsViewList');
    }

}