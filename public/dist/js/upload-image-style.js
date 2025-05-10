document.addEventListener("DOMContentLoaded", function () {
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(function (input) {
        input.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewId =
                        "previewImage-" + input.id.replace("fileInput-", "");
                    const preview = document.getElementById(previewId);
                    if (preview) {
                        preview.setAttribute("src", e.target.result);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Click pe modal => închidere
    const modal = document.getElementById("zoomModal");
    modal.addEventListener("click", function () {
        modal.style.display = "none";
    });
});
//Close buton modal
document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("zoomModal").style.display = "none";
});
// Funcția de zoom cu modal
function zoomImage(previewId) {
    const img = document.getElementById(previewId);
    const modal = document.getElementById("zoomModal");
    const modalImg = document.getElementById("zoomModalImg");

    if (img && modal && modalImg) {
        modalImg.src = img.src;
        modal.style.display = "flex";
    }
}
