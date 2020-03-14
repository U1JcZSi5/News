<?php include VIEWS . 'helpers/header.php'; ?>
<?php
if (isset($this->data['errors'])) {
    foreach ($this->data['errors'] as $error) {
        echo $error . '<br>';
    }
}

?>

<form action="" method="POST">
    Username: <input type="text" name="username" value="<?php echo $this->data['username'] ?>" autocomplete="off"> <br>
    Password: <input type="password" name="password" autocomplete="off"> <br>
    <input type="hidden" name="token" value="<?php echo $this->token; ?>">
    <input type="submit" name="submit_btn" value="SignUp">
</form>

<?php include VIEWS . 'helpers/footer.php'; ?>