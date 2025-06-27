// ? Lixeira Inteligente - Dashboard...
let ip = ""
const MAX_POINTS = 30
const statusEl = document.getElementById("status-connection")
const statusE2 = document.getElementById("status-exportExcel")

// ? Elemetnso Cards
const distanciaInternaEl = document.getElementById('distanciaInterna')
const distanciaExternaEl = document.getElementById('distanciaExterna')
const pessoasPassaramEl = document.getElementById('pessoasPassaram')
const pesoEl = document.getElementById('peso')
const gasDetectadoEl = document.getElementById('gasDetectado')

// ? Gráficos lists
const labels = []
const distanciaInternaData = []
const distanciaExternaData = []
const pesoData = []
const gasData = []

function getGradient(ctx, color_1, color_2) {
    const gradient = ctx.createLinearGradient(0,0,0,400)
    gradient.addColorStop(0, color_1)
    gradient.addColorStop(1, color_2)
    return gradient
}

const shadowLinePlugin = {
    id: 'shadowLine',
    beforeDatasetsDraw(chart) {
        const ctx = chart.ctx
        chart.data.datasets.forEach((dataset, i) => {
            const meta = chart.getDatasetMeta(i)
            if (!meta.hidden && dataset.borderColor) {
                ctx.save()
                ctx.shadowColor = dataset.boderColor + '88'
                ctx.shadowBlur = 12
                ctx.shadowOffsetX = 0
                ctx.shadowOffsetY = 4
                ctx.globalAlpha = 0.7
            }
        })
    },
    afterDatasetDraw(chart) {chart.ctx.restore()}
}

// ? Grafico de distancia:
const ctxDist = document.getElementById('chartDistancia').getContext('2d')
const chartDistancia = new Chart(document.getElementById('chartDistancia'), {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: 'Distância Interna (cm)',
                data: distanciaInternaData,
                borderColor: '#40916c',
                backgroundColor: getGradient(ctxDist, '#b7e4c7', '#d8f3dc'),
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackGroundColor: '#40916c',
                pointBorderColor: '#fff',
                pointHoverRadius: 7,
                borderWidth: 3,
                shadowOffsetX: 2,
                shadowOffsetY: 2,
                shadowBlur: 8,
                shadowColor: '#40916c55'
            },
            {
                label: 'Distância Externa (cm)',
                data: distanciaExternaData,
                borderColor: '#f77f00',
                backgroundColor: getGradient(ctxDist, '#ffe5b4', '#fff3e0'),
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackGroundColor: '#f77f00',
                pointBorderColor: '#fff',
                pointHoverRadius: 7,
                borderWidth: 3,
                shadowOffsetX: 2,
                shadowOffsetY: 2,
                shadowBlur: 8,
                shadowColor: '#f77f0055'
            }
        ]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: { position: 'top', lebels: {font: {size:16}} },
            title: {
                display: true,
                text: 'Distancia dos Sensores',
                font: {size:20, weight: 'bold'},
                color: '#40916c'
            },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#40916c',
                bodyColor: '#333',
                borderColor: '#40916c',
                borderWidth: 1,
                padding: 12
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {color: '#b7e4c7'},
                ticks: {color:'#40916c',font:{size:14}}
            },
            x: {
                grid: {color: '#b7e4c7'},
                ticks: {color: '#40916c',font:{size:14}}
            }
        }
    },
    plugins: [shadowLinePlugin]
})

// ? Grafico de peso
const ctxPeso = document.getElementById('chartPeso').getContext('2d');
const chartPeso = new Chart(ctxPeso, {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Peso (g)',
            data: pesoData,
            borderColor: '#1d3557',
            backgroundColor: getGradient(ctxPeso, '#a8dadc', '#f1faee'),
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: '#1d3557',
            pointBorderColor: '#fff',
            pointHoverRadius: 7,
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: { position: 'top', labels: { font: { size: 16 } } },
            title: {
                display: true,
                text: 'Peso Detectado',
                font: { size: 20, weight: 'bold' },
                color: '#1d3557'
            },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#1d3557',
                bodyColor: '#333',
                borderColor: '#1d3557',
                borderWidth: 1,
                padding: 12
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#a8dadc' },
                ticks: { color: '#1d3557', font: { size: 14 } }
            },
            x: {
                grid: { color: '#a8dadc' },
                ticks: { color: '#1d3557', font: { size: 14 } }
            }
        }
    },
    plugins: [shadowLinePlugin]
});

// ? Grafico de Gás
const ctxGas = document.getElementById('chartGas').getContext('2d');
const chartGas = new Chart(ctxGas, {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Valor MQ-135',
            data: gasData,
            borderColor: '#d90429',
            backgroundColor: getGradient(ctxGas, '#ffb3c1', '#fff0f3'),
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: '#d90429',
            pointBorderColor: '#fff',
            pointHoverRadius: 7,
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: { position: 'top', labels: { font: { size: 16 } } },
            title: {
                display: true,
                text: 'Gás Detectado (MQ-135)',
                font: { size: 20, weight: 'bold' },
                color: '#d90429'
            },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#d90429',
                bodyColor: '#333',
                borderColor: '#d90429',
                borderWidth: 1,
                padding: 12
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#ffb3c1' },
                ticks: { color: '#d90429', font: { size: 14 } }
            },
            x: {
                grid: { color: '#ffb3c1' },
                ticks: { color: '#d90429', font: { size: 14 } }
            }
        }
    },
    plugins: [shadowLinePlugin]
});

async function enviarParaExcel(dados) {
    try {
        const response = await fetch('/DailyGreen-Project/SCRIPTS/PHP/exportar_excel.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        })
        const result = await response.json()
        if (result.success) {console.log("Dados exportados com sucesso para Excel.")}
        statusE2.textContent = "Exportação feita com sucesso! - Feita: "+Date().toLocaleTimeString()
    } catch (error) {
        console.error("Erro ao exportar dados para Excel:", error)
        statusE2.textContent = "Erro ao exportar dados para Excel."
        statusE2.style.color = "red"
    }
}

let intervalId = null

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
    if (!ip) return
    try {
        const res = await fetch(ip, { mode: "cors" })
        const data = await res.json()
        distanciaInternaEl.textContent = data.distanciaInternaCM + " cm"
        distanciaExternaEl.textContent = data.distanciaExternaCM + " cm"
        pessoasPassaramEl.textContent = data.QuantidadeDePessoasQuePassaram
        pesoEl.textContent = data.hx711Peso + " g"
        gasDetectadoEl.textContent = data.mqGasDetectado === "true" || data.mqGasDetectado === true ? "Sim" : "Não"
        const now = new Date().toLocaleTimeString()
        if (labels.length >= MAX_POINTS) {
            labels.shift()
            distanciaInternaData.shift()
            distanciaExternaData.shift()
            pesoData.shift()
            gasData.shift()
        }
        labels.push(now)
        distanciaInternaData.push(data.distanciaInternaCM)
        distanciaExternaData.push(data.distanciaExternaCM)
        pesoData.push(data.hx711Peso)
        gasData.push(data.mqValorAnalogico)
        chartDistancia.update()
        chartPeso.update()
        chartGas.update()
        statusEl.textContent = `Conectado - Última atualização: ${now}`
        statusEl.style.color = "green"
        const dados = {
            horario: new Date().toLocaleTimeString(),
            distanciaInterna: data.distanciaInternaCM,
            distanciaExterna: data.distanciaExternaCM,
            pessoasPassaram: data.QuantidadeDePessoasQuePassaram,
            peso: data.hx711Peso,
            gasDetectado: data.mqGasDetectado === "true" || data.mqGasDetectado === true ? "Sim" : "Não"
        }
        enviarParaExcel(dados)
    } catch (error) {
        statusEl.textContent = "Erro de conexão com ESP32"
        statusEl.style.color = "red"
        console.error("Erro ao buscar dados do ESP32:", error)
    }
}

// ? Evento de clique no botão de conexão
document.getElementById("connectBtn").addEventListener("click", function () {
    const ipValue = document.getElementById("ipInput").value.trim()
    if (!ipValue) {
        statusEl.textContent = "Por favor, insira um IP válido."
        statusEl.style.color = "orange"
        return
    }
    ip = `http://${ipValue}/`
    statusEl.textContent = "Conectando..."
    statusEl.style.color = "blue"
    labels.length = 0
    distanciaInternaData.length = 0
    distanciaExternaData.length = 0
    pesoData.length = 0
    gasData.length = 0
    chartDistancia.update()
    chartPeso.update()
    chartGas.update()
    if (intervalId) clearInterval(intervalId)
    intervalId = setInterval(fetchData, 2000)
    fetchData()
})