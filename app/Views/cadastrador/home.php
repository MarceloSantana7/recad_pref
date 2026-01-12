<?= $this->extend('cadastrador/_layout') ?>

<?= $this->section('title') ?>Recadastramento - Painel<?= $this->endSection() ?>
<?= $this->section('main') ?>

<nav class="bg-[#007437] text-white p-4 flex justify-between items-center">
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

<!-- Formulário centralizado -->
<div class="flex flex-grow flex-col items-center justify-between bg-gray-100 py-10">    
    <form action="<?= base_url('/cadastrador/recadastro') ?>" method="post"
        class="bg-white p-6 rounded shadow-md w-full max-w-md my-auto">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Recadastrar Servidor</h2>
        <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF do Servidor</label>
        <input type="text" id="cpf" name="cpf" placeholder="Digite o CPF"
            class="w-full p-3 border rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
            oninput="applyCpfMask(this)" required>
        <button type="submit"
            class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 mb-4">Recadastrar</button>

        <?php if (session()->has('error')): ?>
            <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-4">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('success')): ?>
            <div class="bg-green-100 text-green-700 border border-green-400 p-4 rounded mb-4">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
    </form>
</div>

<footer class="bg-gray-800 text-white p-4 text-center w-full mt-10">
    <p class="text-sm">&copy; 2025 Prefeitura Municipal - Todos os direitos reservados.</p>
</footer>
<?= $this->Section("pageScripts") ?>
<script>
    function applyCpfMask(input) {
        let value = input.value.replace(/\D/g, ""); // Remove tudo que não for número
        value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o primeiro ponto
        value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o segundo ponto
        value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Adiciona o traço
        input.value = value;
    }
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>