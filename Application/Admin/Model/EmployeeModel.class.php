<?php

namespace Admin\Model;

use Think\Model;

class EmployeeModel extends Model {
    protected $tableName ='employee';
    protected $_validate = array(
        array('e_name','require','职工姓名是必须的！'),
        array('e_gender','require','职工性别是必须的！')
    );
}