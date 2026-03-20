<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScitosAuthController extends Controller
{
    public function show(Request $request): View
    {
        $scitos = config('scitos');
        $selectedRole = $request->string('role')->lower()->value() === 'admin' ? 'admin' : 'member';

        return view('scitos.pages.login', [
            'scitos' => $scitos,
            'pageKey' => 'login',
            'pageTitle' => 'Login SCI-TOS | SMAN 4 Bekasi',
            'pageDescription' => data_get($scitos, 'meta.default_description'),
            'selectedRole' => old('role', $selectedRole),
            'selectedAdminRole' => old('admin_role', 'admin'),
            'adminRoles' => data_get($scitos, 'auth.admin_roles', []),
            'authUser' => $request->session()->get('scitos_auth'),
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $role = $request->input('role') === 'admin' ? 'admin' : 'member';

        if ($role === 'admin') {
            $validated = $request->validate([
                'role' => ['required', 'in:member,admin'],
                'admin_role' => ['required', 'in:admin,executive'],
                'identifier' => ['required', 'string', 'max:100'],
                'password' => ['required', 'string', 'max:100'],
            ]);

            $adminRole = $validated['admin_role'];
            $roleConfig = data_get(config('scitos'), "auth.admin_roles.{$adminRole}");

            if (
                $validated['identifier'] !== data_get($roleConfig, 'username')
                || $validated['password'] !== data_get($roleConfig, 'password')
            ) {
                return back()
                    ->withErrors([
                        'identifier' => 'Akun admin atau access key belum sesuai.',
                    ])
                    ->withInput($request->except('password'));
            }

            $request->session()->put('scitos_auth', [
                'role' => 'admin',
                'admin_role' => $adminRole,
                'admin_label' => data_get($roleConfig, 'label'),
                'name' => data_get($roleConfig, 'display_name'),
                'identifier' => $validated['identifier'],
            ]);

            return redirect()
                ->route('home')
                ->with('status', data_get($roleConfig, 'label') . ' aktif. Floating panel admin siap digunakan dari beranda.');
        }

        $validated = $request->validate([
            'role' => ['required', 'in:member,admin'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'interest' => ['nullable', 'string', 'max:100'],
        ]);

        $request->session()->put('scitos_auth', [
            'role' => 'member',
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'interest' => $validated['interest'] ?? null,
        ]);

        return redirect()
            ->route('home')
            ->with('status', 'Login anggota berhasil. Classroom dan fitur personal SCI-TOS siap dipakai.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('scitos_auth');

        return redirect()
            ->route('home')
            ->with('status', 'Sesi SCI-TOS berhasil diakhiri.');
    }
}
