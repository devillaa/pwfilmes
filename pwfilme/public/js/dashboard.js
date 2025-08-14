class Dashboard {
    constructor() {
        this.init();
    }

    init() {
        this.initAnimations();
        this.initRefreshStats();
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

    initRefreshStats() {
        setInterval(() => {
            this.refreshStats();
        }, 300000);
    }

    async refreshStats() {
        try {
            const response = await fetch("/admin/dashboard/stats");
            const data = await response.json();

            if (data.success) {
                this.updateStatsDisplay(data.stats);
            }
        } catch (error) {
            console.error("Erro ao atualizar estatísticas:", error);
        }
    }

    updateStatsDisplay(stats) {
        Object.keys(stats).forEach((key) => {
            const element = document.querySelector(`[data-stat="${key}"]`);
            if (element) {
                element.textContent = stats[key];
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".dashboard-title")) {
        new Dashboard();
    }
});
