import axios from "axios";

let myfile = document.getElementById("upload-img-post");
let img_post = document.getElementById("img-post");
let first_view = document.querySelector("#first-view");
let sceond_view = document.querySelector("#sceond-view");
let search_username = document.querySelector("#search-username");
let users = document.querySelector("#users");
let modal_create_post = document.querySelector("#modal-create-post");
let create_post = document.querySelector("#create-post");
let caption = document.getElementById("caption");
var form = document.getElementById("uploadForm");
let btn_upload_file = document.querySelector("#btn-upload-file");
var helperList = document.getElementById('helper-list');
sceond_view.style.display = "none";
first_view.style.display = "flex";
btn_upload_file.style.display = "none";



create_post.addEventListener('hidden.bs.modal', () => {
    first_view.style.display = "flex";
    sceond_view.style.display = "none";
    if (myfile.files.length > 0)
        window.location.reload();
    if (modal_create_post.classList.contains("modal-xl"))
        modal_create_post.classList.remove("modal-xl");
});



// Add an event listener to intercept the form submission
form.addEventListener("submit", function (event) {
    event.preventDefault();
    let file = form.myfile.files[0];
    let caption = form.commit_message.value;
    let formData = new FormData();
    formData.append('myfile', file);
    formData.append('commit_message', caption);
    modal_create_post.classList.remove("modal-xl");
    btn_upload_file.style.display = "none";
    sceond_view.innerHTML = `
    <div class="d-flex justify-content-center">
    <div class='spinner'></div>
</div>
    `;
    // Send data to server using Axios
    axios.post('/posts', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(function (response) {
            setTimeout(() => { window.location.reload() }, 1500);
            modal_create_post.classList.remove("modal-xl");
            sceond_view.innerHTML = `
            <div class="d-flex justify-content-center">
            <img src="https://static.cdninstagram.com/rsrc.php/v3/yb/r/sHkePOqEDPz.gif"  class="img-fluid" alt="...">
            </div>
            `;
        })
        .catch(function (error) {
            // Handle error response
            console.error('Error uploading file:', error);
            // Optionally, perform any additional actions here
        });
});


// helper list to apprea hashtage
caption.oninput = function () {
    var inputText = caption.value.split(" ").pop();
    if (inputText.includes("#")) {
        var hashtags = inputText.match(/#[a-zA-Z0-9_]+/g) || [];
        if (hashtags.length > 0) {
            hashtags.map(function (tag) {
                let tagName = tag.substring(1);
                selectHashtag(tagName);
                return tagName;
            });
        } else hideHelperList();
    } else {
        hideHelperList();
    }
}

helperList.addEventListener('click', function (event) {
    if (event.target.tagName.toLowerCase() === 'li') {
        var clickedTag = event.target.textContent;
        var words = caption.value.split(" ");
        words.pop();
        caption.value = words.join(" ");
        caption.value += " #" + clickedTag + " ";
        caption.focus();
    }
    hideHelperList();
});

function showHelperList(hashtags) {

    helperList.innerHTML = "";
    hashtags.forEach(function (tag) {
        let str = `
        <li class="list-group-item" onclick=>${tag.tag}</li>
        `;
        helperList.innerHTML += str;
    });
    helperList.style.display = "block";
}

function hideHelperList() {
    var helperList = document.getElementById('helper-list');
    helperList.style.display = "none";
}
function selectHashtag(tag) {
    axios.get(`/hashtags/filter/${tag}`)
        .then((res) => {
            if (res.data.hashtages.length > 0)
                showHelperList(res.data.hashtages);
            else hideHelperList();
        })
        .catch((error) => {
            console.error("Error fetching data:", error);
        });
}



myfile.addEventListener('change', function (event) {
    first_view.style.display = "none";
    btn_upload_file.style.display = "inline-block";
    sceond_view.style.display = "block";
    var selectedFile = event.target.files[0];
    var fileExtension = selectedFile.name.split('.').pop().toLowerCase();
    var fileUrl = URL.createObjectURL(selectedFile);
    if (['mp4', 'mov', 'avi'].includes(fileExtension)) {
        img_post.style.display = "none";
        var videoElement = document.createElement('video');
        videoElement.src = fileUrl;
        videoElement.controls = true; // Add controls to the video
        var videoContainer = document.getElementById('videoContainer');
        videoElement.classList.add("w-100");
        videoContainer.innerHTML = '';
        videoContainer.appendChild(videoElement);
    } else {
        img_post.style.display = "block";
        img_post.src = fileUrl;
    }

    modal_create_post.classList.add("modal-xl");
});

// search and print list of users
search_username.oninput = () => {
    users.innerHTML = "";
    let username = search_username.value;
    axios.get(`/users/${username}`).then((res) => {
        if (res.data.length > 0)
            res.data.forEach(user => {
                let elementUser = `
    <div class="user-profile">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="/profile">
            <img width="48px" height="48px"
                src="${user.image}"
                class="rounded-circle me-2 img-profile" alt="">
            <div class="user-info">
            <span class="user-username">${user.username}</span>
            <span class="user-name">${user.name}</span>
            </div>
        </a>
    </div>
`;
                users.insertAdjacentHTML("beforeend", elementUser);
            });
    });
}
$(document).ready(function () {
    $('.links-navbar').click(function () {
        $('.links-navbar').each(function () {
            var $currentLink = $(this);
            var defaultImgSrc = $currentLink.data("img-src-default");
            var $img = $currentLink.find("img");
            $img.attr("src", defaultImgSrc);
        });
        var imgSrc = $(this).data('img-src');
        $(this).find("img").attr("src", imgSrc);
        var $span = $(this).find("span");
        $span.css("font-weight", "bold");
    });
    $(document).on('click', function (e) {
        var $modal = $('.modal.show');
        var $offcanvas = $('.offcanvas.show');
        if (!$modal.is(e.target) && $modal.has(e.target).length === 0 &&
            !$offcanvas.is(e.target) && $offcanvas.has(e.target).length === 0) {
            $modal.modal('hide');
            $offcanvas.offcanvas('hide');
        }
        helperLinkeRouter();
    });
    $('#notify').on('hidden.bs.offcanvas', function () {
        helperLinkOff("offcanvasToggleNotify");
    });
    $('#search').on('hidden.bs.offcanvas', function () {
        helperLinkOff("offcanvasToggleSearch");
    });
    $('#create-post').on('hidden.bs.modal', function () {
        helperLinkOff("modalCreate");
    });
    helperLinkeRouter();
});

function helperLinkeRouter() {
    var currentRoute = window.location.pathname;
    let str = "";
    if (currentRoute.includes("/profile")) {
        str = "profile-navbar";
    }
    else if (currentRoute.includes("/")) {
        str = "home-navbar";
    }
    helperLinkOn(str);
}

function helperLinkOn(str) {
    var $currentLink = $(`#${str}`);
    var imgSrc = $currentLink.data('img-src');
    $currentLink.find("img").attr("src", imgSrc);
    var $span = $currentLink.find("span");
    $span.css("font-weight", "bold");
}
function helperLinkOff(str) {
    var $currentLink = $(`#${str}`);
    var defaultImgSrc = $currentLink.data("img-src-default");
    var $img = $currentLink.find("img");
    $img.attr("src", defaultImgSrc);
    var $span = $currentLink.find("span");
    $span.css("font-weight", "normal");
}
