function addEventListenerList(list,method) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener("click", method);
      }
}

var items_uncheck,items_check,add_items,delete_items,delete_lists,add_list,privacy_buttons;

Init();

function Init(){

  items_uncheck = document.getElementsByClassName("item-uncheck");
  items_check = document.getElementsByClassName("item-check");
  addEventListenerList(items_uncheck,checkItem);
  addEventListenerList(items_check,checkItem);

  add_items = document.getElementsByClassName("addItem");
  addEventListenerList(add_items,addItemInput);

  delete_items = document.getElementsByClassName("deleteItem");
  addEventListenerList(delete_items,deleteItem);

  delete_lists = document.getElementsByClassName("deleteButton");
  addEventListenerList(delete_lists,deleteList);

  add_list = document.getElementsByClassName("addList");
  addEventListenerList(add_list,addList);

  var add_item_confirm = document.getElementsByClassName("addItemConfirm");
  addEventListenerList(add_item_confirm,addItem);

  var privacy_buttons = document.getElementsByClassName("privacyButton");
  addEventListenerList(privacy_buttons,changePrivacy);
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
    var date = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName("date");

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

            updateDate(date[0]);
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

  var date = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName("date");

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
          updateDate(date[0]);
        }
      }
  };

  xmlhttp.open("GET", "action_update_item.php?item=" + id, true);
  xmlhttp.send();
}

function addItemInput(event){
  var id = this.parentElement.id;
  id = id.substr(7);
  console.log("addItemInput -> " + id);

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

  var date = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName("date");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          var parent = document.getElementById('item' + id).parentElement;
          parent.remove();
          updateDate(date[0]);
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

  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function() {
  //     if (this.readyState == 4 && this.status == 200) {
  //       if(this.responseText != -1){
  //
  //         Init();
  //       }
  //     }
  // };
  //
  // xmlhttp.open("GET", "action_add_list.php", true);
  // xmlhttp.send();


  var section = document.getElementById("to-do-lists");

  var newList = document.createElement("article");
  newList.setAttribute("id","list"+id);

  var header = document.createElement("header");
  header.setAttribute("class","list-unchecked");
  newList.appendChild(header);

  var del_button = document.createElement("i");
  del_button.setAttribute("class","deleteButton");
  del_button.setAttribute("id","deleteList"+id);
  del_button.innerHTML = 'delete';
  header.appendChild(del_button);

  var title = document.createElement("h1");
  var title_a = document.createElement("a");
  title_a.innerHTML = 'Título'
  title.appendChild(title_a);
  header.appendChild(title);

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

  section.appendChild(newList);

  Init();

  console.log(newList);

  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function() {
  //     if (this.readyState == 4 && this.status == 200) {
  //       if(this.responseText != -1){
  //         var todolist = document.getElementById('list' + id);
  //         todolist.remove();
  //       }
  //     }
  // };
  //
  // xmlhttp.open("GET", "action_delete_list.php?list=" + id, true);
  // xmlhttp.send();


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
