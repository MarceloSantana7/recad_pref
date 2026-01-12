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
<style>
    .hidden-step {
        display: none;
    }
</style>
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
    <form id="multistepForm" action="<?= base_url('/recadastro/salvarEtapa1') ?>"
        class="bg-white p-8 rounded-lg shadow-md" method="POST">
        <input type="hidden" name="id_cadastrador" value="<?= $user->id ?>" />
        <input type="hidden" name="id" value="<?= $servidor['id'] ?>">
        <!-- Step 1 -->
        <div id="step1" class="step">
            <h2 class="text-2xl font-bold mb-6">Dados Pessoais</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Nome Completo -->
                <div>
                    <label for="nome_completo" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                    <input type="text" id="nome_completo" name="nome_completo" value="<?= $servidor['nome_completo'] ?>"
                        readonly
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-100 focus:outline-none">
                </div>
                <!-- CPF -->
                <div>
                    <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                    <input type="text" id="cpf" name="cpf" value="<?= $servidor['cpf'] ?>" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-100 focus:outline-none">
                </div>
                <!-- Matricula -->
                <div>
                    <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula</label>
                    <input type="text" id="matricula" name="matricula" value="<?= $servidor['matricula'] ?>" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-100 focus:outline-none">
                </div>
                <!-- Data de Nascimento -->
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de
                        Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento"
                        value="<?= $servidor['data_nascimento'] ?>" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-100 focus:outline-none">
                </div>
                <!-- Sexo -->
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select required id="sexo" name="sexo"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">Selecione</option>
                        <option value="Masculino" <?= $servidor['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Feminino" <?= $servidor['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <!-- Estado Civil -->
                <div>
                    <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                    <select required id="estado_civil" name="estado_civil"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">Selecione</option>
                        <option value="Solteiro">Solteiro</option>
                        <option value="Casado">Casado</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viuvo">Viúvo</option>
                    </select>
                </div>
                <!-- Naturalidade -->
                <div>
                    <label for="naturalidade" class="block text-sm font-medium text-gray-700">Naturalidade</label>
                    <input required type="text" id="naturalidade" name="naturalidade"
                        value="<?= $servidor['naturalidade'] ?>"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <!-- Nome do pai -->
                <div>
                    <label for="nomePai" class="block text-sm font-medium text-gray-700">Nome do pai</label>
                    <input type="text" id="nomePai" name="nome_pai" value="<?= $servidor['nome_pai'] ?>"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <!-- Nome da mãe -->
                <div>
                    <label for="nomeMae" class="block text-sm font-medium text-gray-700">Nome da mãe</label>
                    <input required type="text" id="nomeMae" name="nome_mae" value="<?= $servidor['nome_mae'] ?>"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>

                <!-- Cor -->
                <div>
                    <label for="cor" class="block text-sm font-medium text-gray-700">Cor</label>
                    <select required id="cor" name="cor"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="" selected disabled>Escolha uma opção</option>
                        <option value="branca" <?= $servidor['cor'] == 'branca' ? 'selected' : '' ?>>Branca</option>
                        <option value="preta" <?= $servidor['cor'] == 'preta' ? 'selected' : '' ?>>Preta</option>
                        <option value="parda" <?= $servidor['cor'] == 'parda' ? 'selected' : '' ?>>Parda</option>
                        <option value="amarela" <?= $servidor['cor'] == 'amarela' ? 'selected' : '' ?>>Amarela</option>
                        <option value="indigena" <?= $servidor['cor'] == 'indigena' ? 'selected' : '' ?>>Indígena</option>
                    </select>

                </div>

                <!-- Portador de deficiência? -->
                <div>
                    <label for="pcd" class="block text-sm font-medium text-gray-700">Portador de deficiência?</label>
                    <input required type="text" id="pcd" name="deficiencia" value="<?= $servidor['deficiencia'] ?>"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>

                <!-- Tipo sanguíneo -->
                <div>
                    <label for="tipoSanguineo" class="block text-sm font-medium text-gray-700">Tipo sanguíneo</label>
                    <select required id="tipoSanguineo" name="tipo_sanguineo"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="" disabled selected>Escolha uma opção</option>
                        <option value="A+" <?= $servidor['tipo_sanguineo'] == 'A+' ? 'selected' : '' ?>>A+</option>
                        <option value="A-" <?= $servidor['tipo_sanguineo'] == 'A-' ? 'selected' : '' ?>>A-</option>
                        <option value="B+" <?= $servidor['tipo_sanguineo'] == 'B+' ? 'selected' : '' ?>>B+</option>
                        <option value="B-" <?= $servidor['tipo_sanguineo'] == 'B-' ? 'selected' : '' ?>>B-</option>
                        <option value="AB+" <?= $servidor['tipo_sanguineo'] == 'AB+' ? 'selected' : '' ?>>AB+</option>
                        <option value="AB-" <?= $servidor['tipo_sanguineo'] == 'AB-' ? 'selected' : '' ?>>AB-</option>
                        <option value="O+" <?= $servidor['tipo_sanguineo'] == 'O+' ? 'selected' : '' ?>>O+</option>
                        <option value="O-" <?= $servidor['tipo_sanguineo'] == 'O-' ? 'selected' : '' ?>>O-</option>
                        <option value="NS" <?= $servidor['tipo_sanguineo'] == 'NS' ? 'selected' : '' ?>>Não sabe</option>
                    </select>
                </div>


            </div>
            <div class="mt-6 flex justify-between">

                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                    onclick="nextStep(2)">Próximo</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div id="step2" class="step hidden">
            <h2 class="text-2xl font-bold mb-6">Endereço, Contato e Lotação atual</h2>
            <div class="grid grid-cols-1 gap-4">
                <!-- Endereço -->
                <div class="flex flex-row gap-3">
                    <div class="w-5/12">
                        <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input required type="text" id="endereco" name="endereco"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div class="w-1/12">
                        <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                        <input required type="text" id="numero" name="numero"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Bairro -->
                    <div class="w-3/12">
                        <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                        <input required type="text" id="bairro" name="bairro"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div class="w-3/12">
                        <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <input required type="text" id="cidade" name="cidade"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>
                <div class="flex flex-row gap-3">
                    <!-- UF -->
                    <div class="w-1/12">
                        <label for="uf" class="block text-sm font-medium text-gray-700">UF</label>
                        <select required id="uf" name="uf"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="BA" selected>BA</option>
                        </select>
                    </div>
                    <!-- CEP -->
                    <div class="w-3/12">
                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                        <input required type="text" id="cep" name="cep"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Celular 1 -->
                    <div class="w-2/12">
                        <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                        <input required type="text" id="celular" name="celular"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Celular 2 -->
                    <div class="w-2/12">
                        <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" id="telefone" name="telefone"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Email -->
                    <div class="w-4/12">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>
                <div class="flex flex-row gap-3">                    
                    <!-- Lotação atual -->
                    <div class="w-4/12">
                        <label for="lotacao_atual" class="block text-sm font-medium text-gray-700">Lotação atual</label>
                        <input type="text" id="lotacao_atual" name="lotacao_atual"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md"
                    onclick="prevStep(1)">Anterior</button>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                    onclick="nextStep(3)">Próximo</button>
            </div>
        </div>

        <!-- Step 3 -->
        <div id="step3" class="step hidden">
            <h2 class="text-2xl font-bold mb-6">Documentos e Observações</h2>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex flex-row gap-3">
                    <!-- RG -->
                    <div class="w-4/12">
                        <label for="rg" class="block text-sm font-medium text-gray-700">RG</label>
                        <input required type="text" id="rg" name="rg"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Órgão Emissor -->
                    <div class="w-1/12">
                        <label for="orgao_emissor" class="block text-sm font-medium text-gray-700">Órgão Emissor</label>
                        <input required type="text" id="orgao_emissor" name="orgao_emissor"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Data de Emissão do RG -->
                    <div class="w-4/12">
                        <label for="data_emissao_rg" class="block text-sm font-medium text-gray-700">Data de Emissão do
                            RG</label>
                        <input required type="date" id="data_emissao_rg" name="data_emissao_rg"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div class="w-3/12">
                        <label for="pis" class="block text-sm font-medium text-gray-700">PIS</label>
                        <input disabled type="text" id="pis" name="pis"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>

                <div class="flex flex-row gap-3">
                    <!-- Título de Eleitor -->
                    <div class="w-4/12">
                        <label for="tituloEleitor" class="block text-sm font-medium text-gray-700">Título de
                            Eleitor</label>
                        <input required type="text" id="tituloEleitor" name="tituloEleitor"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Seção -->
                    <div class="w-2/12">
                        <label for="secao" class="block text-sm font-medium text-gray-700">Seção</label>
                        <input required type="text" id="secao" name="secao"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <!-- Zona -->
                    <div class="w-2/12">
                        <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                        <input required type="text" id="zona" name="zona"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>

                    <!-- Escolaridade -->
                    <div class="w-4/12">
                        <label for="escolaridade" class="block text-sm font-medium text-gray-700">Escolaridade</label>
                        <select required id="escolaridade" name="instrucao"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="fundamental-incompleto">Ensino Fundamental Incompleto</option>
                            <option value="fundamental-completo">Ensino Fundamental Completo</option>
                            <option value="medio-incompleto">Ensino Médio Incompleto</option>
                            <option value="medio-completo">Ensino Médio Completo</option>
                            <option value="superior-incompleto">Ensino Superior Incompleto</option>
                            <option value="superior-completo">Ensino Superior Completo</option>
                            <option value="pos-graduacao">Pós-graduação</option>
                            <option value="mestrado">Mestrado</option>
                            <option value="doutorado">Doutorado</option>
                        </select>
                    </div>
                </div>


                <!-- Observações -->
                <div>
                    <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                    <textarea id="observacoes" name="observacoes"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md"
                    onclick="prevStep(2)">Anterior</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Enviar</button>
            </div>
        </div>
    </form>
</div>

<footer class="bg-gray-800 text-white p-4 text-center w-full mt-10">
    <p class="text-sm">&copy; 2025 Prefeitura Municipal - Todos os direitos reservados.</p>
</footer>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="https://unpkg.com/imask"></script>
<script>
    let currentStep = 1;

    function showStep(step) {
        document.querySelectorAll('.step').forEach((el) => {
            el.classList.add('hidden');
        });
        document.getElementById(`step${step}`).classList.remove('hidden');
    }

    function nextStep(step) {
        if (step > currentStep) {
            if (!validateStep(currentStep)) {
                return;
            }
            currentStep = step;
            showStep(step);
        }
    }

    function prevStep(step) {
        if (step < currentStep) {
            currentStep = step;
            showStep(step);
        }
    }

    // Inicializa o formulário mostrando o primeiro passo
    showStep(currentStep);

    function validateStep(step) {
        let valid = true;
        const currentStep = document.getElementById(`step${step}`);
        const inputs = currentStep.querySelectorAll("input, select, textarea");

        inputs.forEach(input => {
            if (input.required && !input.value.trim()) {
                input.classList.add("border-red-500");
                valid = false;
            } else {
                input.classList.remove("border-red-500");
            }

            // Validação específica para o campo de email
            if (input.type === "email") {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex para validar email
                if (!emailPattern.test(input.value.trim()) && input.value != '') {
                    input.classList.add("border-red-500");
                    valid = false;
                    alert("Por favor, insira um email válido.");
                } else {
                    input.classList.remove("border-red-500");
                }
            }
        });

        if (!valid) {
            alert("Por favor, corrija ou preencha os campos destacados antes de avançar.");
        }

        return valid;
    }


    document.addEventListener("DOMContentLoaded", () => {
        const cpfInput = document.getElementById("cpf");
        if (cpfInput.value) {
            cpfInput.value = cpfInput.value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
    });

    document.getElementById("multistepForm").addEventListener("submit", function (e) {
        const email = document.getElementById("email").value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email) && email != '') {
            e.preventDefault(); // Impede o envio do formulário
            document.getElementById("email").classList.add("border-red-500");
            alert("O email fornecido é inválido. Por favor, corrija e tente novamente.");
        }
    });

    document.addEventListener("DOMContentLoaded", () => {
        const cepInput = document.getElementById("cep");
        IMask(cepInput, { mask: '00000-000' });
        IMask(document.getElementById("celular"), { mask: '(00) 00000-0000' });
        IMask(document.getElementById("telefone"), { mask: '(00) 00000-0000' });
        // Máscara para Título de Eleitor (número de 12 dígitos)
        IMask(document.getElementById("tituloEleitor"), { mask: "0000 0000 0000" });
        // Máscara para Zona Eleitoral (até 4 dígitos)
        IMask(document.getElementById("zona"), { mask: "0000" });
        // Máscara para Seção Eleitoral (até 4 dígitos)
        IMask(document.getElementById("secao"), { mask: "0000" });
    });


</script>
<?= $this->endSection() ?>