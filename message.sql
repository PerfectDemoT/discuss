//建立存储留言的表
create table messages(
	id int auto_increment comment 'id',
	title varchar(20) not null comment '标题',
	content text not null comment '内容',
	addtime varchar(20) not null comment '添加时间',
	username varchar(20) not null comment '用户名' ,
	primary key(id)
)charset=utf8;




//建立用户表
create table users(
	id int auto_increment,
	user_name varchar(20) not null,
	pass_word varchar(20) not null,
	email varchar(30) not null,
	message_num int not null,
	primary key(id)
)charset=utf8;


//建立实验用户表
create table users_test(
	id int auto_increment,
	user_name varchar(20) not null,
	pass_word varchar(20) not null,
	primary key(id)
)charset=utf8;
