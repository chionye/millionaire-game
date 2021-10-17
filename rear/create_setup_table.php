<?php

require_once "get_role_func.php" ;



$query26 = "create table if not exists company_info (

id int unsigned not null auto_increment,

primary key (id),

name varchar(250),

logo_ref varchar(250),

website varchar(250),

sms_sender varchar(250),

email varchar(250),

email_sender varchar(250),

sms_acount_name varchar(250),

sms_acount_password varchar(250),

return_policy text,

sale_message varchar(255),

staff_prefix varchar(50) 

)";

$db->query($query26) or die($db->error);

echo "company_info table created"."<br/>";

$query="replace into company_info(id,name) values ('1','')";

$db->query($query) or die($db->error);

echo "Company Info inserted"."<br/>";



$query26 = "create table if not exists content (

id int unsigned not null auto_increment,

primary key (id),

title varchar(250),

body longtext,

image varchar(250),

view varchar(250),

category varchar(250),

industry varchar(250),

business varchar(250),

parent varchar(250),

type text,

auto varchar(255),

status int(11),

date_uploaded datetime,

date_updated datetime
)";

$db->query($query26) or die($db->error);

echo "content table created"."<br/>";






$query21 = "create table if not exists roles (

roleid int unsigned not null auto_increment,

primary key (roleid),

transcid varchar(50),

rolename varchar(255),

roledesc text,

clientid int

)";

$db->query($query21) or die($db->error);

echo "roles created"."<br/>";





$query2 = "create table if not exists accesslog (

transcid varchar(50),

user  varchar(255)  ,

logindate	datetime, 

logoutdate	datetime,

clientid int

)";

$db->query($query2) or die($db->error);

echo "Access Log table created"."<br/>";






$clientid=1;

$default_role= get_default_role();

$query="replace into roles(roleid,transcid,clientid,rolename,roledesc) values ('1',concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )), '$clientid','Administrator','$default_role')";

$db->query($query) or die($db->error);

echo "Default Role inserted"."<br/>";



	//$db->query("drop table users") or die($db->error);

	

	$query6 = "create table if not exists users (

		  id int unsigned not null auto_increment,

		  primary key (id),

		  transcid varchar(50),

		  picture_ref varchar(100),

		  
		  name varchar(255),

		  

		  phone varchar(70),

		  
		  email varchar(70),

		 

		  username varchar(50),

		password varchar(50),

		

		roleId int,

		accessLevel int

		
		  )";

	$db->query($query6) or die($db->error);

	echo "users created"."<br/>";



	$query6="replace into users(id,transcid,username,password,name,roleid,accesslevel) value ('1',concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )),'administrator','email@admin','administrator','1','3')";

	$db->query($query6) or die($db->error);

	echo "administrator inserted successfully"."<br/>";

?>