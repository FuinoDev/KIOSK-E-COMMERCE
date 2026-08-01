document.addEventListener('DOMContentLoaded', function () {
    // Typing effect for the hero title
    const element = document.getElementById('hero-title');
    const text = element.innerHTML;

    function typeEffect() {
        element.innerHTML = '';
        let i = 0;
        (function typing() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(typing, 100); // Typing speed
            } else {
                setTimeout(() => {
                    element.innerHTML = text; // Reset text
                    setTimeout(typeEffect, 1000); // Loop delay
                }, 1000);
            }
        })();
    }
    typeEffect();

    // Hero image slider
    const images = document.querySelectorAll('.hero-images img');
    let currentIndex = 0;

    function switchHeroImage() {
        if (images.length === 0) return; // Avoid errors if no images exist
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    setInterval(switchHeroImage, 3000); // Switch hero image every 3 seconds

    // Product card image slider
    const productCards = document.querySelectorAll('.product-card img');
    const imageList = [
        "../img/p1.jpeg",
        "../img/p2.jpeg",
        "../img/p3.jpeg",
        "../img/p4.jpeg",
        "../img/p5.jpeg",
        "../img/p6.webp",
        "../img/p7.webp",
        "../img/p8.jpeg",
        "../img/p9.jpeg",
        "../img/p10.jpeg"
    ];

    let currentImageIndex = 0;

    function switchProductCardImage() {
        productCards.forEach((card) => {
            currentImageIndex = (currentImageIndex + 1) % imageList.length;
            card.src = imageList[currentImageIndex];
        });
    }

    setInterval(switchProductCardImage, 3000); // Change product card images every 3 seconds

    // Product card interaction (e.g., redirecting to product page)
    document.querySelectorAll('.product-card').forEach(element => {
        element.addEventListener('click', () => {
            window.location.href = '../pages/product.html'; // Redirect to product page
        });
    });
});
