<?= $this->extend('shield/layout') ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="flex w-full h-screen shadow-lg overflow-hidden">
        <!-- Left side (Logo and Design) -->
        <div class="md:flex w-1/2 bg-[#219653] items-center justify-center">
            <div class="flex flex-col text-center text-white">
                <img src="<?= base_url('imgs/logo.png') ?>" alt="Logo Vera Cruz" class="h-32 mb-4">
            </div>
        </div>

        <!-- Right side (Login Form) -->
        <div class="w-full md:w-1/2 bg-white p-8 mb-6 flex items-center">
            <div class="container mx-auto w-3/4">
                <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Recadastramento - Servidores</h2>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email"
                            class="block text-sm font-medium text-gray-600"><?= lang('Auth.email') ?></label>
                        <input type="email" id="email" name="email" value="<?= old('email') ?>"
                            class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password"
                            class="block text-sm font-medium text-gray-600"><?= lang('Auth.password') ?></label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-500 focus:ring focus:ring-green-300"><?= lang('Auth.login') ?></button>
                </form>

                <div class="mt-4">
                    <?php if (session('success') !== null): ?>
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                            <?= session('success') ?>
                        </div>
                    <?php endif ?>
                    <?php if (session('error') !== null): ?>
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                            <?= session('error') ?>
                        </div>
                    <?php elseif (session('errors') !== null): ?>
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                            <?php if (is_array(session('errors'))): ?>
                                <?php foreach (session('errors') as $error): ?>
                                    <?= $error ?><br>
                                <?php endforeach ?>
                            <?php else: ?>
                                <?= session('errors') ?>
                            <?php endif ?>
                        </div>
                    <?php endif ?>

                    <?php if (session('message') !== null): ?>
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                            <?= session('message') ?>
                        </div>
                    <?php endif ?>
                </div>

                <!-- <p class="mt-4 text-center text-sm text-gray-600">
                    Não tem uma conta? <a href="<?= base_url('register') ?>"
                        class="text-green-600 hover:underline"><?= lang('Auth.register') ?></a>
                </p> -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>