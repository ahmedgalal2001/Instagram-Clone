let profilepic = document.getElementById("prifile-pic");
let inputfile = document.getElementById("input-file");
let chgphoto = document.querySelector("#chgphoto");
chgphoto.addEventListener('change',(e)=>{
    var selectedFile = e.target.files[0];
})
inputfile.onchange = function(){
    profilepic.src = URL.createObjectURL(inputfile.files[0]);
}

