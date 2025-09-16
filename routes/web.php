<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Import Controllers - Frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\PetaDesaController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PerangkatDesaController;

// Import Controllers - Admin
use App\Http\Controllers\AdminPetaController;
use App\Http\Controllers\AdminUmkmController;
use App\Http\Controllers\AdminAgamaController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKontakController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminLayananController;
use App\Http\Controllers\AdminSejarahController;
use App\Http\Controllers\AdminWilayahController;
use App\Http\Controllers\AdminAnggaranController;
use App\Http\Controllers\AdminSdgsController;
use App\Http\Controllers\AdminBansosController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminVisiMisiController;
use App\Http\Controllers\AdminPekerjaanController;
use App\Http\Controllers\AdminPendudukController;
use App\Http\Controllers\AdminStuntingController;
use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminJenisKelaminController;
use App\Http\Controllers\AdminVideoProfileController;
use App\Http\Controllers\AdminPerangkatDesaController;
use App\Http\Controllers\AdminIdentitasSitusController;
use App\Http\Controllers\AdminIdmController;
use App\Http\Controllers\IdmController;
use App\Http\Controllers\InfografisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk refresh CSRF token
Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->name('csrf.token');

// Route untuk debug session (temporary)
Route::get('/session-debug', function () {
    return response()->json([
        'session_id' => session()->getId(),
        'csrf_token' => csrf_token(),
        'session_driver' => config('session.driver'),
        'session_domain' => config('session.domain'),
        'session_secure' => config('session.secure'),
        'session_same_site' => config('session.same_site'),
        'session_lifetime' => config('session.lifetime'),
        'app_url' => config('app.url'),
        'server_https' => request()->server('HTTPS'),
        'server_host' => request()->server('HTTP_HOST'),
        'headers' => [
            'CF-Connecting-IP' => request()->header('CF-Connecting-IP'),
            'CF-Ray' => request()->header('CF-Ray'),
            'X-Forwarded-Proto' => request()->header('X-Forwarded-Proto'),
            'X-Forwarded-For' => request()->header('X-Forwarded-For'),
        ]
    ]);
})->name('session.debug');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [BerandaController::class, 'index']);

Route::get('/berita/{beritas:slug}', [BeritaController::class, 'berita']);
Route::get('/berita', [BeritaController::class, 'index']);

Route::post('/berita/{slug}', [CommentController::class, 'comment']);
Route::post('/berita/{slug}/reply', [CommentController::class, 'commentReply']);

Route::get('/kategori/{kategori:slug}', [kategoriController::class, 'index']);

Route::get('/wilayah', [WilayahController::class, 'index']);

Route::get('/sejarah', [SejarahController::class, 'index']);

Route::get('/visi-misi', [VisiMisiController::class, 'index']);

Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index']);

Route::get('/peta-desa', [PetaDesaController::class, 'index']);

Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/{umkm:slug}', [UmkmController::class, 'detail']);

Route::get('/kontak', [KontakController::class, 'index']);

Route::get('/layanan', [LayananController::class, 'index']);

Route::get('/gallery', [GalleryController::class, 'index']);

// IDM Routes
// IDM Routes
Route::get('/idm', [IdmController::class, 'index'])->name('idm.index');

// Infografis Routes
Route::prefix('infografis')->name('infografis.')->controller(InfografisController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/penduduk', 'penduduk')->name('penduduk');
    Route::get('/apbdes', 'apbdes')->name('apbdes');
    Route::get('/stunting', 'stunting')->name('stunting');
    Route::get('/bansos', 'bansos')->name('bansos');
    Route::get('/sdgs', 'sdgs')->name('sdgs');
});
Route::get('/infografis/idm', [App\Http\Controllers\IdmController::class, 'infografis'])->name('idm.infografis');

Route::get('/pengumuman', [AnnouncementController::class, 'index']);
Route::get('/pengumuman/{pengumuman:slug}', [AnnouncementController::class, 'detail']);

Route::get('/apbdesa', [AnggaranController::class, 'index']);
Route::get('/apbdesa/{anggaran:slug}', [AnggaranController::class, 'detail']);

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Slider Management
Route::resource('/admin/slider', AdminSliderController::class);

// Berita Management
Route::get('/admin/berita/slug', [AdminBeritaController::class, 'slug']);
Route::resource('/admin/berita', AdminBeritaController::class);

// Comment Management
Route::get('/admin/komentar', [AdminCommentController::class, 'index']);
Route::delete('/admin/komentar/{id}', [AdminCommentController::class, 'destroy']);

// Kategori Management
Route::get('/admin/kategori/slug', [AdminKategoriController::class, 'slug']);
Route::resource('/admin/kategori', AdminKategoriController::class);

// Wilayah Management
Route::get('admin/wilayah', [AdminWilayahController::class, 'index']);
Route::get('admin/wilayah/{id}/edit', [AdminWilayahController::class, 'edit']);
Route::put('admin/wilayah/{id}', [AdminWilayahController::class, 'update']);

// Sejarah Management
Route::get('admin/sejarah', [AdminSejarahController::class, 'index']);
Route::get('admin/sejarah/{id}/edit', [AdminSejarahController::class, 'edit']);
Route::put('admin/sejarah/{id}', [AdminSejarahController::class, 'update']);

// Visi Misi Management
Route::get('admin/visi-misi', [AdminVisiMisiController::class, 'index']);
Route::get('admin/visi-misi/{id}/edit', [AdminVisiMisiController::class, 'edit']);
Route::put('admin/visi-misi/{id}', [AdminVisiMisiController::class, 'update']);

// Perangkat Desa Management
Route::resource('admin/perangkat-desa', AdminPerangkatDesaController::class);

// Peta Desa Management
Route::get('/admin/peta-desa', [AdminPetaController::class, 'index']);
Route::put('/admin/peta-desa/{id}', [AdminPetaController::class, 'update']);

// Master Data Management
Route::resource('admin/agama', AdminAgamaController::class);
Route::resource('admin/jenis-kelamin', AdminJenisKelaminController::class);
Route::resource('admin/pekerjaan', AdminPekerjaanController::class);

// UMKM Management
Route::get('/admin/umkm/slug', [AdminUmkmController::class, 'slug']);
Route::resource('admin/umkm', AdminUmkmController::class);

// Kontak Management
Route::get('/admin/kontak', [AdminKontakController::class, 'index']);
Route::put('/admin/kontak/{id}', [AdminKontakController::class, 'update']);

// Video Profile Management
Route::get('/admin/video-profile', [AdminVideoProfileController::class, 'index']);
Route::put('/admin/video-profile/{id}', [AdminVideoProfileController::class, 'update']);

// Identitas Situs Management
Route::get('/admin/identitas-situs/', [AdminIdentitasSitusController::class, 'index']);
Route::put('/admin/identitas-situs/{id}', [AdminIdentitasSitusController::class, 'update']);

// Profile Management
Route::get('/admin/profil/', [AdminProfilController::class, 'index']);
Route::put('/admin/profil/{id}', [AdminProfilController::class, 'update']);
Route::put('/admin/profil/', [AdminProfilController::class, 'changePassword']);

// Layanan Management
Route::resource('/admin/layanan', AdminLayananController::class);

// Gallery Management
Route::resource('/admin/gallery', AdminGalleryController::class);

// IDM Management
Route::patch('/admin/idm/{id}/toggle-active', [AdminIdmController::class, 'toggleActive'])->name('admin.idm.toggle-active');
Route::resource('/admin/idm', AdminIdmController::class)->names('admin.idm');

// Pengumuman Management
Route::get('/admin/pengumuman/slug', [AdminAnnouncementController::class, 'slug']);
Route::resource('/admin/pengumuman', AdminAnnouncementController::class);

// APBDes Management
Route::get('/admin/apbdes/slug', [AdminAnggaranController::class, 'slug']);
Route::delete('/admin/apbdes/bulk-delete', [AdminAnggaranController::class, 'bulkDelete'])->name('admin.apbdes.bulk-delete');
Route::resource('/admin/apbdes', AdminAnggaranController::class)->names('admin.apbdes');

// Penduduk Management
Route::get('admin/penduduk', [AdminPendudukController::class, 'index'])->name('admin.penduduk.index');
Route::get('admin/penduduk/create', [AdminPendudukController::class, 'create'])->name('admin.penduduk.create');
Route::post('admin/penduduk', [AdminPendudukController::class, 'store'])->name('admin.penduduk.store');
Route::get('admin/penduduk/{penduduk}', [AdminPendudukController::class, 'show'])->name('admin.penduduk.show');
Route::get('admin/penduduk/{penduduk}/edit', [AdminPendudukController::class, 'edit'])->name('admin.penduduk.edit');
Route::put('admin/penduduk/{penduduk}', [AdminPendudukController::class, 'update'])->name('admin.penduduk.update');
Route::delete('admin/penduduk/{penduduk}', [AdminPendudukController::class, 'destroy'])->name('admin.penduduk.destroy');

// Penduduk Import & Export
Route::post('admin/penduduk/import', [AdminPendudukController::class, 'importFromExcel'])->name('admin.penduduk.import');
Route::get('admin/penduduk/template/download', [AdminPendudukController::class, 'downloadTemplate'])->name('admin.penduduk.template');
Route::get('admin/penduduk/export', [AdminPendudukController::class, 'exportToExcel'])->name('admin.penduduk.export');

// Stunting Management
Route::resource('/admin/stunting', AdminStuntingController::class)->names('admin.stunting');

// SDGS Management
Route::resource('/admin/sdgs', AdminSdgsController::class)->names('admin.sdgs');

// Bansos Management
Route::resource('/admin/bansos', AdminBansosController::class)->names('admin.bansos');
Route::patch('/admin/bansos/{id}/toggle-infografis', [AdminBansosController::class, 'toggleInfografis'])->name('admin.bansos.toggle-infografis');