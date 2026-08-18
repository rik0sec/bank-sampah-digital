<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');


/*
|--------------------------------------------------------------------------
| BANK SAMPAH - AUTH & DASHBOARD
|--------------------------------------------------------------------------
*/
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard-admin', 'Dashboard::index');
$routes->get('dashboard-petugas', 'DashboardPetugas::index');
    
$routes->get(
    'pengajuan-setoran',
    'PengajuanSetoran::index'
);
$routes->get(
    'pengajuan-setoran/setujui/(:num)',
    'PengajuanSetoran::setujui/$1'
);

$routes->get(
    'pengajuan-setoran/tolak/(:num)',
    'PengajuanSetoran::tolak/$1'
);
$routes->get('dashboard-nasabah', 'DashboardNasabah::index');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - REGISTER WITH OTP
|--------------------------------------------------------------------------
*/
$routes->get('register', 'Register::index');
$routes->post('register/submit', 'Register::submit');
$routes->get('register/verify', 'Register::verify');
$routes->post('register/verify-submit', 'Register::verifySubmit');
$routes->post('register/resend-otp', 'Register::resendOTP');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - MENU NASABAH
|--------------------------------------------------------------------------
*/
$routes->get('nasabah-menu/dashboard', 'NasabahMenu::dashboardSaya');
$routes->get('nasabah-menu', 'NasabahMenu::index');
$routes->get('nasabah-menu/dashboard/(:num)', 'NasabahMenu::dashboard/$1');
$routes->get('nasabah-menu/profil/(:num)', 'NasabahMenu::profil/$1');
$routes->get('nasabah-menu/update/(:num)', 'NasabahMenu::update/$1');
$routes->match(['get', 'post'], 'nasabah-menu/update/(:num)', 'NasabahMenu::update/$1');
$routes->get('nasabah-menu/select', 'NasabahMenu::select');
$routes->get('nasabah-menu/cetak-nota/(:num)', 'NasabahMenu::cetak_nota/$1');
$routes->get('nasabah-menu/nota-detail/(:num)/(:num)', 'NasabahMenu::nota_detail/$1/$2');
$routes->get('nasabah-menu/ajukan-setoran','NasabahMenu::ajukan_setoran'
);

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - NASABAH
|--------------------------------------------------------------------------
*/
$routes->get('nasabah', 'Nasabah::index');
$routes->match(['get', 'post'], 'nasabah/tambah', 'Nasabah::tambah');
$routes->match(['get', 'post'], 'nasabah/edit/(:num)', 'Nasabah::edit/$1');
$routes->get('nasabah/delete/(:num)', 'Nasabah::delete/$1');

$routes->match(['get', 'post'], 'setor-sampah', 'NasabahMenu::ajukan_setoran');
/*
|--------------------------------------------------------------------------
| BANK SAMPAH - JENIS SAMPAH
|--------------------------------------------------------------------------
*/
$routes->get('jenis-sampah', 'JenisSampah::index');
$routes->match(['get', 'post'], 'jenis-sampah/tambah', 'JenisSampah::tambah');
$routes->match(['get', 'post'], 'jenis-sampah/edit/(:num)', 'JenisSampah::edit/$1');
$routes->get('jenis-sampah/delete/(:num)', 'JenisSampah::delete/$1');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - HARGA SAMPAH
|--------------------------------------------------------------------------
*/
$routes->get('harga-sampah', 'HargaSampah::index');
$routes->match(['get', 'post'], 'harga-sampah/tambah', 'HargaSampah::tambah');
$routes->match(['get', 'post'], 'harga-sampah/edit/(:num)', 'HargaSampah::edit/$1');
$routes->get('harga-sampah/delete/(:num)', 'HargaSampah::delete/$1');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - PENYETORAN
|--------------------------------------------------------------------------
*/
$routes->get('penyetoran', 'Penyetoran::index');
$routes->match(['get', 'post'], 'penyetoran/tambah', 'Penyetoran::tambah');
$routes->match(['get', 'post'], 'penyetoran/edit/(:num)', 'Penyetoran::edit/$1');
$routes->get('penyetoran/detail/(:num)', 'Penyetoran::detail/$1');
$routes->get('penyetoran/delete/(:num)', 'Penyetoran::delete/$1');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - LAPORAN
|--------------------------------------------------------------------------
*/
$routes->get('laporan', 'Laporan::index');
$routes->get('laporan/penyetoran', 'Laporan::penyetoran');
$routes->get('laporan/penjualan', 'Laporan::penjualan');

$routes->match(['get', 'post'], 'laporan-petugas', 'LaporanPetugas::index');
$routes->get('laporan-petugas/cetak', 'LaporanPetugas::cetak');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - MANAJEMEN USER
|--------------------------------------------------------------------------
*/
$routes->get('user', 'User::index');
$routes->match(['get', 'post'], 'user/tambah', 'User::tambah');
$routes->match(['get', 'post'], 'user/edit/(:num)', 'User::edit/$1');
$routes->get('user/delete/(:num)', 'User::delete/$1');
$routes->get('user/pending_registrations', 'User::pending_registrations');
$routes->get('user/send-otp/(:num)', 'User::sendOTP/$1');
$routes->get('user/approve-direct/(:num)', 'User::approveDirect/$1');
$routes->get('user/reject/(:num)', 'User::reject/$1');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - DETAIL PENYETORAN
|--------------------------------------------------------------------------
*/
$routes->get('detail-penyetoran', 'DetailPenyetoran::index');
$routes->match(['get', 'post'], 'detail-penyetoran/tambah', 'DetailPenyetoran::tambah');
$routes->match(['get', 'post'], 'detail-penyetoran/edit/(:num)', 'DetailPenyetoran::edit/$1');
$routes->get('detail-penyetoran/delete/(:num)', 'DetailPenyetoran::delete/$1');

/*
|--------------------------------------------------------------------------
| BANK SAMPAH - DETAIL PENJUALAN
|--------------------------------------------------------------------------
*/
$routes->get('detail-penjualan', 'DetailPenjualan::index');
$routes->match(['get', 'post'], 'detail-penjualan/tambah', 'DetailPenjualan::tambah');
$routes->match(['get', 'post'], 'detail-penjualan/edit/(:num)', 'DetailPenjualan::edit/$1');
$routes->get('detail-penjualan/delete/(:num)', 'DetailPenjualan::delete/$1');

$routes->get('profil-admin', 'Profil::admin');

$routes->get('profil-petugas', 'ProfilPetugas::index');
$routes->post('profil-petugas/update', 'ProfilPetugas::update');

$routes->get('profil-admin', 'Profil::admin');
$routes->post('profil-admin/update', 'Profil::update');

$routes->get('penyetoran/export-pdf', 'Penyetoran::exportPdf');
$routes->get('penyetoran/export-excel', 'Penyetoran::exportExcel');

$routes->get('laporan/export-pdf', 'Laporan::exportPdf');
$routes->get('laporan/export-excel', 'Laporan::exportExcel');