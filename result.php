<?php
    header('X-Frame-Options: SAMEORIGIN');
    // URLの復号化
    $method = 'AES-256-CTR';
    $key = '****';
    $iv = '****';
    $decrypt_score = openssl_decrypt(
        $_GET["score"],
        $method,
        $key,
        0,
        $iv
    );
    $explode_score[] = explode("-", $decrypt_score);
    foreach($explode_score as $score){
    }
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<title>結果</title>
</head>
<body>
    <h1>日常生活演技尺度　結果</h1>
    <p>くわしい解釈の仕方は<a href="https://www.jstage.jst.go.jp/article/personality/20/2/20_84/_article/-char/ja/" target="_blank">こちら</a>を参照してください(外部サイトに飛びます)。</p>
    <hr>

    <div class="subscale">
        <h2>日常生活演技行動尺度</h2>
        <p>行動ごとの演技頻度を測る下位尺度です。</p>
        <h3>好印象演技</h3>
        <p><?= $score[0] ?>点</p>
        <h3>調和的演技</h3>
        <p><?= $score[1] ?>点</p>
    </div>

    <div class="subscale">
        <h2>日常生活演技動機尺度</h2>
        <p>動機ごとの演技頻度を測る下位尺度です。</p>
        <h3>関係維持</h3>
        <p><?= $score[2] ?>点</p>
        <h3>実利</h3>
        <p><?= $score[3] ?>点</p>
        <h3>関係獲得</h3>
        <p><?= $score[4] ?>点</p>
    </div>

    <div class="subscale">
        <h2>日常生活演技場面尺度</h2>
        <p>場面ごとの演技頻度を測る下位尺度です。</p>
        <h3>困難状況</h3>
        <p><?= $score[5] ?>点</p>
        <h3>他者依存</h3>
        <p><?= $score[6] ?>点</p>
    </div>

    <button type="button" onclick="ADLS.php">戻る</button>

</body>
</html>
