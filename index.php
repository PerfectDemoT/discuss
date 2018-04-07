<?php

    //获取用户名显示
    $USER = $_COOKIE['USER'] ;
    if(!$USER){
        echo "<script>alert('请先登录');
                window.location.href='login.php';</script>" ;
    }

    //进行分页准备
    //看是否获取到页面标号$page
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
    //设置每页最大显示数
    $pagesize = 6 ;
    //然后计算偏移量
    $pageset = ($page-1)*$pagesize ;

    //链接数据库
    $conn = mysqli_connect('localhost' , 'root' , '' , 'db1') ;
    if(!$conn){
        echo" <script>alert('数据库连接失败，请联系网站管理员');
                    history.go(-1)</script>" ;
    }
    //设置编码
    mysqli_query($conn, "SET NAMES 'utf8'");
    
    //获取数据
    //用limit偏移量来控制显示数量，进行分页
    $sql = "select * from messages order by id desc limit $pageset,$pagesize" ;
    $res = mysqli_query($conn, $sql) ;
    
    $max_sql = "select * from messages" ;
    $max_res = mysqli_query($conn, $max_sql) ;
    $total = mysqli_num_rows($max_res) ;
    $pagemax = ceil($total/$pagesize) ;
    
     //定义一个空数组，用来储存全部数据
    $rows = array() ;
    
    while($row = mysqli_fetch_assoc($res)){
        //array_unshift($rows , $row) ; //让最新的数据排在更前面
        $rows[] = $row ;
    }
    //现在所有的数据已经在rows[]中了
    
    //获取发言前十名排行榜
    $rank = "select * from users order by message_num desc limit 10" ;
    $RANK = mysqli_query($conn, $rank) ;
    $rank_rows = array() ;
    while($row_rank = mysqli_fetch_assoc($RANK)){
        $rank_rows[] = $row_rank ;
    }
    //现在排行榜前十 的数据已经在$rank_rows[]中了
    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>小天论坛</title>
   	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
   	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
   	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div calss="container">
		<div class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				</div>
				
				<div class="collpse navcar-collapse" id="navbar-collapse1">
					<ul class="navbar-nav nav">
					
						<a class="navbar-brand href="index.html">
							<!-- 链接一个图片作为图标 -->
							<img src="brand.png" style="width: 40px; height: 28px ;">
						</a>
						
						<li class="active">
							<a href="index.php">留言板</a>
						</li>
					
						<li><a href="add.php">发布留言</a></li>
	
						<li><a href="mymessages.php">查看我的留言</a></li>
						
						<li>
							<a href="https://www.jiumodiary.com/" target="_blank">搜书引擎</a>
						</li>
					</ul>
			
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="mymessages.php">欢迎访问:<?php echo $USER ?></a>
						</li>
						<li>
							<a href="login.php">注销</a>
						</li>
					</ul>
					
				</div>
			</div><!-- container-fluid -->
		</div><!-- navbar-inverse -->
	
		<div calss="row">
		
			<div class="col-md-3 col-md-offset-1">
				<div class="panel panel-success">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-star"></span>发言排行
					</div>
					<div class="panel-body">
							<?php foreach ($rank_rows as $k):?>
    							<div class="alert alert-success" role="alert">
    								<strong><?php echo "{$k['user_name']}" ;?></strong>
    							</div>
							<?php endforeach;?>
					</div>
				</div>
			</div>
			
			<div class="col-md-7">
			<!-- 下面是将数据库中的数据进行显示 -->
				<?php foreach($rows as $v):?>
    				<div class="panel panel-info">
    					<div class="panel-heading">
    						<span class="glyphicon glyphicon-star"></span>
    						<strong><?php echo"{$v['title']}";?></strong>
    					</div>
    					<div class="panel-body" style="height: 120px;">
    						<?php echo"{$v['content']}";?>
    					</div>
    					<div class="panel-footer">
    						<?php echo"{$v['addtime']}";?>
    					</div>
    				</div>
				<?php endforeach;?> 

				
				<ul class="pager">
    				<li class="previous"><a href="index.php?page=1">&larr;首页</a></li>
    				<li><a href="index.php?page=<?php echo $page<=1 ? 1 : $page-1 ;?>">上一页</a></li>
    				<li><a href="index.php?page=<?php echo $page>=$pagemax ? $pagemax : $page+1 ;?>">下一页</a></li>
    				<li class="next"><a href="index.php?page=<?php echo $pagemax?>">&rarr;尾页</a></li>
				</ul>
				
			</div>
			
			
			
		</div>
		
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-4">
                        <span>Copyright &copy; 
                        	 <script type="text/javascript">
                                copyright=new Date();//取得当前的日期
                                update=copyright.getFullYear();//取得当前的年份
                                document.write(update);//update为自动更新的年份
                            </script>
                        </span> |
                        <span>PerfectDemoT</span> |
                        <span><a href="mailto:lurizhongtian@163.com">联系我们</a></span> |
                        
                        <span><a href="#" data-toggle="modal" data-target="#myModal">打赏小萌新</a></span>
                        
                        <!-- Modal -->
            			<div class="modal fade text-center" id="myModal" tabindex="-1"  aria-labelledby="myModalLabel">
            			  <div class="modal-dialog modal-sm" >
            				<div class="modal-content">
            				  <div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            					<h4 class="modal-title" id="myModalLabel">扫码打赏</h4>
            				  </div>
            				  <div class="modal-body">
            					<form class="navbar-form ">
            						<h4>微信</h4>
            						<img alt="微信二维码" src="weixin.png">
            						<h4>支付宝</h4>
            						<img alt="支付宝二维码" src="zhifubao.png">
            					</form>
            				  </div>
            				  <div class="modal-footer">
            					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            				  </div>
            				</div>
            			  </div>
            			</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
</body>

</html>