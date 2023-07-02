// tinymce plugins
tinymce.init({
    selector: "textarea#content", // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: "image code table lists emoticons",
    toolbar:
        "| image |undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table",
    images_upload_url: "/api/upload-image",
    images_upload_handler: (blobInfo, progress) => {
        return new Promise((resolve, reject) => {
            const xmlRequest = new XMLHttpRequest();
            const formData = new FormData();

            xmlRequest.withCredentials = false;
            xmlRequest.open("POST", "/api/upload-image");

            xmlRequest.upload.onprogress = (e) => {
                progress((e.loaded / e.total) * 100);
            };

            xmlRequest.onload = () => {
                if (xmlRequest.status == 200) {
                    const response = JSON.parse(xmlRequest.response);

                    resolve(response.location);
                } else {
                    reject("HTTP Error: " + xmlRequest.status);
                }
            };

            xmlRequest.onerror = () => {
                reject(
                    "Image upload failed due to a XHR Transport error. Code: " +
                        xmlRequest.status
                );
            };

            formData.append("file", blobInfo.blob(), blobInfo.filename());
            formData.append("image", blobInfo.blob());
            formData.append("title", blobInfo.filename());
            xmlRequest.send(formData);
        });
    },
});
