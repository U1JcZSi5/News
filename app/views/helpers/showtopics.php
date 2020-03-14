<br><br>
<?php foreach ($this->data['topics'] as $topic) : ?>
    <a href="<?php echo BASE_URL . 'topic=' . $topic; ?>"><?php echo ucfirst($topic); ?></a><br>
<?php endforeach; ?>