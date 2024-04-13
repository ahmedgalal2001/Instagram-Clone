/************************************************ for home page *****************************************************/

import axios from "axios";

/************************** Post image hover timer **************************/

document.addEventListener("DOMContentLoaded", function () {
    let avatarImg = document.querySelectorAll(".avatar");
    let avatarContainer = document.querySelectorAll(".avatar-container");
    let postsContainer = document.querySelectorAll(".main-post-div");

    avatarImg.forEach((element) => {
        element.addEventListener("mouseenter", function () {
            let profileDetailsCard = element
                .closest(".avatar-container")
                .querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "block";
            }
        });
    });

    avatarContainer.forEach((container) => {
        container.addEventListener("mouseleave", function () {
            let profileDetailsCard = container.querySelector(
                ".profile-details-card"
            );
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });
    });

    postsContainer.forEach((container) => {
        container.addEventListener("mouseleave", function () {
            let profileDetailsCard = container.querySelector(
                ".profile-details-card"
            );
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });
    });
});

/***************** Toggle comment btn during typing *******************/

document.querySelectorAll(".comment-txt").forEach(function (input) {
    input.addEventListener("input", function () {
        let isEmpty = input.value.trim() === "";
        let submitButton =
            input.parentElement.nextElementSibling.querySelector(".commentBtn");
        submitButton.style.display = isEmpty ? "none" : "inline-block";
    });
});

document.querySelectorAll(".commentBtn").forEach(function (button) {
    button.addEventListener("click", function () {
        let random = 0.0;
        // console.log(random);
        let postId = button.parentElement.previousElementSibling
            .querySelector(".comment-txt")
            .getAttribute("data-bs-comment");
        let commentText = button.parentElement.previousElementSibling
            .querySelector(".comment-txt")
            .value.trim();
        // console.log("postID:", postId);
        // console.log("commentText:", commentText);
        axios
            .post("/comment", { id: postId, comment: commentText })
            .then((res) => {
                random = Math.random();
                // console.log(random);
                // console.log(res.data);
                let commentsNum = document.getElementById(
                    `view-all-comments-${postId}`
                );
                // Increment view all comments count
                if (commentsNum) {
                    commentsNum.innerText = `View all ${res.data.commentsCount.comments_count} comments`;
                }

                let newCommentDiv = document.createElement("div");
                newCommentDiv.classList.add(
                    "col-md-12",
                    "mb-0",
                    "aligh-items-center",
                    "d-flex",
                    `user-comment-${res.data.comment.id}`
                );
                newCommentDiv.innerHTML = `
              <div class="col-md-12 mb-0 aligh-items-center d-flex">
                  <div class="d-flex col-10 align-items-center">
                          <p>
                              <a 
                              href="${'/profile/' + res.data.comment.user_id}" 
                              class="text-decoration-none text-dark user-name-btn"
                              type="button">
                                  <b>${res.data.user_name}</b>
                              </a>
                              ${commentText}
                          </p>
                  </div>

                <div class="col-2 d-flex align-items-start justify-content-end">
                    <a type="button" 
                    class="comment-like post-comment-like-${res.data.comment.id} m-2" 
                    id="${random}"
                    data-bs-postCommment="${res.data.comment.id}"
                    data-bs-postId="${res.data.comment.post_id}">
                        <h6><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h6>
                    </a>
                </div>

              </div>
          `;

                let postContainer = document.getElementById(`post-${postId}`);
                let commentsContainer = postContainer.querySelector(
                    ".comments-container"
                );

                let noComment = document.getElementById(`No-Comment-${postId}`);
                if (commentsContainer) {
                    commentsContainer.appendChild(newCommentDiv);
                    if (noComment) noComment.style.display = "none";
                } else {
                    if (noComment) noComment.style.display = "block";
                }

                button.parentElement.previousElementSibling.querySelector(
                    ".comment-txt"
                ).value = "";

                this.style.display = "none";

                let commentLike = document.getElementById(`${random}`);
                // console.log(commentLike);
                commentLike.addEventListener("click", function () {
                    // console.log(random);
                    let commentId = commentLike.getAttribute(
                        "data-bs-postCommment"
                    );
                    // console.log(commentId);
                    let postId = commentLike.getAttribute("data-bs-postId");
                    // console.log(postId);
                    let commentLikeId = commentLike.getAttribute(
                        "data-bs-commentLike"
                    );

                    if (commentLike.style.color === "red") {
                        commentLike.style.color = "grey";
                        axios
                            .delete(`/commentlike/remove/${commentLikeId}`)
                            .then((res) => {
                                // console.log(res.data);
                            });
                    } else {
                        commentLike.style.color = "red";
                        axios
                            .post("/commentlike", {
                                id: postId,
                                comment_id: commentId,
                            })
                            .then((res) => {
                                // console.log(res.data);
                                commentLike.setAttribute(
                                    "data-bs-commentLike",
                                    res.data.id
                                );
                            });
                    }
                });
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});


/********************************** Status Menu***************************************/

document.addEventListener("DOMContentLoaded", function () {
    let scrollImages = document.querySelector(".scroll-images");
    let scrollLength = scrollImages.scrollWidth - scrollImages.clientWidth;
    let leftButton = document.querySelector(".left");
    let rightButton = document.querySelector(".right");

    function checkScroll() {
        let currentScroll = scrollImages.scrollLeft;
        if (currentScroll === 0) {
            leftButton.setAttribute("disabled", "true");
            rightButton.removeAttribute("disabled");
        } else if (currentScroll === scrollLength) {
            rightButton.setAttribute("disabled", "true");
            leftButton.removeAttribute("disabled");
        } else {
            leftButton.removeAttribute("disabled");
            rightButton.removeAttribute("disabled");
        }
    }

    scrollImages.addEventListener("scroll", checkScroll);
    window.addEventListener("resize", checkScroll);
    checkScroll();

    function leftScroll() {
        scrollImages.scrollBy({
            left: -200,
            behavior: "smooth",
        });
    }

    function rightScroll() {
        scrollImages.scrollBy({
            left: 200,
            behavior: "smooth",
        });
    }

    leftButton.addEventListener("click", leftScroll);
    rightButton.addEventListener("click", rightScroll);
});

/************************************* Handling likes button ************************************/

var myMap = new Map();

var myObject = {};





let likesBtn = document.querySelectorAll(".post-like");
// console.log(likesBtn);
likesBtn.forEach((like) => {
    // console.log(like);
    like.addEventListener("click", function () {
        let postId = like.getAttribute("data-bs-post");
        // console.log(postId);
        let likeId = like.getAttribute("data-bs-like");


        let youParagraphBlade = document.querySelector(`#you-like-blade-${postId}`);
        if(youParagraphBlade) youParagraphBlade.style.display = "none";

        if (like.style.color === "red") 
        {
            like.style.color = "black";
            axios.delete(`/like/destroy/${likeId}`).then((res) => {

                let likes_count =document.querySelector(`.likes-count-${postId}`);
                // console.log(res.data.totalLikes);
                if (likes_count) {
                    
                    likes_count.innerHTML = `${res.data.totalLikes} Likes`;
                }

                let youLike = document.querySelector(`#you-like-${postId}`);
                if(res.data.user.length > 0)
                {
                    if(youLike)
                    {
                        youLike.innerHTML = `<b>${res.data.user[0].user.name}</b>`;
                    }
                    else
                    {
                        youParagraphBlade.style.display = "block";
                        youParagraphBlade.innerHTML = `<b>${res.data.user[0].user.name}</b>`;
                    }

                } else {
                    let othersContent = document.querySelector(`.othersContent-${postId}`);
                    // console.log(othersContent);
                    othersContent.style.display = "none";
                    if(youLike) youLike.style.display = "none";
                }

            });
        } else {
            like.style.color = "red";
            axios.post("/like", { id: postId }).then((res) => {
                // console.log(res.data);
                like.setAttribute("data-bs-like", res.data.id);
                let likes_count =document.querySelector(`.likes-count-${postId}`);
                // console.log(likes_count);
                if (likes_count) {
                    
                    likes_count.innerHTML = `${res.data.Likes} Likes`;
                }

                myObject.count = res.data.Likes;
                myMap.set(postId, myObject);

                // console.log(myMap);


                
                let commentLikesDiv = document.querySelector(`#likes-${postId}`);
                let commentDetails = `
                <div class="likess othersContent-${postId}">

                        <p class="m-1" id="you-like-${postId}">
                            <b>You</b>
                        </p>
                   
                        <p class="m-1">and</p>
                        <a type="button"  
                        data-toggle="modal"
                        data-bs-othersLikesPost="${postId}"
                        id="others-btn-${postId}"
                        class="others-post text-dark text-decoration-none"
                        data-target="#postOthersLikesAlert">
                            <p class="m-1"><b>others</b></p>
                        </a>
                </div>
                `;
                commentLikesDiv.innerHTML = commentDetails;
                let others_btn = document.querySelector(
                    `#others-btn-${postId}`
                );
                others_btn.addEventListener("click", () => {
                    othersLikesModal(postId);
                });
            });
        }
    });
});



/************************************* Handling save (book-mark) button ************************************/

let bookMarkBtn = document.querySelectorAll(".post-book-mark");
// console.log(bookMarkBtn);
bookMarkBtn.forEach((bookMark) => {
    bookMark.addEventListener("click", function () {
        let postId = bookMark.getAttribute("data-bs-post");
        if (bookMark.style.color === "orange") {
            bookMark.style.color = "black";
            axios.delete(`/save/destroy/${postId}`).then((res) => {
                // console.log(res.data);
            });
        } else {
            bookMark.style.color = "orange";
            axios.post("/save", { id: postId }).then((res) => {
                // console.log(res.data);
            });
        }
    });
});

/************** Likes for Comment ****************/

let CommentLikesBtn = document.querySelectorAll(".comment-like");
CommentLikesBtn.forEach((like) => {
    like.addEventListener("click", function () {
        let commentId = like.getAttribute("data-bs-postCommment");
        // console.log(commentId);
        let postId = like.getAttribute("data-bs-postId");
        // console.log(postId);
        let commentLikeId = like.getAttribute("data-bs-commentLike");

        if (like.style.color === "red") {
            like.style.color = "grey";
            axios.delete(`/commentlike/remove/${commentLikeId}`).then((res) => {
                // console.log(res.data);
            });
        } else {
            like.style.color = "red";
            axios
                .post("/commentlike", { id: postId, comment_id: commentId })
                .then((res) => {
                    // console.log(res.data);
                    like.setAttribute("data-bs-commentLike", res.data.id);
                });
        }
    });
});

/********************************************************************************/

let modalDiv = document.querySelector("#commentsModal");
let commentButton = document.querySelectorAll(".comment-btn");
commentButton.forEach((btn) => {
    btn.addEventListener("click", () => {
        let postId = btn.getAttribute("data-bs-commentBtn");
        axios.get(`/post/${postId}`).then((res) => {
            // console.log(res.data);
            let likes = res.data.likes;
            // console.log(res.data.like_user);

            modalDiv.innerHTML = `
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content p-0">
                        
                    <div class="modal-body m-0 p-0">
                    <div class="container-fluid">
                        <div class="row p-0">
                            <div class="col-7 col-lg-7 col-md-12 col-sm-12 d-flex p-0 m-0">
                                <img src="${res.data.post.image_url}" class="w-100 img-fluid" />
                            </div>
                            <div class="col-5 col-lg-5 col-md-12 col-sm-12 d-flex flex-column px-1 align-items-center justify-content-between">  

                                    <!------------------- User's profile --------------------->
                                            <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex flex-column align-items-center p-0 m-0">
                                                <div class="row w-100">
                                                    <div class="col-2 d-flex pt-3 justify-content-start align-items-center">
                                                            <img src="${res.data.post.user.image}"
                                                                class="rounded-circle mb-3 avatar" width="50px"
                                                                height="50px" alt="Avatar" />
                                                    </div>

                                                    <div class="d-flex col-10 justify-content-between align-items-center">
                                                    <a 
                                                    href="${'/profile/' + res.data.post.user.id}" 
                                                    type="button"
                                                    class=" text-decoration-none text-dark">
                                                        <b>
                                                            <p class="mb-0 h6">
                                                                ${
                                                                    res.data.post.user
                                                                        .name
                                                                }
                                                            </p>
                                                        </b>
                                                    </a>
                                                        
                                                        <div>
                                                            <button type="button" class="close border-0 bg-white" data-dismiss="modal" aria-label="Close">
                                                                <h3 aria-hidden="true" class="m-0">&times;</h3>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr class="mt-0">
                                                    <div class="d-flex flex-column modal-comments">
                                                        <div class="p-1 modal-all-comments-display">
                                                            ${
                                                                res.data.allComments.length == 0
                                                                    ? `<p class="text-center">No Comments</p>`
                                                                    : `<div class="comments-modal-container">
                                                                
                                                                </div>`
                                                            }
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <!-------------------------------------------------------->
                                    
                                    <!----------------------------- Icons ---------------------->
                                    <div class="col-12">
                                        <hr>
                                        <div class="row p-0 m-0 w-100">
                                            <div class="col-3 col-lg-3 col-md-3 col-sm-3 d-flex align-items-center justify-content-between">

                                                <a type="button" 
                                                    class="btn-${
                                                        res.data.post.id
                                                    } post-like"
                                                    data-bs-post="${
                                                        res.data.post.id
                                                    }" 
                                                    id="like-btn-modal">
                                                    <h4><b><i class="fa-regular fa-heart"></i></b></h4>
                                                </a>

                                                <a type="button" id="commenr-btn">
                                                    <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                                </a>

                                                <a type="button">
                                                    <h4><b><i class="far fa-paper-plane"></i></b></h4>
                                                </a>


                                            </div>
                                            <div class="col-9 col-lg-9 col-md-9 col-sm-9 d-flex align-items-center justify-content-end">
                                                <a 
                                                type="button" 
                                                class="bookmark-btn-${
                                                    res.data.post.id
                                                } post-book-mark" 
                                                id="book-mark-btn">
                                                    <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <p class="m-1 mx-3" id="likes_modal_count-${postId}">${res.data.all_likes_count} Likes</p>
                        
                                        <div class="others-modal-liked-users-${postId}">
                                            <a type="button"  
                                            data-toggle="modal"
                                            data-bs-othersLikes = "${res.data.post.id}"
                                            class = "others-modal"
                                            data-target="#postOthersLikesAlert">
                                                <p class="m-1"><b></b></p>
                                            </a>
                                        </div>

                                            
                                        </div>

    
                                        <div class="px-3">
                                            <p class=" text-secondary"><i>${
                                                res.data.posts_time
                                            }</i></p>
                                        </div>
                                    </div>
                                    <!---------------------------------------------------------->

                                
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            `;

            // console.log(myMap.get(postId));

            /************************* Modal with post likes btn *************************/
            let postLike = document.getElementById(`postLike-${res.data.post.id}`);
            let postLikeModal = document.querySelector(
                `.btn-${res.data.post.id}`
            );
            // console.log(postLike);
            // console.log(postLikeModal);

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
                let postId = postLike.getAttribute("data-bs-post");
                let likeId = postLike.getAttribute("data-bs-like");

                if (postLike.style.color === "red") {
                    postLike.style.color = "black";
                    postLikeModal.style.color = "black";
                    axios.delete(`/like/destroy/${likeId}`).then((res) => {
                        // console.log(res.data);

                        let likes_modal_count = document.querySelector(`#likes_modal_count-${postId}`);
                        likes_modal_count.innerHTML = `${res.data.totalLikes} Likes`;




                        let likes_count =document.querySelector(`.likes-count-${postId}`);
                        // console.log(res.data.totalLikes);
                        if (likes_count) {
                            
                            likes_count.innerHTML = `${res.data.totalLikes} Likes`;
                        }

                        let youLike = document.querySelector(`#you-like-${postId}`);
                        if(res.data.user.length > 0)
                        {
                            if(youLike)
                            {
                                youLike.innerHTML = `<b>${res.data.user[0].user.name}</b>`;
                            }
                            else
                            {
                                youParagraphBlade.style.display = "block";
                                youParagraphBlade.innerHTML = `<b>${res.data.user[0].user.name}</b>`;
                            }

                        } else {
                            let othersContent = document.querySelector(`.othersContent-${postId}`);
                            // console.log(othersContent);
                            othersContent.style.display = "none";
                            if(youLike) youLike.style.display = "none";
                        }



                    });
                } else {
                    postLike.style.color = "red";
                    postLikeModal.style.color = "red";
                    axios.post("/like", { id: postId }).then((res) => {
                        postLike.setAttribute("data-bs-like", res.data.id);
                        postLikeModal.setAttribute("data-bs-like", res.data.id);
                        // console.log(res.data);

                    let likes_modal_count = document.querySelector(`#likes_modal_count-${postId}`);
                    likes_modal_count.innerHTML = `${res.data.Likes} Likes`;

                    let likes_count =document.querySelector(`.likes-count-${postId}`);
                    // console.log(likes_count);
                    if (likes_count) {
                        
                        likes_count.innerHTML = `${res.data.Likes} Likes`;
                    }

                    myObject.count = res.data.Likes;
                    myMap.set(postId, myObject);

                    // console.log(myMap);


                    
                    let commentLikesDiv = document.querySelector(`#likes-${postId}`);
                    let commentDetails = `
                    <div class="likess othersContent-${postId}">
                        <a type="button" id="a-${postId}">
                            <p class="m-1" id="you-like-${postId}">
                                <b>You</b>
                            </p>
                        </a>
                            <p class="m-1">and</p>
                            <a type="button"  
                            data-toggle="modal"
                            data-bs-othersLikesPost="${postId}"
                            id="others-btn-${postId}"
                            class="others-post text-dark text-decoration-none"
                            data-target="#postOthersLikesAlert">
                                <p class="m-1"><b>others</b></p>
                            </a>
                    </div>
                    `;
                    commentLikesDiv.innerHTML = commentDetails;
                    let others_btn = document.querySelector(
                        `#others-btn-${postId}`
                    );
                    others_btn.addEventListener("click", () => {
                        othersLikesModal(postId);
                    });



                    });
                }
            });
            /******************************* Save btn post with modal *******************************/

            let postBookMark = document.getElementById(
                `book-mark-btn-${res.data.post.id}`
            );
            let postSaveModal = document.querySelector(
                `.bookmark-btn-${res.data.post.id}`
            );

            // console.log(postBookMark);
            // console.log(postSaveModal);
            // console.log(res.data.saved_posts.savedPosts);

            res.data.saved_posts.savedposts.map(function (x) {
                postSaveModal.setAttribute("data-bs-save", `${x.id}`);

                if (res.data.logged_user == x.pivot.user_id) {
                    postSaveModal.setAttribute(
                        "style",
                        "color: orange !important"
                    );
                } else postSaveModal.setAttribute("style", "color: black !important");
            });

            postSaveModal.addEventListener("click", function () {
                let postId = postBookMark.getAttribute("data-bs-post");

                if (postBookMark.style.color === "orange") {
                    postBookMark.style.color = "black";
                    postSaveModal.style.color = "black";
                    axios.delete(`/save/destroy/${postId}`).then((res) => {
                        // console.log(res.data);
                    });
                } else {
                    postBookMark.style.color = "orange";
                    postSaveModal.style.color = "orange";
                    axios.post("/save", { id: postId }).then((res) => {
                        // console.log(res.data);
                    });
                }
            });

            /****************************************************************************************/

            /******************************* Display All Comments ****************************/

            let commentsDiv = document.querySelector(
                ".comments-modal-container"
            );
            // console.log(commentsDiv);
            let allComentsData = res.data.allComments;
            // console.log(allComentsData);

            allComentsData.forEach((comment) => {
                let allComents = `
                    <div class="comment-div-${comment.id} col-md-12 mb-0 aligh-items-center d-flex">
                        <div class="d-flex col-10 align-items-center p-0 comments-modal">   
                                <div class="col-2 d-flex pt-2 justify-content-start align-items-center">
                                    <div class="avatar-container position-relative">
                                        <img src="${comment.user.image}"
                                            class="rounded-circle mb-3 avatar" width="50px"
                                            height="50px" alt="Avatar" />
                                    </div>
                                </div>
    
                                <div>
                                    <p class="m-0">
                                        <a 
                                        href="${'/profile/' + comment.user.id}" 
                                        class=" text-decoration-none text-dark"
                                        type="button">
                                            <b>${comment.user.name}</b>
                                        </a>
                                        ${comment.comment_text} 
                                    </p>
    
                                    <div class="d-flex">
                                        <p class="m-0 text-secondary comment-time"></p>
                                        
                                        <div>
                                            <h6 class="m-0 mx-2 text-secondary text-decoration-underline commentLikedBy">
                                                <i>Liked By</i>
                                            </h6>
                                            <div class="allCommentLikesUsers allCommentLikesUsers-${comment.id}">
                                                <h4 class="m-0 text-center text-secondary"><i>Likes</i></h4>
                                                <hr>
                                            </div>
                                        </div>

                                        ${res.data.logged_user == comment.user_id ? `
                                        <div class="comment-delete">
                                            <a type="button" class="comment-delete-btn" data-comment-id="${comment.id}">
                                                <h6 class="m-0 text-danger mx-2 text-secondary text-decoration-underline">
                                                    <i>Delete</i>
                                                </h6>
                                            </a>
                                        </div>
                                        ` : ""}


                                    </div>

                                </div>
                                
                        </div>
                        <div class="col-2 d-flex p-2 align-items-end justify-content-end align-items-center">
                            <a type="button" 
                            class="comment-like-btn-${comment.id} comment-like"
                            data-bs-postId="${postId}"
                            data-bs-postCommment="${comment.id}"
                            data-bs-post="${comment.id}" 
                            id="like-btn">
                                <h6><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h6>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Deletion</h5>
                                    <a type="button" class="close text-decoration-none text-dark" aria-label="Close">
                                        <h4 aria-hidden="true">&times;</h4>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this comment?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>




                    
                `;
                commentsDiv.innerHTML += allComents;
            });
            
            /******************************* Adding time for each comment ********************************/
            let commentsTime = res.data.comments;
            let timeParagraph = document.querySelectorAll(".comment-time");
            // console.log(timeParagraph);
            timeParagraph.forEach((p, index) => {
                p.innerHTML = `<i>${commentsTime[index]}</i>`;
            });
            

            /********************************** Delete Comment  **********************************/

            var modal = document.getElementById("deleteConfirmationModal");
            var deleteButtons = document.querySelectorAll('.comment-delete-btn');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    var commentId = this.getAttribute('data-comment-id');
                    modal.setAttribute('data-comment-id', commentId);
                    $('#deleteConfirmationModal').modal('show');
                });
            });

            let ConfirmMessage = document.getElementById("confirmDelete");
            if (ConfirmMessage){

                ConfirmMessage.onclick = function () {
                    var commentId = modal.getAttribute('data-comment-id');
                    axios.delete(`/comment/destroy/${commentId}`)
                        .then(response => {
                            let commentDiv = document.querySelector(`.comment-div-${commentId}`);
                            if (commentDiv) {
                                commentDiv.remove();
                            }
                            
                            let postContainer = document.getElementById(`post-${res.data.post.id}`);
                            if (postContainer) {
                                let commentContainer = document.querySelector(`.user-comment-${commentId}`);
                                if (commentContainer) {
                                    commentContainer.remove();
                                }
                            }
    
                            let commentInBlade = document.querySelector(`.user-comment-${commentId}`);
                            if (commentInBlade) {
                                commentInBlade.remove();
                            }

                            /***************** No Comments ******************/
                            let commentContainer = document.querySelector(`.user-comment-${commentId}`);
                            let commentsContainer = postContainer.querySelector(".comments-container");
                            let noComment = document.getElementById(`No-Comment-${res.data.post.id}`);

                            if (commentsContainer) {
                                if (commentContainer) {
                                    commentsContainer.appendChild(commentContainer);
                                }
                                if (noComment && commentsContainer.children.length > 0) {
                                    if(noComment) noComment.style.display = "none";
                                } else {
                                    if(noComment) noComment.style.display = "block";
                                }
                            } else {
                                if (noComment) noComment.style.display = "block";
                            }



                            let modalNoComments = document.querySelector('.modal-all-comments-display');
                            let allComments = document.querySelectorAll('.comments-modal-container');

                            // console.log(allComments);
                            // console.log(res.data.allComments.length);
                            res.data.allComments.length = res.data.allComments.length - 1;
                            if (res.data.allComments.length == 0) {
                                let message = document.createElement('p');
                                message.innerHTML = `<p class="text-center">No Comments</p>`;

                                modalNoComments.appendChild(message);
                            }

                            /*********************** View all comments number ***************************/

                            let viewAllComments = document.getElementById(`view-all-comments-${res.data.post.id}`);
                            if (viewAllComments) {
                                let commentsCount = parseInt(viewAllComments.innerText.split(' ')[2]);
                                if (commentsCount > 0) {
                                    viewAllComments.innerText = `View all ${commentsCount - 1} comments`;
                                }
                            }

                        })
                        .catch(error => {
                            console.error('Error deleting comment:', error);
                        });
                    $('#deleteConfirmationModal').modal('hide');
                };
                document.querySelectorAll("#deleteConfirmationModal .close").forEach((btn) => {
                    btn.onclick = function () {
                        $('#deleteConfirmationModal').modal('hide');
                    };
                });
            }


            /******************************** comment modal like btn *************************/

            res.data.post_comment_id.comments.forEach((comment) => {
                let arr = [];
                let postCommentLike = document.getElementById(`comment-like-${comment.id}`);
                let postCommentLikeModalClass = document.querySelector(
                    `.comment-like-btn-${comment.id}`
                );
                // console.log(postCommentLike);
                // console.log(postCommentLikeModalClass);

                if(postCommentLike && res.data.logged_user == comment.user_id)
                {
                    postCommentLikeModalClass.setAttribute("data-bs-like", `${comment.id}`);
    
                    if (postCommentLike && postCommentLike.style.color === "red")
                    {
                        postCommentLikeModalClass.setAttribute(
                            "style",
                            "color: red !important"
                        );
                    }else {
                        postCommentLikeModalClass.setAttribute(
                            "style",
                            "color: grey !important"
                        );
                    }
    
        
                    postCommentLikeModalClass.addEventListener("click", function () {
                        let postId = postCommentLike.getAttribute("data-bs-postId");
                        let commentId = postCommentLike.getAttribute("data-bs-postCommment");
                        let commentLikeId = postCommentLike.getAttribute("data-bs-commentLike");
    
                        // console.log(postCommentLike);
                        // console.log(postCommentLikeModalClass);
    
    
                        if (postCommentLikeModalClass.style.color === "red") {
                            if(postCommentLike) postCommentLike.style.color = "grey";
                            postCommentLikeModalClass.style.color = "grey";
                            axios.delete(`/commentlike/remove/${commentLikeId}`).then((res) => {
                                // console.log(res.data);
                                commentLikesModalDiv(res.data.final);
                            });
                        } else {
                            if(postCommentLike) postCommentLike.style.color = "red";
                            postCommentLikeModalClass.style.color = "red";
                            axios.post("/commentlike", { id: postId, comment_id: commentId }).then((res) => {
                                if(postCommentLike) postCommentLike.setAttribute("data-bs-commentLike", res.data.id);
                                postCommentLikeModalClass.setAttribute("data-bs-commentLike", res.data.id);
                                // console.log(res.data);
                                // console.log(res.data.final);
                                commentLikesModalDiv(res.data.final);
                            });
                        }
                    });
                } else {

                    let comment_likes_id = document.querySelector(`.comment-like-btn-${comment.id}`);
                    // console.log(comment_likes_id);
                    
                    let allLikes = res.data.allCommentLikes;
                    // console.log(likes);
                    for(let i = 0; i < allLikes.length; i++)
                    {
                        if (comment.id == allLikes[i].comment_id && postId == allLikes[i].post_id && res.data.logged_user == allLikes[i].user_id)
                        {
                            comment_likes_id.setAttribute(
                                "style",
                                "color: red"
                            );
                            comment_likes_id.setAttribute(
                                "data-bs-commentLike",
                                allLikes[i].id
                            );
                            break;
                        }else {
                            comment_likes_id.setAttribute(
                                "style",
                                "color: grey"
                            );
                        }
                    }
                 
                        
                    postCommentLikeModalClass.addEventListener("click", function () {
                        let postId = postCommentLikeModalClass.getAttribute("data-bs-postId");
                        let commentId = postCommentLikeModalClass.getAttribute("data-bs-postCommment");
                        let commentLikeId = postCommentLikeModalClass.getAttribute("data-bs-commentLike");

                        let postCommentLike = document.querySelector(`.post-comment-like-${comment.id}`);
                        // console.log(postCommentLike);

                        // console.log(postId,commentId);

                        if (postCommentLikeModalClass.style.color === "red") {
                            postCommentLikeModalClass.style.color = "grey";
                            if(postCommentLike) postCommentLike.style.color = "grey";
                            axios.delete(`/commentlike/remove/${commentLikeId}`).then((res) => {
                                // console.log(res.data);
                                commentLikesModalDiv(res.data.final);
                            });
                        } else {
                            postCommentLikeModalClass.style.color = "red";
                            if(postCommentLike) postCommentLike.style.color = "red";
                            axios.post("/commentlike", { id: postId, comment_id: commentId }).then((res) => {
                                postCommentLikeModalClass.setAttribute("data-bs-commentLike", res.data.id);
                                if(postCommentLike) postCommentLike.setAttribute("data-bs-commentLike", res.data.id);
                                // console.log(res.data);
                                commentLikesModalDiv(res.data.final);
                            });
                        }
                    });

                }




                
            })
            let commentsLikesUsersArr = res.data.final;
            // console.log(commentsLikesUsersArr);
            commentLikesModalDiv(commentsLikesUsersArr);

            

            

            /*********************************************************************************/

            let othersModalMainDiv = document.getElementById(
                "postOthersLikesAlert"
            );
            let othersModal = document.querySelectorAll(".others-modal");
            othersModal.forEach((btn) => {
                btn.addEventListener("click", () => {
                    othersModalMainDiv.innerHTML = `
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
                      <div class="modal-content">
                          <div class="d-flex align-items-center">
                              <div class="col-11 d-flex align-items-center justify-content-center">
                                  <p class="m-0"><b>Likes</b></p>
                              </div>
                              <button type="button" class="col-1 close border-0 bg-white m-0" data-dismiss="modal" aria-label="Close">
                                  <h1 aria-hidden="true" class="m-0">&times;</h1>
                              </button>
                          </div>
                          <hr class="m-0">
                          <div class="modal-body p-0 d-flex justify-content-center flex-column">
                              <h6 class="text-secondary m-4"><b>${res.data.post.user.name}</b>. can see the total number of people who liked this post.</h6>

                              <div class="vertical-menu w-100 m-0">      
                            </div>

                          </div>
                      </div>
                  </div>
                  `;

                    let likes_div = document.querySelector(".vertical-menu");
                    likes.forEach((myLike) => {
                        let str = `
                      <div class="row w-100 d-flex align-items-center justify-content-between mb-2">
                          <div class="col-9 d-flex align-items-center px-4">
                              <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                              class="rounded-circle avatar bg-dark" width="45px"
                              height="45px" alt="Avatar"/>
                              <a type="button">
                                <b>${myLike.user.name}</b>
                              </a>
                          </div>
                          <div class="col-3 d-flex justify-content-end">
                            <button class="btn btn-primary m-0 w-100">
                                <b>follow</b>
                            </button>
                          </div>
                      </div>
                    `;
                        likes_div.innerHTML += str;
                    });
                });
            });
        }); // axios end
    });
});



/******************************** Main posts others btn for likes **********************************/

function othersLikesModal(postId) {
    axios.get(`/post/${postId}`).then((res) => {
        console.log(res.data);
        let likes = res.data.likes;

        othersModalMainDiv.innerHTML = `
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content">
                <div class="d-flex align-items-center">
                    <div class="col-11 d-flex align-items-center justify-content-center">
                        <p class="m-0"><b>Likes</b></p>
                    </div>
                    <button type="button" class="col-1 close other-close-btn border-0 bg-white m-0" data-dismiss="modal" aria-label="Close">
                        <h1 aria-hidden="true" class="m-0">&times;</h1>
                    </button>
                </div>
                <hr class="m-0">
                <div class="modal-body p-0 d-flex justify-content-center flex-column">
                    <h6 class="text-secondary m-4"><b>${res.data.post.user.name}</b>. can see the total number of people who liked this post.</h6>

                    <div class="vertical-menu w-100 m-0">      
                    </div>

                </div>
            </div>
        </div>
        `;

        let other_close_btn = document.querySelector(".other-close-btn");
        let others_likes_modal = document.querySelector(".others-likes-modal");
        other_close_btn.addEventListener("click", function () {
            // console.log(others_likes_modal);
            others_likes_modal.classList.remove("show");
            others_likes_modal.style.zIndex = "-1 !";
            others_likes_modal.setAttribute("aria-hidden", "true");
            others_likes_modal.setAttribute("style", "display: none");
            document.body.classList.remove("modal-open");
        });

        others_likes_modal.classList.toggle("show");
        others_likes_modal.setAttribute(
            "aria-hidden",
            others_likes_modal.classList.contains("show") ? "false" : "true"
        );
        others_likes_modal.setAttribute(
            "style",
            others_likes_modal.classList.contains("show")
                ? "display: block"
                : "display: none"
        );

        let likes_div = document.querySelector(".vertical-menu");
        likes.forEach((myLike) => {
            let str = `
            <div class="row w-100 d-flex align-items-center justify-content-between mb-2">
                <div class="col-9 d-flex align-items-center px-4">
                    <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                    class="rounded-circle avatar bg-dark" width="45px"
                    height="45px" alt="Avatar"/>
                    <a 
                    href="${'/profile/' + myLike.user.id}"
                    type="button">
                    <b>${myLike.user.name}</b>
                    </a>
                </div>
            </div>
        `;
            likes_div.innerHTML += str;
        });
    });
}

let othersModalMainDiv = document.getElementById("postOthersLikesAlert");
// console.log(othersModalMainDiv);
let othersButton = document.querySelectorAll(".others-post");
// console.log(othersButton);
othersButton.forEach((btn) => {
    btn.addEventListener("click", () => {
        let postId = btn.getAttribute("data-bs-othersLikesPost");
        othersLikesModal(postId);
    });
});











/********************************** Comments Modal Likes Div *********************************/

function commentLikesModalDiv(commentsLikesUsersArr){
    // console.log(commentsLikesUsersArr);
    commentsLikesUsersArr.forEach((like) => {
        let commentId = like.comment_id;
        let commentDiv = document.querySelector(`.comment-div-${commentId}`);
        if (commentDiv) 
        {
            let likesContainer = commentDiv.querySelector(`.allCommentLikesUsers-${commentId}`);
            if (!likesContainer) 
            {
                likesContainer = document.createElement("div");
                likesContainer.classList.add(`allCommentLikesUsers-${commentId}`);
                likesContainer.classList.add(`allCommentLikesUsers`);
                commentDiv.appendChild(likesContainer);
            }
            likesContainer.innerHTML = `<h4 class="m-0 text-center text-secondary"><i>Likes</i></h4>`;

            like.likes.forEach((user)=>{
                let userId = user.user.id;
                let userName = user.user.username;
                        let userLink = document.createElement("a");
                        userLink.setAttribute("type", "button");
                        userLink.classList.add("text-decoration-none");
                        likesContainer.innerHTML += `
                        <div class="row w-100 d-flex align-items-center justify-content-between m-0 mb-2">
                            <div class="col-9 d-flex align-items-center">
                                <img src="${user.user.image}"
                                class="rounded-circle avatar bg-dark" width="40px"
                                height="40px" alt="Avatar"/>
                                <a 
                                href="${'/profile/' + user.user.id}"
                                type="button" class="w-100" >
                                    <b>${userName}</b>
                                </a>
                            </div>
                        </div>
                        `;
                })
        }
        });
}


/********************************* Follow ********************************/

let followBtns = document.querySelectorAll(".follow-btn");

followBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        let userId = btn.getAttribute("data-bs-follow");
        let followType = btn.getAttribute("data-bs-type");
        console.log(btn);
        let userSuggestId = document.getElementById(`follow-btn-suggest-${userId}`);
        let postUserId = document.getElementById(`follow-btn-${userId}`);
        
        if(followType == 'follow'){
            axios.post("/follow", { user_id : userId }).then((res) => {
                // console.log(res.data);
                if (userSuggestId) {
                    userSuggestId.innerHTML = `Unfollow`;
                    userSuggestId.setAttribute("data-bs-type", "unfollow");
                    if(userSuggestId.classList.contains("btn-primary")) userSuggestId.classList.remove("btn-primary");
                    userSuggestId.classList.add("btn-secondary")
                }


                if (postUserId) {
                    postUserId.innerHTML = `Unfollow`;
                    postUserId.setAttribute("data-bs-type", "unfollow");
                    if(postUserId.classList.contains("btn-primary")) postUserId.classList.remove("btn-primary");
                    postUserId.classList.add("btn-secondary")
                }

            });
        } else if(followType == 'unfollow') {
            axios.delete(`/following/${userId}`).then((res) => {
                // console.log(res.data);
                if (userSuggestId) {
                    userSuggestId.innerHTML = `<i class="fa-solid fa-user-plus"></i> follow`;
                    userSuggestId.setAttribute("data-bs-type", "follow");
                    if(userSuggestId.classList.contains("btn-secondary")) userSuggestId.classList.remove("btn-secondary");
                    userSuggestId.classList.add("btn-primary")
                }

                if (postUserId) {
                    postUserId.innerHTML = `<i class="fa-solid fa-user-plus"></i> follow`;
                    postUserId.setAttribute("data-bs-type", "follow");
                    if(postUserId.classList.contains("btn-secondary")) postUserId.classList.remove("btn-secondary");
                    postUserId.classList.add("btn-primary")
                }

            })
        }
    })
})