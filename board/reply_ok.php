<?php
	include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

    $bno = (int)$_GET['idx'];
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    
    if($bno && $_POST['dat_user'] && $userpw && $_POST['content']){
        $_POST['content'] = addslashes($_POST['content']);
        $_POST['dat_user'] = addslashes($_POST['dat_user']);

        $sql = mq("insert into reply(con_num,name,pw,content) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')");
        echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='/board/read.php?idx=$bno';</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
	
?>
