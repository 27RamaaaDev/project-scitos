@extends('layouts.admin')

@php
    $authUser = session('scitos_auth');
    $activeAdminRole = data_get($authUser, 'admin_role', 'admin');
    $adminRoles = data_get($scitos, 'auth.admin_roles', []);
    $activeRoleConfig = data_get($adminRoles, $activeAdminRole, []);
    $divisionOptions = collect(data_get($scitos, 'divisions', []))->pluck('name')->all();
    $customClassroomTasks = collect(session('scitos_classroom.custom_tasks', []));
    $seedTasks = collect(data_get($scitos, 'classroom.tasks', []));
    $allClassroomTasks = $customClassroomTasks->concat($seedTasks)->values();
    $modules = [
        [
            'title' => 'Classroom Console',
            'access' => 'admin',
            'summary' => 'Pantau tugas, status challenge, dan alur briefing koordinator divisi.',
            'tags' => ['Classroom', 'Task Board', 'Monitoring'],
        ],
        [
            'title' => 'Gallery Console',
            'access' => 'admin',
            'summary' => 'Melihat arsip karya, media showcase, dan status koleksi gallery SCI-TOS.',
            'tags' => ['Gallery', 'Media', 'Collection'],
        ],
        [
            'title' => 'Website Insights',
            'access' => 'admin',
            'summary' => 'Membaca ringkasan modul website, halaman aktif, dan titik pengembangan berikutnya.',
            'tags' => ['Insight', 'Website', 'Overview'],
        ],
        [
            'title' => 'Content Settings',
            'access' => 'executive',
            'summary' => 'Mengatur seluruh konten beranda, detail divisi, struktur pengurus, dan informasi pendaftaran.',
            'tags' => ['Content', 'Homepage', 'Control'],
        ],
        [
            'title' => 'Divisi & Pengurus Editor',
            'access' => 'executive',
            'summary' => 'Membuka akses pengelolaan penuh untuk data divisi, koordinator, dan tree kepengurusan.',
            'tags' => ['Divisi', 'Pengurus', 'Editor'],
        ],
        [
            'title' => 'System Access Control',
            'access' => 'executive',
            'summary' => 'Mengelola seluruh fitur spesial admin dan akses penuh ke modul internal website.',
            'tags' => ['Security', 'Permission', 'Executive'],
        ],
    ];
    $openModules = collect($modules)->filter(function ($module) use ($activeAdminRole) {
        return $module['access'] === 'admin' || $activeAdminRole === 'executive';
    });
@endphp

@section('content')
<main class="admin-container">
    <div class="admin-page-shell">
        <aside class="admin-card admin-sidebar">
            <span class="admin-kicker">Backoffice</span>
            <h2 style="margin-top: 14px;">Menu Admin</h2>
            <p style="margin-top: 10px;">Panel ini dipakai untuk memantau modul website SCI-TOS dan sekarang sudah punya kontrol classroom langsung.</p>

            <ul class="admin-menu">
                <li><a href="#overview">Dashboard <small>{{ $openModules->count() }} aktif</small></a></li>
                <li><a href="#classroom-control">Classroom Control <small>{{ $customClassroomTasks->count() }} custom</small></a></li>
                <li><a href="#roles">Role Admin <small>{{ data_get($authUser, 'admin_label') }}</small></a></li>
                <li><a href="#modules">Feature Access <small>{{ $activeAdminRole === 'executive' ? 'Full' : 'Limited' }}</small></a></li>
            </ul>
        </aside>

        <section class="admin-card admin-main-panel">
            <div class="admin-head" id="overview">
                <div>
                    <span class="admin-kicker">SCI-TOS Admin Panel</span>
                    <h1>Dashboard {{ data_get($authUser, 'admin_label', 'Admin') }}</h1>
                    <p>{{ data_get($activeRoleConfig, 'summary') }}</p>
                </div>

                <span class="admin-role-badge {{ $activeAdminRole === 'executive' ? 'is-executive' : '' }}">
                    {{ data_get($authUser, 'admin_label', 'Admin') }}
                </span>
            </div>

            <div class="admin-stat-grid">
                <div class="admin-card admin-stat-card">
                    <strong>{{ $openModules->count() }}</strong>
                    <span>Modul yang bisa diakses sekarang</span>
                </div>
                <div class="admin-card admin-stat-card">
                    <strong>{{ $allClassroomTasks->count() }}</strong>
                    <span>Total item classroom</span>
                </div>
                <div class="admin-card admin-stat-card">
                    <strong>{{ count(data_get($activeRoleConfig, 'permissions', [])) }}</strong>
                    <span>Hak akses pada level ini</span>
                </div>
            </div>

            <div class="admin-section" id="classroom-control">
                <h3>Classroom Control Center</h3>
                <div class="admin-two-col">
                    <div class="admin-card admin-role-card">
                        <span class="admin-kicker">Buat Tugas Baru</span>
                        <p style="margin-top: 14px;">Admin bisa menambahkan tugas berbentuk teks, tugas dengan file, dan khusus executive admin bisa membuat quiz dengan skor.</p>

                        <form action="{{ route('admin.classroom.store') }}" method="post" enctype="multipart/form-data" class="admin-form-grid" style="margin-top: 20px;">
                            @csrf

                            <div class="admin-field">
                                <label for="title">Judul Tugas</label>
                                <input id="title" name="title" type="text" class="admin-input" value="{{ old('title') }}" placeholder="Contoh: Quiz Dasar UI Classroom">
                                @error('title')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="admin-field">
                                <label for="division">Divisi</label>
                                <select id="division" name="division">
                                    <option value="">Pilih divisi</option>
                                    @foreach ($divisionOptions as $division)
                                        <option value="{{ $division }}" @selected(old('division') === $division)>{{ $division }}</option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="admin-field">
                                <label for="task_type">Tipe Tugas</label>
                                <select id="task_type" name="task_type">
                                    <option value="text" @selected(old('task_type') === 'text')>Hanya Teks</option>
                                    <option value="material" @selected(old('task_type') === 'material')>Teks + File</option>
                                    @if ($activeAdminRole === 'executive')
                                        <option value="quiz" @selected(old('task_type') === 'quiz')>Quiz dengan Skor</option>
                                    @endif
                                </select>
                                @error('task_type')
                                    <span class="admin-error">{{ $message }}</span>
                                @else
                                    <span class="admin-helper">{{ $activeAdminRole === 'executive' ? 'Executive admin bisa membuat quiz dengan skor.' : 'Admin biasa bisa membuat tugas teks dan tugas dengan file.' }}</span>
                                @enderror
                            </div>

                            <div class="admin-field">
                                <label for="topic">Topik</label>
                                <input id="topic" name="topic" type="text" class="admin-input" value="{{ old('topic') }}" placeholder="Contoh: Weekly Review">
                                @error('topic')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="admin-field">
                                <label for="due_date">Tanggal Deadline</label>
                                <input id="due_date" name="due_date" type="date" class="admin-input" value="{{ old('due_date') }}">
                                @error('due_date')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="admin-field">
                                <label for="score">Skor Quiz</label>
                                <input id="score" name="score" type="number" min="1" max="1000" class="admin-input" value="{{ old('score') }}" placeholder="{{ $activeAdminRole === 'executive' ? 'Contoh: 100' : 'Executive only' }}" {{ $activeAdminRole !== 'executive' ? 'disabled' : '' }}>
                                @error('score')
                                    <span class="admin-error">{{ $message }}</span>
                                @else
                                    <span class="admin-helper">{{ $activeAdminRole === 'executive' ? 'Isi jika tipe tugas adalah quiz.' : 'Skor hanya aktif untuk executive admin.' }}</span>
                                @enderror
                            </div>

                            <div class="admin-field is-full">
                                <label for="description">Deskripsi Tugas</label>
                                <textarea id="description" name="description" placeholder="Masukkan instruksi tugas, materi, atau deskripsi quiz...">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="admin-field is-full">
                                <label for="attachment">Lampiran File</label>
                                <input id="attachment" name="attachment" type="file" class="admin-input" accept=".pdf,.png,.jpg,.jpeg,.webp,.mp4,.mov,.webm,.doc,.docx,.ppt,.pptx">
                                @error('attachment')
                                    <span class="admin-error">{{ $message }}</span>
                                @else
                                    <span class="admin-helper">Bisa berupa PDF, foto, video, atau dokumen lain. Jika tidak ada file, tugas tetap bisa dipublikasikan sebagai teks.</span>
                                @enderror
                            </div>

                            <div class="admin-field is-full">
                                <button type="submit" class="admin-btn admin-btn-primary">Publikasikan ke Classroom</button>
                            </div>
                        </form>
                    </div>

                    <div class="admin-card admin-role-card">
                        <span class="admin-kicker">Preview Stream</span>
                        <p style="margin-top: 14px;">Task yang Anda tambahkan dari panel ini langsung masuk ke stream classroom prototype pada sesi aktif saat ini.</p>

                        <div class="admin-stream-list" style="margin-top: 20px;">
                            @forelse ($customClassroomTasks as $task)
                                <article class="admin-stream-item">
                                    <strong>{{ $task['title'] }}</strong>
                                    <p>{{ $task['summary'] }}</p>
                                    <div class="admin-stream-meta">
                                        <span>{{ ucfirst($task['task_type']) }}</span>
                                        <span>{{ $task['division'] }}</span>
                                        @if (! empty($task['score']))
                                            <span>{{ $task['score'] }} pts</span>
                                        @endif
                                        @if (! empty($task['attachments']))
                                            <span>{{ count($task['attachments']) }} lampiran</span>
                                        @endif
                                    </div>
                                </article>
                            @empty
                                <article class="admin-stream-item">
                                    <strong>Belum ada tugas custom</strong>
                                    <p>Tugas yang dibuat lewat panel admin akan muncul di sini lalu otomatis ikut tampil di halaman classroom.</p>
                                </article>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-section" id="roles">
                <h3>Role Admin</h3>
                <div class="admin-role-grid">
                    @foreach ($adminRoles as $key => $roleConfig)
                        <div class="admin-card admin-role-card {{ $key === 'executive' ? 'is-executive' : '' }}">
                            <span class="admin-kicker">{{ $roleConfig['label'] }}</span>
                            <p style="margin-top: 14px;">{{ $roleConfig['summary'] }}</p>
                            <ul>
                                @foreach ($roleConfig['permissions'] as $permission)
                                    <li>{{ $permission }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="admin-section" id="modules">
                <h3>Feature Access</h3>
                <div class="admin-module-grid">
                    @foreach ($modules as $module)
                        @php
                            $isOpen = $module['access'] === 'admin' || $activeAdminRole === 'executive';
                        @endphp
                        <div class="admin-card admin-module-card">
                            <div style="display: flex; justify-content: space-between; gap: 16px; align-items: flex-start;">
                                <div>
                                    <span class="admin-kicker">{{ $module['access'] === 'executive' ? 'Executive Only' : 'Admin Access' }}</span>
                                    <h3 style="margin-top: 12px;">{{ $module['title'] }}</h3>
                                </div>
                                <span class="admin-access {{ $isOpen ? 'is-open' : 'is-restricted' }}">
                                    {{ $isOpen ? 'Available' : 'Restricted' }}
                                </span>
                            </div>

                            <p>{{ $module['summary'] }}</p>

                            <div class="admin-module-meta">
                                @foreach ($module['tags'] as $tag)
                                    <span class="admin-tag">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <ul>
                                <li>{{ $isOpen ? 'Modul ini bisa dibuka pada level akses Anda.' : 'Modul ini hanya dibuka untuk executive admin.' }}</li>
                                <li>{{ $module['access'] === 'executive' ? 'Dipakai untuk kontrol penuh dan pengaturan inti website.' : 'Dipakai untuk pemantauan operasional dan fitur spesial yang sudah diizinkan.' }}</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
