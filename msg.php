<?php
header("Content-Type: text/html;charset=utf-8");
// 此页面是为了处理各种返回值
if (! isset($_REQUEST['title']) || ! isset($_REQUEST['company']) || ! isset($_REQUEST['cdate'])) {
    exit();
}
?>
<html>
<head>
<style>
h1,h2,p
{
	font-size:60px;
}
table,td
{
	border:1px solid black;
	font-size:60px;
}
table
{
	width:100%;
	border-collapse: collapse;
}
thead
{
	text-align:center;
	background-color:#999999;
}

</style>
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
			<table>
				<thead>
				<tr>
					<td>规格</td>
					<td>类别</td>
					<td>数量</td>
				</tr>
				</thead>
				<tbody id="guige"></tbody>
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
?>
var x = document.getElementById("guige");
var record = msg.split(";");
var tr = "";
for (r in record){
	if (record[r])
	{
		var f = record[r].split(",");
		var td = "";
		for (e in f)
		{			
			if(f[e]){
				td = td + "<td>"+f[e]+"</td>";
			}
		}
		tr = tr + "<tr>" + td +"</tr>";
	}	
}
x.innerHTML = tr;
</script>
</html>