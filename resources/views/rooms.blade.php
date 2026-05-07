<x-layouts.app :title="'Jai\'s House - ' . __('messages.rooms.title')">
    <div class="bg-pastel-bg min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">{{ __('messages.rooms.title') }}</h1>
                <p class="mt-4 text-xl text-gray-500">{{ __('messages.rooms.subtitle') }}</p>
            </div>

            <!-- Premium Rooms -->
            <div class="mb-16">
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 border-b-4 border-pastel-peach pb-2">{{ __('messages.rooms.premium_collection') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($premiumRooms as $room)
                        <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
                            <div class="relative h-64 bg-gray-200 {{ !$room->is_available ? 'grayscale' : '' }}">
                                @if(!empty($room->images) && isset($room->images[0]))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($room->images[0]) }}" alt="{{ $room->name }}" loading="lazy" decoding="async" width="400" height="256" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 right-4">
                                    @if($room->is_available)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">{{ __('messages.rooms.available') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-600 text-white text-xs font-semibold rounded-full shadow-sm">{{ __('messages.rooms.taken') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $room->name }}</h3>
                                <p class="text-pastel-green font-bold text-lg mb-1">{{ $room->formatted_price }} <span class="text-sm text-gray-400 font-normal">{{ __('messages.rooms.per_month') }}</span></p>
                                <p class="text-xs text-gray-500 mb-3">* {{ __('messages.rooms.minimum_rent') }}</p>
                                
                                {{-- Only show discount badges if real savings exist --}}
                                @if($room->hasSixMonthDiscount() || $room->hasYearlyDiscount())
                                    <div class="mb-4 text-xs font-semibold text-pastel-peach flex gap-2">
                                        @if($room->hasSixMonthDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">6 Mo: Save {{ $room->formatted_six_month_savings }}</span>
                                        @endif
                                        @if($room->hasYearlyDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">Yearly: Save {{ $room->formatted_yearly_savings }}</span>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @if($room->facilities)
                                        @foreach(array_slice($room->facilities, 0, 3) as $facility)
                                            <span class="px-2 py-1 bg-pastel-peach/30 text-gray-600 text-xs rounded-lg">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($room->facilities) > 3)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-lg">{{ __('messages.rooms.more_facilities', ['count' => count($room->facilities) - 3]) }}</span>
                                        @endif
                                    @endif
                                </div>
                                
                                <a href="{{ route('rooms.show', $room) }}" class="block w-full text-center py-3 border border-pastel-green text-pastel-green rounded-xl font-semibold hover:bg-pastel-green hover:text-white transition-colors">
                                    {{ __('messages.rooms.view_details') }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-3xl">
                            {{ __('messages.rooms.no_premium') }}
                        </div>
                    @endforelse
                </div>
                
                @if($premiumRooms->hasPages())
                    <div class="mt-8">
                        {{ $premiumRooms->appends(['standard_page' => request('standard_page'), 'economic_page' => request('economic_page')])->links() }}
                    </div>
                @endif
            </div>

            <!-- Standard Rooms -->
            <div>
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 border-b-4 border-gray-200 pb-2">{{ __('messages.rooms.standard_collection') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($standardRooms as $room)
                        <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
                            <div class="relative h-64 bg-gray-200 {{ !$room->is_available ? 'grayscale' : '' }}">
                                @if(!empty($room->images) && isset($room->images[0]))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($room->images[0]) }}" alt="{{ $room->name }}" loading="lazy" decoding="async" width="400" height="256" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                     <div class="flex items-center justify-center h-full text-gray-400">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4">
                                    @if($room->is_available)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">{{ __('messages.rooms.available') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-600 text-white text-xs font-semibold rounded-full shadow-sm">{{ __('messages.rooms.taken') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $room->name }}</h3>
                                <p class="text-pastel-green font-bold text-lg mb-1">{{ $room->formatted_price }} <span class="text-sm text-gray-400 font-normal">{{ __('messages.rooms.per_month') }}</span></p>
                                <p class="text-xs text-gray-500 mb-3">* {{ __('messages.rooms.minimum_rent') }}</p>
                                
                                {{-- Only show discount badges if real savings exist --}}
                                @if($room->hasSixMonthDiscount() || $room->hasYearlyDiscount())
                                    <div class="mb-4 text-xs font-semibold text-pastel-peach flex gap-2">
                                        @if($room->hasSixMonthDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">6 Mo: Save {{ $room->formatted_six_month_savings }}</span>
                                        @endif
                                        @if($room->hasYearlyDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">Yearly: Save {{ $room->formatted_yearly_savings }}</span>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @if($room->facilities)
                                        @foreach(array_slice($room->facilities, 0, 3) as $facility)
                                            <span class="px-2 py-1 bg-pastel-peach/30 text-gray-600 text-xs rounded-lg">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($room->facilities) > 3)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-lg">{{ __('messages.rooms.more_facilities', ['count' => count($room->facilities) - 3]) }}</span>
                                        @endif
                                    @endif
                                </div>
                                
                                <a href="{{ route('rooms.show', $room) }}" class="block w-full text-center py-3 border border-pastel-green text-pastel-green rounded-xl font-semibold hover:bg-pastel-green hover:text-white transition-colors">
                                    {{ __('messages.rooms.view_details') }}
                                </a>
                            </div>
                        </div>
                    @empty
                       <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-3xl">
                            {{ __('messages.rooms.no_standard') }}
                        </div>
                    @endforelse
                </div>

                @if($standardRooms->hasPages())
                    <div class="mt-8">
                        {{ $standardRooms->appends(['premium_page' => request('premium_page'), 'economic_page' => request('economic_page')])->links() }}
                    </div>
                @endif
            </div>

            <!-- Economic Rooms -->
            <div class="mt-16">
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 border-b-4 border-gray-200 pb-2">{{ __('messages.rooms.economic_collection') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($economicRooms as $room)
                        <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
                            <div class="relative h-64 bg-gray-200 {{ !$room->is_available ? 'grayscale' : '' }}">
                                @if(!empty($room->images) && isset($room->images[0]))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($room->images[0]) }}" alt="{{ $room->name }}" loading="lazy" decoding="async" width="400" height="256" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                     <div class="flex items-center justify-center h-full text-gray-400">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4">
                                    @if($room->is_available)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">{{ __('messages.rooms.available') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-600 text-white text-xs font-semibold rounded-full shadow-sm">{{ __('messages.rooms.taken') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $room->name }}</h3>
                                <p class="text-pastel-green font-bold text-lg mb-1">{{ $room->formatted_price }} <span class="text-sm text-gray-400 font-normal">{{ __('messages.rooms.per_month') }}</span></p>
                                <p class="text-xs text-gray-500 mb-3">* {{ __('messages.rooms.minimum_rent') }}</p>
                                
                                {{-- Only show discount badges if real savings exist --}}
                                @if($room->hasSixMonthDiscount() || $room->hasYearlyDiscount())
                                    <div class="mb-4 text-xs font-semibold text-pastel-peach flex gap-2">
                                        @if($room->hasSixMonthDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">6 Mo: Save {{ $room->formatted_six_month_savings }}</span>
                                        @endif
                                        @if($room->hasYearlyDiscount())
                                            <span class="bg-pastel-peach/10 px-2 py-0.5 rounded">Yearly: Save {{ $room->formatted_yearly_savings }}</span>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @if($room->facilities)
                                        @foreach(array_slice($room->facilities, 0, 3) as $facility)
                                            <span class="px-2 py-1 bg-pastel-peach/30 text-gray-600 text-xs rounded-lg">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($room->facilities) > 3)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-lg">{{ __('messages.rooms.more_facilities', ['count' => count($room->facilities) - 3]) }}</span>
                                        @endif
                                    @endif
                                </div>
                                
                                <a href="{{ route('rooms.show', $room) }}" class="block w-full text-center py-3 border border-pastel-green text-pastel-green rounded-xl font-semibold hover:bg-pastel-green hover:text-white transition-colors">
                                    {{ __('messages.rooms.view_details') }}
                                </a>
                            </div>
                        </div>
                    @empty
                       <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-3xl">
                            {{ __('messages.rooms.no_economic') }}
                        </div>
                    @endforelse
                </div>

                @if($economicRooms->hasPages())
                    <div class="mt-8">
                        {{ $economicRooms->appends(['premium_page' => request('premium_page'), 'standard_page' => request('standard_page')])->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
