<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if(strstr($user_agent, 'Windows NT') !== FALSE){
    $margin_top = '-8px';
} else {
    $margin_top = '-2px';
}

include  $_SERVER['DOCUMENT_ROOT']."/board/db.php";
?>
<!doctype html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="icon" type="image/png" sizes="32x32" href="./favicon.ico">
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/board/style.css">
<style>
  form {
    top : -30px;
    display: flex;
    align-items: center;
    margin: 20px 0;
  }

  input[type="text"] {
    width: 450px;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    margin-right: 10px;
  }

  button[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #19ce60;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 9px;
  }
  #logo {
    float: left;
    font-size: 37px;
    margin-top: <?php echo $margin_top; ?>;
    margin-left: 55px;
  }
  .stitch {
    position: absolute;
    z-index: 99999;
  }
</style>
</head>
<body>
<p class="stitch">
  <img src='/board/stitch.gif' alt='scrump' title='scrump' width='180' height='180' />
</p>
<script>
    setInterval(() => {
        var stitch = document.querySelector('.stitch');
        var x = 0;
        var y = 0;

        x = parseInt(Math.random() * (window.outerWidth-300));
        y = parseInt(Math.random() * (window.outerHeight-300));
        
        stitch.style.left = x + 'px';
        stitch.style.top = y + 'px';
    }, 350);
</script>

<div id="board_title" style="display: block;">
  <span id="logo">DOYEON</span>
<form action="search.php" method="get">
  <input type="text" name="q" placeholder="검색어를 입력하세요">
  <button type="submit">검색</button>
</form>
</div>
<div id="board_area"> 
    <table class="list-ca">
      <thead>
          <tr>
          <th width="1000">
            <div class = "ca">
            <a href="/board/index.php">게시판</a>
            <a href="/board/writer.php">글쓰기</a>
            </div>
          </th>
          
            </tr>
        </thead>
    </table>
    <table class="list-table">
      <thead>
          <tr>
                <th width="700">제목</th>
                <th width="300" rowspan="3">Login</th>
            </tr>
        </thead>
        <?php
        $query = $db->query('select count(*) as cnt from board;');
        $cnt = $query->fetch_array(MYSQLI_NUM);

        // board테이블에서 idx를 기준으로 내림차순해서 5개까지 표시
        $i = $cnt[0];
        $ccnt = 0;
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
            $title = htmlspecialchars($title);
        ?>
      <tbody>
        <tr>
          <td width="700"><?php 
          
        $lockimg = "<img src='/board/lock.png' alt='lock' title='lock' width='20' height='20' />";
        if($board['lock_post']=="1")
          { ?><a href='/board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
            }else{  ?>
        <a href='/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?></a></td>
        <!--<td width="300"><table class="login_btn"><a href="/board/login.php"><button>로그인</button></a></table></td>-->
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
