@extends('layouts.scitos')

@php
    $authUser = session('scitos_auth');
    $steps = data_get($scitos, 'classroom.steps', []);
    $tasks = collect(data_get($scitos, 'classroom.tasks', []));
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">SCI-TOS Classroom</div>
        <h1 class="hero-title">Workspace tugas dari koordinator divisi untuk anggota SCI-TOS.</h1>
        <p class="hero-desc">
            {{ data_get($scitos, 'classroom.summary') }}
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ $tasks->count() }}</strong>
                <span>Tugas aktif</span>
            </div>
            <div class="cyber-card">
                <strong>{{ count($steps) }}</strong>
                <span>Tahap workflow</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $authUser ? 'Aktif' : 'Perlu login' }}</strong>
                <span>Status akses pengguna</span>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="classroom-grid">
            <div class="workflow-stack">
                @foreach ($steps as $step)
                    <div class="cyber-card task-card">
                        <span class="journey-step">{{ $step['title'] }}</span>
                        <p style="margin-top: 12px;">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="workflow-stack">
                @if (! $authUser)
                    <div class="cyber-card task-card">
                        <h3>Akses classroom dimulai dari login.</h3>
                        <p>Masuk sebagai anggota untuk mengerjakan tugas divisi, atau sebagai admin untuk memantau pengembangan sistem classroom dan panel internal.</p>
                        <div class="section-actions" style="justify-content: flex-start; margin-top: 20px;">
                            <a href="{{ route('login', ['role' => 'member']) }}" class="btn btn-primary">Login sebagai Anggota</a>
                            <a href="{{ route('login', ['role' => 'admin']) }}" class="btn btn-secondary">Login sebagai Admin</a>
                        </div>
                    </div>
                @else
                    <div class="cyber-card task-card">
                        <h3>{{ data_get($authUser, 'role') === 'admin' ? data_get($authUser, 'admin_label', 'Mode Admin Aktif') : 'Dashboard Anggota Aktif' }}</h3>
                        <p>
                            {{ data_get($authUser, 'role') === 'admin'
                                ? 'Anda sedang melihat classroom sebagai admin. Floating settings di kanan bawah bisa dipakai untuk masuk ke panel admin sesuai level akses Anda.'
                                : 'Anda sudah masuk sebagai anggota. Gunakan halaman ini untuk memantau tugas-tugas dari koordinator divisi.' }}
                        </p>
                        <div class="task-meta">
                            <span>{{ data_get($authUser, 'name') }}</span>
                            <span>{{ data_get($authUser, 'role') === 'admin' ? data_get($authUser, 'admin_label', 'Admin') : 'Anggota' }}</span>
                            @if (data_get($authUser, 'interest'))
                                <span>{{ data_get($authUser, 'interest') }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="cyber-card task-card">
                    <h3>Task Signals</h3>
                    <p>Classroom dibangun agar koordinator bisa membagikan challenge mingguan, sementara anggota lebih mudah mengikuti ritme belajar yang konsisten.</p>
                    <div class="task-meta">
                        <span>{{ $tasks->where('status', 'Priority')->count() }} Priority</span>
                        <span>{{ $tasks->where('status', 'Open')->count() }} Open</span>
                        <span>{{ $tasks->where('status', 'Weekly')->count() }} Weekly</span>
                        <span>{{ $tasks->where('status', 'Review')->count() }} Review</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="section-header">
            <div class="badge">Task Board</div>
            <h2 class="section-title">Briefing tugas dari koordinator divisi.</h2>
            <p class="section-desc">Board ini masih tahap awal, namun struktur tugas, status, dan identitas koordinator sudah mulai disiapkan untuk pengembangan classroom berikutnya.</p>
        </div>

        <div class="gallery-grid">
            @foreach ($tasks as $task)
                <div class="cyber-card task-card">
                    <div class="task-head">
                        <div>
                            <h3>{{ $task['title'] }}</h3>
                            <p>{{ $task['summary'] }}</p>
                        </div>
                        <span class="task-status task-status-{{ \Illuminate\Support\Str::slug($task['status']) }}">{{ $task['status'] }}</span>
                    </div>
                    <div class="task-meta">
                        <span>{{ $task['division'] }}</span>
                        <span>{{ $task['deadline'] }}</span>
                        <span>{{ $task['format'] }}</span>
                    </div>
                    <p>Koordinator: {{ $task['coordinator'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection
