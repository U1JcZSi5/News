<?php include VIEWS . 'helpers/header.php'; ?>
<?php

if (isset($this->data['errors'])) {
    foreach ($this->data['errors'] as $error) {
        echo $error . '<br>';
    }
}
?>

<form action="" method="POST">
    Author: <input type="text" name="author" value="<?php echo $this->data['author'] ?>" autocomplete="off"> <br>
    Title: <input type="text" name="title" value="<?php echo $this->data['title'] ?>" autocomplete="off"> <br>
    Text: <textarea name="text" cols="30" rows="10"><?php echo $this->data['text'] ?></textarea><br>
    Category: <select name="category" id="category">
        <?php foreach ($this->data['topics'] as $topic) : ?>
            <?php dd($this->data['category']); ?>
            <option value="<?php echo $topic; ?>" selected=""><?php echo ucfirst($topic); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="token" value="<?php echo $this->token; ?>">
    <input type="submit" name="submit_btn" value="Post">
</form>

<?php include VIEWS . 'helpers/footer.php'; ?>