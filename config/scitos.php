<?php

return [
    'brand' => [
        'name' => 'SCI-TOS',
        'subtitle' => 'Science and Technology of SMAN 4 Bekasi',
        'tagline' => 'Rasa ingin tahu, riset, dan kreasi digital.',
        'logo' => 'storage/logoscitos.png',
        'location' => 'Lab Komputer SMAN 4 Bekasi',
        'instagram' => 'https://instagram.com/sci_tos/',
        'tiktok' => '#',
        'youtube' => '#',
    ],

    'meta' => [
        'default_title' => 'SCI-TOS | SMAN 4 Bekasi',
        'default_description' => 'Website profil SCI-TOS, ekstrakurikuler gabungan sains dan teknologi di SMAN 4 Bekasi.',
    ],

    'auth' => [
        'note' => 'Mode admin masih memakai login prototype berbasis session, namun sudah dibagi menjadi admin biasa dan executive admin.',
        'admin_roles' => [
            'admin' => [
                'label' => 'Admin Biasa',
                'username' => env('SCITOS_ADMIN_USERNAME', 'admin'),
                'password' => env('SCITOS_ADMIN_PASSWORD', 'scitos-admin'),
                'display_name' => 'SCI-TOS Admin',
                'summary' => 'Akses beberapa fitur spesial seperti monitoring classroom, gallery, dan ringkasan konten.',
                'permissions' => [
                    'Melihat dashboard admin dan statistik umum.',
                    'Memantau classroom, gallery, dan ringkasan website.',
                    'Mengakses fitur spesial yang sudah dibuka untuk admin biasa.',
                ],
            ],
            'executive' => [
                'label' => 'Executive Admin',
                'username' => env('SCITOS_EXECUTIVE_ADMIN_USERNAME', 'executive'),
                'password' => env('SCITOS_EXECUTIVE_ADMIN_PASSWORD', 'scitos-executive'),
                'display_name' => 'SCI-TOS Executive Admin',
                'summary' => 'Akses penuh untuk mengatur seluruh fitur website, modul admin, classroom, gallery, dan konten utama.',
                'permissions' => [
                    'Mengatur seluruh fitur dan modul website.',
                    'Mengelola classroom, gallery, divisi, pengurus, dan konten beranda.',
                    'Membuka dan mengatur seluruh fitur spesial admin.',
                ],
            ],
        ],
    ],

    'quick_facts' => [
        ['label' => 'Berdiri Resmi', 'value' => '24 Agustus 2019'],
        ['label' => 'Lokasi', 'value' => 'Lab Komputer SMAN 4 Bekasi'],
        ['label' => 'Divisi Aktif', 'value' => '9 Divisi'],
        ['label' => 'Karakter', 'value' => 'Universal, edukatif, mandiri'],
    ],

    'highlights' => [
        [
            'eyebrow' => 'Research Loop',
            'title' => 'Belajar dengan ritme seperti tim produk.',
            'description' => 'Anggota SCI-TOS dibiasakan mengamati isu, menguji ide, lalu mengubahnya menjadi karya yang siap dipresentasikan atau dilombakan.',
            'tags' => ['Riset', 'Eksperimen', 'Problem Solving'],
        ],
        [
            'eyebrow' => 'Creative Production',
            'title' => 'Sains dan media berjalan dalam sistem yang sama.',
            'description' => 'Divisi visual, audio, dan dokumentasi membantu karya ilmiah maupun teknologi tampil lebih kuat dan komunikatif.',
            'tags' => ['Design', 'Video', 'Audio'],
        ],
        [
            'eyebrow' => 'Competition Ready',
            'title' => 'Tumbuh lewat proyek nyata dan arena kompetisi.',
            'description' => 'Setiap divisi dibangun agar siap masuk ke lomba, showcase sekolah, dan tantangan digital dengan standar kerja yang rapi.',
            'tags' => ['Olimpiade', 'Poster', 'Debat'],
        ],
        [
            'eyebrow' => 'Mentoring Mode',
            'title' => 'Koordinator divisi memimpin seperti mentor.',
            'description' => 'Classroom, briefing, review, dan eksperimen mingguan akan dirancang untuk membuat proses belajar lebih terarah.',
            'tags' => ['Classroom', 'Review', 'Team Growth'],
        ],
    ],

    'journey' => [
        [
            'step' => '01',
            'title' => 'Observe',
            'description' => 'Memetakan isu, minat, dan peluang karya dari bidang sains maupun teknologi.',
        ],
        [
            'step' => '02',
            'title' => 'Prototype',
            'description' => 'Mengolah ide menjadi eksperimen, desain, konten, sistem, atau presentasi awal.',
        ],
        [
            'step' => '03',
            'title' => 'Refine',
            'description' => 'Menerima masukan dari koordinator, menyempurnakan detail, dan meningkatkan kualitas output.',
        ],
        [
            'step' => '04',
            'title' => 'Launch',
            'description' => 'Membawa hasil kerja ke lomba, galeri karya, dokumentasi kegiatan, dan showcase organisasi.',
        ],
    ],

    'history' => [
        [
            'label' => '24 Agustus 2019',
            'title' => 'Awal Berdiri Resmi',
            'description' => 'SCI-TOS diresmikan dan berpusat di Lab Komputer SMAN 4 Bekasi sebagai ruang riset, eksplorasi, dan produksi karya.',
        ],
        [
            'label' => 'Visi & Misi',
            'title' => 'Menyatukan Talenta',
            'description' => 'Menghubungkan sains dan teknologi agar ide, bakat, dan pemikiran siswa tumbuh dalam sistem organik yang saling menguatkan.',
        ],
        [
            'label' => 'Hari Ini',
            'title' => '9 Divisi Aktif',
            'description' => 'SCI-TOS berkembang menjadi ekosistem yang menampung riset, media, teknologi terapan, hingga kompetisi digital.',
        ],
    ],

    'emblems' => [
        [
            'title' => 'Abu-abu gelap',
            'description' => 'Melambangkan kecerdasan, kekuatan, dan kemakmuran sebagai pondasi SCI-TOS.',
            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>',
        ],
        [
            'title' => 'Delapan lingkaran',
            'description' => 'Menandai bulan kelahiran SCI-TOS, yaitu bulan ke-8 pada Agustus.',
            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="12" y1="2" x2="12" y2="8"></line><line x1="12" y1="16" x2="12" y2="22"></line><line x1="2" y1="12" x2="8" y2="12"></line><line x1="16" y1="12" x2="22" y2="12"></line></svg>',
        ],
        [
            'title' => 'Sirkuit motherboard',
            'description' => 'Menggambarkan organisasi yang menyatukan bakat dan pemikiran menjadi satu sistem besar.',
            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>',
        ],
        [
            'title' => 'Petir dalam lingkaran',
            'description' => 'Melambangkan energi yang terus hidup, tanpa batas, sekaligus identitas SMAN 4 Bekasi.',
            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>',
        ],
    ],

    'achievements' => [
        'Juara Harapan I FLS2N tingkat Kab/Kota',
        'Juara I Lomba Poster tingkat SMA TFC 20',
        'Juara I Video Reels Instagram terbaik UHAMKA 2022',
        'Juara Favorite Lunar New Year 2023 Photo Competition',
        'Juara I Lomba Cerdas Cermat SCIACTION SMAN 61 Jakarta 2023',
        'Medali Emas Olimpiade Nasional Sains dan Kedokteran 2023 Braindicator',
        'Juara Harapan I Lomba Foto HUT Kota Bekasi tingkat Pelajar 2023',
        '6 Medali Emas Olimpiade Sains Pemuda Indonesia (PCIG 2023)',
        '5 Medali Perak Olimpiade Sains Pemuda Indonesia (PCIG 2023)',
        '4 Medali Perunggu Olimpiade Sains Pemuda Indonesia (PCIG 2023)',
        'Juara Lomba Cepat Tepat Think Fast Competition 19 SMAN 1 Tambun Selatan',
        'Juara I Lomba Design Poster Ekapaksi Cup 2023 SMAN 81 Jakarta',
    ],

    'division_groups' => [
        [
            'name' => 'Science Core',
            'description' => 'Rumpun yang mengasah nalar ilmiah, analisis, riset, dan komunikasi gagasan.',
            'items' => [
                'EPUKITG',
                'Debat',
                'Penemuan & Penelitian Ilmiah (PPI)',
            ],
        ],
        [
            'name' => 'Technology Core',
            'description' => 'Rumpun yang mendorong eksplorasi teknologi, produksi media, dan inovasi digital.',
            'items' => [
                'Programming & Jaringan',
                'Robotik',
                'Photography & Videography',
                'Desain Grafis',
                'Audio',
                'Esports',
            ],
        ],
    ],

    'divisions' => [
        [
            'slug' => 'epukitg',
            'name' => 'EPUKITG',
            'group' => 'Science Core',
            'icon' => 'storage/epukitg.png',
            'summary' => 'Mengasah pengetahuan umum dan melahirkan ide inovasi tepat guna.',
            'description' => 'Divisi ini bergerak pada penguatan wawasan umum, pembacaan isu, serta perancangan solusi sederhana yang bermanfaat dan aplikatif.',
            'focus' => 'Knowledge building, isu aktual, dan karya inovasi yang relevan dengan kebutuhan sekitar.',
            'activities' => [
                'Bedah isu dan pengetahuan umum terstruktur.',
                'Ideasi produk sederhana dan tepat guna.',
                'Latihan presentasi solusi dan studi kasus.',
            ],
            'outputs' => [
                'Konsep inovasi',
                'Poster ide',
                'Presentasi cepat',
            ],
            'leaders' => [
                [
                    'name' => 'Irene Tsabitah',
                    'role' => 'Koordinator EPUKITG',
                    'badge' => 'Science Core',
                    'photo' => null,
                    'bio' => 'Mengarahkan anggota untuk berpikir luas, peka terhadap persoalan, dan mampu merancang inovasi sederhana yang bernilai guna.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'debat',
            'name' => 'Debat',
            'group' => 'Science Core',
            'icon' => 'storage/debat.png',
            'summary' => 'Melatih argumentasi, riset isu, dan public speaking yang terstruktur.',
            'description' => 'Divisi Debat membentuk cara berpikir kritis lewat latihan mosi, penyusunan argumen, penguatan data, dan pembiasaan tampil percaya diri.',
            'focus' => 'Critical thinking, public speaking, dan pengelolaan argumen berbasis isu aktual.',
            'activities' => [
                'Simulasi mosi dan sparring antar anggota.',
                'Riset data pendukung untuk pro dan kontra.',
                'Latihan rebuttal dan closing statement.',
            ],
            'outputs' => [
                'Draft argumentasi',
                'Bank isu',
                'Debate sparring session',
            ],
            'leaders' => [
                [
                    'name' => 'Safeera Alexandria Al Banna',
                    'role' => 'Koordinator Debat',
                    'badge' => 'Science Core',
                    'photo' => null,
                    'bio' => 'Fokus membina keberanian menyampaikan ide sekaligus ketajaman berpikir dalam format debat yang tertib.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'ppi',
            'name' => 'PPI',
            'group' => 'Science Core',
            'icon' => 'storage/ppi.png',
            'summary' => 'Ruang eksperimen, penemuan, dan penelitian ilmiah yang siap dikompetisikan.',
            'description' => 'PPI mengajak anggota menyusun observasi, eksperimen, hingga laporan penelitian ilmiah yang rapi dan dapat dipertanggungjawabkan.',
            'focus' => 'Metode ilmiah, eksperimen, dokumentasi data, dan presentasi riset.',
            'activities' => [
                'Perumusan masalah dan hipotesis penelitian.',
                'Eksperimen dan pencatatan data terstruktur.',
                'Penyusunan laporan dan presentasi ilmiah.',
            ],
            'outputs' => [
                'Proposal riset',
                'Laporan penelitian',
                'Presentasi ilmiah',
            ],
            'leaders' => [
                [
                    'name' => 'Nadzifah Alya Hermawan',
                    'role' => 'Koordinator PPI',
                    'badge' => 'Science Core',
                    'photo' => null,
                    'bio' => 'Mendorong budaya riset yang sistematis, teliti, dan siap dikembangkan menjadi karya ilmiah kompetitif.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'programming-jaringan',
            'name' => 'Programming & Jaringan',
            'group' => 'Technology Core',
            'icon' => 'storage/programming.png',
            'summary' => 'Menjelajahi coding, logika sistem, dan dasar jaringan komputer.',
            'description' => 'Divisi ini menjadi pintu masuk untuk memahami pemrograman, perancangan antarmuka, logika komputasi, serta pengenalan infrastruktur jaringan.',
            'focus' => 'Web development, logika program, automasi sederhana, dan dasar konektivitas jaringan.',
            'activities' => [
                'Latihan HTML, CSS, dan logika pemrograman.',
                'Studi dasar topologi dan troubleshooting jaringan.',
                'Membangun mini project digital dan landing page.',
            ],
            'outputs' => [
                'Mini website',
                'Dokumen flow sistem',
                'Troubleshooting checklist',
            ],
            'leaders' => [
                [
                    'name' => 'Restu Putra Ramadhan',
                    'role' => 'Koordinator Programming & Jaringan',
                    'badge' => 'Technology Core',
                    'photo' => null,
                    'bio' => 'Membimbing anggota membangun proyek digital yang rapi, terstruktur, dan siap berkembang dari latihan dasar ke implementasi nyata.',
                    'special_card' => true,
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                        'youtube' => null,
                        'github' => null,
                        'linkedin' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'robotik',
            'name' => 'Robotik',
            'group' => 'Technology Core',
            'icon' => 'storage/robotik.png',
            'summary' => 'Menggabungkan mekanik, elektronika, dan sistem kontrol menjadi proyek robotik.',
            'description' => 'Divisi Robotik membuka ruang bagi anggota untuk bereksperimen dengan rangkaian, mekanisme gerak, serta kontrol perangkat sederhana.',
            'focus' => 'Perakitan, logika kontrol, sensor, dan problem solving teknis.',
            'activities' => [
                'Perakitan modul dan mekanik sederhana.',
                'Uji fungsi sensor atau aktuator dasar.',
                'Troubleshooting proyek robotik kecil.',
            ],
            'outputs' => [
                'Prototype alat',
                'Dokumentasi rangkaian',
                'Demo robotik',
            ],
            'leaders' => [
                [
                    'name' => 'Andhika Tedja Permana',
                    'role' => 'Koordinator Robotik',
                    'badge' => 'Technology Core',
                    'photo' => null,
                    'bio' => 'Mengarahkan eksplorasi teknik dasar dan membantu anggota menerjemahkan ide menjadi perangkat yang bisa diuji.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'pdv',
            'name' => 'Photography & Videography',
            'group' => 'Technology Core',
            'icon' => 'storage/pdv.png',
            'summary' => 'Membentuk visual storytelling lewat dokumentasi foto dan video.',
            'description' => 'PDV fokus pada pengambilan gambar, dokumentasi kegiatan, editing dasar, serta produksi konten yang merekam energi SCI-TOS dengan baik.',
            'focus' => 'Framing, storytelling visual, editing, dan dokumentasi kegiatan.',
            'activities' => [
                'Latihan foto kegiatan dan momen lapangan.',
                'Editing video reel, recap, dan highlight.',
                'Penyusunan arsip dokumentasi organisasi.',
            ],
            'outputs' => [
                'Photo set',
                'Video recap',
                'Highlight reel',
            ],
            'leaders' => [
                [
                    'name' => 'Muhammad Al-Fatikh Zidane',
                    'role' => 'Koordinator PDV',
                    'badge' => 'Technology Core',
                    'photo' => null,
                    'bio' => 'Menjaga agar momen SCI-TOS terdokumentasi dengan visual yang hidup, rapi, dan siap dipublikasikan.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'desain-grafis',
            'name' => 'Desain Grafis',
            'group' => 'Technology Core',
            'icon' => 'storage/desaingrafis.png',
            'summary' => 'Merancang identitas visual, poster, dan publikasi digital yang kuat.',
            'description' => 'Divisi ini mengolah bentuk, warna, tipografi, dan komposisi menjadi materi visual yang efektif untuk komunikasi organisasi dan kompetisi.',
            'focus' => 'Poster, branding, publikasi digital, dan visual communication.',
            'activities' => [
                'Eksplorasi layout dan tipografi poster.',
                'Pembuatan publikasi event SCI-TOS.',
                'Review desain dan perbaikan komposisi visual.',
            ],
            'outputs' => [
                'Poster lomba',
                'Feed publikasi',
                'Asset visual event',
            ],
            'leaders' => [
                [
                    'name' => 'Salva Aqilah Wibowo',
                    'role' => 'Koordinator Desain Grafis',
                    'badge' => 'Technology Core',
                    'photo' => null,
                    'bio' => 'Mengarahkan kualitas visual SCI-TOS agar tampil modern, komunikatif, dan konsisten di berbagai publikasi.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'audio',
            'name' => 'Audio',
            'group' => 'Technology Core',
            'icon' => 'storage/audio.png',
            'summary' => 'Mempelajari pengolahan suara, recording, dan kontrol audio acara.',
            'description' => 'Divisi Audio berfokus pada kualitas suara, kebutuhan teknis acara, serta proses recording dan mixing dasar untuk konten maupun kegiatan.',
            'focus' => 'Recording, monitoring, mixing, dan event sound handling.',
            'activities' => [
                'Pengenalan peralatan audio dan sinyal suara.',
                'Latihan setup microphone dan monitoring.',
                'Editing suara sederhana untuk konten.',
            ],
            'outputs' => [
                'Audio check sheet',
                'Rekaman dasar',
                'Event audio setup',
            ],
            'leaders' => [
                [
                    'name' => 'Gusti Satya Danuwangsa',
                    'role' => 'Koordinator Audio',
                    'badge' => 'Technology Core',
                    'photo' => null,
                    'bio' => 'Menjaga kualitas audio tetap stabil dan membantu anggota memahami alur teknis suara dalam kegiatan maupun produksi.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
        [
            'slug' => 'esports',
            'name' => 'Esports',
            'group' => 'Technology Core',
            'icon' => 'storage/esports.png',
            'summary' => 'Membina strategi tim, disiplin latihan, dan koordinasi kompetisi digital.',
            'description' => 'Divisi Esports mewadahi latihan kompetitif, penguatan strategi, serta evaluasi performa tim untuk beberapa game aktif SCI-TOS.',
            'focus' => 'Team discipline, strategi bermain, komunikasi tim, dan evaluasi pertandingan.',
            'activities' => [
                'Scrim internal dan review permainan.',
                'Pembagian peran dan koordinasi tim.',
                'Analisis strategi untuk Free Fire, Mobile Legends, dan PUBG.',
            ],
            'outputs' => [
                'Match review',
                'Line-up latihan',
                'Highlight pertandingan',
            ],
            'leaders' => [
                [
                    'name' => 'Wildan Hasan',
                    'role' => 'Koordinator Free Fire',
                    'badge' => 'Esports Unit',
                    'photo' => null,
                    'bio' => 'Mengatur ritme latihan dan evaluasi strategi untuk squad Free Fire SCI-TOS.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
                [
                    'name' => 'Ahmad Rizki Bianji',
                    'role' => 'Koordinator Mobile Legends',
                    'badge' => 'Esports Unit',
                    'photo' => null,
                    'bio' => 'Memimpin pengembangan teamwork dan pembacaan gameplay pada unit Mobile Legends.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
                [
                    'name' => 'Dewa Danendra Ramadhan',
                    'role' => 'Koordinator PUBG',
                    'badge' => 'Esports Unit',
                    'photo' => null,
                    'bio' => 'Berfokus pada koordinasi, positioning, dan evaluasi performa untuk unit PUBG SCI-TOS.',
                    'socials' => [
                        'instagram' => null,
                        'tiktok' => null,
                    ],
                ],
            ],
        ],
    ],

    'board' => [
        'period' => '2024/2025',
        'advisor' => [
            'name' => 'Nur Roqimah, S.Pd',
            'role' => 'Pembina',
            'badge' => 'Pembina Utama',
            'photo' => null,
            'bio' => 'Mendampingi arah pengembangan SCI-TOS sebagai ruang belajar yang edukatif, ilmiah, dan terbuka.',
            'socials' => [
                'instagram' => null,
                'tiktok' => null,
            ],
        ],
        'chair' => [
            'name' => 'Muhammad Rasya Sabiq',
            'role' => 'Ketua Umum',
            'badge' => 'Executive Lead',
            'photo' => null,
            'bio' => 'Mengawal arah besar organisasi, ritme program, dan sinergi antar divisi agar tetap bergerak searah.',
            'socials' => [
                'instagram' => null,
                'tiktok' => null,
            ],
        ],
        'vice_chairs' => [
            [
                'name' => 'Venskha Afrillya Putry',
                'role' => 'Ketua I',
                'badge' => 'Vice Lead',
                'photo' => null,
                'socials' => [
                    'instagram' => null,
                    'tiktok' => null,
                ],
            ],
            [
                'name' => 'Muhammad Geisar Ridho Taulani',
                'role' => 'Ketua II',
                'badge' => 'Vice Lead',
                'photo' => null,
                'socials' => [
                    'instagram' => null,
                    'tiktok' => null,
                ],
            ],
        ],
        'clusters' => [
            [
                'title' => 'Sekretariat',
                'subtitle' => 'Documentation Node',
                'items' => [
                    [
                        'name' => 'Shiffa Ananda V-Elto',
                        'role' => 'Sekretaris Umum',
                        'badge' => 'Secretariat',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                    [
                        'name' => 'Alifa Disa Setyani',
                        'role' => 'Sekretaris I',
                        'badge' => 'Secretariat',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                    [
                        'name' => 'Amanda Putri Farrasya',
                        'role' => 'Sekretaris II',
                        'badge' => 'Secretariat',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Keuangan',
                'subtitle' => 'Finance Node',
                'items' => [
                    [
                        'name' => 'Nayla Mutiara Arumi',
                        'role' => 'Bendahara Umum',
                        'badge' => 'Treasury',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                    [
                        'name' => 'Zafira Jua Santika',
                        'role' => 'Bendahara I',
                        'badge' => 'Treasury',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Hubungan Publik',
                'subtitle' => 'Communication Node',
                'items' => [
                    [
                        'name' => 'Jasmine Tri Ramadhani',
                        'role' => 'Humas I',
                        'badge' => 'Public Relation',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                    [
                        'name' => 'Alfarisyi Davy Febriano',
                        'role' => 'Humas II',
                        'badge' => 'Public Relation',
                        'photo' => null,
                        'socials' => [
                            'instagram' => null,
                            'tiktok' => null,
                        ],
                    ],
                ],
            ],
        ],
    ],

    'gallery' => [
        'summary' => 'SCI-TOS Gallery menampilkan karya visual, dokumentasi, dan video yang merekam ide, eksperimen, serta output kreatif anggota.',
        'items' => [
            [
                'title' => 'Poster Ekapaksi Cup 2023',
                'type' => 'Foto',
                'category' => 'Poster',
                'division' => 'Desain Grafis',
                'creator' => 'Tim Desain Grafis SCI-TOS',
                'year' => '2023',
                'media' => 'storage/desaingrafis.png',
                'description' => 'Karya poster kompetisi yang menonjolkan permainan visual tegas dan hierarki informasi yang rapi.',
            ],
            [
                'title' => 'Best Reels UHAMKA',
                'type' => 'Video',
                'category' => 'Video Reels',
                'division' => 'Photography & Videography',
                'creator' => 'Tim PDV SCI-TOS',
                'year' => '2022',
                'media' => 'storage/pdv.png',
                'description' => 'Video reels yang menjadi salah satu pencapaian media digital SCI-TOS di tahun 2022.',
            ],
            [
                'title' => 'Prototype Robotik Lab Session',
                'type' => 'Foto',
                'category' => 'Prototype',
                'division' => 'Robotik',
                'creator' => 'Tim Robotik SCI-TOS',
                'year' => '2024',
                'media' => 'storage/robotik.png',
                'description' => 'Dokumentasi prototype dan eksplorasi mekanik-elektronik yang diuji dalam sesi lab internal.',
            ],
            [
                'title' => 'Landing Page Programming Sprint',
                'type' => 'Foto',
                'category' => 'UI Showcase',
                'division' => 'Programming & Jaringan',
                'creator' => 'Tim Programming & Jaringan',
                'year' => '2025',
                'media' => 'storage/programming.png',
                'description' => 'Cuplikan eksperimen antarmuka dan struktur halaman hasil sprint mini divisi pemrograman.',
            ],
            [
                'title' => 'Audio Session Highlight',
                'type' => 'Video',
                'category' => 'Behind The Scene',
                'division' => 'Audio',
                'creator' => 'Divisi Audio SCI-TOS',
                'year' => '2024',
                'media' => 'storage/audio.png',
                'description' => 'Highlight sesi pengolahan suara, monitoring, dan setup teknis untuk kegiatan internal.',
            ],
            [
                'title' => 'Research Board Exploration',
                'type' => 'Foto',
                'category' => 'Research',
                'division' => 'PPI',
                'creator' => 'Tim Penelitian Ilmiah',
                'year' => '2024',
                'media' => 'storage/ppi.png',
                'description' => 'Visualisasi board penelitian, struktur eksperimen, dan arah pengembangan topik ilmiah.',
            ],
            [
                'title' => 'Debate Practice Reel',
                'type' => 'Video',
                'category' => 'Practice Reel',
                'division' => 'Debat',
                'creator' => 'Divisi Debat SCI-TOS',
                'year' => '2024',
                'media' => 'storage/debat.png',
                'description' => 'Rekaman suasana sparring, pembacaan mosi, dan latihan public speaking dari sesi debat internal.',
            ],
            [
                'title' => 'Innovation Board Snapshot',
                'type' => 'Foto',
                'category' => 'Innovation',
                'division' => 'EPUKITG',
                'creator' => 'Divisi EPUKITG SCI-TOS',
                'year' => '2024',
                'media' => 'storage/epukitg.png',
                'description' => 'Dokumentasi ide inovasi tepat guna dan susunan pengembangan konsep karya anggota.',
            ],
            [
                'title' => 'Esports Match Highlight',
                'type' => 'Video',
                'category' => 'Match Highlight',
                'division' => 'Esports',
                'creator' => 'Unit Esports SCI-TOS',
                'year' => '2024',
                'media' => 'storage/esports.png',
                'description' => 'Preview suasana scrim, strategi squad, dan highlight pertandingan dari unit esports SCI-TOS.',
            ],
        ],
    ],

    'classroom' => [
        'class_title' => 'SCI-TOS Master Classroom',
        'class_subtitle' => 'Workspace tugas, materi, dan quiz dari koordinator divisi.',
        'class_code' => 'SCI-TOS-4BK',
        'teacher' => 'Nur Roqimah, S.Pd',
        'coordinator_label' => 'Koordinator Divisi SCI-TOS',
        'announcement' => 'Seluruh tugas divisi, materi briefing, dan quiz internal akan dirapikan melalui classroom agar ritme belajar lebih mudah dipantau.',
        'summary' => 'Classroom adalah workspace tugas dari koordinator divisi untuk briefing, challenge, review, dan pelacakan perkembangan anggota.',
        'steps' => [
            [
                'title' => 'Briefing',
                'description' => 'Koordinator membagikan tujuan tugas, format output, dan indikator keberhasilan.',
            ],
            [
                'title' => 'Execution',
                'description' => 'Anggota mengerjakan challenge per divisi dengan ritme mingguan atau per proyek.',
            ],
            [
                'title' => 'Review',
                'description' => 'Hasil tugas direview untuk melihat progres, kualitas, dan peluang peningkatan.',
            ],
        ],
        'tasks' => [
            [
                'id' => 'seed-programming-landing',
                'title' => 'Rancang landing page divisi',
                'division' => 'Programming & Jaringan',
                'coordinator' => 'Restu Putra Ramadhan',
                'status' => 'Priority',
                'task_type' => 'material',
                'topic' => 'Programming Sprint',
                'deadline' => 'Pekan 1',
                'due_date' => '2026-03-28',
                'format' => 'HTML + CSS',
                'score' => null,
                'summary' => 'Membuat landing page sederhana dengan identitas visual divisi dan struktur informasi yang jelas.',
                'attachments' => [
                    [
                        'label' => 'Referensi UI divisi',
                        'type' => 'Image',
                        'path' => 'storage/programming.png',
                    ],
                ],
            ],
            [
                'id' => 'seed-design-poster',
                'title' => 'Buat poster awareness kegiatan',
                'division' => 'Desain Grafis',
                'coordinator' => 'Salva Aqilah Wibowo',
                'status' => 'Open',
                'task_type' => 'text',
                'topic' => 'Poster Studio',
                'deadline' => 'Pekan 1',
                'due_date' => '2026-03-27',
                'format' => 'Poster statis',
                'score' => null,
                'summary' => 'Membuat satu poster dengan visual yang kuat untuk publikasi event internal SCI-TOS.',
                'attachments' => [],
            ],
            [
                'id' => 'seed-pdv-story',
                'title' => 'Photo story kegiatan laboratorium',
                'division' => 'Photography & Videography',
                'coordinator' => 'Muhammad Al-Fatikh Zidane',
                'status' => 'Weekly',
                'task_type' => 'material',
                'topic' => 'Visual Storytelling',
                'deadline' => 'Pekan 2',
                'due_date' => '2026-03-31',
                'format' => '5 frame + caption',
                'score' => null,
                'summary' => 'Menyusun rangkaian foto yang bisa menceritakan proses kegiatan lab secara runtut.',
                'attachments' => [
                    [
                        'label' => 'Contoh angle dokumentasi',
                        'type' => 'Image',
                        'path' => 'storage/pdv.png',
                    ],
                ],
            ],
            [
                'id' => 'seed-debate-rebuttal',
                'title' => 'Simulasi mosi dan rebuttal',
                'division' => 'Debat',
                'coordinator' => 'Safeera Alexandria Al Banna',
                'status' => 'Review',
                'task_type' => 'quiz',
                'topic' => 'Debate Drill',
                'deadline' => 'Pekan 2',
                'due_date' => '2026-04-02',
                'format' => 'Presentasi lisan',
                'score' => 100,
                'summary' => 'Menyiapkan argumen pro-kontra dan merekam sesi rebuttal untuk dievaluasi bersama.',
                'attachments' => [
                    [
                        'label' => 'Template penilaian debat',
                        'type' => 'PDF',
                        'path' => '#',
                    ],
                ],
            ],
            [
                'id' => 'seed-ppi-proposal',
                'title' => 'Draft proposal penelitian mini',
                'division' => 'PPI',
                'coordinator' => 'Nadzifah Alya Hermawan',
                'status' => 'Open',
                'task_type' => 'text',
                'topic' => 'Mini Research',
                'deadline' => 'Pekan 3',
                'due_date' => '2026-04-05',
                'format' => 'Dokumen proposal',
                'score' => null,
                'summary' => 'Menyusun rumusan masalah, tujuan, dan metodologi sederhana untuk proyek riset awal.',
                'attachments' => [],
            ],
            [
                'id' => 'seed-esports-review',
                'title' => 'Analisis strategi scrim',
                'division' => 'Esports',
                'coordinator' => 'Wildan Hasan / Ahmad Rizki Bianji / Dewa Danendra Ramadhan',
                'status' => 'Weekly',
                'task_type' => 'material',
                'topic' => 'Scrim Review',
                'deadline' => 'Pekan 3',
                'due_date' => '2026-04-07',
                'format' => 'Review performa',
                'score' => null,
                'summary' => 'Mencatat pola komunikasi dan keputusan tim dari sesi scrim untuk perbaikan strategi berikutnya.',
                'attachments' => [
                    [
                        'label' => 'Highlight scrim terakhir',
                        'type' => 'Video',
                        'path' => 'storage/esports.png',
                    ],
                ],
            ],
        ],
    ],

    'registration' => [
        'period' => 'Awal semester ganjil (Juli - Agustus)',
        'moment' => 'MPLS atau Demo Ekskul',
        'location' => 'Lab Komputer SMAN 4 Bekasi',
        'summary' => 'Pendaftaran ekstrakurikuler dibuka pada awal semester ganjil. Momen ini menjadi waktu terbaik untuk mengenal divisi-divisi SCI-TOS dan menentukan jalur eksplorasi yang paling sesuai.',
        'steps' => [
            'Pantau pengumuman pembukaan ekskul saat MPLS atau Demo Ekskul.',
            'Kenali divisi-divisi SCI-TOS dan pilih fokus yang paling sesuai dengan minatmu.',
            'Datang ke Lab Komputer untuk bertanya langsung ke pengurus atau pembina saat sesi pengenalan.',
        ],
        'cta_label' => 'Pantau Instagram SCI-TOS',
    ],

    'socials' => [
        ['label' => 'Instagram', 'url' => 'https://instagram.com/sci_tos/'],
        ['label' => 'TikTok', 'url' => '#'],
        ['label' => 'YouTube', 'url' => '#'],
    ],

    'placeholders' => [
        'ai_chat' => [
            'badge' => 'AI Assistant',
            'title' => 'Tanya AI segera hadir.',
            'description' => 'Asisten digital SCI-TOS untuk bantu eksplorasi divisi, info kegiatan, dan tanya jawab umum sedang dipersiapkan.',
        ],
        'admin_panel' => [
            'badge' => 'Admin Console',
            'title' => 'Panel admin SCI-TOS siap dikembangkan.',
            'description' => 'Area ini disiapkan sebagai panel internal untuk mengelola gallery, classroom, dan konten website SCI-TOS.',
        ],
    ],
];
