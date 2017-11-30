<?php

namespace Admin\Model;

use Think\Model;

class MouldsModel extends Model {
    protected $tableName ='moulds';
    protected $_validate = array(
        array('m_name','require','模具名称必填！'),
        array('m_guige','require','模具规格必填！'),
        array('m_price','number','价格必须是数字！')
    );

}