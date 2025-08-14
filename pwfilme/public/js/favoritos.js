class FavoritosPage {
    constructor() {
        this.init();
    }

    init() {
        this.initDeleteConfirmation();
        this.initAnimations();
    }

    initDeleteConfirmation() {
        document.querySelectorAll(".delete-form").forEach((form) => {
            form.addEventListener("submit", (e) => {
                if (
                    !confirm(
                        "Tem certeza que deseja remover este filme dos favoritos?"
                    )
                ) {
                    e.preventDefault();
                }
            });
        });
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
}

document.addEventListener("DOMContentLoaded", () => {
    if (
        document.querySelector(".page-title") &&
        document.querySelector(".page-title").textContent.includes("Favoritos")
    ) {
        new FavoritosPage();
    }
});
