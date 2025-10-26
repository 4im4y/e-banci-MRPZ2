<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Maklumat Keluarga
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('households.edit', $household) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('households.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Household Info -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold">{{ $household->household_number }}</h3>
                                    <p class="text-emerald-100 mt-1">{{ $household->zone->name ?? 'Tiada Zon' }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold">{{ $household->members->count() }}</div>
                                    <div class="text-sm text-emerald-100">Ahli Keluarga</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $household->full_address }}</dd>
                                </div>
                                @if($household->income_range)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pendapatan Bulanan</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            @switch($household->income_range)
                                                @case('below_2000') Bawah RM2,000 @break
                                                @case('2000_3999') RM2,000 - RM3,999 @break
                                                @case('4000_5999') RM4,000 - RM5,999 @break
                                                @case('6000_7999') RM6,000 - RM7,999 @break
                                                @case('8000_9999') RM8,000 - RM9,999 @break
                                                @case('above_10000') RM10,000 ke atas @break
                                            @endswitch
                                        </span>
                                    </dd>
                                </div>
                                @endif
                                @if($household->notes)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Catatan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $household->notes }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Family Members -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Ahli Keluarga ({{ $household->members->count() }})</h3>
                        </div>
                        <div class="p-6">
                            @forelse($household->members as $member)
                            <div class="flex items-center justify-between py-4 border-b border-gray-200 last:border-0">
                                <div class="flex items-center flex-1">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center mr-4">
                                        <span class="text-white text-lg font-semibold">{{ substr($member->full_name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-gray-900">{{ $member->full_name }}</p>
                                            @if($member->pivot->is_head)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Ketua
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $member->gender == 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                {{ $member->gender == 'male' ? 'Lelaki' : 'Perempuan' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-3 mt-1">
                                            <p class="text-xs text-gray-500">{{ $member->formatted_ic }}</p>
                                            <p class="text-xs text-gray-500">{{ $member->age }} tahun</p>
                                            <p class="text-xs text-gray-500">
                                                @switch($member->pivot->relationship)
                                                    @case('head') Ketua Keluarga @break
                                                    @case('spouse') Pasangan @break
                                                    @case('child') Anak @break
                                                    @case('parent') Ibu Bapa @break
                                                    @case('sibling') Adik Beradik @break
                                                    @default Lain-lain @break
                                                @endswitch
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('members.show', $member) }}" class="text-emerald-600 hover:text-emerald-900" title="Lihat Profil">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('households.members.remove', [$household, $member]) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk mengeluarkan ahli ini dari keluarga?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Keluarkan dari Keluarga">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Tiada ahli dalam keluarga ini</p>
                                <p class="text-xs text-gray-400">Gunakan borang di sebelah untuk menambah ahli</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Add Member Form -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Tambah Ahli Keluarga</h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('households.members.add', $household) }}" method="POST" class="space-y-4">
                                @csrf
                                
                                <!-- Member Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Ahli</label>
                                    <select name="member_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Ahli</option>
                                        @foreach($availableMembers as $member)
                                            <option value="{{ $member->id }}">
                                                {{ $member->full_name }} ({{ $member->membership_number }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Relationship -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan</label>
                                    <select name="relationship" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Hubungan</option>
                                        <option value="head">Ketua Keluarga</option>
                                        <option value="spouse">Pasangan</option>
                                        <option value="child">Anak</option>
                                        <option value="parent">Ibu Bapa</option>
                                        <option value="sibling">Adik Beradik</option>
                                        <option value="other">Lain-lain</option>
                                    </select>
                                </div>

                                <!-- Is Head -->
                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_head" value="1" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <span class="ml-2 text-sm text-gray-700">Tandakan sebagai Ketua Keluarga</span>
                                    </label>
                                </div>

                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Ahli
                                </button>
                            </form>

                            @if($availableMembers->isEmpty())
                            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                <p class="text-xs text-yellow-800">Semua ahli aktif sudah berada dalam keluarga atau keluarga lain.</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Statistik</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Jumlah Ahli</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $household->members->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Lelaki</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $household->members->where('gender', 'male')->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Perempuan</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $household->members->where('gender', 'female')->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Dewasa (18+)</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $household->members->filter(fn($m) => $m->age >= 18)->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Kanak-kanak</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $household->members->filter(fn($m) => $m->age < 18)->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Tindakan</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('households.edit', $household) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Maklumat
                            </a>
                            
                            <button onclick="window.print()" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                Cetak Maklumat
                            </button>

                            <form action="{{ route('households.destroy', $household) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk memadamkan keluarga ini? Semua ahli akan dikeluarkan dari keluarga.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Padam Keluarga
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>