<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier de réservation</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins';
            background-color: #EEE2DF;
        }

        .calendar-container {
            margin-top: 4rem;
            background-color: #EED7C5;
            padding: 2rem;
            border-radius: 10px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .calendar-header button {
            background: none;
            border: none;
            cursor: pointer;
            color: #CA7C5C;
            font-size: 1.5rem;
        }

        .calendar-header button:hover {
            color: #B36A5E;
        }

        .calendar-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1rem;
        }

        .calendar-day {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 5rem;
            background-color: #CA7C5C;
            color: white;
            border-radius: 5px;
        }

        .calendar-day.reserved {
            background-color: green;
        }
    </style>
</head>
<body>
<div class="container calendar-container">
    <div class="calendar-header">
        <button id="prev-month"><i class="fas fa-arrow-left"></i></button>
        <h1 id="month-year"></h1>
        <button id="next-month"><i class="fas fa-arrow-right"></i></button>
    </div>
    <div class="calendar-body" id="calendar-body">
        <!-- Les jours du calendrier seront générés ici -->
    </div>
</div>

<!-- JS Bootstrap (jQuery requis) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Le script pour générer le calendrier sera ici
</script>
</body>
</html>
