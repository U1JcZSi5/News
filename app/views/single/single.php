<?php include VIEWS . 'helpers/header.php'; ?>

<?php foreach ($this->data['news'] as $story) : ?>
    <?php include VIEWS . 'helpers/shownews.php'; ?>
<?php endforeach; ?>

<br><br>

<?php foreach ($this->data['comments'] as $story) : ?>
    <h4>Author: <?php echo $story->username; ?></h4>
    <p><?php echo $story->text; ?></p>
    <?php if (\libs\Session::getSession('username') == $story->username || \libs\Session::sessionExists('admin')) : ?>
        <a href="?route=single&id=<?php echo $_GET['id'] ?>&comment_id=<?php echo $story->comments_id ?>">DELETE</a>
    <?php endif; ?>
<?php endforeach; ?>

<br><br>

<?php
if (isset($this->data['errors'])) {
    foreach ($this->data['errors'] as $error) {
        echo $error . '<br>';
    }
}

?>
<form action="" method="POST">
    <h3>Leave Comment</h3>
    Comment: <textarea name="text" cols="30" rows="4">
    </textarea><br>
    <input type="hidden" name="token" value="<?php echo $this->token; ?>">
    <input type="submit" name="submit_btn" value="Comment">
</form>

<?php include VIEWS . 'helpers/footer.php'; ?>