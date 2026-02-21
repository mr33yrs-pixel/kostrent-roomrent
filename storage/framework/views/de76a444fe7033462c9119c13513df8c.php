<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="theme-color" content="#7C9070">
    <meta name="description" content="<?php echo e($metaDescription ?? 'JaiPremiumKost - Premium boarding house rooms with comfortable living experience.'); ?>">
    
    <title><?php echo e($title ?? 'JaiPremiumKost'); ?></title>
    
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Google Analytics -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('app.google_analytics_id')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('app.google_analytics_id')); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo e(config('app.google_analytics_id')); ?>');
    </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</head>
<body class="bg-pastel-bg font-sans antialiased text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-pastel-peach/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="flex-shrink-0 flex items-center gap-3 group">
                        <!-- House Icon -->
                        <!-- Logo Image -->
                        <img src="<?php echo e(asset('images/jai_logo.svg')); ?>" alt="JAI Premium Kost" class="h-12 w-auto">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-6">
                    <a href="<?php echo e(route('home')); ?>" class="text-gray-600 hover:text-pastel-green px-3 py-2 rounded-md text-sm font-medium transition-colors"><?php echo e(__('messages.nav.home')); ?></a>
                    <a href="<?php echo e(route('rooms.index')); ?>" class="text-gray-600 hover:text-pastel-green px-3 py-2 rounded-md text-sm font-medium transition-colors"><?php echo e(__('messages.nav.rooms')); ?></a>
                    <a href="<?php echo e(route('contact')); ?>" class="bg-pastel-green text-white hover:bg-pastel-green/90 px-5 py-2 rounded-full text-sm font-medium transition-all shadow-sm"><?php echo e(__('messages.nav.contact')); ?></a>
                    
                    <!-- Language Switcher -->
                    <div class="relative">
                        <div class="flex items-center space-x-1 text-sm">
                            <a href="<?php echo e(route('language.switch', 'en')); ?>" class="px-2 py-1 rounded <?php echo e(app()->getLocale() === 'en' ? 'bg-pastel-green text-white' : 'text-gray-500 hover:text-pastel-green'); ?>">EN</a>
                            <span class="text-gray-300">|</span>
                            <a href="<?php echo e(route('language.switch', 'id')); ?>" class="px-2 py-1 rounded <?php echo e(app()->getLocale() === 'id' ? 'bg-pastel-green text-white' : 'text-gray-500 hover:text-pastel-green'); ?>">ID</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="sm:hidden flex items-center">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-pastel-green hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pastel-green" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" id="menu-icon-open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" id="menu-icon-close" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-pastel-peach/30">
                <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-pastel-green hover:bg-gray-50"><?php echo e(__('messages.nav.home')); ?></a>
                <a href="<?php echo e(route('rooms.index')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-pastel-green hover:bg-gray-50"><?php echo e(__('messages.nav.rooms')); ?></a>
                <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-pastel-green hover:bg-gray-50"><?php echo e(__('messages.nav.contact')); ?></a>
                
                <!-- Mobile Language Switcher -->
                <div class="px-3 py-2 flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Language:</span>
                    <a href="<?php echo e(route('language.switch', 'en')); ?>" class="px-2 py-1 text-sm rounded <?php echo e(app()->getLocale() === 'en' ? 'bg-pastel-green text-white' : 'text-gray-500'); ?>">EN</a>
                    <a href="<?php echo e(route('language.switch', 'id')); ?>" class="px-2 py-1 text-sm rounded <?php echo e(app()->getLocale() === 'id' ? 'bg-pastel-green text-white' : 'text-gray-500'); ?>">ID</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <?php echo e($slot); ?>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-pastel-peach/30 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center mb-8">
                <!-- House Icon -->
                 <div class="bg-pastel-peach/10 p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-pastel-peach">
                        <path d="M19.006 3.705a.75.75 0 00-.512-1.41L6 6.838V3a.75.75 0 00-.75-.75h-1.5A.75.75 0 003 3v4.93l-1.006.365a.75.75 0 00.512 1.41l16.5-6z" />
                        <path fill-rule="evenodd" d="M3.019 11.115L12 7.843l8.981 3.272A2.25 2.25 0 0122.5 13.236v6.389a2.25 2.25 0 01-2.25 2.25H3.75a2.25 2.25 0 01-2.25-2.25v-6.39c0-.87.494-1.661 1.269-2.062zM3.75 13.5h1.5v6h-1.5v-6zm3 0h10.5v6H6.75v-6zm12 0h1.5v6h-1.5v-6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="text-center mb-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->routeIs('contact') && ($address = $siteSettings['contact_address'] ?? null)): ?>
                    <p class="text-gray-600 mb-4"><?php echo e($address); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex justify-center space-x-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fb = $siteSettings['social_facebook'] ?? null): ?>
                        <a href="<?php echo e($fb); ?>" target="_blank" class="text-gray-400 hover:text-[#1877F2] transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.517c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ig = $siteSettings['social_instagram'] ?? null): ?>
                        <a href="<?php echo e($ig); ?>" target="_blank" class="text-gray-400 hover:text-[#E4405F] transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tiktok = $siteSettings['social_tiktok'] ?? null): ?>
                        <a href="<?php echo e($tiktok); ?>" target="_blank" class="text-gray-400 hover:text-black transition-colors">
                            <span class="sr-only">TikTok</span>
                             <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v6.14c0 1.39-.75 2.72-1.95 3.51-1.21.8-2.72 1.05-4.13.68-1.41-.37-2.61-1.49-3.26-3.05-.66-1.57-.45-3.39.56-4.78 1.01-1.39 2.72-2.17 4.54-2.07.03 0 .07 0 .1.01v4.07c-.64-.15-1.32.09-1.72.61-.41.52-.45 1.24-.11 1.8.34.56.99.87 1.64.8 1.35-.15 2.37-1.35 2.27-2.81v-12.93c.01-.01.02-.02.02-.03.01-.01.01-.02.02-.03q-.03 0-.06 0z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($x = $siteSettings['social_x'] ?? null): ?>
                        <a href="<?php echo e($x); ?>" target="_blank" class="text-gray-400 hover:text-black transition-colors">
                            <span class="sr-only">X</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            
            <div class="text-center">
                <p class="text-base text-gray-500"><?php echo e(__('messages.footer.copyright', ['year' => date('Y')])); ?></p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');
            
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconOpen.classList.toggle('block');
            iconClose.classList.toggle('hidden');
            iconClose.classList.toggle('block');
        }
    </script>
</body>
</html>
<?php /**PATH D:\apps\scratch_apps\jaikost\room-rental-app\resources\views\components\layouts\app.blade.php ENDPATH**/ ?>