<?php
	//导入数据库
    include('conn.php');
    //获取页数和每页显示的条数
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    //计算开始的页数
    $offset = ($page - 1) * $rows;
    //查询
    $sql="select * from user limit $offset , $rows";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)>0){
        $arr = Array();
        while($row=mysqli_fetch_array($result)){
            $arr[] = $row;
        }
    
    //计算用户总数
    $count_result = mysqli_query($conn,"SELECT count(*) FROM user");
    $count_array = mysqli_fetch_array($count_result);

    $array = array();
	$array["total"] = $count_array[0];
	$array["rows"] = $arr;
    echo(json_encode($array));
        
    }
    
// 	$sql='select uid,username,email,reg_date from user';
//     $result=mysqli_query($conn, $sql);
// 	 if(mysqli_num_rows($result)>0) {
// 	    $arr = Array();
	    
// 	    while($row=mysqli_fetch_assoc($result)){  //一行一行的取出结果集中的行记录
// 		$arr[]=$row;  //将行赋值给数组
// 	    } 
// 	    //接受数据是JSON（XML / JSON）
// 	    echo(json_encode($arr));
// 	 }
	
?>