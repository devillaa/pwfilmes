class HomePage {
    constructor() {
        this.init();
    }

    init() {
        this.initAnimations();
        this.initParallax();
    }

    initAnimations() {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("animate-in");
                    }
                });
            },
            {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px",
            }
        );

        document.querySelectorAll("[data-animate]").forEach((element) => {
            observer.observe(element);
        });
    }

    initParallax() {
        const heroSection = document.querySelector(".hero-section");
        if (heroSection) {
            window.addEventListener("scroll", () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                heroSection.style.transform = `translateY(${rate}px)`;
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".hero-section")) {
        new HomePage();
    }
});
