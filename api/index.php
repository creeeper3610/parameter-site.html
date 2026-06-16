<?php
// 1. パラメータに「html」があるかチェック
if (isset($_GET['html'])) {
    
    // 2. URLのぐちゃぐちゃになった文字列を、元の綺麗なHTMLに「デコード」する
    $decoded_html = urldecode($_GET['html']);
    
    // 3. デコードしたHTMLを画面に出力する
    echo $decoded_html;

} else {
    // パラメータがない場合のデフォルト画面
    echo "<h1>サイトの初期状態</h1><p>URLの末尾に ?html=... を付けてアクセスしてください。</p>";
}
?>
