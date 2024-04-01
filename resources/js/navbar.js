let myfile = document.getElementById("upload-img-navbar");
let upload_img = document.getElementById("upload-img");
let img_post = document.getElementById("img-post");
let first_view = document.querySelector("#first-view");
let sceond_view = document.querySelector("#sceond-view");
sceond_view.style.display = "none";
first_view.style.display = "flex";


myfile.addEventListener('change', function (event) {
    first_view.style.display = "none";
    sceond_view.style.display = "block";
    var selectedFile = event.target.files[0];
    var imgUrl = URL.createObjectURL(selectedFile);
    img_post.src = imgUrl;
});
