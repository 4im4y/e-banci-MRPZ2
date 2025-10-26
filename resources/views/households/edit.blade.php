<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Keluarga - {{ $household->household_number }}
            </h2>
            <a href="{{ route('households.show', $household) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <p class="font-semibold mb-2">Terdapat ralat dalam borang:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('households.update', $household) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Maklumat Keluarga -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Keluarga</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Household Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Keluarga <span class="text-red-500">*</span></label>
                                <input type="text" name="household_number" value="{{ old('household_number', $household->household_number) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('household_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Zone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Zon <span class="text-red-500">*</span></label>
                                <select name="zone_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Zon</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}" {{ old('zone_id', $household->zone_id) == $zone->id ? 'selected' : '' }}>
                                            {{ $zone->name }} ({{ $zone->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('zone_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Alamat</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Penuh <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="2" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('address', $household->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Postcode -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Poskod <span class="text-red-500">*</span></label>
                                <input type="text" name="postcode" value="{{ old('postcode', $household->postcode) }}" required maxlength="10" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('postcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bandar <span class="text-red-500">*</span></label>
                                <input type="text" name="city" value="{{ old('city', $household->city) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Negeri <span class="text-red-500">*</span></label>
                                <input type="text" name="state" value="{{ old('state', $household->state) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Ekonomi -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Ekonomi</h3>
                    </div>
                    <div class="p-6">
                        <!-- Income Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendapatan Bulanan Keluarga</label>
                            <select name="income_range" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="">Pilih Pendapatan</option>
                                <option value="below_2000" {{ old('income_range', $household->income_range) == 'below_2000' ? 'selected' : '' }}>Bawah RM2,000</option>
                                <option value="2000_3999" {{ old('income_range', $household->income_range) == '2000_3999' ? 'selected' : '' }}>RM2,000 - RM3,999</option>
                                <option value="4000_5999" {{ old('income_range', $household->income_range) == '4000_5999' ? 'selected' : '' }}>RM4,000 - RM5,999</option>
                                <option value="6000_7999" {{ old('income_range', $household->income_range) == '6000_7999' ? 'selected' : '' }}>RM6,000 - RM7,999</option>
                                <option value="8000_9999" {{ old('income_range', $household->income_range) == '8000_9999' ? 'selected' : '' }}>RM8,000 - RM9,999</option>
                                <option value="above_10000" {{ old('income_range', $household->income_range) == 'above_10000' ? 'selected' : '' }}>RM10,000 ke atas</option>
                            </select>
                            @error('income_range')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Catatan</h3>
                    </div>
                    <div class="p-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                        <textarea name="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Sebarang catatan tambahan tentang keluarga ini...">{{ old('notes', $household->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('households.show', $household) }}" class="inline-flex items-center px-6 py-3 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Kemaskini Keluarga
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>