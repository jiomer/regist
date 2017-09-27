<?php
    //设置编码格式
    header("Content-Type: text/html; charset=utf-8");
    //开启session
    session_start();
    //判断session是否含有username
    if(isset($_SESSION['username'])){
        //清除session
        $username = $_SESSION['username'];
        // unset($_SESSION['userid']);
        // unset($_SESSION['username']);
        // unset($_SESSION['islogin']);
        // unset($_SESSION['isadmin']);
        // unset($_SESSION['isadmin']);
        $_SESSION = array();
        session_destroy();
        //清除cookie
        setcookie("username",'',time()-1);
        echo "<h1>".$username."注销成功！</h1>点击此处 <a href=\"login.html\">登录</a>";
        exit();
    }
    
?>