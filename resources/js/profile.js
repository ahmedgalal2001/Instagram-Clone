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
        Hashtags.classList.remove("text-muted")
      });

      Hashtags.addEventListener("click", () => {
        bodyPeople.classList.add("d-none");
        bodyHashtags.classList.remove("d-none");
        People.classList.remove("text-muted");
        Hashtags.classList.add("text-muted")
      });
