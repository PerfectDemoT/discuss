<?php
    
    //header(Content-type:text/html;charset=utf-8) ;
    //获取用户名显示
    $USER = $_COOKIE['USER'] ;
    if(!$USER){
        echo "<script>alert('请先登录');
                    window.location.href='login.php';</script>" ;
    }
    //设置中国时区
    date_default_timezone_set('PRC');
    //1.接受表单传递过来的数据
    $title = $_POST['title'] ;
    $content = $_POST['content'] ;
    $addtime = date("Y-m-d H:i:s");
    
    //2.进行验证
   // if($title=="" || $content==""){
     //   echo "<script>alert('标题或内容不能为空') ;
       //     history.go(-1)</script>" ;
   // }
    
    //3.把数据提交到数据库
    //链接数据库
    $conn = mysqli_connect('localhost' , 'root' , '' , 'db1') ;
    if(!$conn){
        echo" <script>alert('数据库连接失败，请联系网站管理员');
                history.go(-1)</script>" ;
    }
    //设置编码
    mysqli_query($conn, "SET NAMES 'utf8'");
    //准备将其插入sql语句
    $message = "insert into messages values ('' , '$title' , '$content' , '$addtime' , '$USER')" ;
    
    $usermessageadd = "update users set message_num=message_num+'1' where user_name='{$USER}'" ;
    if(!mysqli_query($conn, $usermessageadd)){
        echo" <script>alert('数据库添加失败，请联系网站管理员');
                history.go(-1)</script>" ;
    }
    else if(!mysqli_query($conn , $message)){
        echo" <script>alert('数据库添加失败，请联系网站管理员');
                history.go(-1)</script>" ;
    }
    else{
        //添加成功之后自动返回到首页
        
        //实验性用API接口验证机器人
       // $url = "http://api.qingyunke.com/api.php?key=free&appid=0&msg='$title'" ;
        //$returnstr = $_GET['$url'] ;
        //发送冰请求接口
       // $contentstr =$url->request($url , false) ;
        //处理返回值
        //$contentstr = json_decode($contentstr) ;
        //$contentstr = $returnstr->content ;
        //echo "<script> alert('$contentstr');</script>" ;
        
        
        
        
        echo"<script> alert('发布成功！')  ;
                window.location.href = 'index.php'</script>" ;
    }
?>