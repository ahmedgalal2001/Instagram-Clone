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
                          <h6><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h6>
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

let likesBtn = document.querySelectorAll(".post-like");
likesBtn.forEach((like) => {
    console.log(like);
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
            // console.log(document.querySelector(`#likes-${postId}`));
            // document.querySelector(`#likes-${postId}`).innerHTML = `
            // <p class="m-1">and</p>                  
            // <a type="button"  
            // data-toggle="modal"
            // data-bs-othersLikesPost = "${postId}"
            // class = "others-post text-dark text-decoration-none"
            // data-target="#postOthersLikesAlert">
            //     <p class="m-1"><b>others</b></p>
            // </a>
            // `;
            axios.post("/like", { "id": postId }).then((res) => {
                console.log(res.data);
                like.setAttribute("data-bs-like", res.data.id);
                // console.log(res.data);
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

/************** Likes for Comment ****************/

let CommentLikesBtn = document.querySelectorAll(".comment-like");
CommentLikesBtn.forEach((like) => {
    like.addEventListener("click", function () {
        let postId = like.getAttribute("data-bs-postCommment");
        let likeId = like.getAttribute("data-bs-likeComment");

        if (like.style.color === 'red') {
            like.style.color = 'grey';
            // axios.delete(`/like/destroy/${likeId}`).then((res) => {
            //     console.log(res.data);
            // });
        } else {
            like.style.color = 'red'
            // axios.post("/like", { "id": postId }).then((res) => {
            //     like.setAttribute("data-bs-like", res.data.id);
            //     console.log(res.data);
            // });
        }
    })
});

/********************************************************************************/

let modalDiv = document.querySelector("#commentsModal")
let commentButton = document.querySelectorAll(".comment-btn");
commentButton.forEach((btn) => {
    btn.addEventListener('click', () => {
        let postId = btn.getAttribute("data-bs-commentBtn");
        axios.get(`/post/${postId}`).then((res) => {
            console.log(res.data);
            let likes = res.data.likes;
            console.log(res.data.like_user);

            modalDiv.innerHTML = `
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content p-0">
                        
                    <div class="modal-body m-0 p-0">
                        <div class="row p-0">
                            <div class="col-7 d-flex p-0 m-0">
                                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid" />
                            </div>
                            <div class="col-5 d-flex flex-column p-0 align-items-center justify-content-start">  
                                <div class="container-fluid">
                                    
                                    <!------------------- User's profile --------------------->
                                    <div class="bg-image hover-overlay m-0" data-mdb-ripple-init
                                        data-mdb-ripple-color="light">
                                        <div class="row m-0 p-0">
                                            <div class="col-10 d-flex align-items-center p-0 m-0">
                                                <div class="col-2 d-flex pt-3 justify-content-start align-items-center">
                                                    <div class="avatar-container position-relative">
                                                        <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                            class="rounded-circle mb-3 avatar" width="50px"
                                                            height="50px" alt="Avatar" />
                                                    </div>
                                                </div>

                                                <div class="d-flex w-100 col-10 justify-content-between align-items-center">
                                                    <p class="mb-0 h6">
                                                        ${res.data.post.user.name}
                                                    </p>
                                                    
                                                    <div>
                                                        <a type="button" data-toggle="modal" data-target="#postOptionsAlert">
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
                                                        <button type="button" class="close border-0 bg-white" data-dismiss="modal" aria-label="Close">
                                                            <h3 aria-hidden="true" class="m-0">&times;</h3>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-------------------------------------------------------->
                                    <hr class="mt-0">
                                    <!----------------------------- Icons ---------------------->

                                    
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
                                    <div class="d-flex flex-column modal-comments">
                                        <div class="p-1 ">
                                            ${res.data.allComments.length == 0 ? 
                                                `<p class="text-center">No Comments</p>`
                                                :
                                                `<div class="comments-modal-container">
                                                
                                                </div>`
                                            }
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 col-lg-3 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">

                                            <a type="button" 
                                                class="btn-${res.data.post.id} post-like"
                                                data-bs-post="${res.data.post.id}" 
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
                                        <div class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                                            <a 
                                            type="button" 
                                            class="bookmark-btn-${res.data.post.id}" 
                                            id="book-mark-btn">
                                                <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <p class=" text-secondary"><i>${res.data.posts_time}</i></p>
                                    </div>
                                    <hr>
                                    
                                    <div class="row w-100 px-1 pb-2 pt-0">
                                        <div class="col-10 px-1">
                                            <input type="text" name="comment" placeholder="Add a comment..."
                                                class="comment-txt fs-6 w-100 m-0">
                                        </div>
                                        <div class="col-2 d-flex justify-content-end">
                                            <a type="button">Post</a>
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

            /************************* Modal with post likes btn *************************/
            let postLike = document.getElementById(`${res.data.post.id}`);
            let postLikeModal = document.querySelector(`.btn-${res.data.post.id}`)
            console.log(postLike);
            console.log(postLikeModal);

            res.data.post_like.likes.map(function(x) {
                postLikeModal.setAttribute("data-bs-like",`${x.id}`);

                if(res.data.logged_user == x.user_id)
                    postLikeModal.setAttribute("style", "color: red !important");
                else
                    postLikeModal.setAttribute("style", "color: black !important"); 
            })



            postLikeModal.addEventListener("click", function () {
                let postId = postLike.getAttribute("data-bs-post");
                let likeId = postLike.getAttribute("data-bs-like");

                if (postLike.style.color === 'red') {
                    postLike.style.color = 'black';
                    postLikeModal.style.color = 'black';
                    axios.delete(`/like/destroy/${likeId}`).then((res) => {
                        console.log(res.data);
                    });
                } else {
                    postLike.style.color = 'red'
                    postLikeModal.style.color = 'red'
                    axios.post("/like", { "id": postId }).then((res) => {
                        postLike.setAttribute("data-bs-like", res.data.id);
                        postLikeModal.setAttribute("data-bs-like", res.data.id);
                        console.log(res.data);
                    });
                }
            })
            /******************************* Save btn post with modal *******************************/

            let bookMarkBtnModal = document.querySelector(`.bookmark-btn-${res.data.post.id}`);
            let bookMarkBtnPost = document.querySelector(`#book-mark-btn-${res.data.post.id}`)
            // console.log(bookMarkBtnModal);
            // console.log(bookMarkBtnPost);

            bookMarkBtn.forEach((bookMark) => {
                bookMark.addEventListener("click", function () {
                    if (bookMark.style.color === 'orange') {
                        bookMark.style.color = 'black';
                    } else {
                        bookMark.style.color = 'orange'
                    }
                })
            })

            /****************************************************************************************/


            /******************************* Display All Comments ****************************/

            let commentsDiv = document.querySelector(".comments-modal-container");
            console.log(commentsDiv);
            let allComentsData = res.data.allComments;
            console.log(allComentsData);

            allComentsData.forEach((comment)=>{          
                let allComents = `
                    <div class="col-md-12 mb-0 aligh-items-center d-flex">
                        <div class="d-flex col-10 align-items-center p-0">   
                                <div class="col-2 d-flex pt-2 justify-content-start align-items-center">
                                    <div class="avatar-container position-relative">
                                        <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                            class="rounded-circle mb-3 avatar" width="50px"
                                            height="50px" alt="Avatar" />
                                    </div>
                                </div>
    
                                <div>
                                    <p class="m-0">
                                        <a type="button">
                                            <b>${comment.user.name}</b>
                                        </a>
                                        ${comment.comment_text} 
                                    </p>
    
                                    <p class="m-0 text-secondary comment-time">
                                        
                                    </p>
                                </div>
                                
                        </div>
                        <div class="col-2 d-flex p-2 align-items-end justify-content-end align-items-center">
                            <a type="button" class="comment-like" id="like-btn">
                                <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                            </a>
                        </div>
                    </div>
                `;
                commentsDiv.innerHTML += allComents;
            });

            let commentsTime = res.data.comments;
            let timeParagraph = document.querySelectorAll(".comment-time");
            console.log(timeParagraph);
            timeParagraph.forEach((p, index) => {
                p.innerHTML = `<i>${commentsTime[index]}</i>`;
            });


            /*********************************************************************************/


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


/******************************** Main posts others btn forr likes **********************************/


let othersModalMainDiv = document.getElementById("postOthersLikesAlert");
// console.log(othersModalMainDiv);
let othersButton = document.querySelectorAll(".others-post");
// console.log(othersButton);
othersButton.forEach((btn) => {
    btn.addEventListener('click', () => {
        let postId = btn.getAttribute("data-bs-othersLikesPost");
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
          let others_likes_modal = document.querySelector(".others-likes-modal")
          other_close_btn.addEventListener('click', function() {
            // console.log(others_likes_modal);
            others_likes_modal.classList.remove('show');
            others_likes_modal.setAttribute('aria-hidden', 'true');
            others_likes_modal.setAttribute('style', 'display: none');

        });

        
            others_likes_modal.classList.toggle('show');
            others_likes_modal.setAttribute('aria-hidden', others_likes_modal.classList.contains('show') ? 'false' : 'true');
            others_likes_modal.setAttribute('style', others_likes_modal.classList.contains('show') ? 'display: block' : 'display: none');


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

});
