<section id="to-do-lists">
<?php foreach( $lists as $todolist) {
  $items = ItemsofList($dbh,$todolist['idList']);
  $tags = TagsofList($dbh,$todolist['idList']);
  ?>
  <article>
      <header>
        <!-- IMAGE? -->
        <h1><a href="edit_list.php?id=<?=$todolist['id']?>"><?=$todolist['title']?></a></h1>
      </header>
      <!-- <img src="http://lorempixel.com/600/300/business/" alt=""> -->
      <!-- Items -->
      <section id="items">
          <!-- <ul> -->
        <table>
            <?php foreach ($items as $item) { ?>
                <!--<li> --> <tr><td><?=$item['info']?></td></tr><!--</li>-->
            <?php } ?>
        </table>
          <!-- </ul> -->
      </section>
      <footer>
        <?php foreach($tags as $tag){ ?>
        <span class="tags"><a href="#">#<?=$tag['name']?></a></span>
        <?php } ?>
        <span class="date"><?php echo gmdate('d/m/y',$todolist['editedDate'])?></span>
        <a class="comments" href="news_item.php?id=<?=$article['id']?>#comments"><?=$article['comments']?></a>
      </footer>
    </article>
  <?php } ?>
  </section>
