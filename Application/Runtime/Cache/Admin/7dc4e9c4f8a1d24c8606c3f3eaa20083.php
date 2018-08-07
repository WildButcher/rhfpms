<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>荣汇丰生产管理系统</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/Public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/Public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/Public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="/Public/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="/Public/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="/Public/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="/Public/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="/Public/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />


        <link href="/Public/css/pagination.css" rel="stylesheet" type="text/css" />

        <!-- Theme style -->
        <link href="/Public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
            
        <!-- Dtree JavaScript -->
        <script type="text/javascript" src="/Public/js/dtree.js"></script>
        
        <script type="text/javascript" src="/Public/js/myjs.js"></script>
        <script type="text/javascript" src="/Public/js/Chart.js"></script>
        <script type="text/javascript" src="/Public/js/WdatePicker.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                PMS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/Public/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>你好, <?php echo ($username); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo ($gaikuang); ?>">
                            <a href="#" onclick="location='/Admin'">
                                <i class="fa fa-bar-chart-o"></i> <span>概况</span>
                            </a>
                        </li>
                        <li class="<?php echo ($kehu); ?>">
                            <a href="#" onclick="location='/Admin/Customer'">
                                <i class="fa fa-users"></i> <span>客户资料</span>
                            </a>
                        </li>
                        <li class="treeview <?php echo ($shangpin); ?>">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>商品管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/Admin/Moulds/index/cid/1"><i class="fa fa-angle-double-right"></i>模具管理</a></li>
                                <li><a href="/Admin/Goods"><i class="fa fa-angle-double-right"></i>产品管理</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($hetong); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>合同管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/Admin/Contract"><i class="fa fa-angle-double-right"></i>合同签订</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($employee); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>员工管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/Admin/Employee"><i class="fa fa-angle-double-right"></i>职工名册</a></li>
                                <li><a href="/Admin/Employeepay"><i class="fa fa-angle-double-right"></i>薪酬发放</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($xitong); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>系统管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/Admin/User"><i class="fa fa-angle-double-right"></i>用户管理</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onclick="location='/Admin/Index/logout'">
                                <i class="fa fa-sign-out"></i> <span>注销退出</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<!-- Right side column. Contains the navbar and content of the page -->
<script language="javascript">
    /*
     * 方法作用：更改form表单的action并提交
     */
    function changeStatus(obj){
        var str = "/admin/employee/recordChange/status/" + obj;
        $("#formContractList").attr("action", str);
        var o = document.getElementsByName('selectedOne[]');
        var sid = new Array();
        for(x in o){
            if(o[x].checked == true){
                sid.push(o[x].value);
            }
        }
        $("#sid").val(sid);
        $("#formContractList").submit();

    }
    /*
     * 方法作用：关联报价单。更改提交的表单的action并提交
     */
    function relationPriceBill(){
        var str = "/admin/employee/relationShow";
        $("#formContractList").attr("action", str);
        $("#formContractList").submit();
    }
    /*
     * 方法作用：导出excel
     */
    function exportExcel(){
        var str = "/admin/employee/toExcel";
        $("#formContractList").attr("action", str);
        $("#formContractList").submit();
    }


</script>
<aside class="right-side">
    <section class="content-header">
        <h1>
            职工花名册
            <small>Employee</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <button class="btn btn-app btn-sm" onclick="location='/admin/employee/recordNew'">新增</button>
                        <table id="example2" class="table table-bordered table-hover text-left">
                            <thead>
                            <tr>
                                <th class="col-xs-2 text-center">
                                    操作
                                </th>
                                <th class="text-center">序号</th>
                                <th class="text-center">人员姓名</th>
                                <th class="text-center">性别</th>
                                <th class="text-center">联系电话</th>
                                <th class="text-center">薪酬价格</th>
                                <th class="text-center">人员状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($employees)): $i = 0; $__LIST__ = $employees;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$employee): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="selectedOne[]" value="<?php echo ($employee["id"]); ?>" />
                                        <button class="btn btn-danger btn-sm" onclick="location='/admin/employee/recordDelete/id/<?php echo ($employee["id"]); ?>'"><i class="fa fa-times"></i></button>
                                        <button class="btn btn-success btn-sm" onclick="location='/admin/employee/recordShow/id/<?php echo ($employee["id"]); ?>'"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td class="text-center"><?php echo ($i); ?></td>
                                    <td><?php echo ($employee["e_name"]); ?></td>
                                    <td><?php echo ($employee["e_gender"]); ?></td>
                                    <td><?php echo ($employee["e_moblie"]); ?></td>
                                    <td><?php echo ($employee["e_pay"]); ?></td>
                                    <td><?php echo ($employee["e_status"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="text-center pagelist">
                            　　<?php echo ($page); ?>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
                </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script type="text/javascript" src="/Public/js/jquery.min.js"></script> 
        <!-- jQuery UI 1.10.3 -->
        <script src="/Public/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/Public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="/Public/js/raphael-min.js"></script>
        <script src="/Public/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="/Public/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script type="text/javascript" src="/Public/js/jquery.vmap.js"></script>
        <script src="/Public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> 
        <!-- fullCalendar -->
        <script src="/Public/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="/Public/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="/Public/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/Public/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="/Public/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/Public/js/AdminLTE/app.js" type="text/javascript"></script>
        
    </body>
</html>