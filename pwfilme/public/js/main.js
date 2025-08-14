const CONFIG = {
    API_BASE_URL: "/api",
    CSRF_TOKEN: document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content"),
    ANIMATION_DURATION: 300,
    DEBOUNCE_DELAY: 300,
};

const Utils = {
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    throttle(func, limit) {
        let inThrottle;
        return function () {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => (inThrottle = false), limit);
            }
        };
    },
    formatNumber(num) {
        return new Intl.NumberFormat("pt-BR").format(num);
    },
    formatDate(date, options = {}) {
        const defaultOptions = {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        };
        return new Intl.DateTimeFormat("pt-BR", {
            ...defaultOptions,
            ...options,
        }).format(new Date(date));
    },
    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },
    smoothScrollTo(element, offset = 0) {
        const targetPosition = element.offsetTop - offset;
        window.scrollTo({
            top: targetPosition,
            behavior: "smooth",
        });
    },
    async copyToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            return true;
        } catch (err) {
            console.error("Erro ao copiar para clipboard:", err);
            return false;
        }
    },
    showNotification(message, type = "info", duration = 3000) {
        const notification = document.createElement("div");
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => notification.classList.add("show"), 10);

        const autoRemove = setTimeout(() => {
            Utils.hideNotification(notification);
        }, duration);
        notification
            .querySelector(".notification-close")
            .addEventListener("click", () => {
                clearTimeout(autoRemove);
                Utils.hideNotification(notification);
            });
    },
    hideNotification(notification) {
        notification.classList.remove("show");
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    },
    showLoading(element, text = "Carregando...") {
        const originalContent = element.innerHTML;
        element.innerHTML = `
            <span class="loading"></span>
            <span class="loading-text">${text}</span>
        `;
        element.disabled = true;
        element.dataset.originalContent = originalContent;
    },

    hideLoading(element) {
        if (element.dataset.originalContent) {
            element.innerHTML = element.dataset.originalContent;
            element.disabled = false;
            delete element.dataset.originalContent;
        }
    },
};

const API = {
    async request(url, options = {}) {
        const defaultOptions = {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": CONFIG.CSRF_TOKEN,
            },
        };

        const config = {
            ...defaultOptions,
            ...options,
            headers: {
                ...defaultOptions.headers,
                ...options.headers,
            },
        };

        try {
            const response = await fetch(url, config);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contentType = response.headers.get("content-type");
            if (contentType && contentType.includes("application/json")) {
                return await response.json();
            }

            return await response.text();
        } catch (error) {
            console.error("API request failed:", error);
            throw error;
        }
    },

    get(url, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const fullUrl = queryString ? `${url}?${queryString}` : url;
        return this.request(fullUrl, { method: "GET" });
    },

    post(url, data = {}) {
        return this.request(url, {
            method: "POST",
            body: JSON.stringify(data),
        });
    },

    put(url, data = {}) {
        return this.request(url, {
            method: "PUT",
            body: JSON.stringify(data),
        });
    },

    delete(url) {
        return this.request(url, { method: "DELETE" });
    },
};

const FormManager = {
    init() {
        this.bindFormEvents();
        this.bindValidationEvents();
    },

    bindFormEvents() {
        document.querySelectorAll("form[data-auto-save]").forEach((form) => {
            const inputs = form.querySelectorAll("input, textarea, select");
            inputs.forEach((input) => {
                input.addEventListener(
                    "input",
                    Utils.debounce(() => {
                        this.autoSave(form);
                    }, 1000)
                );
            });
        });

        document.querySelectorAll("form[data-validate]").forEach((form) => {
            const inputs = form.querySelectorAll("input, textarea, select");
            inputs.forEach((input) => {
                input.addEventListener("blur", () => this.validateField(input));
                input.addEventListener(
                    "input",
                    Utils.debounce(() => this.validateField(input), 300)
                );
            });
        });
    },

    bindValidationEvents() {
        document.querySelectorAll('input[type="email"]').forEach((input) => {
            input.addEventListener("blur", () => {
                if (input.value && !Utils.isValidEmail(input.value)) {
                    this.showFieldError(input, "Email inválido");
                } else {
                    this.clearFieldError(input);
                }
            });
        });

        document.querySelectorAll('input[type="password"]').forEach((input) => {
            input.addEventListener("input", () => {
                const password = input.value;
                const strength = this.checkPasswordStrength(password);
                this.updatePasswordStrength(input, strength);
            });
        });
    },

    validateField(field) {
        const value = field.value.trim();
        const rules = field.dataset.validation?.split("|") || [];

        for (const rule of rules) {
            const [ruleName, ruleValue] = rule.split(":");

            switch (ruleName) {
                case "required":
                    if (!value) {
                        this.showFieldError(field, "Este campo é obrigatório");
                        return false;
                    }
                    break;
                case "min":
                    if (value.length < parseInt(ruleValue)) {
                        this.showFieldError(
                            field,
                            `Mínimo de ${ruleValue} caracteres`
                        );
                        return false;
                    }
                    break;
                case "max":
                    if (value.length > parseInt(ruleValue)) {
                        this.showFieldError(
                            field,
                            `Máximo de ${ruleValue} caracteres`
                        );
                        return false;
                    }
                    break;
                case "email":
                    if (value && !Utils.isValidEmail(value)) {
                        this.showFieldError(field, "Email inválido");
                        return false;
                    }
                    break;
            }
        }

        this.clearFieldError(field);
        return true;
    },

    showFieldError(field, message) {
        this.clearFieldError(field);

        field.classList.add("error");
        const errorElement = document.createElement("div");
        errorElement.className = "field-error";
        errorElement.textContent = message;
        field.parentNode.appendChild(errorElement);
    },

    clearFieldError(field) {
        field.classList.remove("error");
        const errorElement = field.parentNode.querySelector(".field-error");
        if (errorElement) {
            errorElement.remove();
        }
    },

    checkPasswordStrength(password) {
        let score = 0;

        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        if (score < 2) return "weak";
        if (score < 4) return "medium";
        return "strong";
    },

    updatePasswordStrength(field, strength) {
        const strengthIndicator =
            field.parentNode.querySelector(".password-strength") ||
            this.createPasswordStrengthIndicator(field);

        strengthIndicator.className = `password-strength password-strength-${strength}`;
        strengthIndicator.textContent = this.getStrengthText(strength);
    },

    createPasswordStrengthIndicator(field) {
        const indicator = document.createElement("div");
        indicator.className = "password-strength";
        field.parentNode.appendChild(indicator);
        return indicator;
    },

    getStrengthText(strength) {
        const texts = {
            weak: "Senha fraca",
            medium: "Senha média",
            strong: "Senha forte",
        };
        return texts[strength] || "";
    },

    async autoSave(form) {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            await API.post(form.dataset.autoSaveUrl, data);
            Utils.showNotification(
                "Dados salvos automaticamente",
                "success",
                2000
            );
        } catch (error) {
            console.error("Auto-save failed:", error);
        }
    },
};

const FavoritesManager = {
    init() {
        this.bindFavoriteEvents();
    },

    bindFavoriteEvents() {
        document.querySelectorAll(".favorito-form").forEach((form) => {
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                this.toggleFavorite(form);
            });
        });
    },

    async toggleFavorite(form) {
        const button = form.querySelector(".btn-favorito");

        if (button.disabled) return;
        button.disabled = true;

        Utils.showLoading(button, "Processando...");

        try {
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": CONFIG.CSRF_TOKEN,
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            let data;
            try {
                data = await response.json();
            } catch (jsonError) {
                const isCurrentlyFavorited =
                    button.classList.contains("favoritado");

                if (isCurrentlyFavorited) {
                    button.classList.remove("favoritado");
                    button.innerHTML = "🤍 Favoritar";
                } else {
                    button.classList.add("favoritado");
                    button.innerHTML = "❤️ Favoritado";
                }
                return;
            }

            if (data.isFavorito !== undefined) {
                if (data.isFavorito) {
                    button.classList.add("favoritado");
                    button.innerHTML = "❤️ Favoritado";
                } else {
                    button.classList.remove("favoritado");
                    button.innerHTML = "🤍 Favoritar";
                }
            }

            if (data.message) {
                Utils.showNotification(data.message, "success");
            }
        } catch (error) {
            console.error("Erro ao favoritar:", error);
        } finally {
            Utils.hideLoading(button);
            button.disabled = false;
        }
    },
};

const FilterManager = {
    init() {
        this.bindFilterEvents();
        this.initSearchFilters();
    },

    bindFilterEvents() {
        document.querySelectorAll(".filtro-input").forEach((input) => {
            input.addEventListener(
                "input",
                Utils.debounce(() => {
                    this.applyFilters();
                }, CONFIG.DEBOUNCE_DELAY)
            );
        });

        document.querySelectorAll(".filtro-select").forEach((select) => {
            select.addEventListener("change", () => {
                this.applyFilters();
            });
        });
    },

    initSearchFilters() {
        const searchInputs = document.querySelectorAll("input[data-search]");
        searchInputs.forEach((input) => {
            input.addEventListener(
                "input",
                Utils.debounce(() => {
                    this.performSearch(input.value, input.dataset.search);
                }, 500)
            );
        });
    },

    applyFilters() {
        const form = document.querySelector(".filtros-container form");
        if (form) {
            form.submit();
        }
    },

    performSearch(query, target) {
        const elements = document.querySelectorAll(target);
        const searchTerm = query.toLowerCase();

        elements.forEach((element) => {
            const text = element.textContent.toLowerCase();
            const isMatch = text.includes(searchTerm);

            element.style.display = isMatch ? "block" : "none";

            if (isMatch) {
                element.classList.add("search-highlight");
            } else {
                element.classList.remove("search-highlight");
            }
        });
    },
};

const AnimationManager = {
    init() {
        this.initIntersectionObserver();
        this.initScrollAnimations();
    },

    initIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-in");
                }
            });
        }, observerOptions);

        document.querySelectorAll("[data-animate]").forEach((element) => {
            observer.observe(element);
        });
    },

    initScrollAnimations() {
        document.querySelectorAll("[data-parallax]").forEach((element) => {
            window.addEventListener(
                "scroll",
                Utils.throttle(() => {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.5;
                    element.style.transform = `translateY(${rate}px)`;
                }, 16)
            );
        });
    },
};

const ThemeManager = {
    init() {
        this.loadTheme();
        this.bindThemeToggle();
    },

    loadTheme() {
        const savedTheme = localStorage.getItem("theme") || "dark";
        document.documentElement.setAttribute("data-theme", savedTheme);
    },

    bindThemeToggle() {
        const themeToggle = document.querySelector("[data-theme-toggle]");
        if (themeToggle) {
            themeToggle.addEventListener("click", () => {
                this.toggleTheme();
            });
        }
    },

    toggleTheme() {
        const currentTheme =
            document.documentElement.getAttribute("data-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";

        document.documentElement.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);

        Utils.showNotification(
            `Tema alterado para ${newTheme === "dark" ? "escuro" : "claro"}`,
            "info"
        );
    },
};

document.addEventListener("DOMContentLoaded", () => {
    FormManager.init();
    FavoritesManager.init();
    FilterManager.init();
    AnimationManager.init();
    ThemeManager.init();

    const notificationStyles = `
        <style>
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--bg-card);
                border: 1px solid var(--bg-tertiary);
                border-radius: var(--border-radius-lg);
                padding: 1rem;
                box-shadow: var(--shadow-xl);
                z-index: 10000;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                max-width: 400px;
            }

            .notification.show {
                transform: translateX(0);
            }

            .notification-content {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }

            .notification-message {
                color: var(--text-primary);
                font-size: 0.875rem;
            }

            .notification-close {
                background: none;
                border: none;
                color: var(--text-muted);
                font-size: 1.25rem;
                cursor: pointer;
                padding: 0;
                line-height: 1;
            }

            .notification-close:hover {
                color: var(--text-primary);
            }

            .notification-success {
                border-color: var(--text-success);
                background: rgba(16, 185, 129, 0.1);
            }

            .notification-error {
                border-color: var(--text-error);
                background: rgba(239, 68, 68, 0.1);
            }

            .notification-warning {
                border-color: var(--text-warning);
                background: rgba(245, 158, 11, 0.1);
            }

            .notification-info {
                border-color: var(--primary-color);
                background: rgba(99, 102, 241, 0.1);
            }

            .field-error {
                color: var(--text-error);
                font-size: 0.75rem;
                margin-top: 0.25rem;
            }

            .form-input.error {
                border-color: var(--text-error);
            }

            .password-strength {
                font-size: 0.75rem;
                margin-top: 0.25rem;
                padding: 0.25rem 0.5rem;
                border-radius: var(--border-radius);
                text-align: center;
            }

            .password-strength-weak {
                background: rgba(239, 68, 68, 0.1);
                color: var(--text-error);
            }

            .password-strength-medium {
                background: rgba(245, 158, 11, 0.1);
                color: var(--text-warning);
            }

            .password-strength-strong {
                background: rgba(16, 185, 129, 0.1);
                color: var(--text-success);
            }

            .search-highlight {
                background: rgba(99, 102, 241, 0.2);
                border-radius: 2px;
                padding: 0.125rem 0.25rem;
            }

            [data-animate] {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }

            [data-animate].animate-in {
                opacity: 1;
                transform: translateY(0);
            }
        </style>
    `;

    document.head.insertAdjacentHTML("beforeend", notificationStyles);
});

window.ToVerdeFilms = {
    Utils,
    API,
    FormManager,
    FavoritesManager,
    FilterManager,
    AnimationManager,
    ThemeManager,
};
