
const UsersLiked = document.querySelector(".usersLiked");
const imgVideoPost = document.querySelector(".img_post");
const parentPostIcon = document.querySelector(".postIcon");
const parentBookMark=document.querySelector(".parentBookMark");
const parentComments = document.querySelector(".parent-comments");

const post = document.querySelectorAll(".post");

//-----------------------modal post Details----------------------------------------------

post.forEach((a) => {
    a.addEventListener("click", () => {
        let postId = a.getAttribute("post-id");

        axios
            .get(`/post/${postId}`)
            .then((res) => {
                const postData = res.data.post;

                console.log(res.data);




    //----------------------------parent Modal Details for user.------------------------------------------
    const parentModalDetails=document.querySelector(".profile-details-card")
    console.log(parentModalDetails);
        parentModalDetails.innerHTML=`

        <div class="card w-100 px-1 pt-0 details-card">
        <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
            <div class="row m-0 p-0">
                <div class="col-md-9 d-flex align-items-center p-0">
                    <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                        <div class="position-relative avatar-container">
                            <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png"
                                class="rounded-circle mb-3 avatar" width="50px" height="50px" alt="Avatar" />
                        </div>
                    </div>
                    <div class="col-md-9 mx-3">
                        <div class="d-flex">
                            <p class="mb-0 h6">${postData.user.name}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <p class="m-0">2200</p>
                    <p class="m-0">Posts</p>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-center">
                    <p class="m-0">1M</p>
                    <p class="m-0">followers</p>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-center">
                    <p class="m-0">50k</p>
                    <p class="m-0">following</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-between">
                <div class="col-md-4 col-sm-12">
                    <img src="${postData.image_url}" class="w-100 h-100 profile-post-hover">
                </div>
                <div class="col-md-4 col-sm-12">
                    <img src="${postData.image_url}" class="w-100 h-100 profile-post-hover">
                </div>
                <div class="col-md-4 col-sm-12">
                    <img src="${postData.image_url}" class="w-100 h-100 profile-post-hover">
                </div>
            </div>
            <div class="row mt-3">
                <div class=" col-lg-7 col-md-12 col-sm-12 mb-2">
                    <a href="${postData.user.id}" class="custom-link btn btn-primary text-white ">
                        <i class="fa-solid fa-user"></i> View Profile
                    </a>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 mt-md-0 mt-2">
                    <button class="followModal btn btn-primary ">
                        <i class="fa-solid fa-user-plus"></i> follow
                    </button>
                </div>
            </div>
        </div>
    </div>

    `;

const followBtn=document.querySelector('.followModal');
//-----------------------follow btn in Modal details user-----------------------
followBtn.addEventListener("click", async () => {
    let followingId = postData.user.id;

//-----------check user Following or unfollow for other user-------------------------
    if (followBtn.textContent === "Following") {
        axios
            .delete(`/following/${followingId}`)
            .then((res) => {
                console.log(res.data);
                followBtn.innerHTML = ` <i class="fa-solid fa-user-plus"></i> follow`;

            })
            .catch((err) => {
                console.error(err);
            });
    } else {
        await axios
            .post("/follow", { user_id: followingId })
            .then((res) => {
                console.log(res.data);
                followBtn.innerHTML = "Following";

            })
            .catch((err) => {
                console.error(err);
            });
        }});


//------------------------------Update caption and display image or video----------------------------------
                caption.textContent = postData.caption;
                imgVideoPost.innerHTML = "";

                if (postData.video === 0) {
                    imgVideoPost.innerHTML = `
                    <img src="${postData.image_url}" alt="post title" height="100px" width="100px" class="image" />`;
                } else {
                    imgVideoPost.innerHTML = `
                    <video controls src="${postData.image_url}" class="img-fluid"></video>`;
                }

//----------------------------Render user's comments-------------------------------------------------------
            parentComments.innerHTML = `
            <li class="list-group-item border-0 p-0">
                <div class="d-flex justify-content-start align-items-center gap-1">
                <img src="${postData.user.image}" class="rounded-circle" alt="img" height="35px width="35px" />
                    <div class="d-flex">
                        <p class="fs-6 mx-2" style="font-weight: bold">${
                            postData.user.name
                        }</p>
                        <p class="caption mx-1" style="font-size:15px;">${
                            postData.caption
                        }</p>
                    </div>
                </div>
                <div class="d-flex">
                    <a type="button" class="custom-link">
                        <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                            <a href="" class="text-secondary custom-link mx-2">${formatDateRelativeToNow(
                                postData.created_at
                            )}</a>
                        </p>
                    </a>
                </div>
            </li>
            `;

            parentComments.innerHTML +=
            postData.comments.length == 0
                ? `<div class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                <h3> no comments yet</h3>
            </div>`
                : postData.comments
                    .map(
                        (comment) => `
                <li class="list-group-item border-0 p-0">
                    <div class="d-flex justify-content-start align-items-center gap-1">
                    <img src="${postData.user.image}" class="rounded-circle" alt="img" height="35px width="35px" />
                        <div class="commentOnPost d-flex">
                            <p class="fs-6 mx-2" style="font-weight: bold">${comment.user.name}</p>
                            <p class="fs-6 mx-2" style="font-weight: bold">${comment.comment_text}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a type="button" class="custom-link">
                            <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                <a href="" class="text-secondary custom-link mx-2">${formatDateRelativeToNow(comment.created_at)}</a>
                            </p>
                        </a>
                    </div>
                </li>
            `
                    )
                    .join("");
//-----------------------add comment---------------------------------------------------

            const parentComment=document.querySelector('.parentComment');

            parentComment.innerHTML=`

                <div class="col-10">
                <input type="text" post-id=${postData.id} class="comment-txt  border-0 rounded-1 btn btn-white"
                placeholder="Add a comment..." />

                    </div>
                    <div class="col-2">
                    <a type="button" class="submitComment custom-link">Post</a>
            </div>
                    `;
                    const InputText=document.querySelector(".comment-txt");
                    const submitButton=document.querySelector('.submitComment');


                InputText.addEventListener('input', function () {
                let isEmpty = InputText.value.trim() === '';
                let submitButton = InputText.parentElement.nextElementSibling.querySelector(".submitComment");
                console.log(isEmpty);
                submitButton.style.display = isEmpty ? 'none' : 'inline-block';
            });


            const countcommentPost=document.querySelector('.countcommentPost');
            submitButton.addEventListener('click', function () {
                let postId = InputText.getAttribute('post-id');
                let commentText =InputText.value.trim();
                axios.post("/comment", { "id": postId, "comment": commentText})
                .then((res) => {
                    console.log(res.data.commentsCount.comments_count);
                    if(res.data.commentsCount.comments_count == 1)
                    {
                        parentComments.innerHTML =
                        `
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="${postData.user.image}" class="rounded-circle" alt="img" height="35px width="35px" />
                                <div class="commentOnPost d-flex">
                                    <p class="fs-6 mx-2" style="font-weight: bold">${postData.user.name}</p>
                                    <p class="fs-6 mx-2" style="font-weight: bold">${res.data.comment.comment_text}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a type="button" class="custom-link">
                                    <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                        <a href="" class="text-secondary custom-link mx-2">${res.data.created_at}</a>

                                    </p>
                                </a>
                            </div>
                        </li>
                    `;
                    }else{
                parentComments.innerHTML +=
                `
                    <li class="list-group-item border-0 p-0">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                        <img src="${postData.user.image}" class="rounded-circle" alt="img" height="35px width="35px" />
                            <div class="commentOnPost d-flex">
                                <p class="fs-6 mx-2" style="font-weight: bold">${postData.user.name}</p>
                                <p class="fs-6 mx-2" style="font-weight: bold">${res.data.comment.comment_text}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a type="button" class="custom-link">
                                <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                    <a href="" class="text-secondary custom-link mx-2">${res.data.created_at}</a>

                                </p>
                            </a>
                        </div>
                    </li>
                    `;
                }
                countcommentPost.innerHTML=res.data.commentsCount.comments_count;

            }).catch((error) => {
                console.error('Error:', error);

            });
            });

//-----------------------End comment---------------------------------------------------

//------------------------date Of Post---------------------------------------------
            const DateOfPost=document.querySelector('.dateOfPost')
            DateOfPost.innerHTML=`
            <a type="button" class="custom-link">
            <p  class="text-secondary m-0 fs-6">${formatDateRelativeToNow(postData.created_at)}</p>
        </a>
            `;


//---------------------------like-----------------------------------------------------------
const countLikePost=document.querySelector('.countLikePost');
                const icon = document.createElement("div");
                parentPostIcon.innerHTML = "";
                icon.innerHTML = `
            <a type="button"
                    class="btn-${res.data.post.id} "
                    data-bs-post="${res.data.post.id}"
                    id="like-btn-modal">
                    <h4><b><i class="fa-regular fa-heart"></i></b></h4>
                    </a>

            <a type="button" class="custom-link">
                <h4><b><i class="fa-regular fa-comment"></i></b></h4>
            </a>

            <a type="button" class="custom-link">
                <h4><b><i class="far fa-paper-plane"></i></b></h4>
            </a>
        `;

                parentPostIcon.appendChild(icon);

                let postLikeModal = document.querySelector(
                    `.btn-${res.data.post.id}`
                );
                console.log(postLikeModal);

                res.data.post_like.likes.map(function (x) {
                    postLikeModal.setAttribute("data-bs-like", `${x.id}`);

                    if (res.data.logged_user == x.user_id)
                        postLikeModal.setAttribute(
                            "style",
                            "color: red !important"
                        );
                    else
                        postLikeModal.setAttribute(
                            "style",
                            "color: black !important"
                        );
                });

                postLikeModal.addEventListener("click", function () {
                    let postId = postLikeModal.getAttribute("data-bs-post");
                    let likeId = postLikeModal.getAttribute("data-bs-like");

                    if (postLikeModal.style.color === "red") {
                        postLikeModal.style.color = "black";
                        axios.delete(`/like/destroy/${likeId}`).then((res) => {
                            console.log(res.data);
                            res.data.likes[lastLike].user.name

                        });
                    } else {
                        postLikeModal.style.color = "red";
                        axios.post("/like", { id: postId }).then((res) => {
                            postLikeModal.setAttribute(
                                "data-bs-like",
                                res.data.id
                            );
                            console.log(res.data);
                            countLikePost.textContent=res.data.Likes;
                        });
                    }
                });

/***************************************************************************** */

//-------------------------------------Render Display likes------------------------------------
                const likesCount = res.data.likes.length;
                const lastLike = likesCount - 1;
                const likeContent =
                    likesCount === 0
                        ? ""
                        : likesCount === 1
                        ? `<p class="m-1 mx-0">Liked by</p>
                        <a type="button" class="custom-link">
                            <p class="m-1"><b>${res.data.likes[lastLike].user.name}</b></p>
                        </a>`
                        : `<p class="m-1 mx-0">Liked by</p>
                        <a type="button" class="custom-link">
                            <p class="m-1"><b>${
                                res.data.likes[lastLike].user.name
                            }</b></p>
                        </a>
                        <p class="m-1">and</p>
                        <a type="button" class="custom-link">
                            <p class="m-1">${likesCount - 1}<b> others</b></p>
                        </a>`;

                UsersLiked.innerHTML = `<div class="d-flex">${likeContent}</div>`;



 //-----------------------------Save post-------------------------------------------------
        const bookMark = document.createElement("div");
        parentBookMark.innerHTML ="";
        bookMark.innerHTML = `
            <a type="button" id="${res.data.post.id}"
            data-bs-post="${res.data.post.id}"
            class="bookmark-btn" id="book-mark-btn">
            <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>

        </a>

        `;
        parentBookMark.appendChild(bookMark);

        let postSaveModal = document.getElementById(`${res.data.post.id}`);
        console.log(postSaveModal);

        console.log( res.data.saved_posts);

        res.data.saved_posts.savedposts.map(function (x) {
            postSaveModal.setAttribute("data-bs-post", `${x.id}`);

            // console.log(res.data.logged_user);
            if (res.data.logged_user == x.pivot.user_id) {
                postSaveModal.setAttribute(
                    "style",
                    "color: orange !important"
                );
            } else postSaveModal.setAttribute("style", "color: black !important");
        });


        postSaveModal.addEventListener("click", function () {
            let postId = postSaveModal.getAttribute("data-bs-post");

            if (postSaveModal.style.color === "orange") {
                postSaveModal.style.color = "black ";
                console.log(postId);
                axios.delete(`/save/destroy/${postId}`).then((res) => {
                    console.log(res.data);
                });
            } else {
                postSaveModal.style.color = "orange ";
                axios.post("/save", { id: postId }).then((res) => {
                    // console.log(res.data);
                });
            }
        });



/////////////////////////////////////////////////////////////////////////////////////////////
}).catch((err) => {
    console.error(err);
})

})
})



//-------------------card Details user---------------------------------------------------

let avatarImg = document.querySelector(".avatar");
let postsContainer = document.querySelector(".profile-details-card");

console.log(postsContainer);

document.addEventListener("DOMContentLoaded", function () {
    let avatarImg = document.querySelector(".avatar");
    let avatarContainer = document.querySelector(".avatar-container");
    let postsContainer = document.querySelector(".main-post-div");
    console.log(avatarContainer);

    avatarImg.addEventListener("mouseenter", function () {
        let profileDetailsCard = avatarImg
            .closest(".avatar-container")
            .querySelector(".profile-details-card");
        if (profileDetailsCard) {
            profileDetailsCard.style.display = "block";
        }
    });

    avatarContainer.addEventListener("mouseleave", function () {
        let profileDetailsCard = avatarContainer.querySelector(
            ".profile-details-card"
        );
        if (profileDetailsCard) {
            profileDetailsCard.style.display = "none";
        }
    });

    postsContainer.addEventListener("mouseleave", function () {
        let profileDetailsCard = postsContainer.querySelector(
            ".profile-details-card"
        );
        if (profileDetailsCard) {
            profileDetailsCard.style.display = "none";
        }
    });
});




//----------------------Calc post created age-----------------------------------------------
function formatDateRelativeToNow(dateString) {
    const date = new Date(dateString);
    const currentDate = new Date();
    const timeDifference = currentDate.getTime() - date.getTime();
    const minutesDifference = Math.floor(timeDifference / (1000 * 60));
    const hoursDifference = Math.floor(minutesDifference / 60);
    const daysDifference = Math.floor(hoursDifference / 24);
    const weeksDifference = Math.floor(daysDifference / 7);
    const yearsDifference = Math.floor(daysDifference / 365);

    if (yearsDifference > 0) {
        return `${yearsDifference}`;
    } else if (weeksDifference > 0) {
        return `${weeksDifference}`;
    } else if (daysDifference > 0) {
        return `${daysDifference}D`;
    } else if (hoursDifference > 0) {
        return `${hoursDifference}H`;
    } else {
        return `${minutesDifference}M`;
    }
}
