<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Maklumat Ahli
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('members.edit', $member) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg shadow-lg p-8 mb-6">
                <div class="flex items-center">
                    <div class="h-24 w-24 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <span class="text-4xl font-bold text-emerald-600">{{ substr($member->full_name, 0, 1) }}</span>
                    </div>
                    <div class="ml-6 text-white">
                        <h3 class="text-3xl font-bold">{{ $member->full_name }}</h3>
                        <p class="text-emerald-100 mt-1">{{ $member->membership_number }}</p>
                        <div class="flex gap-3 mt-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm">
                                {{ $member->gender == 'male' ? 'Lelaki' : 'Perempuan' }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm">
                                {{ $member->age }} Tahun
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $member->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $member->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Maklumat Peribadi -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Maklumat Peribadi</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">No. Kad Pengenalan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $member->formatted_ic }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->date_of_birth->format('d/m/Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Umur</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->age }} tahun</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Perkahwinan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        @switch($member->marital_status)
                                            @case('single') Bujang @break
                                            @case('married') Berkahwin @break
                                            @case('divorced') Bercerai @break
                                            @case('widowed') Janda/Duda @break
                                            @default - @break
                                        @endswitch
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Maklumat Hubungan -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Maklumat Hubungan</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">No. Telefon</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-semibold">
                                        <a href="tel:{{ $member->phone_number }}" class="text-emerald-600 hover:text-emerald-800">
                                            {{ $member->phone_number }}
                                        </a>
                                    </dd>
                                </div>
                                @if($member->email)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Emel</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="mailto:{{ $member->email }}" class="text-emerald-600 hover:text-emerald-800">
                                            {{ $member->email }}
                                        </a>
                                    </dd>
                                </div>
                                @endif
                                @if($member->full_address)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->full_address }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Maklumat Pekerjaan & Pendidikan -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Maklumat Pekerjaan & Pendidikan</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->occupation ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tahap Pendidikan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        @switch($member->education_level)
                                            @case('no_formal') Tiada Pendidikan Formal @break
                                            @case('primary') Sekolah Rendah @break
                                            @case('secondary') Sekolah Menengah @break
                                            @case('diploma') Diploma @break
                                            @case('degree') Ijazah Sarjana Muda @break
                                            @case('master') Ijazah Sarjana @break
                                            @case('phd') Ijazah Kedoktoran (PhD) @break
                                            @default - @break
                                        @endswitch
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Maklumat Keluarga -->
                    @if($member->households->count() > 0)
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Maklumat Keluarga</h3>
                        </div>
                        <div class="p-6">
                            @foreach($member->households as $household)
                            <div class="border border-gray-200 rounded-lg p-4 mb-4 last:mb-0">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $household->household_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $household->zone->name ?? 'Tiada Zon' }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        @switch($household->pivot->relationship)
                                            @case('head') Ketua Keluarga @break
                                            @case('spouse') Pasangan @break
                                            @case('child') Anak @break
                                            @case('parent') Ibu Bapa @break
                                            @case('sibling') Adik Beradik @break
                                            @default Lain-lain @break
                                        @endswitch
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p class="mb-1"><strong>Alamat:</strong> {{ $household->full_address }}</p>
                                    <p><strong>Jumlah Ahli Keluarga:</strong> {{ $household->total_members }} orang</p>
                                </div>
                                
                                <!-- Family Members -->
                                @if($household->members->count() > 1)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Ahli Keluarga Lain:</p>
                                    <div class="space-y-2">
                                        @foreach($household->members as $familyMember)
                                            @if($familyMember->id !== $member->id)
                                            <div class="flex items-center justify-between text-sm">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center mr-2">
                                                        <span class="text-white text-xs font-semibold">{{ substr($familyMember->full_name, 0, 1) }}</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">{{ $familyMember->full_name }}</p>
                                                        <p class="text-xs text-gray-500">
                                                            @switch($familyMember->pivot->relationship)
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
                                                <a href="{{ route('members.show', $familyMember) }}" class="text-emerald-600 hover:text-emerald-800 text-xs">
                                                    Lihat →
                                                </a>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Catatan -->
                    @if($member->notes)
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Catatan</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-700">{{ $member->notes }}</p>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    
                    <!-- Quick Info -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Maklumat Ringkas</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-emerald-100 rounded-md p-2">
                                    <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500">No. Ahli</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $member->membership_number }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 rounded-md p-2">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500">Tarikh Daftar</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $member->registered_date->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            @if($member->households->first())
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-100 rounded-md p-2">
                                    <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500">Zon Kawasan</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $member->households->first()->zone->name ?? '-' }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Tindakan</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('members.edit', $member) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Maklumat
                            </a>
                            
                            <button onclick="window.print()" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                Cetak Profil
                            </button>

                            <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk memadamkan ahli ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Padam Ahli
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                            <h3 class="text-lg font-semibold text-gray-900">Rekod</h3>
                        </div>
                        <div class="p-6">
                            <div class="flow-root">
                                <ul class="-mb-8">
                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Ahli didaftarkan</p>
                                                        <p class="mt-0.5 text-xs text-gray-400">{{ $member->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if($member->updated_at != $member->created_at)
                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Maklumat dikemaskini</p>
                                                        <p class="mt-0.5 text-xs text-gray-400">{{ $member->updated_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>