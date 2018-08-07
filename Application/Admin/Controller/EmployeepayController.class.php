<?php
namespace Admin\Controller;
use Think\Controller;
class EmployeepayController extends Controller {
    public function _initialize()
    {
        $this->assign('employee', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }
    /*
     * 方法作用：职工薪酬发放列表
     * 输入：request
     * 输出：职工薪酬已发放列表
     */
    public function index(){
    	$year = I('year');
    	if($year==''){
    		$year = date('Y');
    	}; 
    	$month = date('m');
        $this->showpay($year, $month);
    }

    /**
     * 展示工资发放界面
     * @param $year	年
     * @param $month 月
     */
	public function showpay($year,$month){
		$this->assign('year', $year);
		$this->assign('month', $month);
		$paymonth = $year.$month;
		$wheresql['paymonth'] = array('EQ',$paymonth);		
		$emppay = M('payroll');		
		
		$rs = $emppay->where($wheresql)->select();
		
		$sumpaymonth = $emppay->where($wheresql)->sum('paytotal');
		if(count($rs)==0){			
			$this->assign('zaoce','');
			$this->assign('fafang','disabled');
			$emppay = M('employee');
			//$rs = $emppay->field('employee.id,employee.e_name,employee.e_gender,employee.e_pay,payroll.postwage,payroll.agewage,payroll.m_wage,payroll.s_bao,payroll.y_bao,payroll.sy_bao,payroll.gs_bao,payroll.l_bao,payroll.zf_bao')->join('LEFT JOIN payroll ON employee.id = payroll.e_id and payroll.paymonth='.$paymonth)->select();
		}else{
			$this->assign('zaoce','disabled');
			$this->assign('fafang','disabled');
			$emppay = M('employee');
			$rs = $emppay->field('employee.id,employee.e_name,employee.e_gender,payroll.basicwage e_pay,payroll.postwage,payroll.agewage,payroll.m_wage,payroll.s_bao,payroll.y_bao,payroll.sy_bao,payroll.gs_bao,payroll.l_bao,payroll.zf_bao')->join('LEFT JOIN payroll ON employee.id = payroll.e_id and payroll.paymonth='.$paymonth)->select();
		}
		
		$this->assign('sumpaymonth',$sumpaymonth);
		$this->assign('payrolls',$rs);		
		$this->display('employee/pay/payManager');
	}
	
	/**
	 * 工资造册列表
	 */
	public function makePayList(){
		$employee = M('employee');
		$rs = $employee->field('id,e_name,e_gender,e_pay')->select();
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 工资发放
	 */
	public function recordInsert(){
		$e_id = I('e_id');
		$e_pay = I('e_pay');
		$year= I('year');
		$month= I('month');
		$payroll = D("payroll");		
		if(count($e_id)>0){
			for($i=0;$i<count($e_id);$i++){
				$datalist[] = array('e_id'=>$e_id[$i],'e_pay'=>$e_pay[$i],'basicwage'=>$e_pay[$i],'paytotal'=>$e_pay[$i],'paymonth'=>$year.$month);				
			}			
			if($payroll->create()){
				$payroll->addAll($datalist);
			}
			
		}
		$this->showpay($year, $month);
	}
}