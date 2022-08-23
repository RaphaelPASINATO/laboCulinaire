$(document).ready(function(){
    var request = $.post('ajax/liste-ateliers-filtree.php', {}, 'html');

    request.done(function(data) {
        $("#liste-ateliers").empty().html(data);
    });

    request.fail(function(jqXHR) {
        console.log(jqXHR.status + " " + jqXHR.statusText);
        var msgErr = "La requête a échoué : contactez l'administrateur";
        $("#liste-ateliers").empty().html(msgErr);
    });

    $('#filtre-categorie').on('change', function(){
        afficheAteliers();
    });

    $('#filtre-date-debut').on('change', function(){
        afficheAteliers();
    });
    $('#filtre-date-fin').on('change', function(){
        afficheAteliers();
    });
    $('#filtre-prix').on('input', function(){
        afficheAteliers();
    });

    $('#effacer-filtres').on('click', function(){
        $('#filtre-categorie').val(false);
        $('#filtre-prix').val('');
        $('#filtre-date-debut').val('');
        $('#filtre-date-fin').val('');
    });

    function afficheAteliers() {
        var laCategorie = $('#filtre-categorie option:selected').val();
        var lePrix  = $('#filtre-prix').val();
        var laDateDebut = $('#filtre-date-debut').val();
        var laDateFin = $('#filtre-date-fin').val();

        var request = $.post(
            'ajax/liste-ateliers-filtree.php',
            {
                idCategorie: laCategorie,
                filtrePrix: lePrix,
                filtreDateDebut:laDateDebut,
                filtreDateFin: laDateFin
            },
            'html'
        );

        request.done(function(data){
            $("#liste-ateliers").empty().html(data);
        });

        request.fail(function(jqXHR) {
            console.log(jqXHR.status + " " + jqXHR.statusText);
            $("#liste-ateliers").empty()
                .html("La requête a échoué : contactez l'administrateur");
        })
    };
});

