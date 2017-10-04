<?php
namespace Admin\Controller;
use Think\Controller;
class EmployeeController extends Controller {
    public function _initialize()
    {
        $this->assign('employee', 'active');
        if (!session('uid')) {
            header("Content-type: text/html; charset=utf-8");
            redirect(U('/Home/index'), 2, '你还未登录，请先登录！2秒后跳转...');
        }
    }
    /*
     * 方法作用：职工信息列表
     * 输入：request
     * 输出：职工信息列表
     */
    public function index(){
        $Form = M('employee');
        $count = $Form->order('id DESC')->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $rs = $Form->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('employees', $rs);
        $this->assign('page',$show);
        $this->display('employee/employeeManager');
    }

    /*
     * 方法作用：删除职工记录
     * 输入：职工id
     * 输出：删除记录
     */
    public function recordDelete($id){
        $Form = M('employee');
        if($Form->delete($id)){
            $this->redirect('employee/Index');
        }
    }

    /*
     * 方法作用：展示新增页面
     * 输入：request
     * 输出：新增页面
     */
    public function recordNew(){
        $this->display('employee/employeeAdd');
    }
    /*
     * 方法作用：增加一条记录到数据库
     * 输入：职工信息
     * 输出：增加一条记录
     */
    public function recordInsert(){
        $Form = D('employee');
        if($Form->create()){
            $result = $Form->add();
            if ($result) {
                $this->redirect('employee/Index');
            } else {
                $this->error('职工信息添加错误！');
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
        $Form = D('employee');
        if($Form->create()){
            $result = $Form->save();
            if ($result) {
                $this->redirect('employee/Index');
            } else {
                $this->error('职工信息修改错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    /*
     * 方法作用：展示修改页面
     * 输入：id
     * 输出：id对应的记录信息
     */
    public function recordShow($id){
        $Form = M('employee');
        $employee = $Form->find($id);
        if($employee){
            $this->assign('employee', $employee);
            $this->display('employee/employeeEdit');
        }else{
            $this->error('客户资料信息读取错误！');
        }
    }
}