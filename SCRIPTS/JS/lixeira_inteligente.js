let ip = "";
const MAX_POINTS = 30;
const statusEl = document.getElementById("status");
const ctx = document.getElementById("chart").getContext("2d");
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'HC-SR04 (cm) Nivel de Lixo',
                borderColor: 'red',
                backgroundColor: 'rgba(255, 0, 0, 0.1)',
                data: [],
                tension: 0.4
            },
            {
                label: 'HC-SR04 (cm) Distancia na Lixeira',
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
                data: [],
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        animation: {
            duration: 500,
            easing: 'easeOutQuad'
        },
        scales: {
            x: {
                title: { display: true, text: 'Tempo' }
            },
            y: {
                beginAtZero: true,
                suggestedMax: 100,
                title: { display: true, text: 'Distância (cm)' }
            }
        }
    }
});

let intervalId = null;

async function fetchData() {
    if (!ip) return;
    try {
        const response = await fetch(ip, { mode: "cors" });
        const data = await response.json();
        const now = new Date().toLocaleTimeString();

        if (chart.data.labels.length >= MAX_POINTS) {
            chart.data.labels.shift();
            chart.data.datasets[0].data.shift();
            chart.data.datasets[1].data.shift();
        }

        chart.data.labels.push(now);
        chart.data.datasets[0].data.push(data.sensor1);
        chart.data.datasets[1].data.push(data.sensor2);
        chart.update();

        statusEl.textContent = `Conectado - Última atualização: ${now}`;
        statusEl.style.color = "green";
    } catch (error) {
        statusEl.textContent = "Erro de conexão com ESP32";
        statusEl.style.color = "red";
    }
}

document.getElementById("connectBtn").addEventListener("click", function () {
    const ipValue = document.getElementById("ipInput").value.trim();
    if (!ipValue) {
        statusEl.textContent = "Por favor, insira um IP válido.";
        statusEl.style.color = "orange";
        return;
    }
    ip = `http://${ipValue}/`;
    statusEl.textContent = "Conectando...";
    statusEl.style.color = "blue";
    chart.data.labels = [];
    chart.data.datasets[0].data = [];
    chart.data.datasets[1].data = [];
    chart.update();
    if (intervalId) clearInterval(intervalId);
    intervalId = setInterval(fetchData, 1000);
    fetchData();
});