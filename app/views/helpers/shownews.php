<h2><a href="<?php echo BASE_URL . 'route=single&id=' . $story->news_id; ?>"><?php echo $story->title; ?></a><br></h2>
<h3><?php echo date('d-M-Y', strtotime($story->date)); ?></h3>
<p><?php echo $story->text ?></p>