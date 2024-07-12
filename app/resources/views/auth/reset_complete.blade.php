<!--7パスワード再設定完了-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>パスワードリセット</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header h2">{{ __('パスワード再設定完了') }}</div>

                <div class="card-body">
                    <p class="h4 mt-3">パスワードの再設定が完了しました。</p>
                    <p class="h7 mt-3"><a href="{{ route('login') }}">ログイン画面へ</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
