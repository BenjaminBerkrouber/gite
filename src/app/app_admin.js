// // Données de test pour les graphiques
// var userChartData = {
//     labels: ['January', 'February', 'March', 'April', 'May', 'June'],
//     datasets: [{
//         label: 'Users',
//         data: [12, 19, 3, 5, 2, 3],
//         backgroundColor: 'rgba(54, 162, 235, 0.5)',
//         borderColor: 'rgba(54, 162, 235, 1)',
//         borderWidth: 1
//     }]
// };
//
// var reservationChartData = {
//     labels: ['January', 'February', 'March', 'April', 'May', 'June'],
//     datasets: [{
//         label: 'Reservations',
//         data: [5, 10, 6, 8, 4, 7],
//         backgroundColor: 'rgba(255, 99, 132, 0.5)',
//         borderColor: 'rgba(255, 99, 132, 1)',
//         borderWidth: 1
//     }]
// };
//
// // Configuration des options des graphiques
// var chartOptions = {
//     responsive: true,
//     maintainAspectRatio: false,
//     scales: {
//         y: {
//             beginAtZero: true
//         }
//     }
// };
//
// // Suppression des instances précédentes des graphiques
// if (userChart) {
//     userChart.destroy();
// }
//
// if (reservationChart) {
//     reservationChart.destroy();
// }
//
// // Création des graphiques
// var userChartElement = document.getElementById('userChart');
// var userChart = new Chart(userChartElement, {
//     type: 'bar',
//     data: userChartData,
//     options: chartOptions
// });
//
// var reservationChartElement = document.getElementById('reservationChart');
// var reservationChart = new Chart(reservationChartElement, {
//     type: 'bar',
//     data: reservationChartData,
//     options: chartOptions
// });
