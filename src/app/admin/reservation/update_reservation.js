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

console.log('test')