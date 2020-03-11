<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->pageTitle; ?></title>
</head>

<body>
    <form action="" method="POST">
        Username: <input type="text" name="register[username]"> <br>
        Password: <input type="password" name="register[password]"> <br>
        <input type="submit" name="register_btn" value="SignUp">
    </form>
</body>

</html>