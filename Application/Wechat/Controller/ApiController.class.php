<?php

namespace Wechat\Controller;

use Think\Controller;

class ApiController extends Controller {
	public function _initialize() {
		$staticAppId = 'wx4a22cd233c6b73ca';
 		$fromUsers = ['oOYnF0a2d2s7qMxMjwOPWlqejxkQ','oOYnF0bEY8-Gkme6d69Mwc8HO8_Q','oOYnF0X_jReST2Bn8xGKblO0Ciq8','oOYnF0fYmzQwLOySt2AZcO90MERM','oOYnF0d6ypydevFNPxtMyGsX11XA'];
		
 		$appid = I ( 'appid' );
		$fromUser = I('fromUser');
		
		if (($staticAppId != $appid) || (!in_array($fromUser,$fromUsers))) {
			echo "88x23x04";
		}
	}
	public function index() {
		$c_guige = I ( 'c_guige' );
		$Form = M ( 'v_search_product' );
		$wheresql ['c_guige'] = array (
				'like',
				'%' . $c_guige . '%' 
		);
		$moulds = $Form->where ( $wheresql )->order ( 'id DESC' )->select ();
		header ( "Content-type: text/html; charset=utf-8" );
		// echo "<table><thead><tr><th>采购单位</th><th>规格</th><th>单价</th></tr></thead><tbody>";
		// foreach ($moulds as $obj){
		// echo "<tr><td>".$obj['p_name']."</td><td>".$obj['c_guige']."</td><td>".$obj['c_price']."</td></tr>";
		// }
		// echo "</tbody>";
		if (count ( $moulds ) > 0) {
			foreach ( $moulds as $obj ) {
				// echo $obj ['c_date'] . "==" . $obj ['p_name'] . "==" . $obj ['c_guige'] . "==" . $obj ['c_price'] . "\n";
				echo substr($obj ['p_name'],0,9) . "==" . $obj ['c_guige'] . "\n";
			}
		}
	}
}