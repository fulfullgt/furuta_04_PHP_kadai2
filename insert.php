<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$bookname = $_POST['bookname'];
$bookurl = $_POST['bookurl'];
$bookcomment = $_POST['bookcomment'];

// 2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table(uni,bookname,bookurl,bookcomment,date)
  VALUES( NULL, :bookname, :bookurl, :bookcomment, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue('bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('bookcomment', $bookcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();


// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('location: index.php');
}
?>
