<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerangkatDesa;
use App\Models\LembagaDesa;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;

class GuestController extends Controller
{
    public function index()
    {
        // Data statistik untuk ditampilkan di home
        $stats = [
            'total_perangkat' => 15,
            'total_lembaga' => 8,
            'total_rt' => 10,
            'total_rw' => 4,
        ];

        // Data dummy perangkat desa (simulasi dari database)
        $perangkat_desa = [
            [
                'nama' => 'Ahmad Santoso',
                'jabatan' => 'Kepala Desa',
                'nip' => '198302152007011001',
                'kontak' => '081234567890',
                'periode' => '2021-2026',
                'foto' => null
            ],
            [
                'nama' => 'Siti Rahayu',
                'jabatan' => 'Sekretaris Desa',
                'nip' => '198506102010022002',
                'kontak' => '081298765432',
                'periode' => '2021-2026',
                'foto' => null
            ],
            [
                'nama' => 'Budi Prasetyo',
                'jabatan' => 'Kasi Pemerintahan',
                'nip' => '199001152015031003',
                'kontak' => '081355557777',
                'periode' => '2021-2026',
                'foto' => null
            ],
            [
                'nama' => 'Maya Sari',
                'jabatan' => 'Kasi Kesejahteraan',
                'nip' => '198812202012022004',
                'kontak' => '081366667777',
                'periode' => '2021-2026',
                'foto' => null
            ]
        ];

        // Data dummy lembaga desa (simulasi dari database)
        $lembaga_desa = [
            [
                'nama' => 'Badan Permusyawaratan Desa (BPD)',
                'deskripsi' => 'Lembaga yang melaksanakan fungsi pemerintahan di bidang legislasi, budgeting, dan pengawasan dalam pemerintahan desa.',
                'kontak' => '081244446666',
                'ketua' => 'Drs. Suparman',
                'logo' => null,
                'jumlah_anggota' => 9
            ],
            [
                'nama' => 'Pemberdayaan Kesejahteraan Keluarga (PKK)',
                'deskripsi' => 'Lembaga kemasyarakatan yang memberdayakan wanita untuk turut berpartisipasi dalam pembangunan desa.',
                'kontak' => '081277778888',
                'ketua' => 'Ibu Suryani',
                'logo' => null,
                'jumlah_anggota' => 25
            ],
            [
                'nama' => 'Karang Taruna',
                'deskripsi' => 'Organisasi kepemudaan di tingkat desa yang berfungsi sebagai wadah pengembangan generasi muda.',
                'kontak' => '081299998888',
                'ketua' => 'Rizki Pratama',
                'logo' => null,
                'jumlah_anggota' => 35
            ],
            [
                'nama' => 'Lembaga Pemberdayaan Masyarakat (LPM)',
                'deskripsi' => 'Lembaga yang menampung dan mewujudkan aspirasi masyarakat dalam pembangunan desa.',
                'kontak' => '081233334444',
                'ketua' => 'Drs. H. Mahmud',
                'logo' => null,
                'jumlah_anggota' => 15
            ]
        ];

        // Data RT/RW
        $struktur_wilayah = [
            'rw' => [
                ['nomor' => '001', 'ketua' => 'Bapak Joko'],
                ['nomor' => '002', 'ketua' => 'Bapak Slamet'],
                ['nomor' => '003', 'ketua' => 'Bapak Riyadi'],
                ['nomor' => '004', 'ketua' => 'Bapak Hendra']
            ],
            'rt' => [
                ['nomor' => '001', 'rw' => '001', 'ketua' => 'Bapak Surya'],
                ['nomor' => '002', 'rw' => '001', 'ketua' => 'Bapak Rudi'],
                ['nomor' => '003', 'rw' => '002', 'ketua' => 'Bapak Fajar'],
                ['nomor' => '004', 'rw' => '002', 'ketua' => 'Bapak Dwi'],
                ['nomor' => '005', 'rw' => '003', 'ketua' => 'Bapak Eko'],
                ['nomor' => '006', 'rw' => '003', 'ketua' => 'Bapak Agus'],
                ['nomor' => '007', 'rw' => '004', 'ketua' => 'Bapak Wahyu'],
                ['nomor' => '008', 'rw' => '004', 'ketua' => 'Bapak Adi']
            ]
        ];

        // Data untuk passing ke view - TAMBAHKAN TITLE DI SINI
        $data = [
            'title' => 'Portal Desa Mandiri - Perangkat & Lembaga Desa',
            'stats' => $stats,
            'perangkat_desa' => $perangkat_desa,
            'lembaga_desa' => $lembaga_desa,
            'struktur_wilayah' => $struktur_wilayah
        ];

        return view('/pages/dashboard', $data);
    }

    // Method baru untuk halaman Tentang
    public function tentang()
    {
        // Data statistik yang dibutuhkan oleh view tentang.blade.php
        $stats = [
            'total_perangkat' => PerangkatDesa::count(),
            'total_lembaga'   => LembagaDesa::count(),
            'total_rt'        => Rt::count(),
            'total_rw'        => Rw::count(),
            // Menambahkan data real berdasarkan database (Estimasi KK = Warga / 3)
            'total_kk'        => round(Warga::count() / 3), 
            'total_warga'     => Warga::count(),
        ];

        $data = [
            'title' => 'Tentang Kami - Tata Kelola Desa',
            'stats' => $stats,
        ];

        return view('pages/tentang', $data);
    }


    /**

     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
