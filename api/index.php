<?php
// URLパラメータからコードを取得
$html = isset($_GET['html']) ? $_GET['html'] : '<h1>Vercel PHPサイト</h1><p>URLにパラメータを追加してください。</p>';
$css  = isset($_GET['css'])  ? $_GET['css']  : 'body { font-family: sans-serif; padding: 20px; background: #fafafa; }';
$js   = isset($_GET['js'])   ? $_GET['js']   : 'console.log("VercelでJSを実行中");';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Vercel PHPパラメータ反映</title>
    <style><?= $css ?></style>
</head>
<body>
    <?= $html ?>
    <script><?= $js ?></script>
</body>
</html>
