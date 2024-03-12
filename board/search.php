<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db.php";

// 검색어가 입력된 경우
if (isset($_GET['q'])) {
  // 검색어에서 앞뒤 공백 제거
  $query = addslashes(trim($_GET['q']));

  // 검색어가 비어있는 경우
  if ($query == "") {
    echo "검색어를 입력해주세요.";
    exit;
  }

  // 검색 쿼리 작성
  $sql = "SELECT * FROM board WHERE title LIKE '%{$query}%' ORDER BY idx DESC";

  // 검색 쿼리 실행
  $result = mq($sql);

  // 검색 결과 출력
  echo "<h3>검색 결과</h3>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $row['title'] = htmlspecialchars($row['title']);
      echo "<p><a href='read.php?idx={$row['idx']}'>{$row['title']}</a></p>";
    }
  } else {
    echo "검색 결과가 없습니다.";
  }
}

// 검색어가 입력되지 않은 경우
else {
  echo "검색어를 입력해주세요.";
}
?>
