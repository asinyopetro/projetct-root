document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('abonneForm').addEventListener('submit', function(event) {
        let nom = document.getElementById('nom').value;
        let prenom = document.getElementById('prenom').value;
        let email = document.getElementById('email').value;
        let mot_de_passe = document.getElementById('mot_de_passe').value;

        if (nom === '' || prenom === '' || email === '' || mot_de_passe === '') {
            event.preventDefault();
            alert('Tous les champs sont requis.');
        }
    });

    document.getElementById('profilForm').addEventListener('submit', function(event) {
        let nom = document.getElementById('nom').value;
        let prenom = document.getElementById('prenom').value;
        let email = document.getElementById('email').value;

        if (nom === '' || prenom === '' || email === '') {
            event.preventDefault();
            alert('Tous les champs sont requis.');
        }
    });

    document.getElementById('rechercheTitreForm').addEventListener('submit', function(event) {
        let titre = document.getElementById('titre').value;
        if (titre === '') {
            event.preventDefault();
            alert('Le titre est requis.');
        }
    });

    document.getElementById('rechercheCategorieForm').addEventListener('submit', function(event) {
        let categorie_id = document.getElementById('categorie_id').value;
        if (categorie_id === '') {
            event.preventDefault();
            alert('La catégorie est requise.');
        }
    });

    document.getElementById('empruntForm').addEventListener('submit', function(event) {
        let isbn = document.getElementById('isbn').value;
        if (isbn === '') {
            event.preventDefault();
            alert('Le ISBN est requis.');
        }
    });
});
