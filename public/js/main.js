document.addEventListener('DOMContentLoaded', function(event) {
    var deleteLinks = document.querySelectorAll('.delete-link');

    for (var deleteLink of deleteLinks) {
        deleteLink.addEventListener('click', function(event) {
            event.preventDefault();

            if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                document.location = event.target.href;
            }
        });
    }
});
