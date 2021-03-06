<?php

namespace Admin\Controller;

use Think\Controller;

class ContractController extends Controller {
    public function _initialize(){
        $this->assign('hetong', 'active');
        if (! session('uid')) {
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
        $Page = new \Think\Page($count, 25);
        $show = $Page->show();
        $rs = $Form->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('contracts', $rs);
        $this->assign('page', $show);
        $this->display('contract/contractManager');
    }
    
    /*
     * 方法作用：查看合同信息列表,用于手机查看
     * 输入：request
     * 输出：合同信息列表
     */
    public function mobileView($flag, $c_date){
        $Form = M('contract');
        $c_status = '已回款';
        $NEQ = 'NEQ';
        if ($flag) {
            $NEQ = 'EQ';
        }
        $wheresql['c_status'] = array(
                $NEQ,
                $c_status
        ); // 设置未回款查询条件
        $wheresql['c_date'] = array(
                'like',
                '%' . $c_date . '%'
        );
        
        $count = $Form->where($wheresql)->order('id DESC')->count();
        $Page = new \Think\Page($count, 25);
        $show = $Page->show();
        $rs = $Form->where($wheresql)->order('id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('contracts', $rs);
        $this->assign('page', $show);
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
            $this->assign('contracts', $rs);
            $this->display('contract/contractView');
        } else {
            $this->assign('contracts', $rs);
            $this->display('contract/contractView');
        }
    }
    
    /*
     * 方法作用：按照公司名字查询
     * 输入：公司名字
     * 输出：模糊查询的记录
     */
    public function recordSearch($p_name){
        $Form = M('contract');
        if ($p_name != '')
            $c_name = $p_name;
        else
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
            $this->assign('contracts', $rs);
            $this->assign('p_name', $c_name);
            $this->display('contract/contractManager');
        } else {
            $this->assign('contracts', $rs);
            $this->assign('p_name', $c_name);
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
        $p_name = I('p_name');
        if ($Form->delete($id)) {
            $this->recordSearch($p_name);
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
        if ($contract) {
            $this->assign('contract', $contract);
            $this->display('contract/contractEdit');
        } else {
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
        if ($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->redirect('contract/Index');
            } else {
                $this->error('合同信息添加错误！');
            }
        } else {
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
        $p_name = I('p_name');
        if ($Form->create()) {
            $result = $Form->save();
            if ($result) {
                $this->recordSearch($p_name);
            } else {
                $this->error('合同信息修改错误！');
            }
        } else {
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
        $map['id'] = array(
                'in',
                $records
        );
        if ($status == '已签订') {
            $this->contractSigned($records);
        }
        if ($status == '已发货') {
            $this->contractSend($records);
        }
        $Form->where($map)->setField('c_status', $status);
        $this->redirect('contract/Index');
    }
    
    /*
     * 开具发票过程
     */
    public function contractInvoice($status){
        $Form = D('invoice');
        $con = M('contract');
        
        $records = I('sid');
        $this->assign('sid', $records);
        $this->assign('status', $status);
        
        $map['id'] = array(
                'in',
                $records
        );
        $len = $con->where($map)->field('p_name')->group('p_name')->select();
        if (count($len) > 1 || count($len) == 0) {
            $this->error('同一张发票只能开具一个公司或者单位！');
        }
        $c_num = count($con->where($map)->select());
        $i_price = $con->where($map)->sum('c_price');
        $this->assign('c_num', $c_num);
        $this->assign('p_name', $len[0]['p_name']);
        $this->assign('i_price', $i_price);
        
        $this->display('contract/contractInvoice');
    }
    
    /*
     * 开具发票
     */
    public function invoiceOut(){
        $Form = D('invoice');
        $con = D('contract');
        
        $records = I('sid');
        $map['id'] = array(
                'in',
                $records
        );
        $con->where($map)->setField('c_status', '已开票');
        $con->where($map)->setField('i_no', I('i_no'));
        if ($Form->create()) {
            $Form->c_id = $records;
            $result = $Form->add();
            if ($result) {
                $this->redirect('contract/Index');
            } else {
                $this->error('开票发生错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
    
    // curl请求函数，微信都是通过该函数请求
    function https_request($url, $data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    
    // 获取发送数据数组
    function getDataArray($MsgArray){
        $data = array(
                // 要发送给用户的openid
                'touser'=>$MsgArray["touser"],
                // 改成自己的模板id，在微信后台模板消息里查看
                'template_id'=>$MsgArray["template_id"],
                // 点击模板打开的链接
                'url'=>$MsgArray["url"],
                'data'=>array(
                        'title'=>array(
                                'value'=>$MsgArray["title"],
                                'color'=>"#000"
                        ),
                        'company'=>array(
                                'value'=>$MsgArray["company"],
                                'color'=>"#000"
                        ),
                        'guige'=>array(
                                'value'=>$MsgArray["guige"],
                                'color'=>"#000"
                        ),
                        'time'=>array(
                                'value'=>$MsgArray["time"],
                                'color'=>"#000"
                        ),
                        'cdate'=>array(
                                'value'=>$MsgArray["cdate"],
                                'color'=>"#000"
                        )
                )
        );
        return $data;
    }
    /**
     * 微信推送函数
     *
     * @param 采购单位 $company            
     * @param 发货时间 $cdate            
     * @param 所有的规格 $guige            
     */
    public function pushmsg($ACCESS_TOKEN, $company, $cdate, $guige, $touser){
        /**
         * 开始推送微信通知
         */
        // 模板消息请求URL
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $ACCESS_TOKEN;
        
        // 推送的用户
        $MsgArray["touser"] = $touser;
        
        // 推送的模板编号
        $MsgArray["template_id"] = "Q5cIcms-QzNLmUwhTdGS5rRHHM1uCDYpM06RsX_jyfQ";
        
        // 标题是可选值
        $MsgArray["title"] = "有新订单啦！";
        
        // 采购单位
        $MsgArray["company"] = $company;
        
        // 完成时间
        $MsgArray["cdate"] = $cdate;
        
        // 采购的规格
        $MsgArray["guige"] = $guige;
        
        // 推送时间
        $MsgArray["time"] = date('Y-m-d h:i:s', time());
        
        $MsgArray["url"] = "http://pms.ronghuifeng.cn/msg.php?title=" . $MsgArray["title"] . "&time=" . $MsgArray["time"] . "&company=" . $MsgArray["company"] . "&cdate=" . $MsgArray["cdate"] . "&guige=" . $MsgArray["guige"];
        
        // 转化成json数组让微信可以接收
        $json_data = json_encode($this->getDataArray($MsgArray));
        $res = $this->https_request($url, urldecode($json_data)); // 请求开始
        $res = json_decode($res, true);
        
        // if ($res['errcode'] == 0 && $res['errcode'] == "ok") {
        // } else {
        // }
    /**
     * 推送完毕
     */
    }
    
    /*
     * 合同签订后形成生产计划,如果合同中包含模具,则加入模具信息表
     *
     * @param 记录id $records
     */
    public function contractSigned($records){
        $MsgArray = array();
        $guige = "";
        
        $Form = D('v_contract_plan');
        $plan = M('productionplan');
        $moulds = M('moulds');
        $map['id'] = array(
                'in',
                $records
        );
        $rs = $Form->where($map)->order('id')->select();
        foreach ( $rs as $x ) {
            $plandata['p_customer'] = $x['p_name'];
            $plandata['c_id'] = $x['id'];
            $plandata['c_type'] = $x['c_type'];
            $plandata['p_guige'] = $x['c_guige'];
            $plandata['p_num'] = $x['c_number'];
            $plandata['p_stardate'] = $x['c_date'];
            $plandata['p_plandate'] = $x['c_fday'];
            $plandata['p_status'] = '生产中';
            // 以上为插入生产计划
            $guige = $guige . $plandata['p_guige'] . "," . $plandata['c_type'] . "," . $plandata['p_num'] . ";";
            if ($x['c_type'] == '模具') {
                $mouldsdata['cid'] = $x['p_id'];
                $mouldsdata['m_name'] = $x['c_name'];
                $mouldsdata['m_guige'] = $x['c_guige'];
                $mouldsdata['m_date'] = $x['c_date'];
                $mouldsdata['m_price'] = $x['c_price'];
                if ($moulds->create($mouldsdata)) {
                    $resu = $moulds->add();
                    if (! $resu) {
                        $this->error('增添模具失败错误！');
                    }
                }
            }
            // 以上为如果有模具类别则插入模具表,暂时用中文来作为判断
            if ($plan->create($plandata)) {
                $result = $plan->add();
                
                if (! $result) {
                    $this->error('增添生产计划错误！');
                }
            }
        }
        // 先获取ACCESS_TOKEN然后再取关注用户列表。循环用户列表推送消息
        // $ACCESS_TOKEN = json_decode($this->https_request("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxac2d658e937e3036&secret=fa167a09ef1bde4e3b58255ce5773354"), true)["access_token"];
        // 获取关注用户列表
        // $users = json_decode($this->https_request("https://api.weixin.qq.com/cgi-bin/user/get?access_token=" . $ACCESS_TOKEN), true)["data"]["openid"];
        // $users = array(
        // "oj0Jj5iXT7F65JqTHB0n42KQ0iFQ",
        // "oj0Jj5qfVdus4El98ObZu2O-bdzw"
        // );
        
        // 循环用户列表推送消息
        // foreach ( $users as $u ) {
        // $this->pushmsg($ACCESS_TOKEN, $plandata['p_customer'], $plandata['p_stardate'], $guige, $u);
        // }
        // $touser = "oj0Jj5qfVdus4El98ObZu2O-bdzw";
    }
    
    /*
     * 发货以后完成生产计划
     *
     * @param unknown $records
     */
    public function contractSend($records){
        $plan = M('productionplan');
        $map['c_id'] = array(
                'in',
                $records
        );
        $p_factdate = date("Y-m-d");
        $arr = array(
                'p_status'=>'已完成',
                'p_factdate'=>$p_factdate
        );
        $plan->where($map)->setField($arr);
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
     * @param $data 一个二维数组,结构如同从数据库查出来的数组
     * @param $title excel的第一行标题,一个数组,如果为空则没有标题
     * @param $filename 下载的文件名
     * 输出：Excel文件
     */
    public function toExcel(){
        $Form = M('contract');
        $title = array(
                '采购单位名称',
                '合同签订日期',
                '合同金额',
                '合同状态'
        );
        $filename = '合同情况列表';
        $exportData = $Form->field('p_name,c_date,c_price,c_status')->select();
        $exportExcel = new DataToExcel();
        $exportExcel->exportexcel($exportData, $title, $filename);
    }
    
    /*
     * 方法作用：显示合同和明细
     * @param $id 合同的id
     * 输出：合同与合同明细，按照2个变量返回前台
     */
    public function detail($id){
        // 先查询合同信息
        $Form = M('contract');
        $contract = $Form->find($id);
        // 再查询合同明细
        $Form = M('contract_add');
        $wheresql['c_id'] = $id;
        $rs = $Form->where($wheresql)->order('id DESC')->select();
        
        // 将2个变量返回前台
        if ($contract) {
            $this->assign('contract', $contract);
            $this->assign('contractpluses', $rs);
            $this->display('contract/contractDetail');
        } else {
            $this->error('展示合同与明细读取错误！');
        }
    }
}
