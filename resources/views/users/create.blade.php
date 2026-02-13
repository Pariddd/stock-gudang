@extends('layouts.app')

@section('content')

<div class="w-full max-w-2xl mx-auto px-4 lg:px-0">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah User Baru</h1>
        <p class="text-sm text-gray-600 mt-1">
            Buat akun pengguna baru untuk sistem
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700">
                Form User
            </h2>
        </div>

        <form action="{{ route('dashboard.users.store') }}"
              method="POST"
              class="p-6 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Username <span class="text-blue-700">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan username"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-700 focus:border-transparent transition-all {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300' }}"
                       required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password <span class="text-blue-700">*</span>
                </label>
                <div class="relative">
                    <input type="password"
                           id="passwordInput"
                           name="password"
                           placeholder="Minimal 8 huruf"
                           class="w-full border rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:border-transparent transition-all {{ $errors->has('password') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-700' }}" required>
                    <button type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg id="eyeIcon" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eyeOffIcon" class="w-5 h-5 text-gray-400 hover:text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @else
                    <p class="text-gray-500 text-xs mt-1">Password minimal 8 huruf</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Role <span class="text-blue-700">*</span>
                </label>
                <select name="role"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:border-transparent transition-all {{ $errors->has('role') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-700' }}" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
                @error('role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @else
                    <p class="text-gray-500 text-xs mt-1">
                        <strong>Admin:</strong> Akses penuh sistem • 
                        <strong>Staff:</strong> Akses terbatas
                    </p>
                @enderror
            </div>
            <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 ">
                <a href="{{ route('dashboard.users.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-700 text-white text-sm font-medium rounded-lg hover:bg-blue-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        eyeIcon.classList.toggle('hidden');
        eyeOffIcon.classList.toggle('hidden');
    });
</script>

@endsection