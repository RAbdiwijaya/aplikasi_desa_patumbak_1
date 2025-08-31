<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AgendaController,
    GaleriController,
    KesehatanController,
    PengumumanController,
    SuratController,
    BeritaController,
    BumdesController,
    KontakController,
    BerandaController,
    ProfileController,
    PerangkatController,
    UmkmController,
    PertanianController,
    PendidikanController
};

// Beranda
Route::get('/', [BerandaController::class, 'berandauser'])->name('beranda');

// Profil Desa
Route::prefix('profil-desa')->group(function () {
    Route::view('/', 'profil-desa.index')->name('profil-desa.index');
    Route::view('sejarah', 'profil-desa.sejarah')->name('profil-desa.sejarah');
    Route::view('visi-misi', 'profil-desa.visi-misi')->name('profil-desa.visi-misi');
    Route::get('struktur-organisasi', [PerangkatController::class, 'struktur'])->name('profil-desa.struktur-organisasi');
    Route::get('perangkat-desa', [PerangkatController::class, 'index1'])->name('profil-desa.perangkat-desa');
    Route::get('bumdes', [BumdesController::class, 'index'])->name('profil-desa.bumdes');
});

// Layanan
Route::prefix('layanan')->group(function () {
    Route::view('kesehatan', 'layanan.kesehatan')->name('layanan.kesehatan');
    Route::get('layanan.user', [KesehatanController::class, 'kesehatanviewuser'])->name('kesehatan.user');
    Route::view('pendidikan', 'layanan.pendidikan')->name('layanan.pendidikan');
    Route::get('pendidikan.user', [PendidikanController::class, 'userView'])->name('pendidikan.user');
    Route::view('pertanian', 'layanan.pertanian')->name('layanan.pertanian');
    Route::get('umkm.user', [UmkmController::class, 'umkmuser'])->name('umkm.user');
    Route::view('demografi', 'layanan.pertanian')->name('layanan.demografi');
    Route::get('surat-menyurat', [SuratController::class, 'create'])->name('layanan.surat-menyurat');
    Route::post('surat-menyurat', [SuratController::class, 'store'])->name('layanan.surat-menyurat.store');
});
// Berita Routes
Route::resource('berita', BeritaController::class)->except(['show']);
Route::patch('berita/{berita}/toggle-status', [BeritaController::class, 'toggleStatus'])->name('berita.toggle-status');


Route::prefix('berita-kegiatan')->group(function () {
    Route::get('berita-terkini', [BeritaController::class, 'showindex'])->name('berita-kegiatan.berita-terkini');
    Route::view('agenda-kegiatan', 'berita-kegiatan.agenda-kegiatan')->name('agendauser');
    Route::get('pengumuman-user', [PengumumanController::class, 'pengumumanuser'])->name('pengumuman.user');
    Route::get('{slug}', [BeritaController::class, 'show'])->name('berita-kegiatan.show');
});

// Pengumuman (untuk mobile menu)
Route::get('berita-kegiatan/pengumuman', [PengumumanController::class, 'pengumumanuser'])->name('pengumumanuser');

// Galeri
// Route::get('galeri', [GaleriController::class, 'galeriuser'])->name('galeriuser');
// Route::get('galeri.user', [GaleriController::class, 'indexUser'])->name('galeri.user');

// Kontak (Publik)
Route::get('kontak.user', [KontakController::class, 'create'])->name('kontak.create');
Route::post('kontak', [KontakController::class, 'store'])->name('kontak.store');

// Surat Menyurat (Publik)
Route::get('layanan/surat-menyurat', [SuratController::class, 'indexGuest'])->name('layanan.surat-menyurat');
Route::post('layanan/surat-menyurat', [SuratController::class, 'store'])->name('layanan.surat-menyurat.store');
Route::get('/surat-menyurat/get-form/{jenisSurat}', [SuratController::class, 'getForm'])->name('surat-menyurat.get-form');

// Surat Menyurat (Admin)
// Ubah route surat-menyurat untuk admin
Route::middleware(['auth', 'verified'])->prefix('surat-menyurat')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('surat-menyurat.index');
    Route::get('/{source}/{id}', [SuratController::class, 'show'])->name('surat-menyurat.show');
    Route::delete('/{source}/{id}', [SuratController::class, 'destroy'])->name('surat-menyurat.destroy');
    Route::post('/', [SuratController::class, 'store'])->name('surat-menyurat.store');
    Route::get('/{surat}/edit', [SuratController::class, 'edit'])->name('surat-menyurat.edit');
    // Route::get('/{id}/show', [SuratController::class, 'show'])->name('surat-menyurat.show');
    Route::get('/{source}/{id}/print', [SuratController::class, 'createSurat'])->name('surat-menyurat.print');
    Route::get('/create', [SuratController::class, 'create'])->name('surat-menyurat.create');
});

// Kontak (Admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/{kontak}', [KontakController::class, 'show'])->name('kontak.show');
    Route::get('/kontak/{kontak}/edit', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::put('/kontak/{kontak}', [KontakController::class, 'update'])->name('kontak.update');
    Route::delete('/kontak/{kontak}', [KontakController::class, 'destroy'])->name('kontak.destroy');
});

// Dashboard Admin & Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [BerandaController::class, 'admin'])->name('dashboard.index');
    Route::get('dashboard/create', [BerandaController::class, 'create'])->name('dashboard.create');
    Route::get('dashboard/{id}/edit', [BerandaController::class, 'edit'])->name('dashboard.edit');
    Route::delete('dashboard/{id}', [BerandaController::class, 'destroy'])->name('dashboard.destroy');
    // Berita
    
    Route::resource('berita', BeritaController::class)->except(['show']);
    // Surat Menyurat
    Route::get('surat-menyurat', [SuratController::class, 'index'])->name('surat-menyurat.index');
    Route::post('surat-menyurat', [SuratController::class, 'store'])->name('surat-menyurat.store');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Perangkat Desa
    Route::get('/perangkat', [PerangkatController::class, 'index'])->name('perangkat.show');
    Route::get('/perangkat/create', [PerangkatController::class, 'create'])->name('perangkat.create');
    Route::post('/perangkat', [PerangkatController::class, 'store'])->name('perangkat.store');
    Route::get('/perangkat/{id}/edit', [PerangkatController::class, 'edit'])->name('perangkat.edit');
    Route::put('/perangkat/{id}', [PerangkatController::class, 'update'])->name('perangkat.update');
    Route::delete('/perangkat/{id}', [PerangkatController::class, 'destroy'])->name('perangkat.destroy');
    // Galeri
    // Route::get('galeri.index', [GaleriController::class, 'index'])->name('galeri.index');
    // Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    // Route::get('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    // Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    // Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    // Pendidikan
    Route::get('pendidikan', [PendidikanController::class, 'index'])->name('pendidikan.index');
    Route::get('pendidikan/create', [PendidikanController::class, 'create'])->name('pendidikan.create');
    Route::get('pendidikan/{id}/edit', [PendidikanController::class, 'edit'])->name('pendidikan.edit');
    Route::delete('pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');
    // Kesehatan
    Route::get('kesehatan', [KesehatanController::class, 'index'])->name('kesehatan.index');
    Route::get('kesehatan/create', [KesehatanController::class, 'create'])->name('kesehatan.create');
    Route::get('kesehatan/{id}/edit', [KesehatanController::class, 'edit'])->name('kesehatan.edit');
    Route::delete('kesehatan/{id}', [KesehatanController::class, 'destroy'])->name('kesehatan.destroy');
    // UMKM
    Route::get('umkm', [UmkmController::class, 'index'])->name('umkm.index');
    Route::get('umkm/create', [UmkmController::class, 'create'])->name('umkm.create');
    Route::get('umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
    Route::delete('umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');
});

// Galeri Routes
Route::get('galeri.user', [GaleriController::class, 'indexUser'])->name('galeri.user');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

require __DIR__ . '/auth.php';
