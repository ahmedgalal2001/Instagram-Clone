import axios from "axios";

let myfile = document.getElementById("upload-img-navbar");
let img_post = document.getElementById("img-post");
let first_view = document.querySelector("#first-view");
let sceond_view = document.querySelector("#sceond-view");
let search_username = document.querySelector("#search-username");
let users = document.querySelector("#users");
let modal_create_post = document.querySelector("#modal-create-post");

sceond_view.style.display = "none";
first_view.style.display = "flex";




myfile.addEventListener('change', function (event) {
    first_view.style.display = "none";
    sceond_view.style.display = "block";
    var selectedFile = event.target.files[0];
    var imgUrl = URL.createObjectURL(selectedFile);
    img_post.src = imgUrl;
    modal_create_post.classList.add("modal-xl");
});

search_username.onkeyup = () => {
    users.innerHTML = "";
    let username = search_username.value;
    console.log(username);
    axios.get(`/users/${username}`).then((res) => {
        res.data.forEach(user => {
            let elementUser = `
    <div class="user-profile">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="/profile">
            <img width="48px" height="48px"
                src="https://img.freepik.com/free-photo/portrait-american-black-person-looking-up_23-2148749586.jpg"
                class="rounded-circle me-2 img-profile" alt="">
            <div class="user-info">
                <span class="user-email">${user.name}</span>
                <!-- Add more user information here if needed -->
            </div>
        </a>
    </div>
`;
            users.insertAdjacentHTML("beforeend", elementUser);
        });
    });
}

function closeOffcanvas() {
    var offcanvas = document.getElementById('offcanvasScrolling');
    offcanvas.classList.remove('show');
    offcanvas.setAttribute('aria-hidden', 'true');
    offcanvas.setAttribute('style', 'display: none');
}

// Event listener to handle click outside offcanvas
window.addEventListener('click', function (event) {
    var offcanvas = document.getElementById('offcanvasScrolling');
    var toggleButton = document.getElementById('offcanvasToggle');
    var isClickInsideOffcanvas = offcanvas.contains(event.target);
    var isToggleButton = toggleButton.contains(event.target);
    if (!isClickInsideOffcanvas && !isToggleButton) {
        var offcanvasRect = offcanvas.getBoundingClientRect();
        var isNearOffcanvas = event.clientX >= offcanvasRect.left && event.clientX <= offcanvasRect.right &&
            event.clientY >= offcanvasRect.top && event.clientY <= offcanvasRect.bottom;
        if (!isNearOffcanvas) {
            closeOffcanvas();
        }
    }
});

// Event listener to toggle offcanvas visibility
document.getElementById('offcanvasToggle').addEventListener('click', function () {
    var offcanvas = document.getElementById('offcanvasScrolling');
    offcanvas.classList.toggle('show');
    offcanvas.setAttribute('aria-hidden', offcanvas.classList.contains('show') ? 'false' : 'true');
    offcanvas.setAttribute('style', offcanvas.classList.contains('show') ? 'display: block' : 'display: none');
});
