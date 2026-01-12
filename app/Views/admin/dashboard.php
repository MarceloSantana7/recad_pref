<?= $this->extend('recadastro/_layout') ?>
<?= $this->section('title') ?>Recadastramento - Dash Admin<?= $this->endSection() ?>
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

<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col items-center p-6">
        <!-- Título -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Dashboard de Cadastro</h1>

        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mb-8">
            <!-- Servidores Pendentes -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-end">
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Pendentes</h2>
                <p class="text-6xl font-bold text-red-500"><?= $servidoresPendentes; ?></p>
            </div>
            <!-- Servidores Cadastrados -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-end">
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Cadastrados</h2>
                <p class="text-6xl font-bold text-green-500"><?= $servidoresCadastrados; ?></p>
            </div>
            <!-- Total de Servidores -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-end">
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Total</h2>
                <p class="text-6xl font-bold text-blue-500"><?= $totalServidores; ?></p>
            </div>
            <!-- Velocidade -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-end">
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Velocidade de Cadastro</h2>
                <p class="text-6xl font-bold text-purple-500">
                    <?= number_format($velocidadeTotalPorHora, 2); ?> / hora
                </p>
            </div>
        </div>

        <!-- Tabela de Cadastradores -->
        <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-6xl mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Servidores Cadastrados por Cadastradores</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">
                            Cadastrador</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Total
                            de Servidores</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Tempo
                            Médio de Atendimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dadosCadastradores as $cadastrador): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-gray-700"><?= $cadastrador['username']; ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                <?= $cadastrador['totalCadastrados']; ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                <?= $cadastrador['tempoMedioAtendimento']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Tabela de Últimos Servidores Cadastrados -->
        <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-6xl mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Últimos Servidores Cadastrados</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Foto
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Nome
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">CPF
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-600">Data de
                            Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ultimosServidores as $servidor): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="<?= !empty($servidor['foto']) ? base_url($servidor['foto']) : base_url('/imgs/logo.png') ?>" alt="Foto do servidor"
                                    class="object-cover w-12 h-12 rounded-full">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700"><?= $servidor['nome_completo']; ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700"><?= $servidor['cpf']; ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                <?= date('d/m/Y H:i', strtotime($servidor['updated_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?= $this->endSection() ?>