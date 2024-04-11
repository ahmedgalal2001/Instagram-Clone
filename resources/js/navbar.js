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
var helperList = document.getElementById('helper-list');
sceond_view.style.display = "none";
first_view.style.display = "flex";


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
    console.log(file, caption);
    let formData = new FormData();
    formData.append('myfile', file);
    formData.append('commit_message', caption);
    modal_create_post.classList.remove("modal-xl");
    form.innerHTML = `
    <div class="text-center">
         <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
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
            form.innerHTML = `
            <div class="d-flex justify-content-center">
            <img src="https://static.cdninstagram.com/rsrc.php/v3/yb/r/sHkePOqEDPz.gif" class="img-fluid" alt="...">
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
    console.log(inputText); // Split by spaces and get the last element
    if (inputText.includes("#")) {
        var hashtags = inputText.match(/#[a-zA-Z0-9_]+/g) || [];
        if (hashtags.length > 0) {
            hashtags.map(function (tag) {
                let tagName = tag.substring(1);
                console.log(tagName);
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
            console.log(res.data.hashtages);
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
search_username.input = () => {
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

// when i click about body will close automaicaly
document.addEventListener('click', function (e) {
    var offcanvas = document.querySelector('.offcanvas.show');
    if (offcanvas && !offcanvas.contains(e.target)) {
        offcanvas.classList.remove('show');
    }
});
