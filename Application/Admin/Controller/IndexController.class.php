<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
        $this->assign('gaikuang','active');
        if(!session('uid')){
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }

    /*
     * 方法作用：概要界面展示
     * 输入：request
     * 输出：
     * */
    public function index(){
        $username = session('username');
        //合同统计
        $Contract = M('contract');
        $c_date = I('c_date');//签订日期
        
        //人员统计
        $Employee = M('employee');

        $wheresql['c_date'] = array('like','%'.$c_date.'%');//根据提交的日期组合查询条件
        $c_count = count($Contract->where($wheresql)->select());//获取当前年所有合同数
        $this->assign('contractCount',$c_count);

        $c_price = $Contract->where($wheresql)->sum('c_price');//获取当前年所有合同的金额
        $this->assign('contractPrice',$c_price);

        $c_status = '已回款';
        $wheresql['c_status'] = array('EQ',$c_status);//设置已回款查询条件
        $c_has_count = count($Contract->where($wheresql)->select());//获取当前年所有已回款合同数
        $this->assign('hasContractCount',$c_has_count);

        $c_has_price = $Contract->where($wheresql)->sum('c_price');//获取当前年已回款合同的金额
        if($c_has_price){
            $this->assign('hasContractPrice',$c_has_price);
            $this->assign('c_date',$c_date);
        }else{
            $this->assign('hasContractPrice',0);
        }

        //以下为统计职工情况

        $employees = count($Employee->select());
        $this->assign('employees',$employees);

        $genderwheresql['e_gender'] = array('EQ','女');
        $e_gender = count($Employee->where($genderwheresql)->select());
        $this->assign('e_gender',$e_gender);

        $contractwheresql['e_status'] = array('EQ','在职');
        $e_contract = count($Employee->where($contractwheresql)->select());
        $this->assign('e_contract',$e_contract);

        $retirdwheresql['e_status'] = array('EQ','退休返聘');
        $e_retird = count($Employee->where($retirdwheresql)->select());
        $this->assign('e_retird',$e_retird);

        $doublewheresql['e_status'] = array('EQ','双重关系');
        $e_double = count($Employee->where($doublewheresql)->select());
        $this->assign('e_double',$e_double);

        $this->assign('c_date',$c_date);
        $this->assign('username',$username);
        $this->display('/welcome');
    }

    /*
     * 方法作用：注销退出登录
     * 输入：request
     * 输出：清空session跳转至登录页面
     * */
    public function logout(){
        session(null);
        $this->success('注销成功,正跳转至登录页面...', U('/Home/index'));

    }

}