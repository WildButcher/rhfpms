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
<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<!--
    以下js用于ajax动态查询
-->
<script language="javascript">
    /*
     * 方法作用：通过ajax获取后台的人员和基本工资，拼成一个table中的tr挂在tbody下面
     *
     */
    function makePayList(obj){
        obj.disabled="disabled";
        $('#fafang').removeClass("disabled");
        jQuery.ajax({
            url : '/Admin/Employeepay/makePayList/',
            data : {},
            dataType : 'json',
            success : function(data){
                var str = '';
                var i = 1;
                for(x in data){
                    str = str + '<tr><input type=\'hidden\' name=\'e_id[]\' value=\''+data[x].id+'\' />';
                    str = str + '<td class=\"text-center\">'+ i +'</td>';
                    str = str + '<td>'+data[x].e_name+'</td>';
                    str = str + '<td>'+data[x].e_gender+'</td>';
                    str = str + '<td><input name=\'e_pay[]\' type=\'text\' value=\''+data[x].e_pay+'\' /></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td>';
                    str = str + '<td></td></tr>';
                    i = i + 1;
                };
                $('#paycontentajx').append(str);                
            },
            error : function(){
                console.log(str);
            }
        }); 
        
    }

    function formSubmit(){
    	$('#payform').submit();
    }
    /*
     * 方法作用：计算发放工资总额
     */
    function sumTotal(){
        
    }
</script>
<aside class="right-side">
    <section class="content-header">
        <h1>
            职工薪酬发放
            <small>EmployeePay</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <div class="dropdown">                        
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo ($year); ?>
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="/admin/employeepay/index/year/2018">2018</a></li>
                            <li><a href="/admin/employeepay/index/year/2019">2019</a></li>
                            <li><a href="/admin/employeepay/index/year/2020">2020</a></li>
                           <!-- 
                              <li role="separator" class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                             -->
                          </ul>                       
                        </div>
                        <br/>
                        <ul class="nav nav-tabs">
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/01">一月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/02">二月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/03">三月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/04">四月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/05">五月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/06">六月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/07">七月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/08">八月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/09">九月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/10">十月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/11">十一月</a></li>
                          <li role="presentation"><a href="/admin/employeepay/showpay/year/<?php echo ($year); ?>/month/12">十二月</a></li>
                        </ul>
                        <script>                        
                            $(function(){
                              var _li = $(".nav-tabs").find("li");                            
                              var ac = Number(<?php echo ($month); ?>);
                              $(_li[ac-1]).addClass("active");
                            });
                        </script>                       
                    </div><!-- /.box-body -->
                    <form id="payform" role="form" action="/admin/employeepay/recordInsert" method="post">
                    <input type="hidden" name="year" value="<?php echo ($year); ?>" />
                    <input type="hidden" name="month" value="<?php echo ($month); ?>" />
                    <table id="example2" class="table table-bordered table-hover text-left">
                        <thead>
                            <tr>
                                <th class="text-center">序号</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">性别</th>
                                <th class="text-center">基本工资</th>
                                <th class="text-center">岗位工资</th>
                                <th class="text-center">工龄工资</th>
                                <th class="text-center">交通补贴</th>
                                <th class="text-center">养老保险</th>
                                <th class="text-center">医疗保险</th>
                                <th class="text-center">工伤保险</th>
                                <th class="text-center">失业保险</th>
                                <th class="text-center">生育保险</th>
                                <th class="text-center">住房公积金</th>
                            </tr>
                        </thead>
                        <tbody id="paycontentajx">
                            <?php if(is_array($payrolls)): $i = 0; $__LIST__ = $payrolls;if( count($__LIST__)==0 ) : echo "还未发放员工薪酬" ;else: foreach($__LIST__ as $key=>$payroll): $mod = ($i % 2 );++$i;?><tr>
                                    <input type='hidden' name='e_id[]' value='<?php echo ($payroll["id"]); ?>' />                                 
                                    <td class="text-center"><?php echo ($i); ?></td>
                                    <td><?php echo ($payroll["e_name"]); ?></td>
                                    <td><?php echo ($payroll["e_gender"]); ?></td>
                                    <td><input name='e_pay[]' type='text' value='<?php echo ($payroll["e_pay"]); ?>' /></td>
                                    <td><?php echo ($payroll["postwage"]); ?></td>
                                    <td><?php echo ($payroll["agewage"]); ?></td>
                                    <td><?php echo ($payroll["m_wage"]); ?></td>
                                    <td><?php echo ($payroll["s_bao"]); ?></td>
                                    <td><?php echo ($payroll["y_bao"]); ?></td>
                                    <td><?php echo ($payroll["gs_bao"]); ?></td>
                                    <td><?php echo ($payroll["l_bao"]); ?></td>
                                    <td><?php echo ($payroll["sy_bao"]); ?></td>
                                    <td><?php echo ($payroll["zf_bao"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "还未发放员工薪酬" ;endif; ?>
                        </tbody>
                    </table>                            
                    </form>
                    <div>
                        <table id="example2" class="table table-bordered table-hover text-left">
                            <thead>
                                <th class="text-center">实发总额</th>
                            </thead>
                            <tbody id="totalcontent">
                                <tr class="text-center">
                                    <td><?php echo ($sumpaymonth); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-app <?php echo ($zaoce); ?>" onclick="javascript:makePayList(this);">造册</button>
                    <button class="btn btn-app disabled" onclick="location='/admin/employeepay'">====></button>
                    <button class="btn btn-app <?php echo ($fafang); ?>" id="fafang" onclick="javascript:formSubmit()">发放</button>
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