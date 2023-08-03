document.addEventListener('DOMContentLoaded', function() {
    var isBlockingDay = false;
    var blockDayBtn = document.getElementById('block-day-btn');

    lockTime = lockTime.map(function(lockRange) {
        return {
            groupId: 'blocked',
            title: 'BLOQUER',
            start: new Date(lockRange.date_debut.replace(' ', 'T')),
            end: new Date(lockRange.date_fin.replace(' ', 'T')),
            backgroundColor: 'red',
            textColor: 'white'
        };
    });

    cleaningTime = cleaningTime.map(function(cleanRange) {
        return {
            groupId: 'cleaning',
            title: 'Ménage - ' + cleanRange.nomGite,
            start: new Date(cleanRange.date_debut.replace(' ', 'T')),
            end: new Date(cleanRange.date_fin.replace(' ', 'T')),
            backgroundColor: 'green',
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
            ...cleaningTime,
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
            if (info.event.groupId !== 'blocked' && info.event.groupId !== 'cleaning') {
                window.location.href = '/admin/reservation/update?id=' + info.event.id;
            }
        },
        dateClick: function(info) {
            if(isBlockingDay) {
                const clickedDate = info.dateStr;
                window.location.href = '/admin/reservation/lock?date=' + clickedDate;
            }
        }
    });

    calendar.render();
});

document.getElementById('block-day-btns').addEventListener('click', function() {
    this.classList.toggle('active');
});
