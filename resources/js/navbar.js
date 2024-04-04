import axios from "axios";

let myfile = document.getElementById("upload-img-navbar");
let img_post = document.getElementById("img-post");
let first_view = document.querySelector("#first-view");
let sceond_view = document.querySelector("#sceond-view");
let search_username = document.querySelector("#search-username");
let users = document.querySelector("#users");

sceond_view.style.display = "none";
first_view.style.display = "flex";




myfile.addEventListener('change', function (event) {
    first_view.style.display = "none";
    sceond_view.style.display = "block";
    var selectedFile = event.target.files[0];
    var imgUrl = URL.createObjectURL(selectedFile);
    img_post.src = imgUrl;
});

search_username.onkeyup = () => {
    users.innerHTML = "";
    let username = search_username.value;
    if (username == null) username = "";
    axios.get(`/users/${username}`).then((res) => {
        res.data.forEach(user => {
            let elementUser = `
    <div class="user-profile">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="/profile">
            <img width="48px" height="48px"
                src="https://img.freepik.com/free-photo/portrait-american-black-person-looking-up_23-2148749586.jpg"
                class="rounded-circle me-2 img-profile" alt="">
            <div class="user-info">
                <span class="user-email">${user.email}</span>
                <!-- Add more user information here if needed -->
            </div>
        </a>
    </div>
`;

            users.insertAdjacentHTML("beforeend", elementUser);
        });
    });
}

// document.addEventListener('click', function (event) {
//     var offcanvas = document.getElementById('offcanvasScrolling');
//     var target = event.target;
//     var isClickInside = offcanvas.contains(target);
//     if (!isClickInside) {
//         var bsOffcanvas = new bootstrap.Offcanvas(offcanvas);
//         bsOffcanvas.hide();
//     }
// });
