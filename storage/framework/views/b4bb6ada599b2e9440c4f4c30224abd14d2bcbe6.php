<?php $__env->startSection('title', 'Masuk ke Akun Anda'); ?>

<div class="min-h-screen flex flex-col justify-center bg-gradient-to-b from-orange-50 to-white py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('images/logoremove.png')); ?>" alt="Logo Madrasah Imam Muzani" class="w-20 h-20 mx-auto mb-4">
        </a>

        <h2 class="mt-2 text-3xl font-extrabold text-center text-[#7B5E22] leading-9">
            Masuk ke Akun Anda
        </h2>

        <?php if(Route::has('register')): ?>
            <p class="mt-2 text-sm text-center text-gray-600 leading-5">
                Belum punya akun?
                <a href="<?php echo e(route('register')); ?>" class="font-medium text-[#E67E22] hover:text-[#b95d12] transition ease-in-out duration-150">
                    Daftar sekarang
                </a>
            </p>
        <?php endif; ?>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-6 py-8 bg-white shadow-md rounded-xl sm:px-10 border-t-4 border-[#E67E22]">
            <form wire:submit.prevent="authenticate">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Alamat Email
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 text-red-900 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="password" id="password" type="password" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 text-red-900 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input wire:model.lazy="remember" id="remember" type="checkbox" class="h-4 w-4 text-[#E67E22] border-gray-300 rounded focus:ring-[#E67E22]">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                    </div>

                    <div class="text-sm">
                        <a href="<?php echo e(route('password.request')); ?>" class="font-medium text-[#E67E22] hover:text-[#b95d12]">
                            Lupa kata sandi?
                        </a>
                    </div>
                </div>

                
                <div class="mt-6">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-semibold rounded-md text-white bg-[#E67E22] hover:bg-[#b95d12] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E67E22] transition duration-150 ease-in-out">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-4 text-center">
            <a href="<?php echo e(route('home')); ?>" class="text-sm font-medium text-gray-600 hover:text-[#E67E22] transition duration-150 ease-in-out flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>