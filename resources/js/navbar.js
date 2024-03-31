let myfile = document.getElementById("myfile");
let upload_img = document.getElementById("upload-img");

myfile.addEventListener('change', function (event) {
    // Get the selected file(s)
    var selectedFile = event.target.files[0];
    var imgUrl = URL.createObjectURL(selectedFile);

    // Set the innerHTML of upload_img element to display the image
    upload_img.innerHTML = `
    <form id="uploadForm" action="/your-route-url" method="POST" enctype="multipart/form-data">
        <div class="card mb-3 bg-website" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="${imgUrl}" class="img-fluid rounded-start" alt="Selected Image">
              <input type="file" name="image" style="display: none;" value="${selectedFile}" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <textarea class="form-control bg-website" name="commit_message" rows="3" placeholder="Add a commit message"></textarea>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                <button type="submit" class="btn btn-primary">Create Post</button>
              </div>
            </div>
          </div>
        </div>
    </form>`;

    console.log('Selected file:', selectedFile.name);
});
