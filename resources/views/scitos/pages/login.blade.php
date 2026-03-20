@extends('layouts.scitos')

@php
    $authUser = $authUser ?? session('scitos_auth');
    $selectedRole = $selectedRole ?? 'member';
    $selectedAdminRole = $selectedAdminRole ?? 'admin';
    $adminRoles = $adminRoles ?? data_get($scitos, 'auth.admin_roles', []);
    $divisions = data_get($scitos, 'divisions', []);
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">Login SCI-TOS</div>
        <h1 class="hero-title">Pilih mode masuk: anggota atau admin.</h1>
        <p class="hero-desc">
            Halaman login dimulai dari dua pilihan utama. Setelah login berhasil, pengguna akan diarahkan kembali ke beranda. Khusus admin, shortcut ke panel admin akan otomatis muncul sebagai floating settings di kanan bawah.
        </p>
    </section>

    <section class="section container">
        <div class="login-shell">
            <div class="login-choice-grid">
                <a href="{{ route('login', ['role' => 'member']) }}" class="cyber-card login-choice {{ $selectedRole === 'member' ? 'is-active' : '' }}">
                    <span class="mini-label">Mode 01</span>
                    <h3>Login sebagai Anggota</h3>
                    <p>Masuk untuk melihat classroom, tugas divisi, dan pengalaman personal sebagai bagian dari SCI-TOS.</p>
                </a>

                <a href="{{ route('login', ['role' => 'admin']) }}" class="cyber-card login-choice {{ $selectedRole === 'admin' ? 'is-active' : '' }}">
                    <span class="mini-label">Mode 02</span>
                    <h3>Login sebagai Admin</h3>
                    <p>Masuk sebagai admin untuk menyalakan mode kontrol, melihat floating settings, dan membuka panel admin putih. Tersedia dua level: Admin Biasa dan Executive Admin.</p>
                </a>
            </div>

            @if ($authUser)
                <div class="cyber-card session-box">
                    <div>
                        <span class="mini-label">Session Active</span>
                        <h3 style="margin-top: 10px;">Anda sedang masuk sebagai {{ data_get($authUser, 'role') === 'admin' ? 'admin' : 'anggota' }}.</h3>
                        <p style="margin-top: 10px; color: var(--text-muted);">Silakan lanjut ke beranda atau logout untuk berganti mode masuk.</p>
                    </div>

                    <div class="session-grid">
                        <div class="cyber-card">
                            <strong>{{ data_get($authUser, 'name') }}</strong>
                            <span>Nama tampilan</span>
                        </div>
                        <div class="cyber-card">
                            <strong>{{ data_get($authUser, 'role') === 'admin' ? 'Admin' : 'Anggota' }}</strong>
                            <span>Role aktif</span>
                        </div>
                        <div class="cyber-card">
                            <strong>{{ data_get($authUser, 'role') === 'admin' ? data_get($authUser, 'admin_label', '-') : (data_get($authUser, 'interest') ?: '-') }}</strong>
                            <span>{{ data_get($authUser, 'role') === 'admin' ? 'Level admin' : 'Minat / divisi' }}</span>
                        </div>
                    </div>

                    <div class="section-actions" style="justify-content: flex-start;">
                        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Logout</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="cyber-card form-card">
                <span class="mini-label">{{ $selectedRole === 'admin' ? 'Admin Access' : 'Member Access' }}</span>
                <h3 style="margin-top: 12px;">
                    {{ $selectedRole === 'admin' ? 'Masuk sebagai Admin SCI-TOS' : 'Masuk sebagai Anggota SCI-TOS' }}
                </h3>
                <p style="margin-top: 10px; color: var(--text-muted);">
                    {{ $selectedRole === 'admin'
                        ? data_get($scitos, 'auth.note')
                        : 'Flow anggota dibuat ringan agar langsung bisa dipakai untuk tahap awal classroom dan personalisasi beranda.' }}
                </p>

                <form action="{{ route('login.store') }}" method="post" class="form-grid" style="margin-top: 24px;">
                    @csrf
                    <input type="hidden" name="role" value="{{ $selectedRole }}">

                    @if ($selectedRole === 'admin')
                        <div class="field-group">
                            <label for="admin_role">Level Admin</label>
                            <select id="admin_role" name="admin_role">
                                @foreach ($adminRoles as $key => $roleConfig)
                                    <option value="{{ $key }}" @selected($selectedAdminRole === $key)>{{ $roleConfig['label'] }}</option>
                                @endforeach
                            </select>
                            @error('admin_role')
                                <p class="field-error">{{ $message }}</p>
                            @else
                                <p class="input-help">Admin biasa hanya membuka fitur spesial tertentu, sedangkan executive admin mendapat akses penuh ke seluruh fitur.</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="identifier">Username Admin</label>
                            <input id="identifier" name="identifier" type="text" class="input-field" value="{{ old('identifier') }}" placeholder="Masukkan username admin">
                            @error('identifier')
                                <p class="field-error">{{ $message }}</p>
                            @else
                                <p class="input-help">{{ data_get($adminRoles, $selectedAdminRole . '.summary') }}</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="password">Access Key</label>
                            <input id="password" name="password" type="password" class="input-field" placeholder="Masukkan access key admin">
                            @error('password')
                                <p class="field-error">{{ $message }}</p>
                            @else
                                <p class="input-help">Setelah login berhasil, Anda akan diarahkan ke beranda dan floating settings akan aktif.</p>
                            @enderror
                        </div>
                    @else
                        <div class="field-group">
                            <label for="name">Nama Lengkap</label>
                            <input id="name" name="name" type="text" class="input-field" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="input-field" value="{{ old('email') }}" placeholder="Masukkan email aktif">
                            @error('email')
                                <p class="field-error">{{ $message }}</p>
                            @else
                                <p class="input-help">Opsional, tapi berguna untuk tahap awal personalisasi profile.</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="interest">Minat Divisi</label>
                            <select id="interest" name="interest">
                                <option value="">Pilih minat utama</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division['name'] }}" @selected(old('interest') === $division['name'])>{{ $division['name'] }}</option>
                                @endforeach
                            </select>
                            @error('interest')
                                <p class="field-error">{{ $message }}</p>
                            @else
                                <p class="input-help">Pilihan ini akan dipakai untuk menyesuaikan pengalaman classroom ke depannya.</p>
                            @enderror
                        </div>
                    @endif

                    <div class="section-actions" style="justify-content: flex-start; margin-top: 6px;">
                        <button type="submit" class="btn btn-primary">
                            {{ $selectedRole === 'admin' ? 'Login Admin' : 'Login Anggota' }}
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection
