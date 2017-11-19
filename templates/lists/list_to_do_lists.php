<section id="to-do-lists">
<?php foreach( $lists as $todolist) {
  $items = listItems($dbh,$todolist['idList']);
  ?>
  <article>
      <header>
        <h1><a href="news_item.php?id=<?=$todolist['id']?>"><?=$todolist['title']?></a></h1>
      </header>
      <img src="http://lorempixel.com/600/300/business/" alt="">
      <!-- Items -->
      <footer>
        <span class="author"><?=$user['username']?></span>
        <span class="tags"><a href="list_news.php"><?=$article['tags']?></a></span>
        <span class="date"><?php echo gmdate('d/m/y',$article['published'])?></span>
        <a class="comments" href="news_item.php?id=<?=$article['id']?>#comments"><?=$article['comments']?></a>
      </footer>
    </article>
  <?php } ?>
  </section>
