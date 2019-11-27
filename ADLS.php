<?php
    header('X-Frame-Options: SAMEORIGIN');
    // チェック抜け確認
    if(isset($_POST["button"])){
        for ($i = 1; $i <= 17 ; $i++) { 
            if (!isset($_POST["q-1-$i"])) {
                $error_message[] = "①の問".$i."が入力されていません。";
            }
        }
        for ($i = 1; $i <= 22 ; $i++) { 
            if (!isset($_POST["q-2-$i"])) {
                $error_message[] = "②の問".$i."が入力されていません。";
            }
        }
        for ($i = 1; $i <= 21; $i++) { 
            if (!isset($_POST["q-3-$i"])) {
                $error_message[] = "③の問".$i."が入力されていません。";
            }
        }
        // 採点とリザルトURLの生成
        if (!isset($error_message)) {
            // 日常生活演技尺度

            // 日常生活演技行動尺度
            // 好印象演技
            $factor1_score = $_POST["q-1-1"]+$_POST["q-1-2"]+$_POST["q-1-3"]+$_POST["q-1-4"]+$_POST["q-1-5"]+$_POST["q-1-6"]+$_POST["q-1-7"];
            // 調和的演技
            $factor2_score = $_POST["q-1-8"]+$_POST["q-1-9"]+$_POST["q-1-10"]+$_POST["q-1-11"]+$_POST["q-1-12"]+$_POST["q-1-13"]+$_POST["q-1-14"]+$_POST["q-1-15"]+$_POST["q-1-16"]+$_POST["q-1-17"];

            // 日常生活演技動機尺度
            // 関係維持
            $factor3_score = $_POST["q-2-1"]+$_POST["q-2-3"]+$_POST["q-2-4"]+$_POST["q-2-5"]+$_POST["q-2-6"]+$_POST["q-2-7"]+$_POST["q-2-12"]+$_POST["q-2-13"];
            // 実利
            $factor4_score = $_POST["q-2-14"]+$_POST["q-2-15"]+$_POST["q-2-16"]+$_POST["q-2-17"]+$_POST["q-2-18"]+$_POST["q-2-19"]+$_POST["q-2-20"]+$_POST["q-2-21"]+$_POST["q-2-22"];
            // 関係獲得
            $factor5_score = $_POST["q-2-2"]+$_POST["q-2-8"]+$_POST["q-2-9"]+$_POST["q-2-10"]+$_POST["q-2-11"];

            // 日常生活演技場面尺度
            // 困難状況
            $factor6_score = $_POST["q-3-4"]+$_POST["q-3-10"]+$_POST["q-3-11"]+$_POST["q-3-12"]+$_POST["q-3-13"]+$_POST["q-3-14"]+$_POST["q-3-15"]+$_POST["q-3-16"]+$_POST["q-3-17"]+$_POST["q-3-18"]+$_POST["q-3-20"];
            // 他者依存
            $factor7_score = $_POST["q-3-1"]+$_POST["q-3-2"]+$_POST["q-3-3"]+$_POST["q-3-5"]+$_POST["q-3-6"]+$_POST["q-3-7"]+$_POST["q-3-8"]+$_POST["q-3-9"]+$_POST["q-3-19"]+$_POST["q-3-21"];

            // リザルトURLの生成
            $raw_score = $factor1_score."-".$factor2_score."-".$factor3_score."-".$factor4_score."-".$factor5_score."-".$factor6_score."-".$factor7_score;
            $method_name = 'AES-256-CBC';
            $key_string = 'pass';
            // 暗号化
            $method = 'AES-256-CTR';
            $key = '****';
            $iv = '****';
            $encrypted_score = openssl_encrypt($raw_score, $method, $key, 0, $iv);
            header("location: result.php?score=$encrypted_score");
        }
        
    }
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<title>日常生活演技尺度</title>
</head>

<body>
<header>
    <h1>日常生活演技尺度をやってみよう</h1>
    <h2>日常生活演技尺度とは、日常生活の中で行っている演技パターンを理解することを目的とした尺度です。</h2>
    <p>私たちは日常生活において、場合によって演技をしている、またはしていたと思われる場合があるのではないでしょうか。</p>
    <p>以下の質問ではこのような「日常生活での演技」について質問いたします。</p>
    <p>あまり深く考えずに感じたままにお答えください。</p>
    <p>出典:定廣英典・望月聡 (2011).演技パターンに影響を与える諸要因の検討 パーソナリティ研究, 20, 84－97.</p>
</header>
<hr>

<!-- エラーメッセージ表示 -->
<?php if(isset($error_message)){foreach($error_message as $error_message){echo $error_message."<br>";}}?>

<form method="POST" action="ADLS.php">
    <h3>①あなたは以下のような演技をどのくらい行いますか。自分に最も当てはまると思うところに、チェックをつけてください。</h3>
    <div class="question">
        <p>1.優しい、いい人に見えるようにふるまう</p>
        <label><input type="radio" name="q-1-1" value="1"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-1" value="2"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-1" value="3"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-1" value="4"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-1" value="5"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-1" value="6"<?php if(isset($_POST["q-1-1"])){echo ($_POST["q-1-1"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>2.丁寧で、礼儀正しく見えるようにふるまう</p>
        <label><input type="radio" name="q-1-2" value="1"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-2" value="2"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-2" value="3"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-2" value="4"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-2" value="5"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-2" value="6"<?php if(isset($_POST["q-1-2"])){echo ($_POST["q-1-2"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">   
        <p>3.まじめに見えるようにふるまう</p>
        <label><input type="radio" name="q-1-3" value="1"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-3" value="2"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-3" value="3"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-3" value="4"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-3" value="5"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-3" value="6"<?php if(isset($_POST["q-1-3"])){echo ($_POST["q-1-3"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">   
        <p>4.明るく、気さくな人に見えるようにふるまう</p>
        <label><input type="radio" name="q-1-4" value="1"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-4" value="2"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-4" value="3"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-4" value="4"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-4" value="5"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-4" value="6"<?php if(isset($_POST["q-1-4"])){echo ($_POST["q-1-4"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">   
        <p>5.かわいく、またはかっこよく見えるようにふるまう</p>
        <label><input type="radio" name="q-1-5" value="1"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-5" value="2"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-5" value="3"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-5" value="4"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-5" value="5"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-5" value="6"<?php if(isset($_POST["q-1-5"])){echo ($_POST["q-1-5"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>6.優れた、できるひとに見えるようにふるまう</p>
        <label><input type="radio" name="q-1-6" value="1"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-6" value="2"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-6" value="3"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-6" value="4"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-6" value="5"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-6" value="6"<?php if(isset($_POST["q-1-6"])){echo ($_POST["q-1-6"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>7.自分が良く見えるようにふるまう</p>
        <label><input type="radio" name="q-1-7" value="1"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-7" value="2"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-7" value="3"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-7" value="4"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-7" value="5"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-7" value="6"<?php if(isset($_POST["q-1-7"])){echo ($_POST["q-1-7"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>8.ニコニコと愛想よくふるまう</p>
        <label><input type="radio" name="q-1-8" value="1"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-8" value="2"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-8" value="3"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-8" value="4"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-8" value="5"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-8" value="6"<?php if(isset($_POST["q-1-8"])){echo ($_POST["q-1-8"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>9.面白くなくても笑ってみせる</p>
        <label><input type="radio" name="q-1-9" value="1"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-9" value="2"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-9" value="3"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "2") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-9" value="4"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-9" value="5"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-9" value="6"<?php if(isset($_POST["q-1-9"])){echo ($_POST["q-1-9"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">
        <p>10.相手の話に興味があるようにふるまう</p>
        <label><input type="radio" name="q-1-10" value="1"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-10" value="2"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-10" value="3"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-10" value="4"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-10" value="5"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-10" value="6"<?php if(isset($_POST["q-1-10"])){echo ($_POST["q-1-10"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>    
    <div class="question">
        <p>11.盛り上がっていて、楽しそうに見えるようにふるまう</p>
        <label><input type="radio" name="q-1-11" value="1"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-11" value="2"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-11" value="3"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-11" value="4"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-11" value="5"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-11" value="6"<?php if(isset($_POST["q-1-11"])){echo ($_POST["q-1-11"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <div class="question">
        <p>12.相手に対して怒りなどのネガティブな気持ちを感じていてもきにしていないようにふるまう</p>
        <label><input type="radio" name="q-1-12" value="1"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-12" value="2"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-12" value="3"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-12" value="4"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-12" value="5"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-12" value="6"<?php if(isset($_POST["q-1-12"])){echo ($_POST["q-1-12"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <div class="question">
        <p>13.自分がいつも通りに見えるようにふるまう</p>
        <label><input type="radio" name="q-1-13" value="1"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-13" value="2"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-13" value="3"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-13" value="4"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-13" value="5"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-13" value="6"<?php if(isset($_POST["q-1-13"])){echo ($_POST["q-1-13"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <div class="question">
        <p>14.相手と自分の意見が違っていても、相手の意見に賛成しているようにふるまう</p>
        <label><input type="radio" name="q-1-14" value="1"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-14" value="2"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-14" value="3"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-14" value="4"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-14" value="5"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-14" value="6"<?php if(isset($_POST["q-1-14"])){echo ($_POST["q-1-14"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <div class="question">
        <p>15.相手の話を聞いていなかったり、わかっていなくても、理解しているようにふるまう</p>
        <label><input type="radio" name="q-1-15" value="1"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-15" value="2"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-15" value="3"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-15" value="4"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-15" value="5"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-15" value="6"<?php if(isset($_POST["q-1-15"])){echo ($_POST["q-1-15"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>      
    <div class="question">
        <p>16.その場で自分に求められていると思った役割に、合わせた演技をする</p>
        <label><input type="radio" name="q-1-16" value="1"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-16" value="2"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-16" value="3"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-16" value="4"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-16" value="5"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-16" value="6"<?php if(isset($_POST["q-1-16"])){echo ($_POST["q-1-16"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <div class="question">
        <p>17.相手へのリアクションなどを大げさにする</p>
        <label><input type="radio" name="q-1-17" value="1"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-1-17" value="2"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-1-17" value="3"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-1-17" value="4"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-1-17" value="5"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-1-17" value="6"<?php if(isset($_POST["q-1-17"])){echo ($_POST["q-1-17"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>  
    <h3>②あなたは以下のような動機によって演技することがどのくらいありますか。自分に最も当てはまると思うところにチェックをつけてください。</h3>
    <div class="question">
        <p>1.人間関係を円滑にしたいから</p>
        <label><input type="radio" name="q-2-1" value="1"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-1" value="2"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-1" value="3"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-1" value="4"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-1" value="5"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-1" value="6"<?php if(isset($_POST["q-2-1"])){echo ($_POST["q-2-1"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>2.集団の一員でいたいから</p>
        <label><input type="radio" name="q-2-2" value="1"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-2" value="2"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-2" value="3"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-2" value="4"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-2" value="5"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-2" value="6"<?php if(isset($_POST["q-2-2"])){echo ($_POST["q-2-2"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>3.人間関係をこじらせたくないから</p>
        <label><input type="radio" name="q-2-3" value="1"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-3" value="2"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-3" value="3"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-3" value="4"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-3" value="5"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-3" value="6"<?php if(isset($_POST["q-2-3"])){echo ($_POST["q-2-3"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>4.その場を楽しくしたいから</p>
        <label><input type="radio" name="q-2-4" value="1"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-4" value="2"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-4" value="3"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-4" value="4"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-4" value="5"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-4" value="6"<?php if(isset($_POST["q-2-4"])){echo ($_POST["q-2-4"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>5.相手とのトラブルを回避したいから</p>
        <label><input type="radio" name="q-2-5" value="1"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-5" value="2"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-5" value="3"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-5" value="4"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-5" value="5"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-5" value="6"<?php if(isset($_POST["q-2-5"])){echo ($_POST["q-2-5"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>6.相手を傷つけたくないから</p>
        <label><input type="radio" name="q-2-6" value="1"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-6" value="2"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-6" value="3"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-6" value="4"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-6" value="5"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-6" value="6"<?php if(isset($_POST["q-2-6"])){echo ($_POST["q-2-6"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>7.相手に心配をかけたくないから</p>
        <label><input type="radio" name="q-2-7" value="1"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-7" value="2"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-7" value="3"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-7" value="4"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-7" value="5"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-7" value="6"<?php if(isset($_POST["q-2-7"])){echo ($_POST["q-2-7"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>8.自分をよく見せたいから</p>
        <label><input type="radio" name="q-2-8" value="1"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-8" value="2"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-8" value="3"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-8" value="4"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-8" value="5"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-8" value="6"<?php if(isset($_POST["q-2-8"])){echo ($_POST["q-2-8"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>9.自分が悪く見られたくないから</p>
        <label><input type="radio" name="q-2-9" value="1"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-9" value="2"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-9" value="3"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-9" value="4"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-9" value="5"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-9" value="6"<?php if(isset($_POST["q-2-9"])){echo ($_POST["q-2-9"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>10.相手に好かれたいから</p>
        <label><input type="radio" name="q-2-10" value="1"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-10" value="2"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-10" value="3"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-10" value="4"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-10" value="5"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-10" value="6"<?php if(isset($_POST["q-2-10"])){echo ($_POST["q-2-10"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>11.相手と仲良くなりたいから</p>
        <label><input type="radio" name="q-2-11" value="1"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-11" value="2"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-11" value="3"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-11" value="4"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-11" value="5"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-11" value="6"<?php if(isset($_POST["q-2-11"])){echo ($_POST["q-2-11"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>12.その場を和やかにしたいから</p>
        <label><input type="radio" name="q-2-12" value="1"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-12" value="2"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-12" value="3"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-12" value="4"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-12" value="5"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-12" value="6"<?php if(isset($_POST["q-2-12"])){echo ($_POST["q-2-12"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>13.その場の雰囲気を悪くしたくないから</p>
        <label><input type="radio" name="q-2-13" value="1"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-13" value="2"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-13" value="3"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-13" value="4"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-13" value="5"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-13" value="6"<?php if(isset($_POST["q-2-13"])){echo ($_POST["q-2-13"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>14.そこで演技することが社会のルールだと思うから</p>
        <label><input type="radio" name="q-2-14" value="1"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-14" value="2"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-14" value="3"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-14" value="4"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-14" value="5"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-14" value="6"<?php if(isset($_POST["q-2-14"])){echo ($_POST["q-2-14"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>15.仕事や、役割の上で、その演技が求められているから</p>
        <label><input type="radio" name="q-2-15" value="1"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-15" value="2"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-15" value="3"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-15" value="4"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-15" value="5"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-15" value="6"<?php if(isset($_POST["q-2-15"])){echo ($_POST["q-2-15"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>16.相手との会話を早く終わらせたいから</p>
        <label><input type="radio" name="q-2-16" value="1"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-16" value="2"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-16" value="3"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-16" value="4"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-16" value="5"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-16" value="6"<?php if(isset($_POST["q-2-16"])){echo ($_POST["q-2-16"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>17.嫌なことを回避したかったから</p>
        <label><input type="radio" name="q-2-17" value="1"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-17" value="2"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-17" value="3"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-17" value="4"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-17" value="5"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-17" value="6"<?php if(isset($_POST["q-2-17"])){echo ($_POST["q-2-17"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>18.本当の自分を見せたくなかったから</p>
        <label><input type="radio" name="q-2-18" value="1"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-18" value="2"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-18" value="3"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-18" value="4"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-18" value="5"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-18" value="6"<?php if(isset($_POST["q-2-18"])){echo ($_POST["q-2-18"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>19.良い評価が得られれば、自分の目標を達成できるから</p>
        <label><input type="radio" name="q-2-19" value="1"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-19" value="2"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-19" value="3"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-19" value="4"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-19" value="5"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-19" value="6"<?php if(isset($_POST["q-2-19"])){echo ($_POST["q-2-19"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>20.良い関係でいれば、あとあと、相手からよくしてもらえると思ったから</p>
        <label><input type="radio" name="q-2-20" value="1"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-20" value="2"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-20" value="3"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-20" value="4"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-20" value="5"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-20" value="6"<?php if(isset($_POST["q-2-20"])){echo ($_POST["q-2-20"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>21.お金など直接的な利益を得ることができるから</p>
        <label><input type="radio" name="q-2-21" value="1"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-21" value="2"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-21" value="3"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-21" value="4"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-21" value="5"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-21" value="6"<?php if(isset($_POST["q-2-21"])){echo ($_POST["q-2-21"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <div class="question">
        <p>22.メッセージや意見などを効果的に伝えたいから</p>
        <label><input type="radio" name="q-2-22" value="1"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "1") ? " checked" : "";} ?>>まったくない</label>
        <label><input type="radio" name="q-2-22" value="2"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "2") ? " checked" : "";} ?>>ない</label>
        <label><input type="radio" name="q-2-22" value="3"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "3") ? " checked" : "";} ?>>あまりない</label>
        <label><input type="radio" name="q-2-22" value="4"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "4") ? " checked" : "";} ?>>少しある</label>
        <label><input type="radio" name="q-2-22" value="5"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "5") ? " checked" : "";} ?>>ある</label>
        <label><input type="radio" name="q-2-22" value="6"<?php if(isset($_POST["q-2-22"])){echo ($_POST["q-2-22"] == "6") ? " checked" : "";} ?>>よくある</label>
    </div>
    <h3>③あなたは以下のような場面でどのくらい演技を行いますか。自分に最も当てはまると思うところに、チェックをつけてください。</h3>
    <div class="question">  
        <p>1.好きな人といる時</p>
        <label><input type="radio" name="q-3-1" value="1"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-1" value="2"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-1" value="3"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-1" value="4"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-1" value="5"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-1" value="6"<?php if(isset($_POST["q-3-1"])){echo ($_POST["q-3-1"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>2.異性の前にいる時</p>
        <label><input type="radio" name="q-3-2" value="1"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-2" value="2"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-2" value="3"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-2" value="4"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-2" value="5"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-2" value="6"<?php if(isset($_POST["q-3-2"])){echo ($_POST["q-3-2"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>3.仲のいい人といるとき</p>
        <label><input type="radio" name="q-3-3" value="1"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-3" value="2"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-3" value="3"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-3" value="4"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-3" value="5"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-3" value="6"<?php if(isset($_POST["q-3-3"])){echo ($_POST["q-3-3"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>4.嫌いな人、苦手な人といる時</p>
        <label><input type="radio" name="q-3-4" value="1"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-4" value="2"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-4" value="3"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-4" value="4"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-4" value="5"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-4" value="6"<?php if(isset($_POST["q-3-4"])){echo ($_POST["q-3-4"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>5.あまり親しくない人といる時</p>
        <label><input type="radio" name="q-3-5" value="1"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-5" value="2"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-5" value="3"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-5" value="4"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-5" value="5"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-5" value="6"<?php if(isset($_POST["q-3-5"])){echo ($_POST["q-3-5"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>6.親といる時</p>
        <label><input type="radio" name="q-3-6" value="1"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-6" value="2"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-6" value="3"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-6" value="4"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-6" value="5"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-6" value="6"<?php if(isset($_POST["q-3-6"])){echo ($_POST["q-3-6"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>7.先輩または上司といる時</p>
        <label><input type="radio" name="q-3-7" value="1"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-7" value="2"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-7" value="3"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-7" value="4"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-7" value="5"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-7" value="6"<?php if(isset($_POST["q-3-7"])){echo ($_POST["q-3-7"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>8.立場などが、目上の人といる時</p>
        <label><input type="radio" name="q-3-8" value="1"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-8" value="2"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-8" value="3"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-8" value="4"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-8" value="5"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-8" value="6"<?php if(isset($_POST["q-3-8"])){echo ($_POST["q-3-8"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>9.後輩といる時</p>
        <label><input type="radio" name="q-3-9" value="1"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-9" value="2"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-9" value="3"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-9" value="4"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-9" value="5"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-9" value="6"<?php if(isset($_POST["q-3-9"])){echo ($_POST["q-3-9"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>10.人前で発表やプレゼンテーションをするとき</p>
        <label><input type="radio" name="q-3-10" value="1"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-10" value="2"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-10" value="3"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-10" value="4"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-10" value="5"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-10" value="6"<?php if(isset($_POST["q-3-10"])){echo ($_POST["q-3-10"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>11.アルバイトなどで仕事をしているとき</p>
        <label><input type="radio" name="q-3-11" value="1"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-11" value="2"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-11" value="3"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-11" value="4"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-11" value="5"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-11" value="6"<?php if(isset($_POST["q-3-11"])){echo ($_POST["q-3-11"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>12.落ち込んでいたり、気分がのっていない時</p>
        <label><input type="radio" name="q-3-12" value="1"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-12" value="2"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-12" value="3"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-12" value="4"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-12" value="5"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-12" value="6"<?php if(isset($_POST["q-3-12"])){echo ($_POST["q-3-12"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>13.相手の言った事、やったことに、腹が立ったとき</p>
        <label><input type="radio" name="q-3-13" value="1"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-13" value="2"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-13" value="3"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-13" value="4"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-13" value="5"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-13" value="6"<?php if(isset($_POST["q-3-13"])){echo ($_POST["q-3-13"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>14.相手の話に興味がないとき</p>
        <label><input type="radio" name="q-3-14" value="1"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-14" value="2"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-14" value="3"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-14" value="4"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-14" value="5"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-14" value="6"<?php if(isset($_POST["q-3-14"])){echo ($_POST["q-3-14"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>15.相手の話がわからないとき</p>
        <label><input type="radio" name="q-3-15" value="1"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-15" value="2"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-15" value="3"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-15" value="4"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-15" value="5"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-15" value="6"<?php if(isset($_POST["q-3-15"])){echo ($_POST["q-3-15"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>16.相手と意見が違う時</p>
        <label><input type="radio" name="q-3-16" value="1"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-16" value="2"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-16" value="3"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-16" value="4"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-16" value="5"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-16" value="6"<?php if(isset($_POST["q-3-16"])){echo ($_POST["q-3-16"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>17.自分の発言や行動によって相手を傷つけそうなとき</p>
        <label><input type="radio" name="q-3-17" value="1"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-17" value="2"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-17" value="3"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-17" value="4"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-17" value="5"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-17" value="6"<?php if(isset($_POST["q-3-17"])){echo ($_POST["q-3-17"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>18.集団行動をしなければならないとき</p>
        <label><input type="radio" name="q-3-18" value="1"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-18" value="2"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-18" value="3"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-18" value="4"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-18" value="5"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-18" value="6"<?php if(isset($_POST["q-3-18"])){echo ($_POST["q-3-18"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>19.まわりが盛り上がっているとき</p>
        <label><input type="radio" name="q-3-19" value="1"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-19" value="2"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-19" value="3"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-19" value="4"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-19" value="5"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-19" value="6"<?php if(isset($_POST["q-3-19"])){echo ($_POST["q-3-19"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>20.仕事や、約束があって、それを休みたいとき</p>
        <label><input type="radio" name="q-3-20" value="1"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-20" value="2"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-20" value="3"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-20" value="4"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-20" value="5"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-20" value="6"<?php if(isset($_POST["q-3-20"])){echo ($_POST["q-3-20"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <div class="question">  
        <p>21.初対面の相手に対して</p>
        <label><input type="radio" name="q-3-21" value="1"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "1") ? " checked" : "";} ?>>まったくしない</label>
        <label><input type="radio" name="q-3-21" value="2"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "2") ? " checked" : "";} ?>>しない</label>
        <label><input type="radio" name="q-3-21" value="3"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "3") ? " checked" : "";} ?>>あまりしない</label>
        <label><input type="radio" name="q-3-21" value="4"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "4") ? " checked" : "";} ?>>少しする</label>
        <label><input type="radio" name="q-3-21" value="5"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "5") ? " checked" : "";} ?>>する</label>
        <label><input type="radio" name="q-3-21" value="6"<?php if(isset($_POST["q-3-21"])){echo ($_POST["q-3-21"] == "6") ? " checked" : "";} ?>>よくする</label>
    </div>
    <h3>質問は以上です。おつかれさまでした。</h3>
    <input id="button" type="submit" name="button" value="回答する">
</form>
</body>
</html>