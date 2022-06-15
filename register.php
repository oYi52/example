<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
</head>
<body>
    <form action="auth_process.php" method="post">
        <label for="userid">帳號</label>    
        <input type="text" name="userid" id="userid">
        <br>
        <label for="userpass">密碼</label>
        <input type="password" name="userpass" id="userpass">
        <br>
        <label for="userpassConfirm">確認密碼</label>
        <input type="password" name="userpassConfirm" id="userpassConfirm">
        <br>
        <label for="username">姓名</label>
        <input type="text" name="username" id="username">
        <br>
        <hr>
        <input type="submit" name="action" value="註冊">
    </form>
</body>
</html>