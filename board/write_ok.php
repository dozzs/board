<?php

include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

$username = addslashes($_POST['name']);
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$date = date('Y-m-d');

if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}
if($username && $userpw && $title && $content){
    $sql = mq("insert into board(name,pw,title,content,date, lock_post) values('".$username."','".$userpw."','".$title."','".$content."','".$date."','".$lo_post."')"); 
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/board/index.php';</script>";
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>
