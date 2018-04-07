<?php
?>

<?php
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>小天论坛登录</title>
   	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
   	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
   	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    <body>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6 text-center col-md-offset-3">
                	<div class="jumbotron">
                    	<div class="panel panel-primary">
                    		<div class="panel-heading">
                    			<h2>小天论坛</h2>
                    			<h2>用户登录</h2>
                    		</div>
                    		
                    		<div class="panel-body">
                        		<form action="checklogin.php" method="post">
                        			 <div class="form-group">
                                        <label for="username">用户名</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                                     </div>
                                     <div class="form-group">
                                        <label for="password">密码</label>
                                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required />
                                     </div>
                                     <button type="submit" class="btn btn-primary">登录</button>
                                     <a class='btn btn-primary ' href="register.php">注册</a>
                        		</form>
                    		</div>  
                    	</div>
                	</div> 	
                </div>
            </div>
    	</div>
    </body>
</html>