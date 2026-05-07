<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Jai\'s House - ' . __('messages.nav.home')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Jai\'s House - ' . __('messages.nav.home'))]); ?>
    <!-- Hero Section -->
    <div class="relative bg-pastel-peach/20 overflow-hidden" 
         x-data="{ 
             activeSlide: 0, 
             slides: <?php echo e(json_encode($slides)); ?>,
             init() {
                 setInterval(() => {
                     this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                 }, 5000);
             }
         }"
         x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-transparent sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28 min-h-[400px]">
                    <div class="sm:text-center lg:text-left">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" 
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-4"
                                 class="absolute inset-0">
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <span class="block xl:inline" x-text="slide.title"></span>
                                    <span class="block text-pastel-green xl:inline" x-text="slide.highlight"></span>
                                </h1>
                                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0" x-text="slide.description">
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="<?php echo e(route('rooms.index')); ?>" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-pastel-green hover:bg-pastel-green/90 md:py-4 md:text-lg md:px-10 transition-all">
                                            <?php echo e(__('messages.home.browse_rooms')); ?>

                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="<?php echo e(route('contact')); ?>" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-pastel-green bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition-all shadow-sm">
                                            <?php echo e(__('messages.nav.contact')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Spacer to keep height -->
                        <div class="invisible">
                             <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Placeholder</span>
                                <span class="block text-pastel-green xl:inline">Placeholder</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Placeholder description text to maintain layout height.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="h-12 w-full"></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-pastel-green/10 flex items-center justify-center bg-cover bg-center transition-all duration-700 ease-in-out" 
             :style="`background-image: url('${slides[activeSlide]?.image ? '/storage/' + slides[activeSlide].image : ''}');`">
            <template x-if="!slides[activeSlide]?.image">
                <svg class="h-64 w-64 text-pastel-green/20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
            </template>
        </div>
    </div>

    <!-- Advantages Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-pastel-green font-semibold tracking-wide uppercase"><?php echo e(__('messages.home.why_choose_us')); ?></h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    <?php echo e(__('messages.home.better_living')); ?>

                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    <?php echo e(__('messages.home.better_living_desc')); ?>

                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-pastel-green text-white">
                                <!-- Heroicon name: outline/wifi -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900"><?php echo e(__('messages.home.wifi_title')); ?></p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            <?php echo e(__('messages.home.wifi_desc')); ?>

                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-pastel-green text-white">
                                <!-- Heroicon name: outline/shield-check -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900"><?php echo e(__('messages.home.security_title')); ?></p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            <?php echo e(__('messages.home.security_desc')); ?>

                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-pastel-green text-white">
                                <!-- Heroicon name: outline/sparkles -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900"><?php echo e(__('messages.home.cleaning_title')); ?></p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            <?php echo e(__('messages.home.cleaning_desc')); ?>

                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Google Maps Section -->
    <div class="bg-pastel-bg py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900"><?php echo e(__('messages.home.location_title')); ?></h2>
                <p class="mt-4 text-gray-500"><?php echo e(__('messages.home.location_desc')); ?></p>
            </div>
            <div class="rounded-3xl overflow-hidden shadow-lg h-96 bg-gray-200">
                <iframe
                    data-src="<?php echo e($mapsUrl); ?>"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    class="lazy-iframe w-full h-full">
                </iframe>
            </div>
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
<?php /**PATH D:\apps\scratch_apps\jaikost\room-rental-app\resources\views/home.blade.php ENDPATH**/ ?>