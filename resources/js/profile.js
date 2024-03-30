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

      posts.classList.add("border-top", "border-light");
      Save.classList.remove("border-top", "border-light");
      Tagged.classList.remove("border-top", "border-light");

      posts.classList.add("text-light");
      Save.classList.remove("text-light");
      Tagged.classList.remove("text-light");
    });

    Save.addEventListener("click", () => {
      bodyPosts.classList.add("d-none");
      bodySave.classList.remove("d-none");
      bodyTagged.classList.add("d-none");

      posts.classList.remove("border-top", "border-light");
      Save.classList.add("border-top", "border-light");
      Tagged.classList.remove("border-top", "border-light");

      posts.classList.remove("text-light");
      Save.classList.add("text-light");
      Tagged.classList.remove("text-light");
    });

    Tagged.addEventListener("click", () => {
      bodyPosts.classList.add("d-none");
      bodySave.classList.add("d-none");
      bodyTagged.classList.remove("d-none");

      posts.classList.remove("border-top", "border-light");
      Save.classList.remove("border-top", "border-light");
      Tagged.classList.add("border-top", "border-light");

      posts.classList.remove("text-light");
      Save.classList.remove("text-light");
      Tagged.classList.add("text-light");

    });

    //----------People and Hashtags setction--------------------------
    People.addEventListener("click", () => {
      bodyPeople.classList.remove("d-none");
      bodyHashtags.classList.add("d-none");
      People.classList.add("text-light");
      Hashtags.classList.remove("text-light")
    });

    Hashtags.addEventListener("click", () => {
      bodyPeople.classList.add("d-none");
      bodyHashtags.classList.remove("d-none");
      People.classList.remove("text-light");
      Hashtags.classList.add("text-light")
    });
