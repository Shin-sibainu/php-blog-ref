<?php

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "blog");

//データベース接続
try {
    $pdo = new PDO('mysql:charset=UTF8;dbname=' . DBNAME . ';host=' . DBHOST, DBUSER, DBPASS);
} catch (PDOException $e) {
    //接続エラーのときエラー内容を取得する
    $error_message[] = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2チャンネル掲示板</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <!-- TODO:INCLUDE HEADER HERE -->
        <?php include("app/includes/header.php"); ?>

        <!-- メッセージ送信成功時 -->
        <?php if (!empty($success_message)) : ?>
            <p class="success_message"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- バリデーションチェック時 -->
        <?php if (!empty($error_message)) : ?>
            <ul class="errorComment">
                <?php foreach ($error_message as $value) : ?>
                    <li><?php echo $value; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="threadWrapper">
            <div class="childWrapper">
                <div class="threadTitle">
                    <span>【タイトル】</span>
                    <h1>２チャンネル作ってみたｗｗｗ</h1>
                </div>
                <section>
                    <?php if (!empty($message_array)) : ?>
                        <?php foreach ($message_array as $value) : ?>
                            <article>
                                <div class="wrapper">
                                    <div class="nameArea">
                                        <span>名前：</span>
                                        <p class="username"><?php echo $value['username'] ?></p>
                                        <time>：<?php echo date('Y/m/d H:i', strtotime($value['post_date'])); ?></time>
                                    </div>
                                    <p class="comment"><?php echo $value['comment']; ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
                <form method="POST" action="" class="formWrapper">
                    <div>
                        <input type="submit" value="書き込む" name="submitButton">
                        <label for="usernameLabel">名前：</label>
                        <input type="text" name="username" value="<?php if (!empty($_SESSION['username'])) {
                                                                        echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                                                                    }    ?>">
                    </div>
                    <div>
                        <textarea name="comment" class="commentTextArea"></textarea>
                    </div>
                </form>
            </div>
        </div>

        <div class="newThreadWrapper">
            <div class="newChildThreadWrapper">
                <input type="submit" value="新規スレッド書き込み">
            </div>
        </div>
</body>

</html>