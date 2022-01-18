<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World!</h1>
    <hr>
    <form action="process.php" method="POST">
        <input type="text" name="i" value="<?php if(isset($_GET['i'])){echo $_GET['i'];} ?>">
        <select name="count" id="count">
            <option value="1" <?php if(isset($_GET['count'])&&$_GET['count']=="1"){echo "selected";} ?>>+</option>
            <option value="2" <?php if(isset($_GET['count'])&&$_GET['count']=="2"){echo "selected";} ?>>-</option>
            <option value="3" <?php if(isset($_GET['count'])&&$_GET['count']=="3"){echo "selected";} ?>>*</option>
            <option value="4" <?php if(isset($_GET['count'])&&$_GET['count']=="4"){echo "selected";} ?>>/</option>
        </select>
        <input type="text" name="j" value="<?php if(isset($_GET['j'])){echo $_GET['j'];} ?>">
        <input type="submit" value="=">
        <?php if(isset($_GET['result'])){echo $_GET['result'];} ?>
    </form>
</body>
</html>