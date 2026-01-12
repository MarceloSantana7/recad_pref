<?= $this->extend('recadastro/_layout') ?>

<?= $this->section('title') ?>Recadastramento - Painel<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Comprovante de Recadastro</h1>

    <!-- Cabeçalho com Foto e Informações Básicas -->
    <div class="flex flex-col md:flex-row items-center mb-6">
        <!-- Foto do Servidor -->
        <div class="flex-shrink-0">
            <img src="<?= base_url($servidor['foto'])?>" alt="Foto do Servidor"
                class="w-32 h-40 rounded-md border border-gray-300">
        </div>
        <!-- Informações Básicas -->
        <div class="ml-0 md:ml-6 mt-4 md:mt-0 text-center md:text-left">
            <p class="text-lg font-medium text-gray-800">Nome: <?= $servidor['nome_completo'] ?></p>
            <p class="text-lg font-medium text-gray-800">Matrícula: <?= $servidor['matricula'] ?></p>
            <p class="text-lg font-medium text-gray-800">CPF: <?= maskCpf($servidor['cpf']) ?></p>
            <p class="text-lg font-medium text-gray-800">Data de Nascimento: <?= formatDate($servidor['data_nascimento']) ?></p>
        </div>
    </div>

    

    <!-- Observações -->
    <div class="border-t border-gray-300 pt-4 mt-4">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Observações</h2>
        <p class="text-gray-800"><?= $servidor['observacoes'] ?: 'Nenhuma observação registrada.' ?></p>
    </div>

    <!-- Rodapé -->
    <div class="border-t border-gray-300 pt-4 mt-6 text-center">
        <p class="text-sm text-gray-600">Comprovante gerado em: <?= date('d/m/Y H:i:s') ?></p>
        <p class="text-sm text-gray-600">Atendido por: <?= $user->username ?></p>
        <p class="text-sm text-gray-600">Status: 
            <span class="text-green-600 font-bold">
                <?= ucfirst($servidor['status_recadastro']) ?>
            </span>
        </p>
    </div>

    
</div>

<?php
// Funções auxiliares para formatação
function maskCpf($cpf) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}

function formatDate($date) {
    if ($date === '0000-00-00' || empty($date)) {
        return 'N/D';
    }
    return date('d/m/Y', strtotime($date));
}
?>


<?= $this->section('pageScripts') ?>
<?= $this->endSection() ?>
<?= $this->endSection() ?>