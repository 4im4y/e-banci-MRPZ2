<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Senarai Keluarga
            </h2>
            <a href="{{ route('households.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Keluarga Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('households.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="No. Keluarga, Alamat..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>

                            <!-- Zone Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Zon</label>
                                <select name="zone_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Semua Zon</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : '' }}>
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Income Range Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pendapatan Bulanan</label>
                                <select name="income_range" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Semua</option>
                                    <option value="below_2000" {{ request('income_range') == 'below_2000' ? 'selected' : '' }}>Bawah RM2,000</option>
                                    <option value="2000_3999" {{ request('income_range') == '2000_3999' ? 'selected' : '' }}>RM2,000 - RM3,999</option>
                                    <option value="4000_5999" {{ request('income_range') == '4000_5999' ? 'selected' : '' }}>RM4,000 - RM5,999</option>
                                    <option value="6000_7999" {{ request('income_range') == '6000_7999' ? 'selected' : '' }}>RM6,000 - RM7,999</option>
                                    <option value="8000_9999" {{ request('income_range') == '8000_9999' ? 'selected' : '' }}>RM8,000 - RM9,999</option>
                                    <option value="above_10000" {{ request('income_range') == 'above_10000' ? 'selected' : '' }}>RM10,000 ke atas</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            <a href="{{ route('households.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Households Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($households as $household)
                <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $household->household_number }}</h3>
                                <p class="text-sm text-gray-500">{{ $household->zone->name ?? 'Tiada Zon' }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                {{ $household->members_count }} Ahli
                            </span>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 line-clamp-2">
                                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $household->full_address }}
                            </p>
                        </div>

                        <!-- Income Range -->
                        @if($household->income_range)
                        <div class="mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                @switch($household->income_range)
                                    @case('below_2000') < RM2,000 @break
                                    @case('2000_3999') RM2,000 - RM3,999 @break
                                    @case('4000_5999') RM4,000 - RM5,999 @break
                                    @case('6000_7999') RM6,000 - RM7,999 @break
                                    @case('8000_9999') RM8,000 - RM9,999 @break
                                    @case('above_10000') > RM10,000 @break
                                @endswitch
                            </span>
                        </div>
                        @endif

                        <!-- Head of Household -->
                        @if($household->head())
                        <div class="mb-4 pb-4 border-b border-gray-200">
                            <p class="text-xs text-gray-500 mb-1">Ketua Keluarga</p>
                            <p class="text-sm font-medium text-gray-900">{{ $household->head()->full_name }}</p>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('households.show', $household) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat
                            </a>
                            <a href="{{ route('households.edit', $household) }}" class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('households.destroy', $household) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk memadamkan keluarga ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tiada keluarga dijumpai</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulakan dengan menambah keluarga baharu.</p>
                        <div class="mt-6">
                            <a href="{{ route('households.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Keluarga Baru
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($households->hasPages())
            <div class="mt-6">
                {{ $households->links() }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>