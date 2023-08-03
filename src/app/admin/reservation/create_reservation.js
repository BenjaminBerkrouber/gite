$(document).ready(function(){
    $('#userSearch').on('keyup', function(){
        var searchText = $(this).val().toLowerCase();

        if (searchText.length > 0) {
            var filteredUsers = users.filter(function(user) {
                return user.nom.toLowerCase().includes(searchText) || user.prenom.toLowerCase().includes(searchText);
            });

            var html = '';
            if (filteredUsers.length > 0) {
                filteredUsers.forEach(function(user) {
                    html += '<button type="button" class="btn btn-secondary btn-sm mr-2 mb-2" data-id="' + user.id_user + '">' + user.nom + ' ' + user.prenom + '</button>';
                });
            } else {
                html += '<a href="/admin/user/create" class="btn btn-primary btn-sm">User not find, create this user</a>';
            }

            $('#userResults').html(html);
            $('#userResults').fadeIn();
        } else {
            $('#userResults').fadeOut();
        }
    });

    $(document).on('click', '#userResults button', function() {
        $('#userSearch').val($(this).text());
        $('#userId').val($(this).data('id'));
        $('#userResults').fadeOut();
    });
});

function updatePersonnesSelect() {
    var selectedGiteId = $('#giteSelect').val();
    var maxPlaces = gites.find(gite => gite.id_gite === parseInt(selectedGiteId)).places;
    var html = '';
    for (var i = 1; i <= maxPlaces; i++) {
        html += '<option value="' + i + '">' + i + '</option>';
    }
    $('#nb_personnes').html(html);
}

$('#giteSelect').on('change', function() {
    updatePersonnesSelect();
});

updatePersonnesSelect();

$(document).ready(function() {
    var today = new Date();
    var tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);

    // Convertir les dates bloquées en format désactivé
    var disabledDates = lock_time.map(function(lock) {
        return {
            from: new Date(lock.date_debut),
            to: new Date(lock.date_fin)
        };
    });

    disabledDates.push(
        { from: today, to: tomorrow },
        {
            from: new Date(2023, 7, 2, 10, 0), // 7 pour Août car les mois sont indexés à partir de zéro
            to: new Date(2023, 7, 2, 15, 0)
        }
    );

    var dateDebutPicker = flatpickr("#date_debut", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        disable: disabledDates,
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates[0]) {
                dateFinPicker.set('minDate', selectedDates[0]);
            }
        }
    });

    var dateFinPicker = flatpickr("#date_fin", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        disable: disabledDates,
    });
});
