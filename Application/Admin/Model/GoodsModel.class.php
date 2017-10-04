<?php

namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model {
    protected $tableName ='goods';
    protected $_validate = array(
        array('p_name','require','产品名称必填！'),
        array('p_guige','','该规格已经存在！',0,'unique',1),
        array('p_guige','require','产品规格必填！'),
        array('p_price','require','产品价格必填！'),
        array('p_price','number','价格必须是数字！')
    );

}