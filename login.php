<?php
    //设置编码格式
    header("Content-Type: text/html; charset=utf-8");
    //开启session
    session_start();
    //REQUEST_METHOD是否为post
   if($_SERVER['REQUEST_METHOD']=='POST'){
      if(!isset($_POST['login'])){
        //exit('<h1>非法登录!</h1>");
        echo "<h1>login.php非法登录!</h1>";
       // header('refresh:2;url=login.html');  
    }
        $image = strtoupper($_POST['image']);//取得用户输入的图片验证码并转换为大写
        $image2 = $_SESSION['image'];//取得图片验证码中的四个随机数
        if($image == $image2){
            //获取username和password
            $username = htmlspecialchars(trim($_POST['username']));
            $password = md5(trim($_POST['password']));
            
            //链接数据库
            require_once('conn.php');
            $check_query = mysqli_query($conn,"select uid,isadmin from user where username ='$username' and password='$password' limit 1");
            
            if($result = mysqli_fetch_array($check_query)){
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $result['uid'];
                //管理员权限
                $_SESSION['admin']=  $result['isadmin'];
                //验证成功，将username存到session
                $_SESSION['islogin'] = 1;
                if($_POST['remenber']=="ture"){
                    setcookie("username",$username,time()+60*60*24);
                   // setcookie("code",md5($username.md5($password)),time()+60*60*24);
                }else{
                    setcookie("username",'',time()-1);
                    //setcookie("code",'',time()-1);
                }
                header("location:index.php");
            }else{
                echo("用户名或密码错误，请重新登录！<a href=\"javascript:history.back(-1);\">返回</a>");
               // header('refresh :0;url=404.html');
            }
        }else{
            	echo "<script>
            	        alert('验证码错误！');
            	        javascript:history.back(-1);
            	    </script>";
        }
   }else{
       echo "<h1>post非法登录!</h1><a href=\"javascript:history.back(-1);\">返回</a>";
   }
?>