<!--パスワード再設定メール-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセット</title>
</head>
<body>
    <h2>パスワードリセット</h2>

    <p>こんにちは、{{ $user->name }} 様</p>

    <p>以下のリンクをクリックしてパスワードをリセットしてください。</p>
    <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>

    <p>よろしくお願いします。</p>
</body>
</html>
