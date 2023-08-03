<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des réservations</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/view/admin/css/style_admin_gite.css">

    <style>
        #calendar {
            max-width: 90%;
            margin: 0 auto;
            height: 750px;
        }

        #calendar table td {
            border: 0.5px solid rgba(0, 0, 0, 0.4);
        }

        .fc-event-time {
            display: none;
        }

        .fc-daygrid-dot-event .fc-event-title{
            color: black;
        }
    </style>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.js'></script>
    <script src="/app/admin/reservation/app_calendar.js"></script>
    <script>
        var lockTime = <?php echo json_encode($lock_time); ?>;
        var reservations = <?php echo json_encode($reservations); ?>;
        var colors = <?php echo json_encode($colors); ?>;
        var cleaningTime = <?php echo json_encode($cleaning_time); ?>;
    </script>
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

    <h2>View Reservation</h2>
    <br>
    <br>
    <div id='calendar'></div>
</div>

</body>
</html>


