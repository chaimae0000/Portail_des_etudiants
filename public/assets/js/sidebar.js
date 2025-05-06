document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour fermer la sidebar sur les appareils mobiles
    function closeSidebarOnClickOutside() {
        // Seulement nécessaire sur les petits écrans où la sidebar est collapsible
        if (window.innerWidth < 768) {
            const sidebar = document.getElementById('sidebarMenu');
            const toggler = document.querySelector('.navbar-toggler');
            
            // Si la sidebar est ouverte (a la classe show)
            if (sidebar && sidebar.classList.contains('show')) {
                // Créer un élément overlay transparent pour capturer les clics
                const overlay = document.createElement('div');
                overlay.id = 'sidebar-overlay';
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.zIndex = '99'; // Juste en dessous de la sidebar
                overlay.style.background = 'transparent';
                document.body.appendChild(overlay);
                
                // Fermer la sidebar quand on clique sur l'overlay
                overlay.addEventListener('click', function() {
                    // Utiliser l'API Bootstrap pour fermer la sidebar
                    const bsCollapse = new bootstrap.Collapse(sidebar);
                    bsCollapse.hide();
                    
                    // Mettre à jour l'état du toggler
                    toggler.setAttribute('aria-expanded', 'false');
                    toggler.classList.add('collapsed');
                    
                    // Supprimer l'overlay
                    document.body.removeChild(overlay);
                });
                
                // Supprimer l'overlay quand la sidebar se ferme
                sidebar.addEventListener('hidden.bs.collapse', function() {
                    if (document.getElementById('sidebar-overlay')) {
                        document.body.removeChild(document.getElementById('sidebar-overlay'));
                    }
                }, { once: true });
            }
        }
    }
    
    // Ajouter un écouteur d'événement au toggler de la sidebar
    const sidebarToggler = document.querySelector('.navbar-toggler');
    if (sidebarToggler) {
        sidebarToggler.addEventListener('click', function() {
            // Attendre que la transition d'ouverture soit terminée
            setTimeout(closeSidebarOnClickOutside, 150);
        });
    }
    
    // Fermer la sidebar quand on redimensionne la fenêtre à une taille plus grande
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            const overlay = document.getElementById('sidebar-overlay');
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }
    });
});
