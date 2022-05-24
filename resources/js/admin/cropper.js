if (document.querySelector('.js-image-uploader')) {
    document.querySelectorAll('.js-image-uploader').forEach(function (element) {
        element.imageUploader();
    });
}


if (document.querySelector('.upload-photo-input')) {
    document.querySelectorAll('.upload-photo-input').forEach(function (element) {
        element.addEventListener('change', function (event) {
            let files = new FormData();
            files.append('photo', document.forms['form-uploader']['file'].files[0]);
            sendPhoto('/admin/tool/upload', files, function (data) {
                if (data.status === 'success') {
                    document.querySelector('.pre-review-photo').src = data.filePath;
                    let linkHolder = document.querySelector('.link-holder');
                    linkHolder.value = data.filePath;
                    const image = document.querySelector('.pre-review-photo');
                    initCropper(image, getAspectRatio(linkHolder), document.querySelector('.cropper-block'));
                }
            });
        });
    });
}

function sendPhoto(url, data, callback) {
    fetch(url, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        method: 'POST',
        body: data
    }).then(function (response) {
        return response.json();
    }).then(function (json) {
        callback(json);
    }).catch(function (error) {
        console.log(error);
    });
}

function getAspectRatio(linkHolder) {
    let imageWidth = linkHolder.getAttribute('data-width');
    let imageHeight = linkHolder.getAttribute('data-height');
    return imageWidth / imageHeight;
}

function initCropper(image,aspectRatio,cropperBlock) {
    (new Cropper(image)).destroy();
    const croper = new Cropper(image, {
        aspectRatio: aspectRatio,
        zoomable: false,
        checkImageOrigin: false,
        cropend: function () {
            let data = croper.getData();
            cropperBlock.querySelector('#cropX').value = data.x;
            cropperBlock.querySelector('#cropY').value = data.y;
            cropperBlock.querySelector('#cropWidth').value = data.width;
            cropperBlock.querySelector('#cropHeight').value = data.height;
        },
    });
    let data = croper.getData();
    cropperBlock.querySelector('#cropX').value = data.x;
    cropperBlock.querySelector('#cropY').value = data.y;
    cropperBlock.querySelector('#cropWidth').value = data.width;
    cropperBlock.querySelector('#cropHeight').value = data.height;
}

if (document.querySelector('.link-holder')) {
    let imageLink = document.querySelector('.link-holder').value;
    document.querySelector('.pre-review-photo').setAttribute('src', imageLink);
}
