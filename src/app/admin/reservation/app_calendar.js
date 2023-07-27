document.addEventListener('DOMContentLoaded', function() {
    var isBlockingDay = false;
    var blockDayBtn = document.getElementById('block-day-btn');
    var clickedDate;

    lockTime = lockTime.map(function(lockRange) {
        var color, title;
        switch (lockRange.value) {
            case "Menage":
                color = 'green';
                title = 'MÉNAGE';
                break;
            default:
                color = 'red';
                title = 'BLOQUER';
                break;
        }

        return {
            groupId: 'blocked',
            title: title,
            start: new Date(lockRange.date_debut.replace(' ', 'T')),
            end: new Date(lockRange.date_fin.replace(' ', 'T')),
            backgroundColor: color,
            textColor: 'white'
        };
    });

    blockDayBtn.addEventListener('click', function() {
        isBlockingDay = !isBlockingDay;
        this.innerText = isBlockingDay ? 'Cancel blocking' : 'Block day';
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            ...lockTime,
            ...reservations.map(function(reservation) {
                return {
                    id: reservation.id_reservation,
                    title: reservation.nomGite + " | " + reservation.nom,
                    start: new Date(reservation.date_debut.replace(' ', 'T')),
                    end: new Date(reservation.date_fin.replace(' ', 'T')),
                    color: colors[reservation.id_gite]
                };
            })
        ],
        eventClick: function(info) {
            if (info.event.groupId !== 'blocked') {
                window.location.href = '/admin/reservation/update?id=' + info.event.id;
            }
        },
        dateClick: function(info) {
            if(isBlockingDay) {
                clickedDate = info.dateStr;
                // Open the modal here
                $('#myModal').modal('show');
            }
        }
    });

    calendar.render();

    var blockForm = document.getElementById('gites-block-form');
    blockForm.addEventListener('submit', function(event) {
        event.preventDefault();

        var giteIds = Array.from(blockForm.elements).filter(function(element) {
            return element.checked;
        }).map(function(element) {
            return element.value;
        });

        fetch('/admin/reservation/lock', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                date: clickedDate,
                giteIds: giteIds
            })
        }).then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                return Promise.reject('Error:' + response.status);
            }
        }).then(function() {
            // Re-render the calendar with the blocked gîtes.
            calendar.refetchEvents();
            $('#myModal').modal('hide');
        }).catch(function(error) {
            console.log(error);
        });
    });

    // Code to close the modal
    var closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', function() {
        $('#myModal').modal('hide');
    });
});
