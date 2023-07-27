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

        /* Add some styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal {
            z-index: 2000;  /* Changer cette valeur selon vos besoins */
            /* Le reste de vos styles */
        }

    </style>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="/app/admin/reservation/app_calendar.js"></script>
    <script>
        var lockTime = <?php echo json_encode($lock_time); ?>;
        var reservations = <?php echo json_encode($reservations); ?>;
        var colors = <?php echo json_encode($colors); ?>;
    </script>
</head>
<body>
<?php var_dump($lock_time); ?>

<br>
<br>

<div class="container">
    <h1>Reservation Management</h1>
    <hr>

    <a href="/admin/reservation/create" class="btn btn-primary">Create Reservation</a>
    <button class="btn btn-primary" id="block-day-btn">Block Day</button>
    <hr>

    <h2>View Reservation</h2>
    <br>
    <br>
    <div id='calendar'></div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Select Gîtes to Block</h2>
            <form id="gites-block-form">
                <?php foreach ($gites as $gite): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $gite['id_gite'] ?>" id="gite<?= $gite['id_gite'] ?>">
                        <label class="form-check-label" for="gite<?= $gite['id_gite'] ?>">
                            <?= $gite['nom'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary">Block</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
