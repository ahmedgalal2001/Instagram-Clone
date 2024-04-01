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

function toggleButtonVisibility(input, submitButton) {
  if (input.value.trim() !== '') {
      submitButton.style.display = 'block';
  } else {
      submitButton.style.display = 'none';
  }
}

document.querySelectorAll(".comment-txt").forEach(function(input) {
  // let submitButton = input.closest('.main-post-div').querySelector("#submitButton");
  let submitButton = document.querySelector(".main-post-div #submitButton");

  input.addEventListener('keyup', function() {
      toggleButtonVisibility(input, submitButton);
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

let likesBtn = document.getElementById("like-btn");
let likeIcon = document.getElementById("like-icon");
// console.log(likesBtn);

likesBtn.addEventListener("click", function(){
    
    if(likeIcon.style.color === 'red'){
        likeIcon.style.color = 'black';
    } else {
        likeIcon.style.color = 'red'
    }
})


let bookMarkBtn = document.getElementById("book-mark-btn");
let bookMarkicon = document.getElementById("book-mark-icon");
// console.log(likesBtn);

bookMarkBtn.addEventListener("click", function(){
    
    if(bookMarkicon.style.color === 'orange'){
        bookMarkicon.style.color = 'black';
    } else {
        bookMarkicon.style.color = 'orange'
    }
})

/********************************************************************************/