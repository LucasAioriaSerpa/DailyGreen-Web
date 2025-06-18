// ? Lixeira Inteligente - Dashboard...
let ip = "";
const MAX_POINTS = 30;
const statusEl = document.getElementById("status");

// ? Elemetnso Cards
const distanciaInternaEl = document.getElementById('distanciaInterna');
const distanciaExternaEl = document.getElementById('distanciaExterna');
const pessoasPassaramEl = document.getElementById('pessoasPassaram');
const pesoEl = document.getElementById('peso');
const gasDetectadoEl = document.getElementById('gasDetectado');

// ? Gráficos lists
const labels = [];
const distanciaInternaData = [];
const distanciaExternaData = [];
const pesoData = [];
const gasData = [];

// ? Grafico de distancia:
const chartDistancia = new Chart(document.getElementById('chartDistancia'), {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: 'Distância Interna (cm)',
                data: distanciaInternaData,
                borderColor: '#40916c',
                backgroundColor: '#b7e4c7',
                fill: false,
                tension: 0.2
            },
            {
                label: 'Distância Externa (cm)',
                data: distanciaExternaData,
                borderColor: '#f77f00',
                backgroundColor: '#ffe5b4',
                fill: false,
                tension: 0.2
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});

// ? Grafico de peso
const chartPeso = new Chart(document.getElementById('chartPeso'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Peso (g)',
            data: pesoData,
            borderColor: '#1d3557',
            backgroundColor: '#a8dadc',
            fill: false,
            tension: 0.2
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});

// ? Grafico de Gás
const chartGas = new Chart(document.getElementById('chartGas'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Valor MQ-135',
            data: gasData,
            borderColor: '#d90429',
            backgroundColor: '#ffb3c1',
            fill: false,
            tension: 0.2
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});

let intervalId = null;

/**
 * Busca dados dos sensores do dispositivo ESP32 e atualiza os elementos da interface e gráficos.
 *
 * Esta função realiza as seguintes ações:
 * - Envia uma requisição fetch para o dispositivo ESP32 usando o endereço IP fornecido.
 * - Analisa a resposta JSON contendo dados dos sensores como distância interna/externa, contagem de pessoas, peso e detecção de gás.
 * - Atualiza os elementos DOM correspondentes com os valores mais recentes dos sensores.
 * - Mantém e atualiza os arrays de dados para visualização nos gráficos, garantindo um número máximo de pontos.
 * - Atualiza os gráficos para refletir os novos dados.
 * - Atualiza o indicador de status de conexão com base no sucesso ou falha da operação fetch.
 *
 * @async
 * @function fetchData
 * @returns {Promise<void>} Resolvido quando os dados forem buscados e a interface atualizada.
 */
async function fetchData() {
    if (!ip) return;
    try {
        const res = await fetch(ip, { mode: "cors" });
        const data = await res.json();

        // Atualiza cards
        distanciaInternaEl.textContent = data.distanciaInternaCM + " cm";
        distanciaExternaEl.textContent = data.distanciaExternaCM + " cm";
        pessoasPassaramEl.textContent = data.QuantidadeDePessoasQuePassaram;
        pesoEl.textContent = data.hx711Peso + " g";
        gasDetectadoEl.textContent = data.mqGasDetectado === "true" || data.mqGasDetectado === true ? "Sim" : "Não";

        // Atualiza gráficos
        const now = new Date().toLocaleTimeString();

        if (labels.length >= MAX_POINTS) {
            labels.shift();
            distanciaInternaData.shift();
            distanciaExternaData.shift();
            pesoData.shift();
            gasData.shift();
        }
        labels.push(now);
        distanciaInternaData.push(data.distanciaInternaCM);
        distanciaExternaData.push(data.distanciaExternaCM);
        pesoData.push(data.hx711Peso);
        gasData.push(data.mqValorAnalogico);

        chartDistancia.update();
        chartPeso.update();
        chartGas.update();

        statusEl.textContent = `Conectado - Última atualização: ${now}`;
        statusEl.style.color = "green";
    } catch (error) {
        statusEl.textContent = "Erro de conexão com ESP32";
        statusEl.style.color = "red";
        console.error("Erro ao buscar dados do ESP32:", error);
    }
}

// ? Evento de clique no botão de conexão
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
    // ! Limpa dados antigos
    labels.length = 0;
    distanciaInternaData.length = 0;
    distanciaExternaData.length = 0;
    pesoData.length = 0;
    gasData.length = 0;
    chartDistancia.update();
    chartPeso.update();
    chartGas.update();
    if (intervalId) clearInterval(intervalId);
    intervalId = setInterval(fetchData, 2000);
    fetchData();
});