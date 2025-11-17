// Validation simple pour formulaire register/login/book
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll("form");

    forms.forEach(function(form) {
        form.addEventListener("submit", function(e) {
            let valid = true;

            form.querySelectorAll("input[required]").forEach(function(input) {
                if (input.value.trim() === "") {
                    valid = false;
                    input.style.borderColor = "red";
                } else {
                    input.style.borderColor = "#ccc";
                }
            });

            if (!valid) {
                e.preventDefault();
                alert("Please fill all required fields!");
            }
        });
    });
});
