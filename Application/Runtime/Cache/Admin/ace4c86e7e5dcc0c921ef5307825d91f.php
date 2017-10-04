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
                            <a href="#" onclick="location='/index.php/Admin'">
                                <i class="fa fa-bar-chart-o"></i> <span>概况</span>
                            </a>
                        </li>
                        <li class="<?php echo ($kehu); ?>">
                            <a href="#" onclick="location='/index.php/Admin/Customer'">
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
                                <li><a href="/index.php/Admin/Moulds/index/cid/1"><i class="fa fa-angle-double-right"></i>模具管理</a></li>
                                <li><a href="/index.php/Admin/Goods"><i class="fa fa-angle-double-right"></i>产品管理</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($hetong); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>合同管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/index.php/Admin/Contract"><i class="fa fa-angle-double-right"></i>合同签订</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($employee); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>员工管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/index.php/Admin/Employee"><i class="fa fa-angle-double-right"></i>职工名册</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($xitong); ?>">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>系统管理</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/index.php/Admin/User"><i class="fa fa-angle-double-right"></i>用户管理</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onclick="location='/index.php/Admin/Index/logout'">
                                <i class="fa fa-sign-out"></i> <span>注销退出</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<!--
    以下js用于ajax动态查询
-->
<script language="javascript">
    /*
     * 方法作用：单位名称文本框失去焦点后隐藏div
     * 输入：obj文本框对象
     * 输出：隐藏div
     */
    function hiddenList(){
        $('#c_show').hide();
    }

    /*
     * 方法作用：填充隐藏的单位id和填充单位名称
     * 输入：i单位id号，n单位名称
     * 输出：填充成功
     */
    function fText(i,n){
        $('#p_id').val(i);
        $('#p_name').val(n);
        $('#c_show').hide();
    }

    /*
     * 方法作用：通过ajax获取后台的数据列表，并用js拼凑为一个table，table的tr有onclick方法调用。拼凑完毕后增加到隐藏div中。
     * 输入：obj文本框对象本身
     * 输出：显现div层，并且数据为数据库中查询的数据列表即单位名称
     */
    function getList(obj){
        $('#c_show').text("");
        jQuery.ajax({
            url : '/index.php/Admin/Customer/listForAjax/',
            data : {'c_name':obj.value},
            dataType : 'json',
            success : function(data){
                var str = '<table id=\"example2\" class=\"table table-bordered table-hover text-left\"><thead><tr><td class=\"text-right\"><b>【关闭】</b></td></thead><tbody>';
                console.log(data);
                for(x in data){
                    str = str + '<tr><td onClick=\"fText(\'' + data[x].id + '\',\''+ data[x].c_name +'\');\">'+data[x].c_name+'</td></tr>';
                };
                str = str + '</table>';
                $('#c_show').append(str);
            },
            error : function(){
                $('#c_show').hide();
            }
        });

        $('#c_show').attr('z-index','999');
        $('#c_show').css( {
            'position' : 'absolute',
            'padding':'10px',
            'top' : '75px',
            'left' :'10px',
            'background': '#FFFFFF'
        } ).show();
    }
</script>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <section class="content-header">
        <h1>
            合同签订
            <small>Contract In</small>
        </h1>
    </section>
    <section class="content" id="bbb">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form role="form" action="/index.php/Admin/Contract/recordUpdate" method="post" name="form1">
                            <!-- text input -->
                            <div class="form-group">
                                <label>客户名称</label>
                                <input type="hidden" id="p_id" name="p_id" value="<?php echo ($contract["p_id"]); ?>"/>
                                <input type="hidden" id="id" name="id" value="<?php echo ($contract["id"]); ?>"/>
                                <input type="text" id="p_name" name="p_name" class="form-control" placeholder="请选择..." oninput="getList(this)" value="<?php echo ($contract["p_name"]); ?>">
                            </div>
                            <div class="form-group" id="c_show"  style="display:none;" onclick="hiddenList()"></div>
                            <div class="form-group">
                                <label>签订日期</label><br/>
                                <input name="c_date" type="text" class="Wdate" onClick="WdatePicker()" value="<?php echo ($contract["c_date"]); ?>">
                            </div>
                            <div class="form-group">
                                <label>合同金额</label>
                                <input type="text" name="c_price" class="form-control" placeholder="请输入..." value="<?php echo ($contract["c_price"]); ?>">
                            </div>
                            <div class="form-group">
                                <label>发票编号</label>
                                <input type="text" name="i_no" class="form-control" placeholder="请输入..." value="<?php echo ($contract["i_no"]); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>合同状态</label>
                                <select name="c_status" class="form-control">
                                    <option value="<?php echo ($contract["c_status"]); ?>"><?php echo ($contract["c_status"]); ?></option>
                                    <option value="已拟定">已拟定</option>
                                    <option value="已签订">已签订</option>
                                    <option value="已开票">已开票</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-sm" value="保存">
                                <button class="btn btn-primary btn-sm" onclick="javascript:window.history.go(-1)">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
                </div><!-- ./wrapper -->
		<!-- jQuery 2.0.2 -->
        <script src="/Public/js/jquery.min.js"></script>
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
        <script src="/Public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="/Public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
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