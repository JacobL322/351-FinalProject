document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".image-wrapper");
    const prevButton = document.querySelector(".gallery-button.prev");
    const nextButton = document.querySelector(".gallery-button.next");

    let currentIndex = 0; // To track the current position
    const cardWidth = 607; // Width of each card + margin
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

    //Visibily Moves Cards
    function updateGallery() {
        const offset = currentIndex * cardWidth * -1; // Calculate the offset
        wrapper.style.transform = `translateX(${offset}px)`;
    }
});


//CRUD Sort
function sortTable(column) {
    const table = document.getElementById("animalTable");
    const rows = Array.from(table.tBodies[0].rows); // Get all rows in tbody
    const columnIndex = Array.from(table.tHead.rows[0].cells).findIndex(cell => cell.dataset.column === column);

    const isAscending = table.dataset.sortOrder !== "asc"; // Toggle sort order
    table.dataset.sortOrder = isAscending ? "asc" : "desc";

    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent.trim().toLowerCase();
        const bText = b.cells[columnIndex].textContent.trim().toLowerCase();
        return isAscending ? aText.localeCompare(bText) : bText.localeCompare(aText);
    });

    // Append sorted rows back to the table body
    rows.forEach(row => table.tBodies[0].appendChild(row));
}