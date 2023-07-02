const textArea = document.getElementById("codemirror");
const buttonRun = document.getElementById("runCodeMirror");
const editor = CodeMirror.fromTextArea(textArea, {
    mode: "text/html",
    lineNumbers: true,
    theme: "dracula",
    autoCloseTags: true,
    extraKeys: {
        "Ctrl-Space": "autocomplete",
    },
});

let delay;

buttonRun.addEventListener("click", function () {
    clearTimeout(delay);
    delay = setTimeout(updatePreview, 300);
});

function updatePreview() {
    let previewFrame = document.getElementById("preview");
    let preview =
        previewFrame.contentDocument || previewFrame.contentWindow.document;
    preview.open();
    preview.write(editor.getValue());
    preview.close();
}
setTimeout(updatePreview, 300);

// typeTask
const code = document.getElementById("code");
const file = document.getElementById("file");
const isCode = document.getElementById("isCode").classList;
const isAttachment = document.getElementById("isAttachment").classList;
const isAttachmentValue = document.getElementById("isAttachmentValue");

if (sessionStorage.getItem("tipe_tugas") == "code") {
    isAttachmentValue.value = "0";
    isCode.remove("hidden");
    isAttachment.add("hidden");
    code.setAttribute("selected", true);
} else {
    isAttachmentValue.value = "1";
    isCode.add("hidden");
    isAttachment.remove("hidden");
    file.setAttribute("selected", true);
}

window.typeTask = function typeTask(type) {
    if (type == 1) {
        sessionStorage.setItem("tipe_tugas", "attachment");
        isAttachmentValue.value = "1";
        isCode.add("hidden");
        isAttachment.remove("hidden");
    } else {
        sessionStorage.setItem("tipe_tugas", "code");
        isAttachmentValue.value = "0";
        isCode.remove("hidden");
        isAttachment.add("hidden");
    }
};

export default typeTask;
