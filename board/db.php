<?php
ini_set('display_errors', 0);
error_reporting(0);

    // 데이터베이스 연결 정보 설정
    $host = "localhost";    // MySQL 호스트 이름
    $user = "admin";     // MySQL 계정 아이디
    $pw = "password";       // MySQL 계정 비밀번호
    $dbName = "board"; // MySQL 데이터베이스 이름

    // MySQL 데이터베이스 연결
    $db = new mysqli($host, $user, $pw, $dbName);
    $db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
