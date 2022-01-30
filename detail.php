<?php
//1.外部ファイル読み込みしてDB接続
require_once('funcs.php');
$pdo = db_conn();

//2.対象のUNIを取得
$uni = $_GET['uni'];

//3．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE uni=:uni;");
$stmt->bindValue(':uni',$uni,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク更新フォーム</legend>
                <label>本のタイトル：<input type="text" name="bookname" value="<?= $result['bookname'] ?>"></label><br>
                <label>本のURL：<input type="text" name="bookurl" value="<?= $result['bookurl'] ?>"></label><br>
                <label><textarea name="bookcomment" rows="4" cols="40"><?= $result['bookcomment'] ?></textarea></label><br>
                <input type="hidden" name="uni" value="<?= $result['uni']?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>
