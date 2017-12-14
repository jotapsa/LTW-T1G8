function addEventListenerList(list,method,eventType) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener(eventType, method);
      }
}

function removeEventListenerList(list,method,eventType) {
      for (let i = 0;i < list.length; i++) {
        list[i].removeEventListener(eventType, method);
      }
}

function addEventListenerColor(list,method,eventType) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener(eventType, method,false);
        list[i].select();
      }
}

var items_uncheck,
items_check,
add_items,
delete_items,
delete_lists,
add_list,
add_item_confirm,
privacy_buttons,
color_buttons,
tags_buttons,
titles,
colorPickers,
close_tags,
add_tags,
delete_tags;

function getListfromItem(item){
  for(let i=0;i<5;i++)
    item = item.parentElement;
  return item.id.substr(4);
}

function getColorofList(header,idList){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var color = this.responseText;
          header.setAttribute("style","background-color: "+color+";");
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php?list=" + idList + '&getColor=' + idList, true);
  xmlhttp.send();
}

function getUsernameofList(user,idList){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          user.setAttribute("href","search.php?user="+this.responseText);
          user.innerHTML = '@'+this.responseText;
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php?list=" + idList + '&getUsername=' + idList, true);
  xmlhttp.send();
}

Init();

function Init(){
  items_uncheck = document.getElementsByClassName("item-uncheck");
  items_check = document.getElementsByClassName("item-check");
  addEventListenerList(items_uncheck,checkItem,"click");
  addEventListenerList(items_check,checkItem,"click");

  add_items = document.getElementsByClassName("addItem");
  addEventListenerList(add_items,addItemInput,"click");

  delete_items = document.getElementsByClassName("deleteItem");
  addEventListenerList(delete_items,deleteItem,"click");

  delete_lists = document.getElementsByClassName("deleteButton");
  addEventListenerList(delete_lists,deleteList,"click");

  add_list = document.getElementsByClassName("addList");
  addEventListenerList(add_list,addList,"click");

  add_item_confirm = document.getElementsByClassName("addItemConfirm");
  addEventListenerList(add_item_confirm,addItem,"click");

  privacy_buttons = document.getElementsByClassName("privacyButton");
  addEventListenerList(privacy_buttons,changePrivacy,"click");

  color_buttons = document.getElementsByClassName("colorButton");
  addEventListenerList(color_buttons,editColor,"click");

  tags_buttons = document.getElementsByClassName("tagsButton");
  addEventListenerList(tags_buttons,manageTags,"click");

  titles = document.getElementsByClassName("editTitle");
  addEventListenerList(titles,editTitle,"keyup");

  colorPickers = document.getElementsByClassName("colorPick");
  addEventListenerColor(colorPickers,changeColor,"input");
}

function init_Tags(){
  close_tags = document.getElementsByClassName("tagsClose");
  addEventListenerList(close_tags,closeTags,"click");

  add_tags = document.getElementsByClassName("addTag");
  addEventListenerList(add_tags,addTag,"click");

  delete_tags = document.getElementsByClassName("deleteTag");
  addEventListenerList(delete_tags,deleteTag,"click");
}

function close_Tags(){
  close_tags = document.getElementsByClassName("tagsClose");
  removeEventListenerList(close_tags,closeTags,"click");

  add_tags = document.getElementsByClassName("addTag");
  removeEventListenerList(add_tags,addTag,"click");

  delete_tags = document.getElementsByClassName("deleteTag");
  removeEventListenerList(delete_tags,deleteTag,"click");
}

function $(selector) {
  return document.querySelectorAll(selector);
}

NodeList.prototype.css = function(property, value) {
  [].forEach.call(this, function(element) {
    element.style[property] = value;
  });
  return this;
}

function addItem(event){
  var idList = this.id;
  idList = idList.substr(3);

  var input = document.getElementById('input'+idList);
  var add_item = document.getElementById('addItem'+idList);
  var table = document.getElementById('addItem'+idList).parentElement;
  var header = document.getElementById("list"+idList).querySelector("header");
  str = input.value;

  if(str.length == 0){
    input.focus();
    return;
  }
  else {
    var date = document.getElementById("date"+idList);

    input.parentElement.remove();
    input.remove();
    this.remove();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != -1){
            var newID = this.responseText;

            var item = document.createElement("tr");

            var item_info = document.createElement("td");
            item_info.setAttribute("class","item-uncheck");
            item_info.setAttribute("id","item"+newID);
            item_info.innerHTML = str;
            item.appendChild(item_info);

            var delete_item = document.createElement("td");
            delete_item.setAttribute("class","deleteItem");
            delete_item.setAttribute("id","deleteItem"+newID);
            delete_item.innerHTML = 'X';
            item.appendChild(delete_item);

            table.insertBefore(item, add_item);

            //uncheck List
            header.className = 'list-unchecked';
            getColorofList(header,idList);

            updateDate(date);
            $('#addItem'+idList+ ' .addItem').css('display', 'table-cell');
            Init();
          }
        }
    };

    xmlhttp.open("POST", "action_add_item.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('info='+str+'&list='+idList);
  }
}


function updateDate(date){
  let d = new Date();
  let day = d.getDate();
  let month = d.getMonth()+1;
  let year = d.getFullYear();
  date.innerHTML = day +'/'+ month +'/'+ year;
}

function checkItem(event){
  var id = this.id;
  id = id.substr(4);

  var idList = getListfromItem(this);
  var header = document.getElementById("list"+idList).querySelector("header");
  var date = document.getElementById("date"+idList);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          checkedList = this.responseText.charAt(0);
          checkedItem = this.responseText.charAt(1);

          if(checkedList == 1){
            header.className = 'list-checked';
            header.setAttribute("style","background-color: green;")
          }
          else{
            header.className = 'list-unchecked';
            getColorofList(header,idList);
          }

          if(checkedItem == 1){
            this.className = 'item-check';
            $('#item'+id).css('background-color', '#8db600');
          }
          else{
            this.className = 'item-uncheck';
            $('#item'+id).css('background-color', 'white');
          }
          updateDate(date);
        }
      }
  };

  xmlhttp.open("GET", "action_update_item.php?item=" + id, true);
  xmlhttp.send();
}

function addItemInput(event){
  var id = this.parentElement.id;
  id = id.substr(7);

  $('#addItem'+id+ ' .addItem').css('display', 'none');

  var add = document.getElementById("addItem"+id);

  var add_confirm = document.createElement("td");
  add_confirm.setAttribute("id","add"+id);
  add_confirm.setAttribute("class","addItemConfirm");
  add_confirm.innerHTML = '+';
  add.appendChild(add_confirm);


  var input_td = document.createElement("td");
  var inputText = document.createElement("input");
  inputText.setAttribute('type','text');
  inputText.setAttribute('name','newItem');
  inputText.setAttribute('id','input'+id);
  input_td.appendChild(inputText);
  add.insertBefore(input_td, add.childNodes[1]);

  Init();

  inputText.focus();
}

function deleteItem(event){
  var id = this.id;
  id = id.substr(10);

  var idList = getListfromItem(this);
  var header = document.getElementById("list"+idList).querySelector("header");
  var date = document.getElementById("date"+idList);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          checkedList = this.responseText;

          if(checkedList == 1){
            header.className = 'list-checked';
            header.setAttribute("style","background-color: green;")
          }
          else{
            header.className = 'list-unchecked';
            getColorofList(header,idList);
          }

          var parent = document.getElementById('item' + id).parentElement;
          parent.remove();
          updateDate(date);
        }
      }
  };

  xmlhttp.open("GET", "action_delete_item.php?item=" + id, true);
  xmlhttp.send();
}

function addList(event){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var id = this.responseText;
          var section = document.getElementById("to-do-lists");

          var newList = document.createElement("article");
          newList.setAttribute("id","list"+id);
          newList.setAttribute("class","editable");

          var header = document.createElement("header");
          header.setAttribute("class","list-unchecked");
          header.setAttribute("style","background-color: #0000ff");
          newList.appendChild(header);

          var del_button = document.createElement("i");
          del_button.setAttribute("class","deleteButton");
          del_button.setAttribute("id","deleteList"+id);
          del_button.innerHTML = 'delete';
          header.appendChild(del_button);

          var privacy_button = document.createElement("i");
          privacy_button.setAttribute("class","privacyButton");
          privacy_button.setAttribute("id","privacyList"+id);
          privacy_button.innerHTML = 'lock_open';
          header.appendChild(privacy_button);

          var edit = document.createElement("input");
          edit.setAttribute("type","text");
          edit.setAttribute("id","editTitle"+id);
          edit.setAttribute("class","editTitle");
          edit.setAttribute("value","Title");
          header.appendChild(edit);

          var tags_button = document.createElement("i");
          tags_button.setAttribute("class","tagsButton");
          tags_button.setAttribute("id","tagsList"+id);
          tags_button.innerHTML = 'local_offer';
          header.appendChild(tags_button);

          var color_button = document.createElement("i");
          color_button.setAttribute("class","colorButton");
          color_button.setAttribute("id","colorList"+id);
          color_button.innerHTML = 'colorize';
          header.appendChild(color_button);

          var section_items = document.createElement("section");
          section_items.setAttribute("class","items");
          newList.appendChild(section_items);

          var table = document.createElement("table");
          table.setAttribute("id","table-items"+id);
          section_items.appendChild(table);

          var tbody = document.createElement("tbody");
          table.appendChild(tbody);

          var add = document.createElement("tr");
          add.setAttribute("id","addItem"+id);
          tbody.appendChild(add);

          var add_button = document.createElement("td");
          add_button.setAttribute("class","addItem");
          add_button.setAttribute("colspan","2");
          add_button.setAttribute("style","display: table-cell;");
          add_button.innerHTML = '+';
          add.appendChild(add_button);

          var footer = document.createElement("footer");
          newList.appendChild(footer);

          var date = document.createElement("span");
          date.setAttribute("class","date");
          date.setAttribute("id",'date'+id);
          updateDate(date);
          footer.appendChild(date);

          var user = document.createElement("span");
          user.setAttribute("class","user");
          user.setAttribute("id",'user'+id);
          var user_a = document.createElement("a");
          getUsernameofList(user_a,id);
          user.appendChild(user_a);
          footer.appendChild(user);

          section.insertBefore(newList, section.childNodes[0]);
          edit.focus();
          Init();
        }
      }
  };

  xmlhttp.open("GET", "action_add_list.php", true);
  xmlhttp.send();
}

function deleteList(event){
  var id = this.id;
  id = id.substr(10);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var todolist = document.getElementById('list' + id);
          todolist.remove();
        }
      }
  };

  xmlhttp.open("GET", "action_delete_list.php?list=" + id, true);
  xmlhttp.send();
}

function changePrivacy(event){
  var id = this.id;
  id = id.substr(11);
  var privacy;

  var text = this.innerHTML;
  var self = this;
  if(text == 'lock')
    privacy = 0;
  else {
    privacy = 1;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          if(privacy){
            self.innerHTML = 'lock';
          }
          else{
            self.innerHTML = 'lock_open';
          }
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php?list=" + id + '&privacy=' + privacy, true);
  xmlhttp.send();
}

function editColor(event){
  var id = this.id;
  id = id.substr(9);

  var color_picket = document.getElementById("colorPick"+id);
  color_picket.click();
}

function changeColor(event){
  var id = this.id;
  id = id.substr(9);

  var color = event.target.value;
  colorList = color.substr(1);
  this.parentElement.setAttribute("style","background-color: " + color);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var date = document.getElementById("date"+id);
          updateDate(date);
        }
      }
  };
  xmlhttp.open("GET", "action_update_list.php?list=" + id + '&color=' + colorList, true);
  xmlhttp.send();
}

function editTitle(event){
  var id = this.id;
  id = id.substr(9);
  str = this.value;

  var xmlhttp = new XMLHttpRequest();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var date = document.getElementById("date"+id);
          updateDate(date);
        }
      }
  };
  xmlhttp.open("GET", "action_update_list.php?list=" + id + '&title=' + str, true);
  xmlhttp.send();
}

function manageTags(event){
  var idList = this.id;
  idList = idList.substr(8);

  var tags = document.querySelector("#list"+idList+" footer").getElementsByClassName("tags");
  var n_tags = tags.length;

  var modal = document.createElement("div");
  modal.setAttribute("id","tags"+idList);
  modal.setAttribute("class","tagsModal");
  modal.setAttribute("style","display:block");

  var content = document.createElement("div");
  content.setAttribute("class","tagsContent");
  modal.appendChild(content);
  // -------------header--------------------
  var header = document.createElement("div");
  header.setAttribute("class","tagsHeader");
  content.appendChild(header);

  var close_button = document.createElement("span");
  close_button.setAttribute("class","tagsClose");
  close_button.innerHTML = '&times;';
  header.appendChild(close_button);

  var title = document.createElement("h2");
  title.setAttribute("class","tagsTitle");
  title.innerHTML = 'Tags';
  header.appendChild(title);

  // -------------body--------------------
  var body = document.createElement("div");
  body.setAttribute("class","tagsBody");
  content.appendChild(body);

  var table = document.createElement("table");
  body.appendChild(table);

  for(let i=0;i< n_tags;i++){
    var tag = tags[i];
    var tag_id = tag.id.substr(3);

    var tags_table = document.createElement("tr");
    table.appendChild(tags_table);

    var tag_td = document.createElement("td");
    tag_td.setAttribute("class","tagText");
    tag_td.innerHTML = tag.childNodes[0].innerHTML.substr(1);
    tags_table.appendChild(tag_td);

    var tag_delete = document.createElement("td");
    tag_delete.setAttribute("class","deleteTag");
    tag_delete.setAttribute("id","deleteTag"+tag_id);
    tag_delete.innerHTML = 'X';
    tags_table.appendChild(tag_delete);
  }
  var add_table = document.createElement("tr");
  table.appendChild(add_table);

  var input_td = document.createElement("td");
  var tag_input = document.createElement("input");
  tag_input.setAttribute("type","text");
  tag_input.setAttribute("name","newTag");
  tag_input.setAttribute("id","newTag"+idList);
  input_td.appendChild(tag_input);
  add_table.appendChild(input_td);

  var tag_add = document.createElement("td");
  tag_add.setAttribute("class","addTag");
  tag_add.setAttribute("id","addTag"+idList);
  tag_add.innerHTML = '+';
  add_table.appendChild(tag_add);

  var section = document.getElementById("to-do-lists");
  section.appendChild(modal);

  init_Tags();
  tag_input.focus();
}


function closeTags(event){
  var tagModal = this.parentElement.parentElement.parentElement;
  tagModal.setAttribute("style","display:none");
  tagModal.remove();
  close_Tags();
}

function addTag(event){
  var idList = this.id;
  idList = idList.substr(6);

  var table = this.parentElement.parentElement;
  var add_button = this.parentElement;
  var self = this;
  var date = document.getElementById("date"+idList);
  var input = document.getElementById("newTag"+idList);
  var str = input.value;

  if(str.length == 0){
    input.focus();
    return;
  }
  else{
    str = str.replace(/\s+/g, '');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != -1){
            var idTag = this.responseText;
            var tag_tr = document.createElement("tr");
            table.appendChild(tag_tr);

            var tag_td = document.createElement("td");
            tag_td.setAttribute("class","tagText");
            tag_td.innerHTML = str;
            tag_tr.appendChild(tag_td);

            var tag_delete = document.createElement("td");
            tag_delete.setAttribute("class","deleteTag");
            tag_delete.setAttribute("id","deleteTag"+idTag);
            tag_delete.innerHTML = 'X';
            tag_tr.appendChild(tag_delete);

            table.insertBefore(tag_tr,add_button);
            // -------------------------------------------------------------
            var footer = document.querySelector("#list"+idList+" footer");
            var date = document.getElementById("date"+idList);

            var tag_span = document.createElement("span");
            tag_span.setAttribute("class","tags");
            tag_span.setAttribute("id",'tag'+idTag);
            footer.insertBefore(tag_span,date);

            var tag_a = document.createElement("a");
            tag_a.setAttribute("href","search.php?tag="+str);
            tag_a.innerHTML = '#'+str;
            tag_span.appendChild(tag_a);

            var input = document.getElementById("newTag"+idList);
            input.value = '';

            init_Tags();
            input.focus();
            updateDate(date);
          }
        }
    };

    xmlhttp.open("GET", "action_update_list.php?list=" + idList + '&newTag=' + str, true);
    xmlhttp.send();
  }
}

function deleteTag(event){
  var idTag = this.id;
  idTag = idTag.substr(9);

  var tagModal = document.getElementsByClassName("tagsModal")[0];
  var idList = tagModal.id.substr(4);

  var date = document.getElementById("date"+idList);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var parent = document.getElementById('deleteTag' + idTag).parentElement;
          parent.remove();
          var tag = document.getElementById('tag' + idTag);
          tag.remove();

          var input = document.getElementById("newTag"+idList);
          input.focus();
          updateDate(date);
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php?list=" + idList + '&delTag=' + idTag, true);
  xmlhttp.send();
}

window.onclick = function(event) {
  var tagModal = document.getElementsByClassName("tagsModal")[0];
    if (event.target == tagModal) {
        tagModal.style.display = "none";
        tagModal.remove();
        close_Tags();
    }
}
