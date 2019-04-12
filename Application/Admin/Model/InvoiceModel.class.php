<?php

namespace Admin\Model;

use Think\Model;

class InvoiceModel extends Model {
    protected $tableName = 'invoice';
    protected $_validate = array(
            array(
                    'p_name',
                    'require',
                    '客户名称是必须的！'
            ),
            array(
                    'create_date',
                    'require',
                    '开票日期是必须的！'
            ),
            array(
                    'c_price',
                    'require',
                    '总金额是必须的！'
            ),
            array(
                    'i_no',
                    'require',
                    '发票编号是必须的！'
            )
    );
}