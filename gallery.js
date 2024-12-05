document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".image-wrapper");
    const prevButton = document.querySelector(".gallery-button.prev");
    const nextButton = document.querySelector(".gallery-button.next");

    let currentIndex = 0; // To track the current position
    const cardWidth = 607; // Width of each card + margin (adjust if necessary)
    const visibleCards = Math.floor(document.querySelector(".image-gallery").offsetWidth / cardWidth);
    const totalCards = document.querySelectorAll(".image-card").length;

    // Move to the next set of images
    nextButton.addEventListener("click", () => {
        if (currentIndex < totalCards - visibleCards) {
            currentIndex++;
            updateGallery();
        }
    });

    // Move to the previous set of images
    prevButton.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateGallery();
        }
    });

    function updateGallery() {
        const offset = currentIndex * cardWidth * -1; // Calculate the offset
        wrapper.style.transform = `translateX(${offset}px)`;
    }
});
