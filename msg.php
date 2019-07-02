<?php
header("Content-Type: text/html;charset=utf-8");
// 此页面是为了处理各种返回值
if (! isset($_REQUEST['title']) || ! isset($_REQUEST['company']) || ! isset($_REQUEST['cdate'])) {
    exit();
}
?>
<html>
<head>
<title><?php

echo $_REQUEST['title'];
?></title>

</head>
<body>
	<h1><?php

echo $_REQUEST['title'];
?></h1>
	<div>
		<h2><?php
echo $_REQUEST['company'];
?></h2>
		<h2>
			<table id="guige">
			</table>
		</h2>
		<p>发货时间:<?php
echo $_REQUEST['cdate'];
?></p>
	</div>
</body>
<script type="text/javascript">
var msg;
<?php
echo "msg = '" . $_REQUEST['guige'] . "';";
var x = document.getElementById("guige");
var record = msg.split(";");
var tr;
for (r in record){
	var td;
	var feild = r.split(",");
	for (let f in feild){
		td = td + "<td>"+feild[f]+"</td>";
	}
	tr = tr + "<tr>" + td +"</tr>";
}
x.innerHTML = tr;
?>

</script>
</html>