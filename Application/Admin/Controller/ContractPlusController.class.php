<?php
namespace Admin\Controller;
use Think\Controller;
class ContractPlusController extends Controller {
    public function _initialize()
    {
        $this->assign('hetong', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：展示合同附件增加产品页面
     * 输入：合同id，产品列表
     * 输出：合同产品页面
     */
    public function index($id){
        $Form = M('contract_add');
        $wheresql['c_id']=$id;
        $rs = $Form->where($wheresql)->order('id DESC')->select();
        $this->assign('contract_pluses', $rs);
        $this->assign('cid', $id);
        $this->display('contract/plusAddManager');
    }


    /*
     * 方法作用：删除客户记录
     * 输入：客户id
     * 输出：删除记录
     */
    public function recordDelete($id,$cid){
        $Form = M('contract_add');
        if($Form->delete($id)){
            $this->redirect('/Admin/Contract_Plus/Index/id/'.$cid);
        }
    }

    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew($cid){
        $this->assign('cid', $cid);
        $this->display('contract/plusAdd');
    }

    /*
     * 方法作用：增加一条记录到数据库
     * 输入：客户信息
     * 输出：增加一条记录
     */
    public function recordInsert($cid){
        $Form = D('contract_add');
        if($Form->create()){
            $result = $Form->add();
            if ($result) {
                //dump('Admin/ContractPlus/Index/id/'.$cid);
                $this->redirect('/Admin/Contract_Plus/Index/id/'.$cid);
            } else {
                $this->error('合同附加信息添加错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    /*
     * 方法作用：查询模具规格
     * 输入：模具规格
     * 输出：查询结果列表，包括合同信息
     *
     */
    public function searchViewList($c_guige){
        $Form = M('v_search_product');
        $wheresql['c_guige'] = array('like','%'.$c_guige.'%');
        $moulds = $Form->where($wheresql)->order('id DESC')->select();
        $this->assign('moulds', $moulds);
        $this->display('moulds/mouldsViewList');
    }

    /**
     * 方法作用：查询需求公司历史采购产品
     * 输入：需求公司名称
     * 输出：查询结果列表，包括合同信息
     */
    public function searchPname($p_name){
        $Form = M('v_search_product');
        $wheresql['p_name'] = array('like','%'.$p_name.'%');
        $moulds = $Form->where($wheresql)->order('c_date DESC')->select();
        $this->assign('moulds', $moulds);
        $this->display('moulds/mouldsViewList');
    }
}
