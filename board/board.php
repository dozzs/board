<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db.php"; ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/board/style.css">
</head>
<body>
<div id="login_btn">
  <a href="/board/login.php"><button>로그인</button></a>
</div>
<div id="board_title">
<h1>DOYEON</h1>
</div>
<div id="board_area"> 
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
        $query = $db->query('select count(*) as cnt from board;');
        $cnt = $query->fetch_array(MYSQLI_NUM);

        // board테이블에서 idx를 기준으로 내림차순해서 5개까지 표시
        $i = $cnt[0];
          $sql = mq("select * from board order by idx desc limit 0,5"); 
            while($board = $sql->fetch_array())
            {
              //title변수에 DB에서 가져온 title을 선택
              $title=$board["title"]; 
              if(strlen($title)>30)
              { 
                //title이 30을 넘어서면 ...표시
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $i--; ?></td>
          <td width="500"><?php 
        $lockimg = "<img src='/board/lock.png' alt='lock' title='lock' width='20' height='20' />";
        if($board['lock_post']=="1")
          { ?><a href='/board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
            }else{  ?>
        <a href='/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="write_btn">
      <a href="/board/writer.php"><button>글쓰기</button></a>
    </div>
  </div>
</body>
</html>