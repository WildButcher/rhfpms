<?php

namespace Admin\Model;

use Think\Model;

class ContractModel extends Model {
    protected $tableName = 'contract';
    protected $_validate = array(
            array(
                    'p_name',
                    'require',
                    '需方单位名称是必须的！'
            ),
            array(
                    'c_price',
                    'require',
                    '总金额是必须的！'
            )
    );
}