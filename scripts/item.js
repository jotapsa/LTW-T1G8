function addEventListenerList(list) {
    for (var i = 0, len = list.length; i < len; i++) {
        list[i].addEventListener("click", updateItem);
    }
}

var items = document.getElementsByClassName("item");
addEventListenerList(items);

function updateItem(event){
  var id = this.id;
  id = id.substr(4);

}
