<?php
// 「code」というパラメータから圧縮された文字列を取得する
if (isset($_GET['code'])) {
    // Base64という形式で圧縮されたコードを元のHTMLに復元する
    $decoded_code = base64_decode($_GET['code']);
    echo $decoded_code;
} else {
    // パラメータがない場合は、コードを入力してURLを作る「生成画面」を表示する
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
            .result { margin-top: 20px; background: #eef; padding: 15px; border-radius: 4px; word-break: break-all; }
        </style>
    </head>
    <body>
        <h1>短縮URLパラメータジェネレーター</h1>
        <p>ここにHTML/CSSコードを貼り付けてボタンを押すと、真っ白にならない安全なURLを作れます。</p>
        <textarea id="source" placeholder="<!DOCTYPE html>... ここにコードを貼り付け"></textarea>
        <button onclick="generateURL()">共有用URLを生成</button>
        
        <div id="output-area" style="display:none;">
            <h3>生成されたURL（これをコピーしてアクセス）：</h3>
            <div class="result" id="url-result"></div>
        </div>

        <script>
            function generateURL() {
                const sourceCode = document.getElementById('source').value;
                if(!sourceCode) return alert('コードを入力してください');
                
                // JavaScriptでコードをBase64という短い形式に変換（圧縮）する
                // 日本語（全角文字）が壊れないように特殊な変換を挟んでいます
                const base64Code = btoa(unescape(encodeURIComponent(sourceCode)));
                
                // 今のサイトのURLの末尾に「?code=圧縮文字」をくっつける
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
