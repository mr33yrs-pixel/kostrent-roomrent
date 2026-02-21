<x-layouts.app :title="'JaiPremiumKost - ' . $room->name">
    <div class="bg-pastel-bg min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Link -->
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-pastel-green hover:text-pastel-green/80 mb-8 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('messages.room_detail.back_to_rooms') }}
            </a>

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <!-- Image Gallery -->
                <div class="relative">
                    @if(!empty($room->images))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
                            @foreach($room->images as $index => $image)
                                <div class="{{ $index === 0 ? 'md:col-span-2' : '' }} {{ $index === 0 ? 'h-80' : 'h-48' }} bg-gray-200">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" alt="{{ $room->name }} - Image {{ $index + 1 }}" loading="lazy" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="h-80 bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Availability Badge -->
                    <div class="absolute top-4 right-4">
                        @if($room->is_available)
                            <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-semibold rounded-full shadow">{{ __('messages.rooms.available') }}</span>
                        @else
                            <span class="px-4 py-2 bg-red-100 text-red-800 text-sm font-semibold rounded-full shadow">{{ __('messages.rooms.booked') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Room Details -->
                <div class="p-8">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                        <div>
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-2 {{ $room->type === 'premium' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($room->type) }}
                            </span>
                            <h1 class="text-3xl font-extrabold text-gray-900">{{ $room->name }}</h1>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-pastel-green">{{ $room->formatted_price }}</p>
                            <p class="text-gray-500">{{ __('messages.rooms.per_month') }}</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $room->name }}</h1>
                         @if(!$room->is_available)
                            <span class="inline-block px-3 py-1 bg-gray-600 text-white text-sm font-semibold rounded-full mb-2 shadow-sm">{{ __('messages.rooms.taken') }}</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full mb-2 shadow-sm">{{ __('messages.rooms.available') }}</span>
                        @endif
                        <p class="text-2xl font-bold text-pastel-green">{{ $room->formatted_price }} <span class="text-lg text-gray-500 font-normal">{{ __('messages.rooms.per_month') }}</span></p>
                    </div>

                    {{-- Special Packages --}}
                    @if($room->price_6_months || $room->price_yearly)
                        <div class="bg-pastel-bg rounded-2xl p-6 mb-8 border border-pastel-peach/20">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-pastel-peach mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                                {{ __('messages.room_detail.special_packages') }}
                            </h3>
                            <div class="space-y-3">
                                @if($room->price_6_months)
                                    <div class="flex justify-between items-center p-3 bg-white rounded-xl shadow-sm">
                                        <span class="text-gray-600">6 Months</span>
                                        <div class="text-right">
                                            <span class="block font-bold text-gray-900">{{ $room->formatted_price_6_months }}</span>
                                            @if($room->hasSixMonthDiscount())
                                                <span class="text-xs text-pastel-peach font-semibold">Save {{ $room->formatted_six_month_savings }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($room->price_yearly)
                                    <div class="flex justify-between items-center p-3 bg-white rounded-xl shadow-sm">
                                        <span class="text-gray-600">1 Year</span>
                                        <div class="text-right">
                                            <span class="block font-bold text-gray-900">{{ $room->formatted_price_yearly }}</span>
                                            @if($room->hasYearlyDiscount())
                                                <span class="text-xs text-pastel-peach font-semibold">Save {{ $room->formatted_yearly_savings }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Facilities -->
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">{{ __('messages.room_detail.facilities') }}</h2>
                        <div class="flex flex-wrap gap-3">
                            @if($room->facilities)
                                @foreach($room->facilities as $facility)
                                    <span class="px-4 py-2 bg-pastel-peach/30 text-gray-700 rounded-xl text-sm font-medium">{{ $facility }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Description (using sanitized output) -->
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">{{ __('messages.room_detail.description') }}</h2>
                        <div class="prose prose-gray max-w-none text-gray-600">
                            {!! $room->safe_description !!}
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8 mt-8">
                        @if($room->is_available)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $siteSettings['contact_whatsapp'] ?? '6281234567890') }}?text={{ urlencode(__('messages.room_detail.whatsapp_message', ['name' => $room->name])) }}" target="_blank" class="block w-full text-center py-4 bg-green-500 hover:bg-green-600 text-white rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.013 6.17 1.242 8.413 3.491 2.243 2.248 3.481 5.242 3.484 8.404.004 6.57-5.336 11.897-11.897 11.897-2.029.003-4.006-.525-5.783-1.523l-6.21 1.731zm18.324-7.55c-.279-.138-1.642-.81-1.896-.902-.253-.093-.437-.138-.621.138-.183.279-.714.902-.873 1.085-.158.183-.318.206-.596.069-.279-.138-1.18-.435-2.247-1.385-.836-.745-1.401-1.666-1.565-1.948-.164-.282-.017-.435.123-.574.127-.124.279-.323.419-.485.139-.162.185-.275.279-.459.093-.185.048-.344-.023-.485-.072-.139-.621-1.498-.849-2.05-.224-.543-.454-.469-.623-.478-.161-.008-.345-.008-.529-.008-.184 0-.482.069-.734.341-.252.274-.962.939-.962 2.292 0 1.352.986 2.658 1.123 2.845.139.185 1.941 2.966 4.704 4.159.658.283 1.171.452 1.574.58.665.212 1.27.182 1.748.11 1.26-.062 1.642-.671 1.874-1.319.231-.649.231-1.204.162-1.32-.07-.116-.254-.184-.533-.323"/></svg>
                                {{ __('messages.room_detail.book_via_whatsapp') }}
                            </a>
                        @else
                            <button disabled class="block w-full text-center py-4 bg-gray-400 text-white rounded-xl font-bold text-lg cursor-not-allowed flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                {{ __('messages.rooms.taken') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
