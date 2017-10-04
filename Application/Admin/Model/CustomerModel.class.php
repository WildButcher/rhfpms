<?php

namespace Admin\Model;

use Think\Model;

class CustomerModel extends Model {
    protected $tableName ='customer';
    protected $_validate = array(
        array('c_name','require','单位名称是必须的！'),
        array('c_tax','require','税号是必须的！'),
        array('c_bank','require','开户行和帐号是必须的！'),
        array('c_addr','require','单位地址是必须的！')
    );
}