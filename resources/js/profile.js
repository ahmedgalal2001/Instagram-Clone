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
const parentHashtags = document.querySelector(".parentHashtags");
const searchFollowers=document.querySelector(".searchFollowers")
const searchFollowings = document.querySelector(".searchFollowings");
const caption = document.querySelector(".caption");
const post = document.querySelectorAll(".post");

console.log(parentHashtags);

//-------------------Load All Followers on Modal by default-----------------------
function loadAllFollowers() {
    axios.get(`/followers`)
        .then(res => {
            displayFollowers(res.data.followers,res.data.followingsIds);

        })
        .catch(err => {
            console.error(err);
        });
}

//-----------------Filter  Followers  depend on name User-------------------------
function filterFollowers(nameUser) {
    axios.get(`/followers/${nameUser}`)
        .then(res => {

            let followers = res.data.followers;

            if (typeof followers === 'object' && !Array.isArray(followers)) {
                followers = Object.entries(followers).map(([key, value]) => ({
                    id: key,
                    ...value
                }));
            }
            displayFollowers(followers,res.data.followingsIds);
        })
        .catch(err => {
            console.error(err);
        });
}

//----------------Display Followers---------------------------------
function displayFollowers(followers,followingsIds) {
    parentFollowers.innerHTML = '';

    if(followers.length===0)
    {
        const nofollower=document.createElement('div');
        nofollower.innerHTML=`
        <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
        #
        <h3>No results</h3>
       </li>
        `;
        parentFollowers.appendChild(nofollower);

    }else{

        followers.forEach(follower => {
            const newFollower = document.createElement("div");
            newFollower.innerHTML = `
                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-start align-items-center gap-1">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                            class="rounded-circle img-fluid" alt="img" width="50px" />
                        <div class="d-flex flex-column">
                            <p class="fs-5 mt-3  mx-1">${follower.username}
                            ${followingsIds.includes(follower.id) ? '' : `<button class=" btn btn-white follow"  follow_id="${follower.id}" ><span class="fs-6 text-primary fw-bold">Follow</span></button>`}
                            </p>
                            <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                ${follower.name}
                            </p>

                        </div>
                    </div>
                    <div>
                        <button type="button" class="remove-follower-btn btn btn-primary btn-sm fs-6" data-follower-id="${follower.id}">Remove</button>
                    </div>
                </li>
            `;
            parentFollowers.appendChild(newFollower);
        });

    //--------------remove follower-----------------------
    parentFollowers.querySelectorAll('.remove-follower-btn').forEach(btn => {
        btn.addEventListener("click", () => {
            const followerId = btn.getAttribute("data-follower-id");
            axios.delete(`/followers/${followerId}`)
                .then((res) => {
                    btn.closest('li').remove();
                    count_followings.textContent = res.data.count.following_count;
                    count_followers.textContent = res.data.count.followers_count;
                })
                .catch(err => {
                    console.error(err);
                });
        });
    });

// ------------------------unfollow and following in Followers-------------------------
document.querySelectorAll(".follow").forEach((btn) => {

    btn.addEventListener("click", async () => {

        const follow_id = btn.getAttribute("follow_id");

        //-----------check user Following or unfollow for other user-------------------------
        if (btn.textContent === "Follow") {
            await axios.post("/follow", { user_id: follow_id })
                .then((res) => {

                    btn.textContent = "Following";
                    count_followings.textContent =
                        res.data.count.following_count;


                })
                .catch((err) => {
                    console.error(err);
                });
        } else {
            axios
                .delete(`/following/${follow_id}`)
                .then((res) => {

                    btn.textContent = "Follow";
                    count_followings.textContent =
                        res.data.count.following_count;
                        console.log(res.data.count.following_count);
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
searchFollowers.addEventListener('input', () => {
    const follower = searchFollowers.value.trim();
    if (follower === '') {
        loadAllFollowers();
    } else {
        filterFollowers(follower);
    }
});

//-------load All Followers by default--------------------------------------------------
loadAllFollowers();


 //#region  Followings

//-------------------Load All Followings on Modal by default-----------------------
function loadAllFollowings() {
    axios.get(`/followings`)
        .then(res => {
            displayFollowings(res.data.followings);
        })
        .catch(err => {
            console.error(err);
        });
}

//-------------------------Filter  Followings  depend on name User
function filterFollowings(nameUser) {
    axios.get(`/followings/${nameUser}`)
        .then(res => {

            let followings = res.data.followings;

            if (typeof followings === 'object' && !Array.isArray(followings)) {
                followings = Object.entries(followings).map(([key, value]) => ({
                    id: key,
                    ...value
                }));
            }
            displayFollowings(followings);
        })
        .catch(err => {
            console.error(err);
        });
}

//----------------Display Followers---------------------------------
function displayFollowings(followings) {
    parentFollowings.innerHTML = '';

    if(followings.length===0)
    {
        const nofollowing=document.createElement('div');
        nofollowing.innerHTML=`
        <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
        #
        <h3>No results</h3>
       </li>

        `;
        parentFollowings.appendChild(nofollowing);
    }else{
    followings.forEach(following => {
        const newFollowing = document.createElement("div");
        newFollowing.innerHTML = `
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
                    <button type="button"  following-id="${following.id}" class=" following-btn btn btn-primary  btn-sm fs-6">Following</button>
                </div>
            </li>
        `;
        parentFollowings.appendChild(newFollowing);
    });

//---------------Following button---------------------------
    document.querySelectorAll(".following-btn").forEach((btn) => {

        btn.addEventListener("click", async () => {

            let followingId = btn.getAttribute("following-id");

            //-----------check user Following or unfollow for other user-------------------------
                if (btn.textContent === "Following") {
                    axios.delete(`/following/${followingId}`)
                         .then((res) => {

                            btn.textContent = "Follow";
                            count_followings.textContent =
                                res.data.count.following_count;


                        })
                        .catch((err) => {
                            console.error(err);
                        });
                } else {
                    await axios.post("/follow", { user_id: followingId })
                            .then((res) => {

                                btn.textContent = "Following";
                                count_followings.textContent =
                                    res.data.count.following_count;
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
searchFollowings.addEventListener('input', () => {
    const following = searchFollowings.value.trim();
    if (following === '') {
        loadAllFollowings();
    } else {
        filterFollowings(following);
    }
});

//-------load All Followers by default--------------------------------------------------
loadAllFollowings();

//#endregion Followings


//#region  Hashtags



//#endregion  Hashtags

const UsersLiked=document.querySelector(".usersLiked");
//-----------------------modal post Details-----------------------------------
post.forEach((a) => {

    a.addEventListener("click", () => {

        let postId = a.getAttribute("post-id");

        axios.get(`/post/${postId}`)
             .then((res) => {
                console.log(res.data);
                caption.textContent = res.data.postDetails.caption;

                    parentComments.innerHTML = `
                        <li class="list-group-item border-0 p-0">
                            <div class="d-flex justify-content-start align-items-center gap-1">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"

                                    class="rounded-circle img-fluid" alt="img" width="35px" />


                                 <div class="d-flex">
                                    <p class="fs-6 mx-2" style="font-weight: bold">${
                                        res.data.CurrentUser
                                    } </p>
                                    <p class="caption mx-1" style="font-size:15px;"> ${
                                        res.data.postDetails.caption
                                    } </p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a type="button" class="custom-link>
                                    <div class="d-flex">
                                        <a type="button" class="custom-link">
                                            <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                                <a href="" class="text-secondary custom-link mx-2">
                                                    ${formatDateRelativeToNow(
                                                        res.data.postDetails.created_at
                                                        )}
                                                </a>
                                            </p>
                                        </a>
                                    </div>
                                </a>
                            </div>

                        </li>
                    `;

                res.data.postDetails.comments.forEach((comment) => {

                    const newcomment = document.createElement("div");
                    newcomment.innerHTML = `
                <li class="list-group-item border-0 p-0">
                    <div class="d-flex justify-content-start align-items-center gap-1">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                        class="rounded-circle img-fluid" alt="img" width="35px" />
                        <div class="commentOnPost d-flex">
                            <p class="fs-6 mx-2" style="font-weight: bold">ahmed_43d </p>
                            <p class="fs-6 mx-2" style="font-weight: bold">${comment.comment_text}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a type="button" class="custom-link">
                            <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                <a href="" class="text-secondary custom-link mx-2">
                                    49w
                                </a>
                                <a href="" class="text-secondary custom-link mx-2">
                                    2likes
                                </a>
                                <a href="" class="text-secondary custom-link mx-2">
                                    Reply
                                </a>
                            </p>
                        </a>
                    </div>

                </li>
                `;

                parentComments.appendChild(newcomment);

                });


                const like=document.createElement("div");
                UsersLiked.innerHTML='';
                    like.innerHTML=`

                    <p class="m-1 mx-0">Liked by</p>
                    <a type="button" class="custom-link">
                        <p class="m-1"><b>${res.data.postDetails.likes[0].user_id}</b></p>
                    </a>
                    <p class="m-1">and</p>
                    <a type="button" class="custom-link">
                        <p class="m-1">${res.data.postDetails.likes.length}<b> others</b></p>
                    </a>


                    `;
                    like.classList.add("d-flex")
                    UsersLiked.appendChild(like);


            })
            .catch((err) => {
                console.error(err);
            });
    });
});




    let avatarImg = document.querySelector(".avatar");
    // let avatarContainer = document.querySelector(".avatar-container");
    let postsContainer = document.querySelector(".profile-details-card");

    console.log(postsContainer);

document.addEventListener("DOMContentLoaded", function() {
    let avatarImg = document.querySelector(".avatar");
    let avatarContainer = document.querySelector(".avatar-container");
    let postsContainer = document.querySelector(".main-post-div");
    console.log(avatarContainer);

        avatarImg.addEventListener("mouseenter", function() {
            let profileDetailsCard = avatarImg.closest('.avatar-container').querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "block";
            }
        });



        avatarContainer.addEventListener("mouseleave", function() {
            let profileDetailsCard = avatarContainer.querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });


        postsContainer.addEventListener("mouseleave", function() {
            let profileDetailsCard = postsContainer.querySelector(".profile-details-card");
            if (profileDetailsCard) {
                profileDetailsCard.style.display = "none";
            }
        });
    });


    // const UsersLiked=document.querySelector(".usersLiked");

// axios.get('/likes')
//   .then(res=>{
//     console.log(res.data.userLiked);
//     res.data.userLiked.forEach(user=>{
//         const like=document.createElement("div");
//         like.innerHTML=`

//         <p class="m-1 mx-0">Liked by</p>
//         <a type="button" class="custom-link">
//             <p class="m-1"><b>mohamedtorkey1520</b></p>
//         </a>
//         <p class="m-1">and</p>
//         <a type="button" class="custom-link">
//             <p class="m-1"><b>28 others</b></p>
//         </a>


//         `;
//         UsersLiked.appendChild(like);
//     })
//   })
//   .catch(err=>{
//     console.error(err);
//   })
//----------------------Calc post created age--------------------------------
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






















// ------------------------unfollow and following in following Modal-------------------------
// document.querySelectorAll(".following-btn").forEach((btn) => {

//     btn.addEventListener("click", async () => {

//         let followingId = btn.getAttribute("following-id");

//         //-----------check user Following or unfollow for other user-------------------------
//             if (btn.textContent === "Following") {
//                 axios.delete(`/following/${followingId}`)
//                      .then((res) => {

//                         btn.textContent = "Follow";
//                         count_followings.textContent =
//                             res.data.count.following_count;
//                             console.log(res.data.count.following_count);
//                             button.closest('li').remove();
//                     })
//                     .catch((err) => {
//                         console.error(err);
//                     });
//             } else {
//                 await axios.post("/follow", { user_id: followingId })
//                         .then((res) => {

//                             btn.textContent = "Following";
//                             count_followings.textContent =
//                                 res.data.count.following_count;
//                         })
//                         .catch((err) => {
//                             console.error(err);
//                         });
//             }
//     });
// });


// ------------------------unfollow and following in Followers-------------------------
// document.querySelectorAll(".follow").forEach((btn) => {

//     btn.addEventListener("click", async () => {

//         const follow_id = btn.getAttribute("follow_id");

//         //-----------check user Following or unfollow for other user-------------------------
//         if (btn.textContent === "Follow") {
//             await axios.post("/follow", { user_id: follow_id })
//                 .then((res) => {

//                     btn.textContent = "Following";
//                     count_followings.textContent =
//                         res.data.count.following_count;


//                 })
//                 .catch((err) => {
//                     console.error(err);
//                 });
//         } else {
//             axios
//                 .delete(`/following/${follow_id}`)
//                 .then((res) => {

//                     btn.textContent = "Follow";
//                     count_followings.textContent =
//                         res.data.count.following_count;
//                         console.log(res.data.count.following_count);
//                 })
//                 .catch((err) => {
//                     console.error(err);
//                 });
//         }
//     });
// });
