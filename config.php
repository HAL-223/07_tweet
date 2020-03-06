<?php
// 設定ファイル
// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=mysql;dbname=camp_tweet;charset=utf8');
define('DB_USER', 'admin_user');
define('DB_PASSWORD', '1234');

// Noticeというエラーを非表示にする
error_reporting(E_ALL & ~E_NOTICE);