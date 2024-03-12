<?php include $_SERVER['DOCUMENT_ROOT']."/board/db.php";?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/board/style.css" />
</head>
<body>
<div id="board_area"> 
	<h1>로그인</h1>
	<h4>로그인 페이지 입니다.</h4>
		<span id="mem_info">
			<?php
				if(isset($_SESSION['userid'])){ //세션 userid가 있으면 페이지를 보여줍니다
					// lo_point변수에 sql쿼리결과를 저장
					$sql = mq("select * from member where userid='".$_SESSION['userid']."'");
					$lo_point = $sql->fetch_array();
			?>
			<?php echo $_SESSION['userid']; ?>님 어서오세요. &nbsp;&nbsp;&nbsp;<a href="/board/logout.php">로그아웃</a><br />
			<?php }else{ ?><!--세션 userid체크해서 세션값 없으면 로그인 폼 표시 -->
				<form action="/board/login_ok.php" method="post">
					<ul>
						<li><input type="text" name="userid" placeholder="아이디" required /></li>
						<li><input type="text" name="userpw" placeholder="비밀번호" required /></li>
						<li><input type="submit" value="로그인"></li>
						<li> <a href='/board/join_form.php'>회원가입</a></li>
					</ul>
				</form>
			<?php } ?>
		</span>
    </div>
  </div>
</body>
</html>