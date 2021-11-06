window.onload = function () {
    let button = document.getElementById("lookup");
    button.addEventListener("click",searchBtnClick);
    

    var formel =document.getElementsByClassName('form-control');
    var formdata =new FormData();




    function searchBtnClick(e){
        e.preventDefault();
        console.log('clicked');
        const htr = new XMLHttpRequest();

        search = document.getElementById("country").value;
        console.log('worked');
       
       
        htr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("result").innerHTML = this.responseText;
                console.log('worked second');
                console.log(search);
            }
        }

        console.log('nope');
        htr.open("GET", "http://localhost/info2180-lab5/world.php?country="+search+"&lookup=#");
        htr.send();

    }
};