<html>
    <head>
        <title>Stamp Card Admin -CoderDojo oooo</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="/css/admin_style.css">
    </head>
    <body>
        <div class="hit-the-floor">
            <h1>スタンプカード管理画面</h1>
            <h2>値を変更したい場合は、~~まで。</h2>
            <h3>電源</h3>
        </div>
        <form action="action_man.php" method="post">
        <div class="switch">
            <input type="hidden" name="foo" value="off" name="check"> 
            <input id="switch" checked type="checkbox" value="on" name="check"/>
            <label for="switch"></label>
        </div>
        <br>
        <input type="text" class="textbox" name="number" value="一回に対する個数"/>
        <input type="submit" class="sync_btn" value="更新"/>
        </form>
    </body>
</html>