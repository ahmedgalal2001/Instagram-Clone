import axios from "axios";

let People = document.querySelector("#People");
let Hashtags = document.querySelector("#Hashtags");
let bodyPeople = document.querySelector("#bodyPeople");
let bodyHashtags = document.querySelector("#bodyHashtags");
let posts = document.querySelector("#Posts");
let Save = document.querySelector("#Save");
let Tagged = document.querySelector("#Tagged");
let bodyPosts = document.querySelector("#bodyPosts");
let bodySave = document.querySelector("#bodySave");
let bodyTagged = document.querySelector("#bodyTagged");

//------------posts,save Tagged sections--------------------------
posts.addEventListener("click", () => {
    bodyPosts.classList.remove("d-none");
    bodySave.classList.add("d-none");
    bodyTagged.classList.add("d-none");

    posts.classList.add("border-top", "border-dark");
    Save.classList.remove("border-top", "border-dark");
    Tagged.classList.remove("border-top", "border-dark");

    posts.classList.remove("text-muted");
    Save.classList.add("text-muted");
    Tagged.classList.add("text-muted");
});

Save.addEventListener("click", () => {
    bodyPosts.classList.add("d-none");
    bodySave.classList.remove("d-none");
    bodyTagged.classList.add("d-none");

    posts.classList.remove("border-top", "border-dark");
    Save.classList.add("border-top", "border-dark");
    Tagged.classList.remove("border-top", "border-dark");

    posts.classList.add("text-muted");
    Save.classList.remove("text-muted");
    Tagged.classList.add("text-muted");
});

Tagged.addEventListener("click", () => {
    bodyPosts.classList.add("d-none");
    bodySave.classList.add("d-none");
    bodyTagged.classList.remove("d-none");

    posts.classList.remove("border-top", "border-dark");
    Save.classList.remove("border-top", "border-dark");
    Tagged.classList.add("border-top", "border-dark");

    posts.classList.add("text-muted");
    Save.classList.add("text-muted");
    Tagged.classList.remove("text-muted");
});
//----------People and Hashtags setction--------------------------

People.addEventListener("click", () => {
    bodyPeople.classList.remove("d-none");
    bodyHashtags.classList.add("d-none");
    People.classList.add("text-muted");
    Hashtags.classList.remove("text-muted");
});

Hashtags.addEventListener("click", () => {
    bodyPeople.classList.add("d-none");
    bodyHashtags.classList.remove("d-none");
    People.classList.remove("text-muted");
    Hashtags.classList.add("text-muted");
});

//--------------------------------------------------------------
const count_followers = document.querySelector(".count_followers");
const count_followings = document.querySelector(".count_followings");
const parentComments = document.querySelector(".parent-comments");
const parentFollowers = document.querySelector(".parentFollowers");
const parentFollowings = document.querySelector(".parentFollowings");
const searchFollowers = document.querySelector(".searchFollowers");
const searchFollowings = document.querySelector(".searchFollowings");
const FollowUser = document.querySelector(".FollowUser");
const caption = document.querySelector(".caption");
const post = document.querySelectorAll(".post");

console.log(FollowUser);
//-----------------------------------------------------------------------------------

if (FollowUser) {
    FollowUser.addEventListener("click", async () => {
        const userId = FollowUser.getAttribute("user-id");
        // console.log(userId);
        //-----------check user Following or unfollow for other user-------------------------
        if (FollowUser.textContent === "Follow") {
            await axios
                .post("/follow", { user_id: userId })
                .then((res) => {
                    FollowUser.innerHTML = "Following";

                })
                .catch((err) => {
                    console.error(err);
                });
        } else {
            axios
                .delete(`/following/${userId}`)
                .then((res) => {
                    FollowUser.innerHTML = "Follow";

                })
                .catch((err) => {
                    console.error(err);
                });
        }
    });
}

//-------------------Load All Followers on Modal by default-----------------------
function loadAllFollowers() {
    const user_id = parentFollowers.getAttribute("user-id");
    axios
        .get(`/followers/${user_id}`)
        .then((res) => {
            console.log(res.data);
            displayFollowers(
                res.data.followers,
                res.data.followingsIds,
                res.data.Current_Usr,
                res.data.followingsIdForCurrentUsr
            );
        })
        .catch((err) => {
            console.error(err);
        });
}

//-----------------Filter  Followers  depend on name User-------------------------
function filterFollowers(nameUser) {
    const user_id = parentFollowers.getAttribute("user-id");

    axios
        .get(`/followers/${user_id}/${nameUser}`)
        .then((res) => {
            let followers = res.data.followers;
            console.log(res.data.Current_Usr);

            if (typeof followers === "object" && !Array.isArray(followers)) {
                followers = Object.entries(followers).map(([key, value]) => ({
                    id: key,
                    ...value,
                }));
            }
            displayFollowers(
                followers,
                res.data.followingsIds,
                res.data.Current_Usr
            );
        })
        .catch((err) => {
            console.error(err);
        });
}

//----------------Display Followers---------------------------------
function displayFollowers(followers, followingsIds, currentUser,followingsIdForCurrentUsr) {
    parentFollowers.innerHTML = "";

    if (followers.length === 0) {
        const nofollower = document.createElement("div");
        nofollower.innerHTML = `
        <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
        #
        <h3>No results</h3>
       </li>
        `;
        parentFollowers.appendChild(nofollower);
    } else {
        let random = 0.0;
        followers.forEach((follower) => {
            random = Math.random();
            parentFollowers.innerHTML += `
            <a   href="${follower.id}" class="custom-link">
                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-start align-items-center gap-1">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                            class="rounded-circle img-fluid" alt="img" width="50px" />
                        <div class="d-flex flex-column">
                            <p class="fs-5 mt-3  mx-1" >
                            ${follower.username}
                            <span id="${random}">
                            ${
                                followingsIds.includes(follower.id)
                                    ? ""
                                    : `<button class=" btn btn-white follow"  follow_id="${follower.id}" ><span class="fs-6 text-primary fw-bold">Follow</span></button>`
                            }
                            </span>
                            </p>
                            <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                ${follower.name}
                            </p>

                        </div>
                    </div>
                    <div>
                    ${
                        currentUser === true
                            ? `<button type="button" class="remove-follower-btn btn btn-primary btn-sm fs-6" data-follower-id="${follower.id}">Remove</button>`
                            : followingsIdForCurrentUsr.includes(follower.id) ?
                            `<button class=" btn btn-primary follow"  follow_id="${follower.id}" ><span class="fs-6 text-white fw-bold">Following</span></button>`
                            :`<button class=" btn btn-primary follow"  follow_id="${follower.id}" ><span class="fs-6 text-white fw-bold">Follow</span></button>`
                    }

                    </div>
                </li>
                </a>
            `;

            let dtt = document.getElementById(`${random}`);
            let str = `
           <button class=" btn btn-white follow"  follow_id="${follower.id}" ><span class="fs-6 text-primary fw-bold">Follow</span></button>
            `;
            if (!followingsIds.includes(follower.id) && currentUser) {
                dtt.innerHTML = str;
            } else {
                dtt.innerHTML = "";
            }
        });

//--------------------------------remove follower--------------------------------------
        parentFollowers
            .querySelectorAll(".remove-follower-btn")
            .forEach((btn) => {
                btn.addEventListener("click", () => {
                    const followerId = btn.getAttribute("data-follower-id");

                    axios
                        .delete(`/followers/${followerId}`)
                        .then((res) => {
                            btn.closest("li").remove();
                            count_followings.textContent =
                                res.data.count.following_count;
                            count_followers.textContent =
                                res.data.count.followers_count;
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                });
            })


//-------------------------unfollow and following in Followers--------------------------------------
        document.querySelectorAll(".follow").forEach((btn) => {
            btn.addEventListener("click", async () => {
                const follow_id = btn.getAttribute("follow_id");

        //-----------check user Following or unfollow for other user-------------------------

                if (btn.textContent === "Follow") {
                    await axios
                        .post("/follow", { user_id: follow_id })
                        .then((res) => {
                            console.log(res.data);
                            btn.textContent = "Following";
                            if(res.data.currentUser){
                                count_followings.textContent =
                                    res.data.count.following_count;
                                }
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                } else {
                    axios
                        .delete(`/following/${follow_id}`)
                        .then((res) => {
                            btn.textContent = "Follow";
                            if(res.data.currentUser){
                                count_followings.textContent =
                                    res.data.count.following_count;
                                }
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                }
            });
        });
    }
}

//----------------check on user if enter name user or not------------------------------
searchFollowers.addEventListener("input", () => {
    const follower = searchFollowers.value.trim();
    if (follower === "") {
        loadAllFollowers();
    } else {
        filterFollowers(follower);
    }
});

//-------load All Followers by default--------------------------------------------------
loadAllFollowers();



//#region------------------ Followings------------------------------------------------


//-------------------Load All Followings on Modal by default--------------------------
function loadAllFollowings() {
    const userId = parentFollowings.getAttribute("user-id");

    axios
        .get(`/followings/${userId}`)
        .then((res) => {
            console.log(res.data.followingsId);
            displayFollowings(res.data.followings,res.data.Current_Usr,res.data.followingsId);
        })
        .catch((err) => {
            console.error(err);
        });
}

//-------------------------Filter  Followings  depend on name User-------------------------
function filterFollowings(nameUser) {
    const userId = parentFollowings.getAttribute("user-id");
    axios
        .get(`/followings/${userId}/${nameUser}`)
        .then((res) => {
            let followings = res.data.followings;

            console.log(res.data);

            if (typeof followings === "object" && !Array.isArray(followings)) {
                followings = Object.entries(followings).map(([key, value]) => ({
                    id: key,
                    ...value,
                }));
            }
            displayFollowings(followings);
        })
        .catch((err) => {
            console.error(err);
        });
}

//----------------Display Followers---------------------------------------------------------
function displayFollowings(followings,currentUser,followingsIdCurrentUsr) {
    parentFollowings.innerHTML = "";

    if (followings.length === 0) {
        const nofollowing = document.createElement("div");
        nofollowing.innerHTML = `
        <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
        #
        <h3>No results</h3>
       </li>

        `;
        parentFollowings.appendChild(nofollowing);
    } else {
        followings.forEach((following) => {
            console.log(following.id);
            const newFollowing = document.createElement("div");
            newFollowing.innerHTML = `
            <a   href="${following.id}" class="custom-link">
            <li class="list-group-item  border-0 d-flex justify-content-between align-items-center ">
                <div class="d-flex justify-content-start align-items-center gap-1 ">
                    <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                        class="rounded-circle img-fluid" alt="img" width="50px" />
                    <div class="d-flex flex-column mx-1">
                        <p class="fs-5 mt-3">${following.username} </p>
                        <p class="text-secondary"
                            style="font-size:15px; font-weight: bold; margin-top:-19px;">${following.name}
                        </p>
                    </div>
                </div>
                <div>
                ${
                    following.id ==currentUser?
                    '': followingsIdCurrentUsr.includes(following.id)?

                    `<button type="button"  following-id="${following.id}" class="following-btn btn btn-primary  btn-sm fs-6">Following</button>`
                    :`<button type="button"  following-id="${following.id}" class="following-btn btn btn-primary  btn-sm fs-6">Follow</button>`
                }
                </div>
            </li>
            </a>
        `;
            parentFollowings.appendChild(newFollowing);
        });

//----------------------------Following button---------------------------------------------
        document.querySelectorAll(".following-btn").forEach((btn) => {
            btn.addEventListener("click", async () => {
                let followingId = btn.getAttribute("following-id");

 //-----------check user Following or unfollow for other user--------------------------------

                if (btn.textContent === "Following") {
                    axios
                        .delete(`/following/${followingId}`)
                        .then((res) => {
                            console.log(res.data);
                            console.log(currentUser);
                            btn.textContent = "Follow";
                            if(res.data.currentUser){
                            count_followings.textContent =
                                res.data.count.following_count;
                            }
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                } else {
                    await axios
                        .post("/follow", { user_id: followingId })
                        .then((res) => {
                            console.log(res.data);
                            btn.textContent = "Following";
                            if(res.data.currentUser){
                                count_followings.textContent =
                                    res.data.count.following_count;
                                }
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                }
            });
        });
    }
}

//----------------check on user if enter name user or not------------------------------
searchFollowings.addEventListener("input", () => {
    const following = searchFollowings.value.trim();
    if (following === "") {
        loadAllFollowings();
    } else {
        filterFollowings(following);
    }
});

//-------load All Followers by default--------------------------------------------------
loadAllFollowings();

//#endregion Followings


const UsersLiked = document.querySelector(".usersLiked");
const imgVideoPost = document.querySelector(".img_post");
const parentPostIcon = document.querySelector(".postIcon");
const parentBookMark=document.querySelector(".parentBookMark")
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
                            <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png" class="rounded-circle img-fluid" alt="img" width="35px" />
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
                    postData.comments.length === 0
                        ? `<div class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                        <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                        <h3> no comments yet</h3>
                    </div>`
                        : postData.comments
                              .map(
                                  (comment) => `
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex justify-content-start align-items-center gap-1">
                                <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png" class="rounded-circle img-fluid" alt="img" width="35px" />
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



                submitButton.addEventListener('click', function () {
                    let postId = InputText.getAttribute('post-id');
                    let commentText =InputText.value.trim();
                    axios.post("/comment", { "id": postId, "comment": commentText})
                    .then((res) => {
                    parentComments.innerHTML +=
                     `
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex justify-content-start align-items-center gap-1">
                                <img src="${res.data.user_name.image_url}" class="rounded-circle img-fluid" alt="img" width="35px" />
                                <div class="commentOnPost d-flex">
                                    <p class="fs-6 mx-2" style="font-weight: bold">${res.data.user_name.name}</p>
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

                        });
                    } else {
                        postLikeModal.style.color = "red";
                        axios.post("/like", { id: postId }).then((res) => {
                            postLikeModal.setAttribute(
                                "data-bs-like",
                                res.data.id
                            );
                            console.log(res.data);
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

//----------------------------Delete post------------------------------------------

                const parentDelete=document.querySelector('.parentDelete');
                console.log(parentDelete);
                parentDelete.innerHTML=`
                <h4><a type="button" post-id=${postData.id} class="btnDelete w-100 text-decoration-none text-danger"
                data-dismiss="modal">Delete</a></h4>`;

                const btnDelete=document.querySelector('.btnDelete')
                btnDelete.addEventListener("click",()=>{

                    const postID=btnDelete.getAttribute('post-id');
                                axios.delete(`/post/${postID}`)
                                .then((res)=>{
                                    console.log(res.data);
                                    location.reload()
                                })
                                .catch((err)=>{
                                    console.error(err);
                                });
                            })

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


        res.data.saved_posts.savedposts.map(function (x) {
            postSaveModal.setAttribute("data-bs-post", `${x.id}`);

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

                axios.delete(`/save/destroy/${postId}`).then((res) => {
                    // console.log(res.data);
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






// postLikeModal.addEventListener("click", function () {
//     let postId = postLikeModal.getAttribute("data-bs-post");
//     let likeId = postLikeModal.getAttribute("data-bs-like");

//     if (postLikeModal.style.color === "red") {
//         postLikeModal.style.color = "black";
//         axios.delete(`/like/destroy/${likeId}`).then((res) => {
//             console.log(res.data);

//         });
//     } else {
//         postLikeModal.style.color = "red";
//         axios.post("/like", { id: postId }).then((res) => {
//             postLikeModal.setAttribute(
//                 "data-bs-like",
//                 res.data.id
//             );
//             console.log(res.data);
//         });
//     }
// });

