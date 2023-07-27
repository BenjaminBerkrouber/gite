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
