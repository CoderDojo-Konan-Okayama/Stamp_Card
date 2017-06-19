<?php
$mysqli = new mysqli('Your_Server_Host', 'User_Name', 'Pass_Word', 'Data_Base_Name');
$user_id = $_GET['id'];
$password = $_GET['pass'];
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
$admin_sql = "SELECT switch FROM admin_data";//switch状態取得
if ($result = $mysqli->query($admin_sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
        $switch = $row['switch'];
    }
    // 結果セットを閉じる
    $result->close();
}
//以降スイッチオンの場合のみ
if ($switch == 1){
    // 完成済みのSELECT文を実行する
$sql = "SELECT stamp, lap FROM stamp_data WHERE id = '" . $user_id . "' AND pass = '" . $password . "'";//SQL文(SELECT)
if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
        $stamp = $row["stamp"];
        $lap = $row["lap"];
    }
    // 結果セットを閉じる
    $result->close();
}
if ($stamp > 4){
    $stamp = $stamp - 4;
    $lap = $lap + 1;
}else{
    $stamp = intval($stamp) + 1;
}
$stmt = $mysqli->prepare("UPDATE stamp_data SET stamp=? ,lap=? WHERE id=? AND pass=?");
		if ($stmt) {
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('iiss', $stamp,$lap,$user_id,$password);			
			//クエリ実行
			$stmt->execute();
			//ステートメント切断
			$stmt->close();
		}else{
			echo $mysqli->errno . $mysqli->error;
		}
}
//ここまで
$mysqli->close();
?>

<html>
    <!-- switchによって内容変更 !-->
        <head>
        <meta charset="utf-8"/>
        <title>Stamp Card -CoderDoj oooo</title>
        <link rel="stylesheet" href="/magic-master/magic.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <? if ($switch == 1):?>
        <div id="card">
        <img src="/img/img-back.png"/>
        <h1 class="ttl">Stamp Card</h1>
        <p class="id">ID:<?php echo $user_id; ?></p><p class="no">NO. <?php echo $lap;?></p>
        <table>
            <tr>
                <td class="box"><?php if ($stamp > 0){
                    if ($stamp == 1){
                        echo '<img src="/img/stamp.png" class="stamp magictime puffIn"/>';
                    }
                    else{
                        echo '<img src="/img/stamp.png" class="stamp"/>';
                    }
                }
                ?></td>
                <td class="box"><?php if ($stamp > 1){
                    if ($stamp == 2){
                        echo '<img src="/img/stamp.png" class="stamp magictime puffIn"/>';
                    }
                    else{
                        echo '<img src="/img/stamp.png" class="stamp"/>';
                    }
                }
                ?>
                <td class="box"><?php if ($stamp > 2){
                    if ($stamp == 3){
                        echo '<img src="/img/stamp.png" class="stamp magictime puffIn"/>';
                    }
                    else{
                        echo '<img src="/img/stamp.png" class="stamp"/>';
                    }
                }
                ?></td>
            </tr>
            <tr>
                <td class="box"><?php if ($stamp > 3){
                    if ($stamp == 4){
                        echo '<img src="/img/stamp.png" class="stamp magictime puffIn"/>';
                    }
                    else{
                        echo '<img src="/img/stamp.png" class="stamp"/>';
                    }
                }
                ?></td>
                <td class="box"><?php if ($stamp > 4){
                    if ($stamp == 5){
                        echo '<img src="/img/stamp.png" class="stamp magictime puffIn"/>';
                    }
                    else{
                        echo '<img src="/img/stamp.png" class="stamp"/>';
                    }
                }
                ?></td>
                <td class="box_empty"></td>
            </tr>
            </div>
        </table>
        <?else:?>
        <h1>電源オフ</h1>
        <?endif;?>
    </body>
    </html>