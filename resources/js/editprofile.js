let profilepic = document.getElementById("prifile-pic");
let inputfile = document.getElementById("input-file");
let chgphoto = document.querySelector("#chgphoto");
chgphoto.addEventListener('change',(e)=>{
    console.log(e);
    document.getElementById('form-photo-profile').submit();
})
// inputfile.onchange = function(){
//     profilepic.src = URL.createObjectURL(inputfile.files[0]);
// }
