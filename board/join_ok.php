<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

$userid = addslashes($_POST['userid']);
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = addslashes($_POST['name']);

$id_check = mq("select * from member where id='{$userid}'");
	$id_check = $id_check->fetch_array();
	if($id_check !== null){
		echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
	}else{
$sql = mq("insert into member (id,pw,name) values('".$userid."','".$userpw."','".$username."')");
?>
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/board/index.php">
<?php } ?>
