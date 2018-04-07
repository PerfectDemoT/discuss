<?php
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    
    //链接数据库
    $conn = mysqli_connect('localhost' , 'root' , '' , 'db1') ;
    if(!$conn){
        echo" <script>alert('数据库连接失败，请联系网站管理员');
                history.go(-1)</script>" ;
    }
    //设置编码
    mysqli_query($conn, "SET NAMES 'utf8'");
    
    $sql = "select * from users where user_name='{$username}' and pass_word='{$password}'" ;
    $res = mysqli_query($conn, $sql) ; //这里如果有符合的用户名和密码，则已经取出一条记录
    
    //看取出了多少条记录，如果为0，则用户名或者密码错误
    $row = mysqli_num_rows($res) ;
    if(!$row){
        echo "<script>alert('用户名或密码错误，请检查') ;
                history.go(-1)</script>" ;
    }
    else{
        setcookie('USER' , $username) ;
        echo"<script>window.location.href='index.php'</script>";
    }
?>