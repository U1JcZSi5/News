<?php include VIEWS . 'helpers/header.php'; ?>

<a href="?route=dashboard&list=users">Users</a><br>
<a href="?route=dashboard&list=news">News</a><br>

<?php if ($this->active) : ?>
    <?php foreach ($this->data['news'] as $story) : ?>
        Title:<?php echo $story->title; ?>
        <a href="?route=dashboard&list=<?php echo $_GET['list'] ?>&id=<?php echo $story->news_id; ?>">delete</a><br>
    <?php endforeach; ?>
<?php else : ?>
    <?php foreach ($this->data['users'] as $user) : ?>
        User:<?php echo $user->username; ?>
        <a href="?route=dashboard&list=<?php echo $_GET['list'] ?>&id=<?php echo $user->user_id; ?>">delete</a><br>
    <?php endforeach; ?>
<?php endif; ?>

<?php include VIEWS . 'helpers/footer.php'; ?>