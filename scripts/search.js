

function runScript(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("search").value;
        var page = 'search.php?q=' + tb;
        window.location = page;
        return false;
    }
}

function showHints(str) {

    var dataList = document.getElementById('datalist');
    document.getElementById("datalist").innerHTML = "";

    if (str.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tags = JSON.parse(this.responseText);
                for(let i=0;i < tags.length; i++){
                  var option = document.createElement('option');
                  option.value = tags[i];
                  dataList.appendChild(option);
                }
            }
        };

        xmlhttp.open("GET", "search_tags.php?tag=" + str, true);
        xmlhttp.send();
    }
}
