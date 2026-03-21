@extends('layouts.scitos')

@php
    $authUser = session('scitos_auth');
    $steps = data_get($scitos, 'classroom.steps', []);
    $baseTasks = collect(data_get($scitos, 'classroom.tasks', []));
    $customTasks = collect(session('scitos_classroom.custom_tasks', []));
    $tasks = $customTasks->concat($baseTasks)->values();
    $tasksByTopic = $tasks->groupBy(fn ($task) => $task['topic'] ?? 'General');
    $attachmentCount = $tasks->sum(fn ($task) => count($task['attachments'] ?? []));
    $quizCount = $tasks->where('task_type', 'quiz')->count();
    $materialCount = $tasks->where('task_type', 'material')->count();
    $textCount = $tasks->where('task_type', 'text')->count();
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">SCI-TOS Classroom</div>
        <h1 class="hero-title">Classroom dengan pola visual seperti ruang kelas digital modern.</h1>
        <p class="hero-desc">
            {{ data_get($scitos, 'classroom.summary') }}
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ $tasks->count() }}</strong>
                <span>Tugas dan materi aktif</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $attachmentCount }}</strong>
                <span>Lampiran tugas</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $authUser ? 'Masuk' : 'Guest' }}</strong>
                <span>Status pengguna</span>
            </div>
        </div>
    </section>

    <section class="section container classroom-app">
        <div class="classroom-banner classroom-surface">
            <div>
                <span class="classroom-badge">{{ data_get($scitos, 'classroom.class_code') }}</span>
                <h2>{{ data_get($scitos, 'classroom.class_title') }}</h2>
                <p>{{ data_get($scitos, 'classroom.class_subtitle') }}</p>
            </div>
            <div class="classroom-banner-meta">
                <div>
                    <strong>Pembina</strong>
                    <span>{{ data_get($scitos, 'classroom.teacher') }}</span>
                </div>
                <div>
                    <strong>Koordinator</strong>
                    <span>{{ data_get($scitos, 'classroom.coordinator_label') }}</span>
                </div>
            </div>
        </div>

        <div class="classroom-layout-overview">
            <div class="classroom-surface classroom-overview-card">
                <span class="classroom-badge">Workspace Tugas</span>
                <h3>Stream utama untuk membaca update, materi, dan agenda divisi.</h3>
                <p>Tampilan ini dirancang seperti Google Classroom: fokus ke banner kelas, stream yang rapi, topik classwork, dan panel people tanpa terasa berat.</p>
            </div>
            <div class="classroom-surface classroom-overview-card">
                <span class="classroom-badge">Task Board</span>
                <h3>{{ $materialCount }} material, {{ $textCount }} tugas teks, {{ $quizCount }} quiz aktif.</h3>
                <p>Admin dapat mempublikasikan tugas baru dari panel admin. Executive Admin juga bisa membuat quiz berskor untuk evaluasi anggota.</p>
            </div>
        </div>

        <div class="classroom-tabs">
            <a href="#stream" class="classroom-tab is-active">Stream</a>
            <a href="#classwork" class="classroom-tab">Classwork</a>
            <a href="#people" class="classroom-tab">People</a>
        </div>

        <div class="classroom-layout">
            <aside class="classroom-sidebar">
                <div class="classroom-surface classroom-side-card">
                    <strong>Kode Kelas</strong>
                    <h3>{{ data_get($scitos, 'classroom.class_code') }}</h3>
                    <p>Bagikan kode ini untuk menandai identitas utama classroom SCI-TOS.</p>
                </div>

                <div class="classroom-surface classroom-side-card">
                    <strong>Pengumuman</strong>
                    <p>{{ data_get($scitos, 'classroom.announcement') }}</p>
                </div>

                <div class="classroom-surface classroom-side-card">
                    <strong>Ringkasan Tipe Tugas</strong>
                    <ul class="classroom-mini-list">
                        <li>Text task untuk instruksi singkat.</li>
                        <li>Material task untuk tugas dengan lampiran file.</li>
                        <li>Quiz task dengan skor untuk evaluasi.</li>
                    </ul>
                </div>

                <div class="classroom-surface classroom-side-card">
                    <strong>Upcoming</strong>
                    <ul class="classroom-mini-list">
                        @foreach ($tasks->take(3) as $task)
                            <li>
                                <span>{{ $task['title'] }}</span>
                                <small>{{ $task['deadline'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="classroom-surface classroom-side-card">
                    <strong>Alur Belajar</strong>
                    <ul class="classroom-mini-list">
                        @foreach ($steps as $step)
                            <li>
                                <span>{{ $step['title'] }}</span>
                                <small>{{ $step['description'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (! $authUser)
                    <div class="classroom-surface classroom-side-card">
                        <strong>Masuk untuk lanjut</strong>
                        <p>Login anggota untuk pengalaman classroom yang lebih personal, atau login admin untuk menambah tugas lewat panel admin.</p>
                        <div class="section-actions" style="justify-content: flex-start; margin-top: 16px;">
                            <a href="{{ route('login', ['role' => 'member']) }}" class="btn btn-primary">Login Anggota</a>
                            <a href="{{ route('login', ['role' => 'admin']) }}" class="btn btn-secondary">Login Admin</a>
                        </div>
                    </div>
                @endif
            </aside>

            <div class="classroom-main">
                <section id="stream" class="classroom-stream">
                    <div class="classroom-surface stream-composer">
                        <div class="stream-composer-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M12 4h9"></path>
                                <path d="M4 9h16"></path>
                                <path d="M4 15h16"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Stream SCI-TOS</strong>
                            <p>{{ $tasks->count() }} tugas, materi, dan quiz tampil dalam alur kelas yang lebih mudah dibaca seperti Google Classroom. Setiap posting memuat topik, deadline, skor, dan lampiran bila tersedia.</p>
                        </div>
                    </div>

                    <div class="stream-list">
                        @foreach ($tasks as $task)
                            @php
                                $typeLabel = match ($task['task_type'] ?? 'text') {
                                    'quiz' => 'Quiz',
                                    'material' => 'Material',
                                    default => 'Text Task',
                                };
                                $typeIcon = match ($task['task_type'] ?? 'text') {
                                    'quiz' => 'Q',
                                    'material' => 'M',
                                    default => 'T',
                                };
                            @endphp
                            <article class="classroom-surface stream-card">
                                <div class="stream-card-head">
                                    <div class="stream-card-icon">{{ $typeIcon }}</div>
                                    <div>
                                        <span class="stream-card-type">{{ $typeLabel }}</span>
                                        <h3>{{ $task['title'] }}</h3>
                                        <p>{{ $task['division'] }} • {{ $task['coordinator'] }}</p>
                                    </div>
                                </div>

                                <p class="stream-card-desc">{{ $task['summary'] }}</p>

                                <div class="stream-card-meta">
                                    <span>{{ $task['topic'] }}</span>
                                    <span>{{ $task['deadline'] }}</span>
                                    @if (! empty($task['score']))
                                        <span>Skor {{ $task['score'] }}</span>
                                    @endif
                                </div>

                                @if (! empty($task['attachments']))
                                    <div class="stream-attachments">
                                        @foreach ($task['attachments'] as $attachment)
                                            @php
                                                $isDisabled = blank($attachment['path'] ?? null) || ($attachment['path'] ?? null) === '#';
                                            @endphp
                                            @if ($isDisabled)
                                                <span class="attachment-chip is-disabled">{{ $attachment['type'] }} • {{ $attachment['label'] }}</span>
                                            @else
                                                <a href="{{ asset($attachment['path']) }}" target="_blank" rel="noreferrer" class="attachment-chip">
                                                    {{ $attachment['type'] }} • {{ $attachment['label'] }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </section>

                <section id="classwork" class="classroom-classwork">
                    <div class="section-header" style="margin-bottom: 28px; align-items: flex-start; text-align: left;">
                        <div class="badge">Classwork</div>
                        <h2 class="section-title" style="font-size: clamp(2rem, 4vw, 2.6rem);">Tugas dikelompokkan per topik.</h2>
                        <p class="section-desc" style="max-width: 760px;">Model ini meniru pola Google Classroom: tugas, materi, dan quiz dibaca berdasarkan topik supaya tidak terasa seperti daftar panjang yang membingungkan.</p>
                    </div>

                    <div class="classwork-topic-list">
                        @foreach ($tasksByTopic as $topic => $topicTasks)
                            <div class="classroom-surface topic-card">
                                <div class="topic-head">
                                    <div>
                                        <span class="classroom-badge">{{ $topic }}</span>
                                        <h3>{{ $topic }}</h3>
                                    </div>
                                    <span class="topic-count">{{ $topicTasks->count() }} item</span>
                                </div>

                                <div class="topic-task-grid">
                                    @foreach ($topicTasks as $task)
                                        <article class="topic-task-card">
                                            <strong>{{ $task['title'] }}</strong>
                                            <p>{{ $task['division'] }}</p>
                                            <div class="stream-card-meta">
                                                <span>{{ ucfirst($task['task_type'] ?? 'text') }}</span>
                                                @if (! empty($task['score']))
                                                    <span>{{ $task['score'] }} pts</span>
                                                @endif
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section id="people" class="classroom-people">
                    <div class="section-header" style="margin-bottom: 28px; align-items: flex-start; text-align: left;">
                        <div class="badge">People</div>
                        <h2 class="section-title" style="font-size: clamp(2rem, 4vw, 2.6rem);">Siapa yang menggerakkan classroom.</h2>
                    </div>

                    <div class="people-grid">
                        <div class="classroom-surface people-card">
                            <strong>Pembina Kelas</strong>
                            <h3>{{ data_get($scitos, 'classroom.teacher') }}</h3>
                            <p>Mengawal arah besar classroom dan pembelajaran SCI-TOS.</p>
                        </div>

                        <div class="classroom-surface people-card">
                            <strong>Koordinator Divisi</strong>
                            <h3>{{ data_get($scitos, 'classroom.coordinator_label') }}</h3>
                            <p>Mengisi stream dengan tugas, materi, review, dan quiz sesuai kebutuhan divisi.</p>
                        </div>

                        <div class="classroom-surface people-card">
                            <strong>Status Anda</strong>
                            <h3>{{ $authUser ? data_get($authUser, 'name') : 'Guest Viewer' }}</h3>
                            <p>{{ $authUser ? 'Anda sedang terhubung ke classroom SCI-TOS.' : 'Masuk untuk melihat pengalaman classroom yang lebih personal.' }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>
@endsection
