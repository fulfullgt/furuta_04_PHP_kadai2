<?php
//selsect.phpから処理を持ってくる
//1.対象のIDを取得
$uni= $_GET['uni'];

//2.DB接続します
require_once('funcs.php');
$pdo = db_conn();

//3.削除SQLを作成
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE uni=:uni;");
$stmt->bindValue(':uni',$uni,PDO::PARAM_INT);
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}





