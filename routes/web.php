<?php

use App\Http\Controllers\ScitosAuthController;
use App\Http\Controllers\ScitosAdminController;
use Illuminate\Support\Facades\Route;

$scitos = config('scitos');

$pageData = function (string $pageKey, string $pageTitle, ?string $pageDescription = null, array $extra = []) use ($scitos): array {
    return array_merge([
        'scitos' => $scitos,
        'pageKey' => $pageKey,
        'pageTitle' => $pageTitle,
        'pageDescription' => $pageDescription ?? data_get($scitos, 'meta.default_description'),
    ], $extra);
};

$renderPage = function (string $view, string $pageKey, string $pageTitle, ?string $pageDescription = null, array $extra = []) use ($pageData) {
    return function () use ($view, $pageKey, $pageTitle, $pageDescription, $extra, $pageData) {
        return view($view, $pageData($pageKey, $pageTitle, $pageDescription, $extra));
    };
};

Route::get('/', $renderPage('scitos.pages.home', 'home', 'SCI-TOS | SMAN 4 Bekasi'))->name('home');
Route::get('/tentang', $renderPage('scitos.pages.tentang', 'tentang', 'Tentang SCI-TOS | SMAN 4 Bekasi'))->name('tentang');
Route::get('/prestasi', $renderPage('scitos.pages.prestasi', 'prestasi', 'Prestasi SCI-TOS | SMAN 4 Bekasi'))->name('prestasi');
Route::get('/divisi', $renderPage('scitos.pages.divisi', 'divisi', 'Divisi SCI-TOS | SMAN 4 Bekasi'))->name('divisi');
Route::get('/pengurus', $renderPage('scitos.pages.pengurus', 'pengurus', 'Pengurus SCI-TOS | SMAN 4 Bekasi'))->name('pengurus');
Route::get('/gallery', $renderPage('scitos.pages.gallery', 'gallery', 'SCI-TOS Gallery | SMAN 4 Bekasi'))->name('gallery');
Route::get('/classroom', $renderPage('scitos.pages.classroom', 'classroom', 'SCI-TOS Classroom | SMAN 4 Bekasi'))->name('classroom');
Route::get('/gabung', $renderPage('scitos.pages.gabung', 'gabung', 'Gabung SCI-TOS | SMAN 4 Bekasi'))->name('gabung');

Route::get('/login', [ScitosAuthController::class, 'show'])->name('login');
Route::post('/login', [ScitosAuthController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [ScitosAuthController::class, 'logout'])->name('logout');
Route::post('/admin/classroom/tasks', [ScitosAdminController::class, 'storeClassroomTask'])->name('admin.classroom.store');

Route::get(
    '/admin/panel',
    function () use ($pageData) {
        if (data_get(session('scitos_auth'), 'role') !== 'admin') {
            return redirect()
                ->route('login', ['role' => 'admin'])
                ->with('status', 'Masuk sebagai admin untuk membuka panel admin SCI-TOS.');
        }

        return view(
            'scitos.pages.admin-panel',
            $pageData(
                'admin-panel',
                'Panel Admin SCI-TOS | SMAN 4 Bekasi',
                null,
                [
                    'comingBadge' => data_get(config('scitos'), 'placeholders.admin_panel.badge'),
                    'comingTitle' => data_get(config('scitos'), 'placeholders.admin_panel.title'),
                    'comingDescription' => data_get(config('scitos'), 'placeholders.admin_panel.description'),
                ]
            )
        );
    }
)->name('admin.panel');

Route::get(
    '/ai-chat',
    $renderPage(
        'scitos.pages.coming-soon',
        'ai-chat',
        'Tanya AI SCI-TOS | SMAN 4 Bekasi',
        null,
        [
            'comingBadge' => data_get($scitos, 'placeholders.ai_chat.badge'),
            'comingTitle' => data_get($scitos, 'placeholders.ai_chat.title'),
            'comingDescription' => data_get($scitos, 'placeholders.ai_chat.description'),
        ]
    )
)->name('ai-chat');
