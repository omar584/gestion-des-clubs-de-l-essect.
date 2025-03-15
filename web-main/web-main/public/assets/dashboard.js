document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('adhesionsChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin"],
            datasets: [{
                label: 'Adhésions par Mois',
                data: [5, 10, 15, 7, 20, 25],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
});
