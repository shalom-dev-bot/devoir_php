// public/assets/js/main.js
document.addEventListener("DOMContentLoaded", function () {

    // 1. Messages flash qui disparaissent après 4 secondes
    const flash = document.querySelector('.alert');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = "opacity 0.8s";
            flash.style.opacity = "0";
            setTimeout(() => flash.remove(), 800);
        }, 4000);
    }

    // 2. Validation live des champs (inscription & login)
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function () {
            if (this.name === 'username' && this.value.length < 3) {
                this.style.borderColor = '#e74c3c';
            } else if (this.name === 'password' && this.value.length > 0 && this.value.length < 6) {
                this.style.borderColor = '#e74c3c';
            } else {
                this.style.borderColor = '#2ecc71';
            }
        });
    });

    // 3. Modal de confirmation de suppression (beau au lieu du vieux confirm())
    document.querySelectorAll('a[data-confirm]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const message = this.getAttribute('data-confirm') || "Supprimer ce livre ?";
            const url = this.getAttribute('href');

            // Création du modal
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0,0,0,0.7); display: flex; align-items: center;
                justify-content: center; z-index: 9999;
            `;

            modal.innerHTML = `
                <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; min-width: 300px;">
                    <p style="margin: 0 0 20px; font-size: 18px;">${message}</p>
                    <button id="confirmDelete" style="background:#e74c3c; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; margin:5px;">
                        Supprimer
                    </button>
                    <button id="cancelDelete" style="background:#95a5a6; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; margin:5px;">
                        Annuler
                    </button>
                </div>
            `;

            document.body.appendChild(modal);

            document.getElementById('confirmDelete').onclick = () => location.href = url;
            document.getElementById('cancelDelete').onclick = () => modal.remove();
            modal.onclick = (e) => { if (e.target === modal) modal.remove(); };
        });
    });

    // 4. Burger menu (si tu veux plus tard)
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('nav');
    if (burger && nav) {
        burger.addEventListener('click', () => {
            nav.classList.toggle('active');
            burger.classList.toggle('toggle');
        });
    }
});