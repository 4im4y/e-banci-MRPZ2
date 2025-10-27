<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Ahli - {{ $member->full_name }}
            </h2>
            <a href="{{ route('members.show', $member) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
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

            <form action="{{ route('members.update', $member) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Maklumat Keahlian -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Keahlian</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Membership Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Ahli <span class="text-red-500">*</span></label>
                                <input type="text" name="membership_number" value="{{ old('membership_number', $member->membership_number) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('membership_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- IC Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Kad Pengenalan <span class="text-red-500">*</span></label>
                                <input type="text" name="ic_number" value="{{ old('ic_number', $member->ic_number) }}" required maxlength="12" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('ic_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Peribadi -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Peribadi</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penuh <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name', $member->full_name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Date of Birth -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tarikh Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth->format('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jantina <span class="text-red-500">*</span></label>
                                <select name="gender" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Jantina</option>
                                    <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Lelaki</option>
                                    <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                                <!-- Bangsa -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bangsa <span class="text-red-500">*</span></label>
                                <select name="bangsa" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="melayu" {{ old('bangsa', 'melayu') == 'melayu' ? 'selected' : '' }}>Melayu</option>
                                    <option value="china" {{ old('bangsa') == 'china' ? 'selected' : '' }}>China</option>
                                    <option value="india" {{ old('bangsa') == 'india' ? 'selected' : '' }}>India</option>
                                    <option value="lain-lain" {{ old('bangsa') == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                            </div>

                            <!-- Marital Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkahwinan</label>
                                <select name="marital_status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Status</option>
                                    <option value="single" {{ old('marital_status', $member->marital_status) == 'single' ? 'selected' : '' }}>Bujang</option>
                                    <option value="married" {{ old('marital_status', $member->marital_status) == 'married' ? 'selected' : '' }}>Berkahwin</option>
                                    <option value="divorced" {{ old('marital_status', $member->marital_status) == 'divorced' ? 'selected' : '' }}>Bercerai</option>
                                    <option value="widowed" {{ old('marital_status', $member->marital_status) == 'widowed' ? 'selected' : '' }}>Janda/Duda</option>
                                </select>
                                @error('marital_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Hubungan -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Hubungan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Phone Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telefon <span class="text-red-500">*</span></label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $member->phone_number) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Emel</label>
                                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="address" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('address', $member->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Postcode -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Poskod</label>
                                <input type="text" name="postcode" value="{{ old('postcode', $member->postcode) }}" maxlength="10" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('postcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bandar</label>
                                <input type="text" name="city" value="{{ old('city', $member->city) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Negeri</label>
                                <input type="text" name="state" value="{{ old('state', $member->state) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Pekerjaan & Pendidikan -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Pekerjaan & Pendidikan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Occupation -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" name="occupation" value="{{ old('occupation', $member->occupation) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('occupation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Education Level -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahap Pendidikan</label>
                                <select name="education_level" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Tahap Pendidikan</option>
                                    <option value="no_formal" {{ old('education_level', $member->education_level) == 'no_formal' ? 'selected' : '' }}>Tiada Pendidikan Formal</option>
                                    <option value="primary" {{ old('education_level', $member->education_level) == 'primary' ? 'selected' : '' }}>Sekolah Rendah</option>
                                    <option value="secondary" {{ old('education_level', $member->education_level) == 'secondary' ? 'selected' : '' }}>Sekolah Menengah</option>
                                    <option value="diploma" {{ old('education_level', $member->education_level) == 'diploma' ? 'selected' : '' }}>Diploma</option>
                                    <option value="degree" {{ old('education_level', $member->education_level) == 'degree' ? 'selected' : '' }}>Ijazah Sarjana Muda</option>
                                    <option value="master" {{ old('education_level', $member->education_level) == 'master' ? 'selected' : '' }}>Ijazah Sarjana</option>
                                    <option value="phd" {{ old('education_level', $member->education_level) == 'phd' ? 'selected' : '' }}>Ijazah Kedoktoran (PhD)</option>
                                </select>
                                @error('education_level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Keluarga -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Maklumat Keluarga</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Household -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Keluarga / Isi Rumah</label>
                                <select name="household_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Keluarga</option>
                                    @foreach($households as $household)
                                        <option value="{{ $household->id }}" {{ old('household_id', $currentHousehold?->id) == $household->id ? 'selected' : '' }}>
                                            {{ $household->household_number }} - {{ $household->zone->name ?? 'Tiada Zon' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('household_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Relationship -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan dalam Keluarga</label>
                                <select name="relationship" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Pilih Hubungan</option>
                                    <option value="head" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'head' ? 'selected' : '' }}>Ketua Keluarga</option>
                                    <option value="spouse" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'spouse' ? 'selected' : '' }}>Pasangan</option>
                                    <option value="child" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'child' ? 'selected' : '' }}>Anak</option>
                                    <option value="parent" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'parent' ? 'selected' : '' }}>Ibu Bapa</option>
                                    <option value="sibling" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'sibling' ? 'selected' : '' }}>Adik Beradik</option>
                                    <option value="other" {{ old('relationship', $currentHousehold?->pivot->relationship) == 'other' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                                @error('relationship')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Is Head -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_head" value="1" {{ old('is_head', $currentHousehold?->pivot->is_head) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-700">Tandakan jika ahli ini adalah Ketua Keluarga</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Status & Catatan -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                        <h3 class="text-lg font-semibold text-gray-900">Status & Catatan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Active Status -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-700">Ahli Aktif</span>
                            </label>
                            <p class="mt-1 text-xs text-gray-500">Nyahtanda jika ahli tidak lagi aktif</p>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                            <textarea name="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Sebarang catatan tambahan tentang ahli ini...">{{ old('notes', $member->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('members.show', $member) }}" class="inline-flex items-center px-6 py-3 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring ring-emerald-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Kemaskini Ahli
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>