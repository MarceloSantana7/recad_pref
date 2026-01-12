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

<form action="<?= base_url('/recadastro/salvarEtapa3') ?>" method="post" enctype="multipart/form-data"
    class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <input type="hidden" name="id" value="<?= $servidor['id'] ?>">

    <!-- Campo de Upload -->
    <div class="mb-4">
        <label for="documento" class="block text-sm font-medium text-gray-700 mb-2">Documento Digitalizado</label>
        <input type="file" name="documento" id="documento" accept=".pdf,.jpg,.jpeg,.png"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <p class="mt-1 text-sm text-gray-500">Envie o documento em formato PDF ou imagem (JPG/PNG).</p>
    </div>

    <!-- Prévia do Arquivo -->
    <div id="preview-container" class="hidden mb-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Prévia do Arquivo:</p>
        <div id="file-preview" class="border border-gray-300 rounded-lg p-4 bg-gray-50"></div>
    </div>

    <!-- Botão de Enviar -->
    <button type="submit"
        class="w-full bg-blue-500 text-white text-sm font-medium py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Finalizar
    </button>
</form>



<?= $this->section('pageScripts') ?>
<script>

    const fileInput = document.getElementById("documento");
    const previewContainer = document.getElementById("preview-container");
    const filePreview = document.getElementById("file-preview");

    document.querySelector("form").addEventListener("submit", function (e) {
        const fileInput = document.getElementById("documento");

        if (!fileInput.files.length) {
            e.preventDefault(); // Impede o envio do formulário
            alert("Por favor, anexe o documento antes de finalizar.");
            fileInput.focus(); // Foca no campo de upload
        }
    });


    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        previewContainer.classList.add("hidden"); // Esconde a prévia inicialmente
        filePreview.innerHTML = ""; // Limpa qualquer prévia anterior

        if (file) {
            const fileType = file.type;

            if (fileType.includes("image")) {
                // Prévia de Imagem
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.alt = "Prévia da Imagem";
                img.classList.add("w-full", "h-auto", "rounded-lg", "border");
                filePreview.appendChild(img);
                previewContainer.classList.remove("hidden");
            } else if (fileType.includes("pdf")) {
                // Prévia de PDF
                const iframe = document.createElement("iframe");
                iframe.src = URL.createObjectURL(file);
                iframe.classList.add("w-full", "h-96", "rounded-lg", "border");
                filePreview.appendChild(iframe);
                previewContainer.classList.remove("hidden");
            } else {
                // Tipo de arquivo não suportado
                const message = document.createElement("p");
                message.textContent = "Formato não suportado para prévia.";
                message.classList.add("text-red-500", "text-sm");
                filePreview.appendChild(message);
                previewContainer.classList.remove("hidden");
            }
        }
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>