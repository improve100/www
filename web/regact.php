<?php

/*
本页面: regact.php
作用: 接收POST数据, 并检验$_POST的合法性
然后连接数据库,并提交入库.

*/


// 1: 收取$_POST数据

$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$msg = trim($_POST['msg']);

echo $name.'<br/>';
echo $phone.'<br/>';
echo $email.'<br/>';
echo $msg.'<br/>';

// 2:判断姓名,性别,经验,学历是否填写.
if($name=='') {
    echo 'name is null';
    exit;
}
if($phone=='') {
    echo 'phone is null';
    exit;
}

if(!$email) {
    echo 'email is empty';
    exit;
}
if(!$msg) {
    echo 'msg is empty';
    exit;
}

$email += 0;


// 3:连接数据误时 ,拼凑$sql语句

$conn = mysql_connect('localhost','a0309152220','48387184');

if(!$conn) {
    echo 'connect err<br />';
    exit;
}

$sql = 'use a0309152220';
$rs = mysql_query($sql,$conn);

if(!$rs) {
    echo 'select table fail<br />';
    echo mysql_error($conn);
    exit;
}


$sql = 'set names utf8';
mysql_query($sql,$conn);



// 拼接insert 语句.
$sql = "insert into custommsg (name,phone,email,msg) values ('$name','$phone','$email','$msg')";


// 4: 实例化mysql,得到对象.
// 先跳过.

// 5: 调用mysql的query方法,
$rs = mysql_query($sql,$conn);

// 6: 判断执行的结果, 作相应提示.
if($rs) {
    echo 'send info success,id:',mysql_insert_id($conn);
} else {
    echo 'querry fail<br />',mysql_error();
}



