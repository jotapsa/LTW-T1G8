function addEventListenerList(list,method,eventType) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener(eventType, method);
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
colorPickers;

function getListfromItem(item){
  for(let i=0;i<5;i++)
    item = item.parentElement;
  return item.id.substr(4);
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

var n_lists=0;
var add_lists=0;
getNumberLists();

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
  var id = this.id;
  id = id.substr(3);

  var input = document.getElementById('input'+id);
  var table = document.getElementById('addItem'+id).parentElement;
  str = input.value;

  if(str.length == 0){
    return;
  }
  else {
    var date = document.getElementById("date"+id);

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
            delete_item.setAttribute("id","delete"+newID);
            delete_item.innerHTML = 'X';
            item.appendChild(delete_item);

            table.insertBefore(item, table.childNodes[table.childNodes.length-2]);

            updateDate(date);
            console.log('aqui');
            $('#addItem'+id+ ' .addItem').css('display', 'table-cell');
            Init();
          }
        }
    };

    xmlhttp.open("POST", "action_add_item.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('info='+str+'&list='+id);
  }
}


function updateDate(date){
  let d = new Date();
  let day = d.getDate();
  let month = d.getMonth()+1;
  let year = d.getYear() % 100;
  date.innerHTML = day +'/'+ month +'/'+ year;
}

function checkItem(event){
  var id = this.id;
  id = id.substr(4);

  var idList = getListfromItem(this);
  var date = document.getElementById("date"+idList);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          if(this.responseText == 1){
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
  add_confirm.innerHTML = '✓';
  add.appendChild(add_confirm);

  var inputText = document.createElement("input");
  inputText.setAttribute('type','text');
  inputText.setAttribute('name','newItem');
  inputText.setAttribute('id','input'+id);
  add.insertBefore(inputText, add.childNodes[1]);

  Init();

  inputText.focus();
}

function deleteItem(event){
  var id = this.id;
  id = id.substr(6);

  var idList = getListfromItem(this);
  var date = document.getElementById("date"+idList);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var parent = document.getElementById('item' + id).parentElement;
          parent.remove();
          updateDate(date);
        }
      }
  };

  xmlhttp.open("GET", "action_delete_item.php?item=" + id, true);
  xmlhttp.send();
}

function getNumberLists(){
  var number;
  var self = this;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          self.n_lists = this.responseText;
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php", false);
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
          section_items.appendChild(table);

          var add = document.createElement("tr");
          add.setAttribute("id","addItem"+id);
          table.appendChild(add);

          var add_button = document.createElement("td");
          add_button.setAttribute("class","addItem");
          add_button.innerHTML = '+';
          add.appendChild(add_button);

          var footer = document.createElement("footer");
          section_items.appendChild(footer);

          var date = document.createElement("span");
          date.setAttribute("class","date");
          date.setAttribute("id",'date'+id);
          updateDate(date);
          footer.appendChild(date);

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
  color = color.substr(1);
  this.parentElement.setAttribute("style","background-color: " + color);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "action_update_list.php?list=" + id + '&color=' + color, true);
  xmlhttp.send();
}

function editTitle(event){
  var id = this.id;
  id = id.substr(9);
  str = this.value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "action_update_list.php?list=" + id + '&title=' + str, true);
  xmlhttp.send();
}

function manageTags(event){
  var idList = this.id;
  idList = idList.substr(8);

  var table_items = document.getElementById("table-items"+idList).childNodes[1].childNodes;
  var n_items = table_items.length;

  var modal = document.createElement("div");
  modal.setAttribute("id","tags"+idList);
  modal.setAttribute("class","tagsPopup");

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

  var table

  for(let i=0;i< n_tags-2;i+=2){
    var
  }



//
//   <div id="tags" class="tagsPopup">
//
//   <!-- Modal content -->
//   <div class="modal-content">
//     <div class="modal-header">
//       <span class="close"></span>
//       <h2>Modal Header</h2>
//     </div>
//     <div class="modal-body">
//       <p>Some text in the Modal Body</p>
//       <p>Some other text...</p>
//     </div>
//   </div>
//
// </div>


}
