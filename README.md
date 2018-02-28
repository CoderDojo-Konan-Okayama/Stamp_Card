# Stamp Card
CoderDojo 岡山 岡南 で使用しているスタンプカードを以下の理由で電子化してしまおう、と作りました。

- 紙、インク代がもったいない。
- こちらにも、スタンプのたまっている状況を把握することができ、景品？を無駄に買い置きする必要がなくなる。
- プログラミング教室だからそのほうが割に合う（←説得力皆無。）
- 一番は、管理人代理のプログラミングの練習と、興味本位。

結果、使われなくなりましたが...

## 仕様

QRコードを読み取ると、URLを取得できる。

URLは、 `○○○○.○○/stamp_push.php/?id=oo&pass=oo` という形にしています。

わかったかもしれませんが、これを、 `$_GET` で取得し、データベースサーバーでクエリをかけて、一致したものに+１する、という簡単なプログラムです。

そして、五個たまったら、`$lap` を＋１してリセットするという...

(簡単なはずなのに時間がかなりかかったのは、サブドメインの発行をミスったからなのか、どうなのか...)

**思いっきりバグ対策も、SQLインジェクション対策もしてません。（狙われる情報もないし、基本動かないから。）**

### データベース

あまり詳しく書くのは面倒なのですが...

管理データテーブルと、ユーザーデータテーブルを作り、

- 管理は、主にスイッチや、一回に押す回数とかを記録。
- ユーザーは、その名の通り、`ID,PASS,stamp,lap` というフィールドを作っています。

### 各ファイル

コードの説明はどーでもいいから（自分で読むから）、とっとと各ファイルの役割教えろや(# ﾟДﾟ) という方に。

- stamp_push.php => Stampを押すアニメーションからデータベース操作。
- db-config.php => （未実装）データベースの情報をここに入れておいて、呼び出せば積んばがる状態にするつもり。
- card_manager.php => 管理画面本体
- action_man.php => 管理画面の「更新」ボタンクリック時の挙動。（なぜか別ファイルに入れている。謎。）
- add_user.php => ユーザーの追加が面倒になったので、パスワードの生成と、ユーザーIDの生成を一緒にして、データベースに挿入。
- /magic-master/... => CSSアニメーション
- /img/... => 画像
- /css/... => スタイルファイル

### コードの内容

＜省略＞

```php
$mysqli = new mysqli('Your_Server_Host', 'User_Name', 'Pass_Word', 'Data_Base_Name');
//Your_Server_Host=>ホスト名,User_Name=>ユーザー名,Pass_Word=>パスワード,Data_Base_Name=>データベース名 に変更。
```

### 使い方

#### スタンプを押す

`○○○○.○○/stamp_push.php/?id=oo&pass=oo` にアクセスする。

以上。

#### 管理する

管理画面を強化していこうと思いますが、今のところ未実装なので、MySQL管理ツールを使用してください。

スイッチのON/OFFは実装しています。

**あとは、コード読んで～！！ 説明する気力が...**

## 以後の予定

まずは、セキュリティを万全にして、名前・年齢を一緒に閉じ込めて、なんなら、いま帰りましたメール的なものも入れて...

「夢」は広がる一方です。

## 重要

**結構実用できるかもですが、セキュリティ対策とバグ対策は皆無です。**

絶対に個人情報を含む内容を扱わないように！！！！

## Pull Request 大歓迎！！

作ったのは経験浅い中学二年ですので(;´･ω･)

是非是非！！

**Issue も大歓迎！！**

とか言っても誰もくれないし、だれもこのプログラム使わないだろう。

だって、そもそも保存用にあげてるだけ。（負け惜しみ）

**一応、使ってでた損害も、作成者は一切責任を負いません！！！！**

## LICENSE

このソースコードは、MIT ライセンスに基づき公開、配布されています。
詳しくは、LICENSE ファイルを参照ください。
