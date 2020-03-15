<?php include VIEWS . 'helpers/header.php'; ?>

<?php if (!$this->active) : ?>
    <?php foreach ($this->data['news'] as $story) : ?>
        <img style="height: 200px; width: 200px;" src="<?php echo IMAGES . $story->image ?>" alt="No image">
        <?php include VIEWS . 'helpers/shownews.php'; ?>
    <?php endforeach; ?>
<?php else : ?>
    <?php foreach ($this->data['news'] as $story) : ?>
        <img style="height: 200px; width: 200px;" src="<?php echo IMAGES . $story->image ?>" alt="No image">
        <?php include VIEWS . 'helpers/shownews.php'; ?>
    <?php endforeach; ?>
<?php endif; ?>

<br><br>
<?php foreach ($this->data['topics'] as $topic) : ?>
    <a href="<?php echo BASE_URL . 'topic=' . $topic; ?>"><?php echo ucfirst($topic); ?></a><br>
<?php endforeach; ?>

<?php include VIEWS . 'helpers/footer.php'; ?>