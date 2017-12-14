
var search = document.getElementById("search");
search.addEventListener("keyup",showHints);
search.addEventListener("keypress",Search);


function changeType(str){
  var inputSearch = document.getElementById('search');
  if(str == 'user'){
    inputSearch.placeholder = 'search for user...';
  }
  else {
    inputSearch.placeholder = 'search for tag...';
  }
}


function Search(event) {
    if (event.keyCode == 13) {
        var input = document.getElementById("search");
        var inputSearch = document.getElementById('searchType').value;
        str = input.value;

        if(str == ''){
          input.focus();
          return false;
        }
        else if(str.indexOf(' ') >= 0){
          input.value = '';
          input.focus();
          return false;
        }
        else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText != 0){
                  var page = 'search.php?' + inputSearch + '=' + str;
                  window.location = page;
                  return false;
                }
                else {
                  input.value = '';
                  input.focus();
                  return false;
                }
              }
          };
          if(inputSearch == 'user'){
            xmlhttp.open("GET", "check_username.php?username=" + str, true);
          }
          else {
            xmlhttp.open("GET", "check_tag.php?tag=" + str, true);
          }
          xmlhttp.send();
        }
    }
}

function showHints(event) {
    str = this.value;
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
