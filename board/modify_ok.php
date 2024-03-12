<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

$bno = (int)$_GET['idx'];
$username = addslashes($_POST['name']);
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$sql = mq("update board set name='".$username."',pw='".$userpw."',title='".$title."',content='".$content."' where idx='".$bno."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=read.php?idx=<?php echo $bno; ?>">
