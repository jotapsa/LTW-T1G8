<section id="to-do-lists">
<?php foreach( $lists as $todolist) {
  $items = ItemsofList($dbh,$todolist['idList']);
  $tags = TagsofList($dbh,$todolist['idList']);
  ?>
  <article id="list<?=$todolist['idList']?>">
    <?php if($todolist['checked']){ ?>
      <header class="list-checked">
    <?php }
      else{ ?>
      <header class="list-unchecked" style="background-color: <?=$todolist['color']?>">
    <?php }
        if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
          if(ListBelongsUser($dbh,$_SESSION['username'],$todolist['idList'])) {?>
            <i class="deleteButton" id="deleteList<?=$todolist['idList']?>">delete</i>
        <?  if($todolist['privacy'] == 1)
              $privacy = 'lock';
            else {
              $privacy = 'lock_open';
            }?>
            <i class="privacyButton" id="privacyList<?=$todolist['idList']?>"><?=$privacy?></i>
        <?}
        }?>
        <?php if(isset($_SESSION['username']) && $_SESSION['username'] != '' && ListBelongsUser($dbh,$_SESSION['username'],$todolist['idList'])){?>
                  <input type="text" id="editTitle<?=$todolist['idList']?>" class="editTitle" value="<?=$todolist['title']?>">
                  <i class="tagsButton" id="tagsList<?=$todolist['idList']?>">local_offer</i>
                  <i class="colorButton" id="colorList<?=$todolist['idList']?>">colorize</i>
                  <input type="color" id="colorPick<?=$todolist['idList']?>" class="colorPick" style="display: none">
            <?}
            else { ?>
              <h1><a class="title" id="title<?=$todolist['idList']?>"><?=$todolist['title']?></a></h1>
            <? }?>

      </header>
      <section class="items">
        <table>
        <?php foreach ($items as $item) { ?>
          <tr>
            <?php if($item['checked']){ ?>
              <td class="item-check" id="item<?=$item['idItem']?>"><?=$item['info']?></td>
            <?php }
              else{ ?>
              <td class="item-uncheck" id="item<?=$item['idItem']?>"><?=$item['info']?></td>
            <?php }
            if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
              if(ListBelongsUser($dbh,$_SESSION['username'],$todolist['idList'])) {?>
              <td class="deleteItem" id="delete<?=$item['idItem']?>">X</td>
              <?}
            }?>
          </tr>
        <?php }
          if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
            if(ListBelongsUser($dbh,$_SESSION['username'],$todolist['idList'])) {?>
              <tr id="addItem<?=$todolist['idList']?>">
                <td class="addItem" colspan="2">+</td>
              </tr>
            <?}
          }?>
        </table>
      </section>
      <footer>
        <?php foreach($tags as $tag){ ?>
        <span class="tags"><a href="search.php?tag=<?=$tag['name']?>">#<?=$tag['name']?></a></span>
        <?php } ?>
        <span id="date<?=$todolist['idList']?>"class="date"><?php echo gmdate('d/m/y',$todolist['editedDate'])?></span>
      </footer>
    </article>
  <?php } ?>
  </section>
