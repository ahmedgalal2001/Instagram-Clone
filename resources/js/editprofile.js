let profilepic = document.getElementById("prifile-pic");
let inputfile = document.getElementById("input-file");

inputfile.onchange = function(){
    profilepic.src = URL.createObjectURL(inputfile.files[0]);
}