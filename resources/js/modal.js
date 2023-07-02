import { Modal } from "flowbite";
const triggerModal = document.getElementById("trigger-modal");
const targetModal = document.getElementById("staticModal");
const modal = new Modal(targetModal, {
    closable: true,
});

if (triggerModal.getAttribute("data-trigger")) {
    modal.show();
}

document.getElementById("close-modal").addEventListener("click", function () {
    modal.hide();
});
