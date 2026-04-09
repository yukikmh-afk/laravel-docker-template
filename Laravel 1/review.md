# Laravel Lesson レビュー①

## Todo一覧機能

### Todoモデルのallメソッドで実行しているSQLは何か
 - select * from todos;
 - app/ Todo.php内Modelクラスを継承したTodoクラスにて、$tables='todos'でテーブルを指定

### Todoモデルのallメソッドの返り値は何か
 - todosテーブルのフィールドをkeyとした二次元連想配列

### 配列の代わりにCollectionクラスを使用するメリットは
 - 配列同様１つの変数に複数のデータを格納できる
 - 配列以上に格納しているデータの操作、並び替え(sortBy())、フィルター(where())などが容易
 - 配列を拡張し様々な操作やメソッドが用意されている

### view関数の第1・第2引数の指定と何をしているか
 - 第一引数・・・表示するblade.phpファイル
 - 第二引数・・・viewに引き渡したデータを連想配列で引き渡す(key = view側で使う際の名前 value = 引き渡したい値)

### index.blade.phpの$todos・$todoに代入されているものは何か
 - TodoController->index()内で呼び出しているview関数の第二引数
 - Modelを使用して取得したtodosテーブルの中身を連想配列でforech文の形で１個ずつ順番に$todoに格納

## Todo作成機能
 - view(resouces/views/todo/create.blade.php)。formタグでアクションにtodoクラスのstoreメソッドの呼び出し
 - 引数Requestインスタンスで呼び出し元(create.blade.php)でpostされたデータが格納
 - Requestインスタンスのallメソッドでpostされたデータを全て取得
 - DB操作のModelクラスを継承しているTodoクラスのインスタンスを作成
 - Modelインスタンス->fill(追加したいデータ)でデータ追加配列を使用して複数のデータをまとめて更新できる)
 - Modelインスタンス->save()fillで保存されたデータを実行
### Requestクラスのallメソッドは何をしているか
 - postされたデータが複数ある場合もある。postされたデータの全件取得

### fillメソッドは何をしているか
 - fillメソッドでDBに追加したいデータを一時期的に保存

### $fillableは何のために設定しているか
 - セキュリティ保守。ユーザーが勝手にIDやNameなどを書き換えないようにcontentのみの変更を許可している

### saveメソッドで実行しているSQLは何か
 - fillメソッドで保存された追加したいデータを実際に追加する
 - INSERT INTO 'todos' ($inputs);
 - またfind()などでDBから値を取得したりするとsave()の呼び出しは更新(UPDATE)になる

### redirect()->route()は何をしているか
 - 指定したページへの遷移。
 - view()は指定されたbladeの中身を表示する処理でURLなどが変わらない
 - redirect->route()はページを遷移するためURLが変わる
 - view()・・・主にデータの表示、フォームの表示
 - route()・・・データの保存、更新、削除後
 - 保存した後にユーザーがF5などで画面更新するとデータの二重送信が行われるリスクあり

## その他

### テーブル構成をマイグレーションファイルで管理するメリット
 - マイグレーション・・・テーブル作成を担うファイル
   マイグレーションファイルを共有することで複数の人間で同じテーブルを用意することができる

### マイグレーションファイルのup()、down()は何のコマンドを実行した時に呼び出されるのか
 - up・・・DBに新しくデータを追加、更新する際に呼び出される　php artisan migrateコマンド実行時など
 - down・・・DBからデータを削除する際に呼び出される php artisan migrate:rollbackコマンド実行時など

### Seederクラスの役割は何か
 - シーダー・・・レコードの作成を担うファイル
 - マイグレーション同様、シーダーファイルを共有することで複数の環境で同じデータを用意することができる

### route関数の引数・返り値・使用するメリット
 - route()関数のことかredirect->route()のことか曖昧なため両方記述
 - route()
  - 引数・・・表示するrouteの名前
  - 返り値・・・引数で指定したrouteのURL(String型)
  - メリット・・・URLを作成する関数。view内でURLの記述をする際に使用する。
    routes/web.phpで名前付きルートを定義できる。URLの変更時などに容易に対応できる
 - redirect->route()
  - 引数・・・遷移するrouteの名前
  - 返り値・・・RedirectResponsインスタンス。遷移先URLなどを格納
  - メリット・・・ページの遷移。view()では画面更新などが行われるとデータの二重送信が行われるリスクがあるため、ページを遷移して防止する

### @extends・@section・@yieldの関係性とbladeを分割するメリット
 - @yield・・・ここに@sectionを入れる
 - @section・・・@section ~ @endsectionの記述を@yieldに挿入する
 - @extends・・・指定したファイルの読込
 - メリット・・・複数のviewで共通する記述の使い回しが可能。記述ミスの防止や効率化

### @csrfは何のための記述か
 - csrfの防止
   偽装サイトなどからのアクセスの防止。アクセストークンの自動生成
### {{ }}とは何の省略系か
 - php echoの省略
   <?php echo $hoge; ?> を省略し{{$hoge}}
