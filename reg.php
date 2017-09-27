<?php
    session_start();
    header("Content-Type: text/html; charset=utf-8");
    if(!isset($_POST['submit'])){
        exit("<h1>非法登录!</h1>");
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $regimage = strtoupper($_POST['regimage']);//取得用户输入的图片验证码并转换为大写
    $regimage2 = $_SESSION['image'];//取得图片验证码中的四个随机数
    include('conn.php');
    $check_query = mysqli_query($conn,"select uid from user where username ='$username' limit 1");
    if($regimage == $regimage2){
        if(mysqli_fetch_array($check_query)){
            echo '错误：用户名 '.$username.' 已存在。<a href="javascript:history.back(-1);">返回</a>';
            exit;
        }
        //写入
        $password = md5($password);
        $sql = "insert into user (username,password,email) values ('$username','$password','$email');";
        if(mysqli_query($conn,$sql)){
            exit("用户注册成功，点击此处 <a href=\"login.html\">登录</a>");
        }else {
          //  echo '抱歉！添加数据失败：'.mysqli_error().'<br />';
            echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
        }
    }else
		{
			echo "<script>
			        alert('注册验证码错误！');
			        javascript:history.back(-1);
			      </script>";
		}
?>
