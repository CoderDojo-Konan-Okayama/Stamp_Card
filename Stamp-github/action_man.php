<?php
$mysqli = new mysqli('Your_Server_Host', 'User_Name', 'Pass_Word', 'Data_Base_Name');
$number = $_POST['number']; 
$check = $_POST['check'];
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
if($check == 'on'){
    $is_check = 1;//on =1,off=0;
}else{
    $is_check = 0;
}
$stmt = $mysqli->prepare("UPDATE admin_data SET stamp_number=? ,switch=?");
 if ($stmt) {
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('ii', $number,$is_check);
			//クエリ実行
			$stmt->execute();
			//ステートメント切断
			$stmt->close();
		}else{
			echo $mysqli->errno . $mysqli->error;
		}
$mysqli->close();
header("Location: card_manager.php");
?>