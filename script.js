function searchPet(){
    let search = document.getElementById("search").value;
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
    if (this.status == 200){
        document.getElementById("result").innerHTML = this.responseText;
    }
}
;
  xhttp.open("GET", "search.php?search=" + search, true);
  xhttp.send();
}

document.getElementById("search-form").addEventListener("submit",function(event) {
    event.preventDefault();
    searchPet();
});