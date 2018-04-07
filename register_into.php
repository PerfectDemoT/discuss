<?php

    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $email = $_POST['email'] ;
    
    $conn = mysqli_connect('localhost' , 'root' , '' , 'db1') ;
    if(!$conn){
        echo" <script>alert('数据库连接失败，请联系网站管理员');
                    history.go(-1)</script>" ;
    }
    //设置编码
    mysqli_query($conn, "SET NAMES 'utf8'");
    //开始对数据库进行用户插入
    $user = "insert into users values (default , '$username' , '$password' , '$email')" ;
    
    if(!mysqli_query($conn , $user)){//将用户名和密码插入到数据库中
        echo" <script>alert('注册失败，请联系网站管理员');
                    history.go(-1)</script>" ;
    }
    else{
        //添加成功之后自动返回到首页
        echo"<script> alert('注册成功！')  ;
                    window.location.href = 'login.php'</script>" ;
    }
?>
