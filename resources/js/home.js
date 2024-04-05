/************************************************ for home page *****************************************************/

import axios from "axios";

/************************** Post image hover timer **************************/

document.addEventListener("DOMContentLoaded", function () {
    let avatarImg = document.querySelectorAll(".avatar");
    let avatarContainer = document.querySelectorAll(".avatar-container");
    let postsContainer = document.querySelectorAll(".main-post-div");

    avatarImg.forEach(element => {
        element.addEventListener("mouseenter", function () {
            let profileDetailsCard = element.closest('.avatar-container').querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "block";
            }
        });
    });

    avatarContainer.forEach(container => {
        container.addEventListener("mouseleave", function () {
            let profileDetailsCard = container.querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });
    });

    postsContainer.forEach(container => {
        container.addEventListener("mouseleave", function () {
            let profileDetailsCard = container.querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });
    });
});



/***************** Toggle post a comment btn during typing *******************/


document.querySelectorAll(".comment-txt").forEach(function (input) {
    input.addEventListener('input', function () {
        let isEmpty = input.value.trim() === '';
        let submitButton = input.parentElement.nextElementSibling.querySelector(".commentBtn");
        submitButton.style.display = isEmpty ? 'none' : 'inline-block';
    });
});


document.querySelectorAll(".commentBtn").forEach(function (button) {
    button.addEventListener('click', function () {
        let postId = button.parentElement.previousElementSibling.querySelector(".comment-txt").getAttribute('data-bs-comment');
        let commentText = button.parentElement.previousElementSibling.querySelector(".comment-txt").value.trim();
        console.log("postID:", postId);
        console.log("commentText:", commentText);
        axios.post("/comment", { "id": postId, "comment": commentText }).then((res) => {
            console.log(res.data);
            let newCommentDiv = document.createElement('div');
            newCommentDiv.classList.add('col-md-12', 'mb-0', 'aligh-items-center', 'd-flex');
            newCommentDiv.innerHTML = `
              <div class="col-md-12 mb-0 aligh-items-center d-flex">
                  <div class="d-flex col-10 align-items-center">
                          <p>
                              <a type="button">
                                  <b>${res.data.user_name}</b>
                              </a>
                              ${commentText}
                          </p>
                  </div>
                  <div class="col-2 d-flex align-items-end justify-content-end">
                      <a type="button" class="comment-like" id="like-btn">
                          <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                      </a>
                  </div>
              </div>
          `;

            let postContainer = document.getElementById(`post-${postId}`);
            let commentsContainer = postContainer.querySelector(".comments-container");
            commentsContainer.appendChild(newCommentDiv);

            button.parentElement.previousElementSibling.querySelector(".comment-txt").value = '';
        }).catch((error) => {
            console.error('Error:', error);
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
            behavior: "smooth"
        });
    }

    function rightScroll() {
        scrollImages.scrollBy({
            left: 200,
            behavior: "smooth"
        });
    }

    leftButton.addEventListener("click", leftScroll);
    rightButton.addEventListener("click", rightScroll);
});

/************************************* Handling likes button ************************************/

let likes = document.querySelectorAll(".post-like");
likes.forEach((like) => {
    like.addEventListener("click", function () {
        let postId = like.getAttribute("data-bs-post");
        let likeId = like.getAttribute("data-bs-like");

        if (like.style.color === 'red') {
            like.style.color = 'black';
            axios.delete(`/like/destroy/${likeId}`).then((res) => {
                console.log(res.data);
            });
        } else {
            like.style.color = 'red'
            axios.post("/like", { "id": postId }).then((res) => {
                like.setAttribute("data-bs-like", res.data.id);
                console.log(res.data);
            });
        }
    })
});


let bookMarkBtn = document.querySelectorAll(".post-book-mark");
// console.log(bookMarkBtn);

bookMarkBtn.forEach((bookMark) => {
    bookMark.addEventListener("click", function () {
        if (bookMark.style.color === 'orange') {
            bookMark.style.color = 'black';
        } else {
            bookMark.style.color = 'orange'
        }
    })
})

/********************************************************************************/

let modalDiv = document.querySelector("#commentsModal")
let commentButton = document.querySelectorAll(".comment-btn");
commentButton.forEach((btn) => {
    btn.addEventListener('click', () => {
        let postId = btn.getAttribute("data-bs-commentBtn");
        axios.get(`/post/${postId}`).then((res) => {
            console.log(res.data);
            let random = Math.random();
            let user = res.data.user;
            let likes = res.data.likes;
            // let that = this;foundUser
            console.log(res.data.like_user);

            modalDiv.innerHTML = `
      <div class="modal-dialog modal-dialog-centered modal-xl h-100" role="document">
          <div class="modal-content">
              <div class="d-flex justify-content-end">
                  <button type="button" class="close border-0 bg-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-6 p-3">
                          <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid" />
                      </div>
                      <div class="col-6 d-flex align-items-center justify-content-center">

                          <div class="container-fluid">
                              <!------------------- User's profile --------------------->
                              <div class="bg-image hover-overlay" data-mdb-ripple-init
                                  data-mdb-ripple-color="light">
                                  <div class="row m-0 p-0">
                                      <div class="col-9 d-flex align-items-center p-0">
                                          <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                              <div class="avatar-container position-relative">
                                                  <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                      class="rounded-circle mb-3 avatar" width="65px"
                                                      height="65px" alt="Avatar" />
                                              </div>
                                          </div>
                                          <div class="col-12 mx-3">
                                              <div class="d-flex justify-content-between">
                                                  <p class="mb-0 h6">
                                                      
                                                  </p>
                                                  <a type="button" data-toggle="modal" data-target="">
                                                      <svg aria-label="More options"
                                                          class="x1lliihq x1n2onr6 x5n08af" height="24"
                                                          role="img" viewBox="0 0 24 24" width="24">
                                                          <title>More options</title>
                                                          <circle cx="12" cy="12" r="1.5"
                                                              fill="black"></circle>
                                                          <circle cx="6" cy="12" r="1.5"
                                                              fill="black"></circle>
                                                          <circle cx="18" cy="12" r="1.5"
                                                              fill="black"></circle>
                                                      </svg>
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <!-------------------------------------------------------->
                              <hr class="mt-0">
                              <!----------------------------- Icons ---------------------->

                              <div class="row">
                                  <div
                                      class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">

                                      <a type="button" class="like-btn" id="like-btn">
                                          <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                                      </a>

                                      <a type="button" id="commenr-btn">
                                          <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                      </a>

                                      <a type="button">
                                          <h4><b><i class="far fa-paper-plane"></i></b></h4>
                                      </a>


                                  </div>
                                  <div
                                      class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                                      <a type="button" class="bookmark-btn" id="book-mark-btn">
                                          <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                      </a>
                                  </div>
                              </div>
                              <div class="d-flex">
                                <p class="m-1 mx-0">Liked by</p>
                                <a type="button"> 
                                  <p class="m-1">
                                  <b>
                                    ${res.data.like_user ? res.data.like_user.user.name : "No Likes"}
                                  </b>
                                  </p>
                                </a>
                                ${res.data.like_user ? `
                                <p class="m-1">and</p>

                                <a type="button"  
                                data-toggle="modal"
                                data-bs-othersLikes = "${res.data.post.id}"
                                class = "others-modal"
                                data-target="#postOthersLikesAlert">
                                    <p class="m-1"><b>others</b></p>
                                </a>
                                
                                ` : ""}
                                 
                              </div>
                              <div class="d-flex">
                                  <a type="button">
                                      <p class="text-secondary m-0">View all 23 comments</p>
                                  </a>
                              </div>
                              <div class="row">
                                  <div class="col-10">
                                      <input type="text" name="comment" placeholder="Add a comment..."
                                          class="comment-txt fs-6">
                                  </div>
                                  <div class="col-2">
                                      <a type="button">Post</a>
                                  </div>
                              </div>

                              <!---------------------------------------------------------->
                              {{-- <hr class="mt-0"> --}}

                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    `;
            let othersModalMainDiv = document.getElementById("postOthersLikesAlert");
            let othersModal = document.querySelectorAll(".others-modal");
            othersModal.forEach((btn)=>{
              btn.addEventListener('click',()=>{
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

                  let likes_div = document.querySelector('.vertical-menu');
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
              })
            })
        }); // axios end
    });
});
