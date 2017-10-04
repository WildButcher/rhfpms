<?php

namespace Admin\Model;

use Think\Model;

class UserModel extends Model {
    protected $tableName ='user';
    protected $_validate = array(
        array('username','require','用户姓名是必须的！'),
        array('account','require','登录帐号是必须的！'),
        array('account','','该登录帐号已经存在！',0,'unique',1)
    );
    protected $_auto = array (
        array('password','md5',3,'function')
    );
}