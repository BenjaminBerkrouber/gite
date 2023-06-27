<?php
// Controleur
$current_date = date("Y-m-d");
$first_day_of_month = date("Y-m-01", strtotime($current_date));
$last_day_of_month = date("Y-m-t", strtotime($current_date));

//$reservations = get_reservations_by_date_range($first_day_of_month,$last_day_of_month);
$reservations = get_all_reservations();

$colors = ["#EED7C5", "#C89F9C", "#CA7C5C", "#B36A5E"];

include_once('view/admin/include/header.view.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Calendrier des réservations</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EEE2DF;
        }

        #calendar {
            max-width: 60%;
            margin: 0 auto;
            height: 800px;
        }
    </style>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr', // Set language to French
                events: [
                    <?php foreach ($reservations as $reservation): ?>
                    {
                        id: '<?php echo $reservation['id_reservation']; ?>', // Add the reservation ID
                        title: '<?php echo $reservation['nomGite']." | Famille : ".$reservation["nom"]." - ".$reservation["nb_personnes"]." pers.";?>',
                        start: '<?php echo $reservation["date_debut"]; ?>',
                        end: '<?php echo $reservation["date_fin"]; ?>',
                        color: '<?php echo $colors[array_rand($colors)]; ?>' // Random color from the palette
                    },
                    <?php endforeach; ?>
                ],
                eventClick: function(info) {
                    window.location.href = '/admin/reservation/update?id=' + info.event.id;
                },
                eventDidMount: function(info) {
                    info.el.addEventListener('contextmenu', function(ev) {
                        ev.preventDefault();
                        if(confirm("Voulez-vous supprimer cette réservation ?")) {
                            window.location.href = '/admin/reservation/delete?id_reservation=' + info.event.id;
                        }
                    });
                }
            });
            calendar.render();
        });
    </script>

</head>
<body>

<div id='calendar'></div>

</body>
</html>
