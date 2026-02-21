<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'JaiPremiumKost - ' . __('messages.nav.contact')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('JaiPremiumKost - ' . __('messages.nav.contact'))]); ?>
    <div class="bg-pastel-bg min-h-screen py-12 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl tracking-tight"><?php echo e(__('messages.contact.title')); ?></h1>
                <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto"><?php echo e(__('messages.contact.subtitle')); ?></p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Left Side: Contact Info -->
                    <div class="p-8 sm:p-12 bg-pastel-green/10 flex flex-col justify-center">
                        <div class="space-y-8">
                             <!-- Address -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-pastel-green/20 text-pastel-green">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide"><?php echo e(__('messages.contact.address')); ?></h3>
                                    <p class="mt-1 text-base font-semibold text-gray-900 whitespace-pre-line"><?php echo e($siteSettings['contact_address'] ?? 'Address not set'); ?></p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-pastel-peach/20 text-pastel-peach">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide"><?php echo e(__('messages.contact.email')); ?></h3>
                                    <a href="mailto:<?php echo e($siteSettings['contact_email'] ?? ''); ?>" class="mt-1 text-base font-semibold text-gray-900 hover:text-pastel-green transition-colors block"><?php echo e($siteSettings['contact_email'] ?? ''); ?></a>
                                </div>
                            </div>

                             <!-- Operating Hours -->
                             <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-50 text-blue-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Operating Hours</h3>
                                    <p class="mt-1 text-base font-semibold text-gray-900"><?php echo e(__('messages.contact.operating_hours')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Row -->
                        <div class="mt-10 pt-8 border-t border-gray-200">
                             <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase mb-4">Connect With Us</h3>
                             <div class="flex space-x-6">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fb = $siteSettings['social_facebook'] ?? null): ?>
                                    <a href="<?php echo e($fb); ?>" target="_blank" class="text-gray-400 hover:text-[#1877F2] transition-colors"><span class="sr-only">Facebook</span><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.517c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ig = $siteSettings['social_instagram'] ?? null): ?>
                                    <a href="<?php echo e($ig); ?>" target="_blank" class="text-gray-400 hover:text-[#E4405F] transition-colors"><span class="sr-only">Instagram</span><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tiktok = $siteSettings['social_tiktok'] ?? null): ?>
                                    <a href="<?php echo e($tiktok); ?>" target="_blank" class="text-gray-400 hover:text-black transition-colors"><span class="sr-only">TikTok</span><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v6.14c0 1.39-.75 2.72-1.95 3.51-1.21.8-2.72 1.05-4.13.68-1.41-.37-2.61-1.49-3.26-3.05-.66-1.57-.45-3.39.56-4.78 1.01-1.39 2.72-2.17 4.54-2.07.03 0 .07 0 .1.01v4.07c-.64-.15-1.32.09-1.72.61-.41.52-.45 1.24-.11 1.8.34.56.99.87 1.64.8 1.35-.15 2.37-1.35 2.27-2.81v-12.93c.01-.01.02-.02.02-.03.01-.01.01-.02.02-.03q-.03 0-.06 0z"/></svg></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($x = $siteSettings['social_x'] ?? null): ?>
                                    <a href="<?php echo e($x); ?>" target="_blank" class="text-gray-400 hover:text-black transition-colors"><span class="sr-only">X</span><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                             </div>
                        </div>
                    </div>

                    <!-- Right Side: CTA / Image -->
                    <div class="relative bg-pastel-green p-8 sm:p-12 flex flex-col justify-center items-center text-center">
                        <!-- Decorative background pattern could go here -->
                        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                        
                        <div class="relative z-10">
                            <h2 class="text-3xl font-extrabold text-white mb-6">Need a Quick Response?</h2>
                            <p class="text-white/90 mb-8 text-lg">We are most active on WhatsApp! Tap the button below to chat with our admin directly.</p>
                            
                            <a href="https://wa.me/<?php echo e($siteSettings['contact_whatsapp'] ?? config('app.whatsapp_number')); ?>?text=<?php echo e(urlencode(__('messages.contact.whatsapp_message'))); ?>" target="_blank" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-bold rounded-full shadow-lg text-pastel-green bg-white hover:bg-gray-100 transition-all transform hover:scale-105">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <?php echo e(__('messages.contact.chat_whatsapp')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Section (Optional Placeholder) -->
            <!-- <div class="mt-12 rounded-3xl overflow-hidden shadow-lg h-96 bg-gray-200">
                <iframe src="https://www.google.com/maps/embed?..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div> -->
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH D:\apps\scratch_apps\jaikost\room-rental-app\resources\views\contact.blade.php ENDPATH**/ ?>