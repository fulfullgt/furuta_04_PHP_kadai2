<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$bookname = $_POST['bookname'];
$bookurl = $_POST['bookurl'];
$bookcomment = $_POST['bookcomment'];
$uni = $_POST["uni"];
$date = $_POST["date"];


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare( "UPDATE gs_bm_table SET bookname = :bookname, bookurl = :bookurl, bookcomment = :bookcomment, date = sysdate() WHERE uni = :uni;" );


$stmt->bindValue('bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('bookcomment', $bookcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)  
$stmt->bindValue(':uni', $uni, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT


$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}