<?php
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'gameinfopage_stp', 'djknpassdb', 'gameinfopage_dbstamp');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
for ($i=0;$i<25;$i++){
    $pass = ($i+2) * 2 ^2 *111111;
    $id = $i * 10000000;
    $stmt = $mysqli->prepare("INSERT INTO stamp_data (id,pass) VALUES (?,?);");
        if ($stmt) {
		    	//プレースホルダへ実際の値を設定する
		    	$stmt->bind_param('ss',$id,$pass);
		    	//クエリ実行
		    	$stmt->execute();
		    	//ステートメント切断
                echo "Success!!!(". $i .")";
			    $stmt->close();
		}else{
			    echo $mysqli->errno . $mysqli->error;
		}
}
?>