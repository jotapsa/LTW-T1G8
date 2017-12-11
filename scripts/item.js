function addEventListenerList(list,method) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener("click", method);
      }
}

var items_uncheck = document.getElementsByClassName("item-uncheck");
var items_check = document.getElementsByClassName("item-check");
addEventListenerList(items_uncheck,checkItem);
addEventListenerList(items_check,checkItem);

var add_items = document.getElementsByClassName("addItem");
addEventListenerList(add_items,addItemInput);

var delete_items = document.getElementsByClassName("deleteItem");
addEventListenerList(delete_items,deleteItem);

var delete_lists = document.getElementsByClassName("deleteButton");
addEventListenerList(delete_lists,deleteList);

var add_list = document.getElementsByClassName("addList");
addEventListenerList(add_list,addList);

var n_lists;

function $(selector) {
  return document.querySelectorAll(selector);
}

NodeList.prototype.css = function(property, value) {
  [].forEach.call(this, function(element) {
    element.style[property] = value;
  });
  return this;
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
  var id = this.id;
  id = id.substr(4);
  var confirm = document.getElementById('add'+id);
  var row = document.getElementById('addItem'+id);
  this.style.display="none";
  var input = document.createElement("td");
  input.setAttribute('id','newItem' + id);
  input.setAttribute('class','inputItem');
  var inputText = document.createElement("input");
  inputText.setAttribute('type','text');
  inputText.setAttribute('name','newItem');
  input.append(inputText);
  row.insertBefore(input, row.childNodes[1]);
  confirm.style.display="table-cell";
}

function deleteItem(event){
  var id = this.id;
  id = id.substr(6);

  var date = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName("date");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
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
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != -1){
          n_lists = this.responseText;
        }
      }
  };

  xmlhttp.open("GET", "action_update_list.php", true);
  xmlhttp.send();
}

function addList(event){
  var id = getNumberLists();
  console.log(id);
  // var newList = document.createElement("article");
  // newList.setAttribute("id","list10");
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
