class FilmesPage {
    constructor() {
        this.init();
    }

    init() {
        this.initLazyLoading();
        this.initAutoFilters();
        this.initDeleteConfirmation();
        this.initTooltips();
    }

    initLazyLoading() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove("lazy");
                    observer.unobserve(img);
                }
            });
        });

        images.forEach((img) => imageObserver.observe(img));
    }

    initAutoFilters() {
        const filterInputs = document.querySelectorAll(".filtro-input");

        filterInputs.forEach((input) => {
            input.addEventListener(
                "input",
                Utils.debounce(() => {
                    const form = input.closest("form");
                    if (form) {
                        form.submit();
                    }
                }, 500)
            );
        });
    }

    initDeleteConfirmation() {
        document.querySelectorAll(".delete-form").forEach((form) => {
            form.addEventListener("submit", (e) => {
                if (
                    !confirm(
                        "Tem certeza que deseja excluir este filme? Esta ação não pode ser desfeita."
                    )
                ) {
                    e.preventDefault();
                }
            });
        });
    }

    initTooltips() {
        const tooltipElements = document.querySelectorAll("[data-tooltip]");

        tooltipElements.forEach((element) => {
            element.addEventListener("mouseenter", (e) => {
                const tooltip = document.createElement("div");
                tooltip.className = "tooltip";
                tooltip.textContent = e.target.dataset.tooltip;
                document.body.appendChild(tooltip);

                const rect = e.target.getBoundingClientRect();
                tooltip.style.left =
                    rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + "px";
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + "px";
                tooltip.style.opacity = "1";

                e.target.tooltip = tooltip;
            });

            element.addEventListener("mouseleave", (e) => {
                if (e.target.tooltip) {
                    e.target.tooltip.remove();
                    e.target.tooltip = null;
                }
            });
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".filmes-container")) {
        new FilmesPage();
    }
});
