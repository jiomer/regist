<?php 
    //导入数据库
    include('conn.php');
    //查询
    $sql='select * from user limit 0,5';
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0) {
        
       echo ' <table border="1px" cellspacing="0" cellpadding="0" width=300>';
       echo '	<tr><th>uid</th><th>姓名</th><th>email</th><th>regTime</th></tr>';
       while($row=mysqli_fetch_assoc($result)) {
        echo "<tr><th>".$row['uid']."</th><th>".$row['username']."</th><th>".$row['email']."</th><th>".$row['reg_date']."</th></tr>";
        }
       echo '	</table>';
      
    }
?>