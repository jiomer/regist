<?php
    //开启session
    session_start();
    header("Content-Type: text/html; charset=utf-8");
    //判断cookie是否含有username
    if(isset($_COOKIE['username'])){
        $_SESSION['username'] = $_COOKIE['username'];
    }
    //判断session是否含有islogin
    if( isset($_SESSION['islogin']) ){
        $admin = $_SESSION['admin'];
        $username = $_SESSION['username'];
        $userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
    <!-- easyui库导入开始 -->
    <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <link type="image/vnd.microsoft.icon" href="./img/favicon.png" rel="shortcut icon">
    <script type="text/javascript" src="easyui/jquery.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <!-- easyui库导入结束 -->
    <link rel="stylesheet" type="text/css" href="css/myicon.css">
    <style>
        .logo {
            width: 180px;
            height: 25px;
            line-height: 70px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            float: left;
        }
        .logo a{
            text-decoration: none;
            color: #fff;
        }
        .logout{
            float: right;
            margin-top: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="easyui-layout">
        <!--   头部     -->
        <div data-options="region:'north'" style="height:70px;padding-left:10px;background: #000;">
            <div class="logo"><a href="#">后台管理</a></div>
            <!--<div class="logout">你好，admin | <a href="#">退出</a></div>-->
            <div class="logout" style="padding:5px 0;">
                <?php
                    if($admin){
                ?>
        		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-myuser'">用户管理</a>
        		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-mymenu'">菜单管理</a>
        		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-myman'">角色管理</a>
        		<?php } ?>
        		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-myedit'">信息发布</a>
        		<a href="loginout.php" class="easyui-linkbutton" data-options="iconCls:'icon-loginout'">登出</a>
	       </div>
        </div>
<!--        底部-->
        <div data-options="region:'south',split:false" style="height:60px;">
            <p style="height:20px;line-height:30px; text-align:center">
                Theme by<a href="#" title="test"> Guoliangjun</a> Design.

            </p>
        </div>
<!--        左边-->
        <div data-options="region:'west',split:false" title="菜单导航" style="width:200px;padding:10px;">
            <div class="easyui-panel" style="padding:6px;width: 178px;">
                <ul class="easyui-tree">
            <li>
                <span>系统菜单</span>
                <ul>
                    <?php
                        if($admin){
                    ?>
                    <li data-options="state:'closed'">
                        <span>权限管理</span>
                        <ul>
                            <li>
                                <span>用户管理</span>
                            </li>
                            <li>
                                <span>菜单管理</span>
                            </li>
                            <li>
                                <span>角色管理</span>
                            </li>
                        </ul>
                    </li>
                    <?php
                         }
                        ?>
                    <li data-options="state:'closed'">
                        <span>新闻公告</span>
                        <ul>
                            <li>企业新闻</li>
                        </ul>
                    </li>
                    <li data-options="state:'closed'">
                        <span>信息发布</span>
                        <ul>
                            <li>信息发布</li>
                        </ul>
                    </li>
                    <li>个人信息</li>
                </ul>
            </li>
        </ul>
            </div>
    <!--        <input class="easyui-tagbox" value="搜索"  style="width:100%" data-options="-->
    <!--        buttonText: '<?php echo "搜索";?>',-->
    <!--    onClickButton: function(){-->
    <!--      alert('click button');-->
    <!--    }-->
    <!--">-->
            <input class="easyui-searchbox" data-options="prompt:'<?php echo "搜索";?>',searcher:doSearch" style="width:178px"></input>
	        <script>
        		function doSearch(value){
        			alert('You input: ' + value);
        		}
        	</script>
    
        </div>
<!--        右边-->
        <div data-options="region:'center'">
            <div class="easyui-tabs" style="width:100%;">
                <div title="Title1" style="padding:10px">
                    
                    <?php
                                echo "<h1>".$username.",欢迎登录Demo后台!</h1>";
                                echo '用户ID：'.$userid.'<br />';
                                echo "是否为管理员:".$admin."<br />";
                    ?>
                    
                    当前时间：<?php echo date("Y-m-d H:i");?>
                    
                </div>
                <div title="Title2" id="Title2" style="padding:10px">
                    <?php
                        echo "Title2";
                        include('selectuser.php');
                    ?>
                       
                    
                </div>
                <div title="Title3" style="padding:10px">
                    <?php
                        echo "Title3";
                    ?>
                    <table class="easyui-datagrid" data-options="pagination:true,rownumbers:true,url:'getdata.php',toolbar:'#tb'">
                		<thead>
                		<tr>
                		<th data-options="field:'uid',width:80,align:'center'">uid</th>
                		<th data-options="field:'username',width:150,align:'center'">姓名</th>
                		<th data-options="field:'email',width:300,align:'center'">email</th>
                		<th data-options="field:'reg_date',width:180,align:'center'">regTime</th>
                		</tr>
                		</thead>
                	</table>
                </div>
                	<div id="tb" style="height:auto">
                	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
                	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()">Remove</a>
                	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()">Accept</a>
                	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()">Reject</a>
                	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="getChanges()">GetChanges</a>
                	</div>
        </div>
</body>
</html>

<?php
}else{
        echo "<h1>非法登录!</h1>点击此处<a href=\"login.html\">登录</a>";
       // header('refresh:10;url=login.html');
    }
?>