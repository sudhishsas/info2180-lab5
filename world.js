window.onload = function () {
    let button = document.getElementById("lookup");
    let citybtn = document.getElementById("cities");
    citybtn.addEventListener("click",cityBtnClick);
    button.addEventListener("click",searchBtnClick);
    

    var formel =document.getElementsByClassName('form-control');
    var formdata =new FormData();

    function cityBtnClick(i){
        i.preventDefault();
        console.log('clicked city');
        const htr = new XMLHttpRequest();

        search = sanitizer(document.getElementById("country").value);
        console.log('worked yes');
       
       
        htr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("result").innerHTML = this.responseText;
                console.log('worked city');
                console.log(search);
            }
        }

        console.log('nope');
        htr.open("GET", "http://localhost/info2180-lab5/world.php?country="+search+"&context=cities");
        htr.send();
    }


    function searchBtnClick(e){
        e.preventDefault();
        console.log('clicked');
        const htr = new XMLHttpRequest();

        search = sanitizer(document.getElementById("country").value);
        console.log('worked');
       
       
        htr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("result").innerHTML = this.responseText;
                console.log('worked second');
                console.log(search);
            }
        }

        console.log('nope');
        htr.open("GET", "http://localhost/info2180-lab5/world.php?country="+search);
        htr.send();

    }
};



function sanitizer(str){
    str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
    return str.trim();
}