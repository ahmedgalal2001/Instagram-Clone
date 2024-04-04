/************************************************ for home page *****************************************************/

/************************** Post image hover timer **************************/

document.addEventListener("DOMContentLoaded", function() {
  let avatarImg = document.querySelectorAll(".avatar");
  let avatarContainer = document.querySelectorAll(".avatar-container");
  let postsContainer = document.querySelectorAll(".main-post-div");

  avatarImg.forEach(element => {
      element.addEventListener("mouseenter", function() {
          let profileDetailsCard = element.closest('.avatar-container').querySelector(".profile-details-card");
          if (profileDetailsCard) {
              profileDetailsCard.style.display = "block";
          }
      });
  });

  avatarContainer.forEach(container => {
      container.addEventListener("mouseleave", function() {
          let profileDetailsCard = container.querySelector(".profile-details-card");
          if (profileDetailsCard) {
              profileDetailsCard.style.display = "none";
          }
      });
  });

  postsContainer.forEach(container => {
      container.addEventListener("mouseleave", function() {
          let profileDetailsCard = container.querySelector(".profile-details-card");
          if (profileDetailsCard) {
              profileDetailsCard.style.display = "none";
          }
      });
  });
});



/***************** Toggle post a comment btn during typing *******************/


document.querySelectorAll(".comment-txt").forEach(function(input) {
  input.addEventListener('input', function() {
    let isEmpty = input.value.trim() === '';
    let submitButton = input.parentElement.nextElementSibling.querySelector(".commentBtn");
    submitButton.style.display = isEmpty ? 'none' : 'inline-block';
  });
});


document.querySelectorAll(".commentBtn").forEach(function(button) {
  button.addEventListener('click', function() {
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

document.addEventListener("DOMContentLoaded", function () 
{
    let scrollImages = document.querySelector(".scroll-images");
    let scrollLength = scrollImages.scrollWidth - scrollImages.clientWidth;
    let leftButton = document.querySelector(".left");
    let rightButton = document.querySelector(".right");

    function checkScroll() 
    {
      let currentScroll = scrollImages.scrollLeft;
      if (currentScroll === 0) 
      {
        leftButton.setAttribute("disabled", "true");
        rightButton.removeAttribute("disabled");
      } else if (currentScroll === scrollLength) 
      {
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

    function leftScroll() 
    {
      scrollImages.scrollBy({
        left: -200,
        behavior: "smooth"
      });
    }

    function rightScroll() 
    {
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
    like.addEventListener("click", function () 
    {
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
                console.log(res.data);
            });
        }
    })
});


let bookMarkBtn = document.querySelectorAll(".post-book-mark");
// console.log(bookMarkBtn);

bookMarkBtn.forEach((bookMark)=>{
  bookMark.addEventListener("click", function(){
      if(bookMark.style.color === 'orange'){
        bookMark.style.color = 'black';
      } else {
        bookMark.style.color = 'orange'
      }
  })
})

/********************************************************************************/