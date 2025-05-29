document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("input", (e) => {
        const target = e.target;
        if (target.name === "phone") {
            if (!/^\d{10,15}$/.test(target.value)) {
                target.setCustomValidity("Enter a valid phone number.");
            } else {
                target.setCustomValidity("");
            }
        }

        if (target.name === "isbn") {
            if (!/^\d{10,13}$/.test(target.value)) {
                target.setCustomValidity("Enter a valid ISBN (10-13 digits).");
            } else {
                target.setCustomValidity("");
            }
        }
    });
});
