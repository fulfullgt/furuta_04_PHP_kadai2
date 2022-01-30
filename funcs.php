<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

// DB接続関数
function db_conn(){
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=fulfull_book_db;charset=utf8;host=mysql57.fulfull.sakura.ne.jp','fulfull','Furu-1549');
        return $pdo;   
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }

}

// エラー関数
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
    header("Location: " . $file_name );
    exit();
}




