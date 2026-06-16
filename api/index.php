<?php
// ブラウザに対して「これはただの文字ではなく、HTMLサイトです」と宣言する（超重要）
header('Content-Type: text/html; charset=utf-8');

// 「code」というパラメータがあればBase64をデコードして実行
if (isset($_GET['code'])) {
    
    // Base64を元のHTMLコードに復元
    $decoded_code = base64_decode($_GET['code']);
    
    // 復元したHTMLをそのままサイトとして出力
    echo $decoded_code;
    exit; // 処理をここで終了させる

} else {
    // パラメータがない場合は、URLを生成する画面を出す
    ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>URL作成ジェネレーター</title>
        <style>
            body { font-family: sans-serif; padding: 30px; background: #fafafa; max-width: 800px; margin: 0 auto; }
            textarea { width: 100%; height: 300px; font-family: monospace; font-size: 14px; padding: 10px; box-sizing: border-box; }
            button { background: #0076df; color: white; border: none; padding: 12px 25px; font-size: 16px; border-radius: 4px; cursor: pointer; margin-top: 10px; }
            .result { margin-top: 20px; background: #eef; padding: 15px; border-radius: 4px; word-break: break-all; user-select: all; }
        </style>
    </head>
    <body>
        <h1>短縮URLパラメータジェネレーター</h1>
        <p>ここにHTMLコードを貼り付けてボタンを押すと、文字化けや途切れの起きない共有URLを作れます。</p>
        <textarea id="source" placeholder="<!DOCTYPE html>... ここにコードを貼り付け"></textarea>
        <button onclick="generateURL()">共有用URLを生成</button>
        
        <div id="output-area" style="display:none;">
            <h3>生成されたURL（コピーしてアクセス）：</h3>
            <div class="result" id="url-result"></div>
        </div>

        <script>
            function generateURL() {
                const sourceCode = document.getElementById('source').value;
                if(!sourceCode) return alert('コードを入力してください');
                
                // 日本語を壊さずにBase64化する処理
                const base64Code = btoa(unescape(encodeURIComponent(sourceCode)));
                
                // 共有用URLを組み立て
                const sharedURL = window.location.origin + window.location.pathname + '?code=' + base64Code;
                
                document.getElementById('url-result').innerText = sharedURL;
                document.getElementById('output-area').style.display = 'block';
            }
        </script>
    </body>
    </html>
    <?php
}
?>
