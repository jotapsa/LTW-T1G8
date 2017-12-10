function addEventListenerList(list,method) {
      for (let i = 0;i < list.length; i++) {
        list[i].addEventListener("click", method);
      }
}

var items_uncheck = document.getElementsByClassName("item-uncheck");
var items_check = document.getElementsByClassName("item-check");
addEventListenerList(items_uncheck,checkItem);
addEventListenerList(items_check,checkItem);

var add_buttons = document.getElementsByClassName("addItem");
addEventListenerList(add_buttons,addItem);

function checkItem(event){
  var id = this.id;
  id = id.substr(4);
  console.log(id);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == 1){
          this.className = 'item-check';
        }
        else{
          this.className = 'item-uncheck';
        }
      }
  };

  xmlhttp.open("GET", "action_update_item.php?item=" + id, true);
  xmlhttp.send();
}

function addItem(event){
  var id = this.id;
  id = id.substr(4);
  console.log(id);
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
