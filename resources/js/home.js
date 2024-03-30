/************************************************ for home page *****************************************************/

/************************** Post image hover timer **************************/

document.addEventListener("DOMContentLoaded", function() {
    let avatarContainer = document.querySelector(".avatar-container");
    let profileDetailsCard = document.querySelector(".profile-details-card");

    avatarContainer.addEventListener("mouseenter", function() {
        setTimeout(function() {
            profileDetailsCard.style.display = "block";
        }, 500);
    });

    avatarContainer.addEventListener("mouseleave", function() {
        profileDetailsCard.style.display = "none";
    });
});

/***************** Toggle post a comment btn during typing *******************/

function toggleButtonVisibility()
{
    let inputText = document.querySelector('.comment-txt').value;
    let submitButton = document.getElementById('submitButton');

    if (inputText.trim() !== '')
    {
        submitButton.style.display = 'block';
    } else {
        submitButton.style.display = 'none';
    }
}

let commentInput = document.querySelector(".comment-txt");
// console.log(commentInput);
commentInput.addEventListener('keyup',function(){
    toggleButtonVisibility();
})

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