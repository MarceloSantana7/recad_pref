<?= $this->extend('recadastro/_layout') ?>
<?php
$status = $servidor['status_recadastro'];

function getStatusClass($currentStep, $status)
{
    $steps = ['etapa1', 'etapa2', 'etapa3', 'finalizado'];

    $currentIndex = array_search($status, $steps);
    $stepIndex = $currentStep - 1;

    if ($stepIndex < $currentIndex) {
        return 'completed';
    } elseif ($stepIndex === $currentIndex) {
        return 'active';
    }

    return '';
}
?>
<?= $this->section('title') ?>Recadastramento - Painel<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<nav class="bg-[#007437] text-white p-4 flex justify-between items-center mb-12">
    <!-- Lado esquerdo da Navbar -->
    <div class="text-lg font-semibold">
        <a href="#" class="hover:text-gray-300">Recadastramento</a>
    </div>

    <!-- Lado direito da Navbar -->
    <div class="flex items-center space-x-4">
        <span class="text-md">Bem-vindo, <span class="font-bold"><?php echo $user->username ?></span></span>
        <a href="<?= base_url('/logout') ?>"
            class="flex items-center bg-[#144108] hover:bg-[#9DC242] text-white text-sm px-3 py-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m6-3h-12m12 0l-3-3m3 3l-3 3" />
            </svg>
            Sair
        </a>
    </div>
</nav>

<div class="container mx-auto p-4">
    <div class="status-container">
        <div class="status-step <?= getStatusClass(1, $status) ?>">1. Dados Básicos</div>
        <div class="status-line"></div>
        <div class="status-step <?= getStatusClass(2, $status) ?>">2. Foto</div>
        <div class="status-line"></div>
        <div class="status-step <?= getStatusClass(3, $status) ?>">3. Documentos</div>
    </div>
</div>
<form action="<?= base_url('/recadastro/salvarEtapa2') ?>" method="post" enctype="multipart/form-data"
    class="space-y-4">
    <input type="hidden" name="id" value="<?= esc($servidor['id']) ?>">

    <div class="flex justify-center">
        <!-- Botão para Iniciar a Câmera -->
        <button type="button" id="start-camera"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
            Iniciar Câmera
        </button>
    </div>

    <!-- Container da Câmera -->
    <div id="camera-container" class="hidden flex flex-col items-center space-y-4">
        <div class="video-wrapper w-48 h-64 overflow-hidden relative border-2 border-gray-300 rounded-lg">
            <video id="video" autoplay
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full object-cover"></video>
        </div>
        <button type="button" id="capture"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
            Capturar Foto
        </button>
    </div>

    <!-- Pré-visualização da Foto Capturada -->
    <div id="preview-container" class="hidden flex flex-col items-center space-y-4">
        <div class="w-48 h-64 border-2 border-gray-300 rounded-lg overflow-hidden">
            <canvas id="photo" width="240" height="320" class="w-full h-full"></canvas>
        </div>
        <p class="text-center">Prontinho, imagem capturada no formato 3x4!</p>
        <button type="button" id="retake"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
            Tirar Outra Foto
        </button>
    </div>

    <!-- Input Oculto para Armazenar a Foto -->
    <input type="hidden" name="foto" id="foto">

    <div class="flex justify-center">
        <!-- Botão de Avançar -->
        <button type="submit"
            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
            Avançar
        </button>
    </div>
</form>

<?= $this->section('pageScripts') ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const startCameraButton = document.getElementById("start-camera");
        const cameraContainer = document.getElementById("camera-container");
        const video = document.getElementById("video");
        const captureButton = document.getElementById("capture");
        const previewContainer = document.getElementById("preview-container");
        const photoCanvas = document.getElementById("photo");
        const retakeButton = document.getElementById("retake");
        const fotoInput = document.getElementById("foto");
        let imageDataUrl = "";

        // Inicia a câmera
        startCameraButton.addEventListener("click", async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                video.srcObject = stream;
                startCameraButton.classList.add("hidden");
                cameraContainer.classList.remove("hidden");
            } catch (error) {
                console.error("Erro ao acessar a câmera:", error);
                alert("Erro ao acessar a câmera. Verifique as permissões.");
            }
        });

        // Captura a foto no formato 3x4
        captureButton.addEventListener("click", () => {
            const context = photoCanvas.getContext("2d");
            const aspectRatio = 3 / 4;
            const width = video.videoWidth;
            const height = video.videoHeight;
            const videoAspectRatio = width / height;

            let sourceWidth, sourceHeight, sourceX, sourceY;

            if (videoAspectRatio > aspectRatio) {
                // Vídeo é mais largo, ajusta a largura
                sourceHeight = height;
                sourceWidth = height * aspectRatio;
                sourceX = (width - sourceWidth) / 2;
                sourceY = 0;
            } else {
                // Vídeo é mais alto, ajusta a altura
                sourceWidth = width;
                sourceHeight = width / aspectRatio;
                sourceX = 0;
                sourceY = (height - sourceHeight) / 2;
            }

            // Desenha a imagem no canvas com a proporção 3x4
            context.drawImage(video, sourceX, sourceY, sourceWidth, sourceHeight, 0, 0, photoCanvas.width, photoCanvas.height);
            imageDataUrl = photoCanvas.toDataURL("image/jpeg");

            // Salva a imagem no input oculto
            fotoInput.value = imageDataUrl;

            // Exibe a pré-visualização
            cameraContainer.classList.add("hidden");
            previewContainer.classList.remove("hidden");
        });

        // Tirar outra foto
        retakeButton.addEventListener("click", () => {
            previewContainer.classList.add("hidden");
            cameraContainer.classList.remove("hidden");
        });

        document.querySelector("form").addEventListener("submit", function (e) {
            const fotoInput = document.getElementById("foto");

            if (!fotoInput.value.trim()) {
                e.preventDefault(); // Impede o envio do formulário
                alert("Você precisa capturar uma foto antes de avançar.");
            }
        });

    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>