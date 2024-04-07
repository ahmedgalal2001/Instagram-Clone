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
const caption = document.querySelector(".caption");
const post = document.querySelectorAll(".post");


//------------------------remove follower----------------------------

document.querySelectorAll(".remove-follower-btn").forEach((btn) => {

    btn.addEventListener("click", () => {
        let followerId = btn.getAttribute("follower-id");

        axios.delete(`/followers/${followerId}`)
            .then((res) => {
                count_followings.textContent = res.data.count.following_count;
                count_followers.textContent = res.data.count.followers_count;
            })
            .catch((err) => {
                console.error(err);
            });
    });
});

// ------------------------unfollow and following in following Modal-------------------------
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
                })
                .catch((err) => {
                    console.error(err);
                });
        }
    });
});

//-----------------------modal post Details-----------------------------------
post.forEach((a) => {

    a.addEventListener("click", () => {

        let postId = a.getAttribute("post-id");

        axios.get(`/post/${postId}`)
             .then((res) => {
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
            })
            .catch((err) => {
                console.error(err);
            });
    });
});

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
