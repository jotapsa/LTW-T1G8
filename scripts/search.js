
function changeType(str){
  var inputSearch = document.getElementById('search');
  if(str == 'user'){
    inputSearch.placeholder = 'search for user...';
  }
  else {
    inputSearch.placeholder = 'search for tag...';
  }
}


function Search(e) {
    if (e.keyCode == 13) {
        var input = document.getElementById("search").value;
        if(input == '')
          return false;
        var type = document.getElementById('searchType').value;
        var page = 'search.php?' + type + '=' + input;
        window.location = page;
        return false;
    }
}

function showHints(str) {
    var dataList = document.getElementById('datalist');
    document.getElementById("datalist").innerHTML = "";
    var typeSearch = document.getElementById('searchType').value;

    if (str.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText != -1){
                var options = JSON.parse(this.responseText);
                for(let i=0;i < options.length; i++){
                  var option = document.createElement('option');
                  option.value = options[i];
                  dataList.appendChild(option);
                }
              }
            }
        };

        if(typeSearch == 'user'){
          xmlhttp.open("GET", "search_users.php?user=" + str, true);
        }
        else {
          xmlhttp.open("GET", "search_tags.php?tag=" + str, true);
        }
        xmlhttp.send();
    }
}
