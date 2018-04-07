<?php
    //获取用户名显示
    $USER = $_COOKIE['USER'] ;
    if(!$USER){
        echo "<script>alert('请先登录');
                window.location.href='login.php';</script>" ;
    }
    
    //链接数据库
    $conn = mysqli_connect('localhost' , 'root' , '' , 'db1') ;
    if(!$conn){
        echo" <script>alert('数据库连接失败，请联系网站管理员');
                    history.go(-1)</script>" ;
    }
    //设置编码
    mysqli_query($conn, "SET NAMES 'utf8'");
    
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
						
						<li>
							<a href="index.php">留言板</a>
						</li>
					
						<li class="active"><a href="#">发布留言</a></li>
	
						<li><a href="mymessages.php">查看我的留言</a></li>
						
						<li><a href="https://www.jiumodiary.com/" target="_blank">搜书引擎</a></li>
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
				<form action="insert.php" method="post">
					<div class="form-group">
						<label>留言主题</label>
						<input type="text" class="form-control" name="title" required />
					</div>
					<div calss="form-group">
						<label>留言内容</label>
						<textarea class="form-control" rows="10" name="content" required></textarea>
					</div>
					
						<input type="submit" class="btn btn-primary pull-right" value="发表" />
					
				</form>		
			</div>
			
		</div><div class="copyright">
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