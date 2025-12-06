<?php $__env->startSection('title', 'Buat Akun Baru'); ?>

<div class="min-h-screen flex flex-col justify-center bg-gradient-to-b from-orange-50 to-white py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('images/logoremove.png')); ?>" alt="Logo Madrasah Imam Muzani" class="w-20 h-20 mx-auto mb-4">
        </a>

        <h2 class="mt-2 text-3xl font-extrabold text-center text-[#7B5E22] leading-9">
            Buat Akun Baru
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>" class="font-medium text-[#E67E22] hover:text-[#b95d12] transition ease-in-out duration-150">
                Masuk di sini
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-6 py-8 bg-white shadow-md rounded-xl sm:px-10 border-t-4 border-[#E67E22]">
            <form wire:submit.prevent="register">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="name" id="name" type="text" required autofocus
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 
                               focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm
                               <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 text-red-900 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['name'];
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
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Alamat Email
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="email" id="email" type="email" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 
                               focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm
                               <?php $__errorArgs = ['email'];
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
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 
                               focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm
                               <?php $__errorArgs = ['password'];
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

                
                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Kata Sandi
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 
                               focus:outline-none focus:ring-[#E67E22] focus:border-[#E67E22] sm:text-sm">
                    </div>
                </div>

                
                <div class="mt-8">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-semibold 
                                   rounded-md text-white bg-[#E67E22] hover:bg-[#b95d12] 
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E67E22]
                                   transition duration-150 ease-in-out">
                        Daftar
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
<?php /**PATH C:\xampp\ImamMuzani\resources\views/livewire/auth/register.blade.php ENDPATH**/ ?>