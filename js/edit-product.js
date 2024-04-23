const form = document.querySelector('.form');
const inputFile = form.querySelector('#image');
const hiddenError = document.querySelector('.hidden');
const mainForm = document.querySelector('form');
const progress = document.querySelector('.progress');
const percent = document.querySelector('.percent');
const nameF = document.querySelector('.name');
const progressRow = document.querySelector('.progress-area .row');
const uploadedArea = document.querySelector('.uploaded-area');

form.addEventListener('click', () => {
    inputFile.click();
});

let uploadCount = 0;
inputFile.addEventListener('change', (e) => {
    let file = e.target.files[0];
    if(file){
        let fileName = file.name;
        let fileType = file.type;
        if (fileType == "image/jpeg" || fileType == "image/avif" || fileType == "image/png" || fileType == "image/gif" || fileType == "apng" || fileType == "image/svg+xml" || fileType == "image/webp") {
            if (fileType == "image/avif" || fileType == "image/webp") {
                if (uploadCount < 6) {
                    if (fileName.length >= 12) {
                        let splitName = fileName.split('.');
                        fileName = splitName[0].substring(0, 12) + "... ." + splitName[1];
                    }
                    uploadImage(fileName, mainForm, file);
                    uploadCount++;
                }else{
                    hiddenError.style.display = "block";
                    hiddenError.innerText = "Only 6 images can be uploaded for a product";
                    setTimeout(() =>{
                        hiddenError.innerText = null;
                        hiddenError.style.display = "none";
                    }, 5000);
                }
            } else {
                hiddenError.style.display = "block";
                hiddenError.innerText = "Please select with webp or avif extension only";
                setTimeout(() =>{
                    inputFile.value = null;
                    hiddenError.innerText = null;
                    hiddenError.style.display = "none";
                }, 5000);
            }
        } else {
            hiddenError.style.display = "block";
            hiddenError.innerText = "Error: the file selected by the user is not an image";
            setTimeout(() =>{
                inputFile.value = null;
                hiddenError.innerText = null;
                hiddenError.style.display = "none";
            }, 5000);
        }
    }
});

function uploadImage(name, frm ,file){
    let size = file.size;
    let sizeKB = Math.floor(size/1024);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "ajax-handlers/changeImage.php", true);
    xhr.upload.addEventListener('progress', (e) => {
        let loaded = e.loaded;
        let progr = Math.floor((loaded/size) * 100);
        if (progr >= 100) {
            progr = 100;
        }
        progressRow.style.display = "flex";
        progress.style.width = progr + "%";
        percent.innerText = progr + "%";
        nameF.innerHTML = name + ` <i class="fas fa-dot-circle"></i> Uploading`;
        if (progr == 100) {
            progressRow.style.display = "none";
            let uploadedHTML = `<li class="row">
                                    <i class="fas fa-file-alt"></i>
                                    <div class="content">
                                        <div class="details">
                                            <div class="name"><span>`+ name +`</span><i class="fas fa-dot-circle"></i><span class="up_sign">Uploaded</span></div>
                                            <span class="size">`+ sizeKB +`KB</span>
                                        </div>
                                    </div>
                                    <i class="fas fa-check"></i>
                                </li>`;
            uploadedArea.insertAdjacentHTML('afterbegin', uploadedHTML);
        }
    });
    let formData = new FormData(frm);
    xhr.send(formData);
}