<?php

namespace Tests\Feature;

use Tests\TestCase;

class ScitosPagesTest extends TestCase
{
    public function test_public_pages_return_successful_response(): void
    {
        foreach (['home', 'tentang', 'prestasi', 'divisi', 'pengurus', 'gallery', 'classroom', 'gabung', 'login', 'ai-chat'] as $routeName) {
            $this->get(route($routeName))->assertOk();
        }
    }

    public function test_home_uses_route_based_navigation_links(): void
    {
        $response = $this->get(route('home'));

        foreach (['tentang', 'prestasi', 'divisi', 'pengurus', 'gallery', 'classroom', 'gabung', 'login', 'ai-chat'] as $routeName) {
            $response->assertSee('href="' . route($routeName) . '"', false);
        }
    }

    public function test_shared_assets_render_on_key_pages(): void
    {
        $home = $this->get(route('home'));
        $home->assertSee(asset(config('scitos.brand.logo')), false);

        $divisions = $this->get(route('divisi'));
        $divisions->assertSee(asset('storage/epukitg.png'), false);
        $divisions->assertSee(asset('storage/programming.png'), false);
        $divisions->assertSee('Klik untuk detail');

        $gallery = $this->get(route('gallery'));
        $gallery->assertSee(asset('storage/pdv.png'), false);
        $gallery->assertSee(asset('storage/desaingrafis.png'), false);
    }

    public function test_pages_show_expected_targeted_content(): void
    {
        $this->get(route('home'))
            ->assertSee('Mission Control')
            ->assertSee('SCI-TOS Gallery')
            ->assertSee('Classroom');

        $this->get(route('tentang'))
            ->assertSee('Makna Lambang')
            ->assertSee('Simbol yang membawa karakter SCI-TOS.');

        $this->get(route('prestasi'))
            ->assertSee('prestasi_full_log.sh')
            ->assertSee('Total pencapaian tercatat');

        $this->get(route('divisi'))
            ->assertSee('Klik untuk detail')
            ->assertSee('Koordinator Divisi');

        $this->get(route('pengurus'))
            ->assertSee('Family Tree')
            ->assertSee('Koordinator Divisi');

        $this->get(route('gallery'))
            ->assertSee('Etalase karya anggota SCI-TOS')
            ->assertSee('Koleksi Lengkap');

        $this->get(route('classroom'))
            ->assertSee('Workspace tugas')
            ->assertSee('Task Board');

        $this->get(route('login'))
            ->assertSee('Login sebagai Anggota')
            ->assertSee('Login sebagai Admin')
            ->assertSee('Executive Admin');

        $this->get(route('ai-chat'))
            ->assertSee('Tanya AI segera hadir.');
    }

    public function test_member_login_redirects_home_and_sets_session_state(): void
    {
        $response = $this->post(route('login.store'), [
            'role' => 'member',
            'name' => 'Rasya Member',
            'email' => 'member@example.test',
            'interest' => 'Programming & Jaringan',
        ]);

        $response->assertRedirect(route('home'));

        $this->withSession([
            'scitos_auth' => [
                'role' => 'member',
                'name' => 'Rasya Member',
                'email' => 'member@example.test',
                'interest' => 'Programming & Jaringan',
            ],
        ])->get(route('home'))
            ->assertOk()
            ->assertSee('Rasya Member')
            ->assertSee('Member Mode');
    }

    public function test_admin_login_enables_floating_panel_icon_and_panel_access(): void
    {
        $response = $this->post(route('login.store'), [
            'role' => 'admin',
            'admin_role' => 'admin',
            'identifier' => config('scitos.auth.admin_roles.admin.username'),
            'password' => config('scitos.auth.admin_roles.admin.password'),
        ]);

        $response->assertRedirect(route('home'));

        $adminSession = [
            'scitos_auth' => [
                'role' => 'admin',
                'admin_role' => 'admin',
                'admin_label' => config('scitos.auth.admin_roles.admin.label'),
                'name' => config('scitos.auth.admin_roles.admin.display_name'),
                'identifier' => config('scitos.auth.admin_roles.admin.username'),
            ],
        ];

        $this->withSession($adminSession)
            ->get(route('home'))
            ->assertOk()
            ->assertSee('href="' . route('admin.panel') . '"', false);

        $this->withSession($adminSession)
            ->get(route('admin.panel'))
            ->assertOk()
            ->assertSee('Dashboard Admin Biasa')
            ->assertSee('Restricted');
    }

    public function test_executive_admin_gets_full_admin_panel_access(): void
    {
        $response = $this->post(route('login.store'), [
            'role' => 'admin',
            'admin_role' => 'executive',
            'identifier' => config('scitos.auth.admin_roles.executive.username'),
            'password' => config('scitos.auth.admin_roles.executive.password'),
        ]);

        $response->assertRedirect(route('home'));

        $executiveSession = [
            'scitos_auth' => [
                'role' => 'admin',
                'admin_role' => 'executive',
                'admin_label' => config('scitos.auth.admin_roles.executive.label'),
                'name' => config('scitos.auth.admin_roles.executive.display_name'),
                'identifier' => config('scitos.auth.admin_roles.executive.username'),
            ],
        ];

        $this->withSession($executiveSession)
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Executive Admin');

        $this->withSession($executiveSession)
            ->get(route('admin.panel'))
            ->assertOk()
            ->assertSee('Dashboard Executive Admin')
            ->assertSee('Available');
    }

    public function test_admin_panel_redirects_guests_to_admin_login(): void
    {
        $this->get(route('admin.panel'))
            ->assertRedirect(route('login', ['role' => 'admin']));
    }
}
