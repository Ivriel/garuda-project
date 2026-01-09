// how to use:
// add .accordion to the parent elements that need to change height

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the class 'accordion'
    const accordions = document.querySelectorAll('.accordion');

    accordions.forEach((accordion) => {
        // Calculate the height of each accordion element
        const height = accordion.scrollHeight;

        // Set the height as an inline style
        accordion.style.height = `${height}px`;
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the class 'accordion-with-select'
    const accordions = document.querySelectorAll('.accordion-with-select');

    accordions.forEach((accordion) => {
        const btn = accordion.querySelector('.accordion-btn');
        const content = accordion.querySelector('.accordion-content');
        const arrow = accordion.querySelector('.arrow');

        // Function to open the accordion (set height dynamically based on content)
        const openAccordion = () => {
            const fullHeight = content.scrollHeight + 75; // content + button height
            accordion.style.height = `${fullHeight}px`;
            arrow.style.transform = 'rotate(0deg)';
        };

        // Function to close the accordion (set height to 75px)
        const closeAccordion = () => {
            accordion.style.height = '75px';
            arrow.style.transform = 'rotate(180deg)';
        };

        // Initially, the accordion is open (calculate and set height)
        openAccordion();

        // Add click event to toggle the accordion between open and closed states
        btn.addEventListener('click', () => {
            const isOpen = accordion.style.height !== '75px';
            if (isOpen) {
                closeAccordion();
            } else {
                openAccordion();
            }
        });
    });
});