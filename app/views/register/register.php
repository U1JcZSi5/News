<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->pageTitle; ?></title>
</head>

<body>
    <?php
    if (isset($this->data['errors'])) {
        foreach ($this->data['errors'] as $error) {
            echo $error . '<br>';
        }
    }
    ?>
    <form action="" method="POST">
        Username: <input type="text" name="username" value="" autocomplete="off"> <br>
        Password: <input type="password" name="password" value="" autocomplete="off"> <br>
        <input type="hidden" name="token" value="<?php echo $this->token; ?>">
        <input type="submit" name="register_btn" value="SignUp">
    </form>

</body>

</html>