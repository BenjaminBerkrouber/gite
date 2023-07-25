<?php
// Controleur
$current_date = date("Y-m-d");
$first_day_of_month = date("Y-m-01", strtotime($current_date));
$last_day_of_month = date("Y-m-t", strtotime($current_date));

$reservations = get_all_reservations();
$lock_time = get_all_lock_time();
//$colors = ["#EED7C5", "#C89F9C", "#CA7C5C", "#B36A5E"];

$colors = [
    '1' => "#B36A5E",
    '2' => "#C89F9C"
];

include_once('view/admin/include/header.view.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des réservations</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>

        #calendar {
            max-width: 80%;
            margin: 0 auto;
            height: 750px;
        }

        #calendar table td {
            border: 0.5px solid rgba(0, 0, 0, 0.4);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EEE2DF;
        }
        h1, h2 {
            color: #CA7C5C;
            text-align: left;
        }
        .btn-primary {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }
        .btn-primary:hover {
            background-color: #C89F9C;
            border-color: #C89F9C;
        }

        .fc-event-time {
            display: none;
        }

        .fc-daygrid-dot-event .fc-event-title{
            color: red;
            text-align: center;
            font-size: 15px;
        }

    </style>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.js'></script>
</head>
<body>

<br>
<br>

<div class="container">
    <h1>Reservation Management</h1>
    <hr>

    <a href="/admin/reservation/create" class="btn btn-primary">Create Reservation</a>
    <button  class="btn btn-primary" id="block-day-btn">Block Day</button>

    <hr>

    <!-- Tableau affichant tous les utilisateurs -->
    <h2>View Reservation</h2>
    <br>
    <br>
    <div id='calendar'></div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var isBlockingDay = false;
        var blockDayBtn = document.getElementById('block-day-btn');

        var lockTime = <?php echo json_encode($lock_time); ?>;
        lockTime = lockTime.map(function(lockRange) {
            return {
                groupId: 'blocked',
                title: 'BLOQUER',
                start: new Date(lockRange.date_debut.replace(' ', 'T')),
                end: new Date(lockRange.date_fin.replace(' ', 'T')),
                backgroundColor: 'red',  // changez ici pour "red" ou toute autre couleur que vous voulez
                textColor: 'white' // couleur de texte blanc
            };
        });


        blockDayBtn.addEventListener('click', function() {
            isBlockingDay = !isBlockingDay;
            this.innerText = isBlockingDay ? 'Cancel blocking' : 'Block day';
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // Vos autres options de calendrier ici...
            events: [
                ...lockTime,
                <?php foreach ($reservations as $reservation): ?>
                {
                    id: '<?php echo $reservation['id_reservation']; ?>',
                    title: '<?php echo $reservation['nomGite']." | Famille : ".$reservation["nom"]." - ".$reservation["nb_personnes"]." pers.";?>',
                    start: new Date('<?php echo $reservation["date_debut"]; ?>'.replace(' ', 'T')),
                    end: new Date('<?php echo $reservation["date_fin"]; ?>'.replace(' ', 'T')),
                    color: '<?php echo $colors[$reservation["id_gite"]]; ?>'
                },
                <?php endforeach; ?>
            ],
            eventClick: function(info) {
                if (info.event.groupId !== 'blocked') {
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
</script>
<script>
    document.getElementById('block-day-btns').addEventListener('click', function() {
        this.classList.toggle('active');
    });
</script>
</body>
</html>
