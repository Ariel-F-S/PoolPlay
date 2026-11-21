<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use Tinderbox\Clickhouse\Server;
use Tinderbox\Clickhouse\ServerProvider;
use Tinderbox\Clickhouse\Client;

Route::controller(TokoController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tampil-produk', 'semuaProduk')->name('produk.semua');
    Route::get('/inventaris', 'inventaris')->name('produk.inventaris');
    Route::get('/produk/cari', 'cari')->name('produk.cari');
    Route::get('/tambah-produk', 'create')->name('produk.create');
    Route::post('/simpan-produk', 'store')->name('produk.store');
    Route::get('/produk/edit/{id}', 'edit')->name('produk.edit');
    Route::put('/produk/edit/{id}', 'update')->name('produk.update');
    Route::delete('/produk/delete/{id}', 'destroy')->name('produk.delete');
    Route::get('/produk/{id}', 'show')->whereNumber('id')->name('produk.show');
    Route::get('/about', 'about')->name('about');
});

Route::get('/test-clickhouse', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    

    $serverProvider = (new ServerProvider())->addServer($server);
    $client = new Client($serverProvider);
    

    // 1. Read data dari tabel school.students
    $students = $client->readOne("SELECT * FROM school.students")->getRows();

    // 2. Query agregasi rata-rata umur per kelas
    $avgAge = $client->readOne("
        SELECT grade, AVG(age) AS average_age
        FROM school.students
        GROUP BY grade
        ORDER BY grade
    ")->getRows();

    // 3. Query JOIN tabel students & courses
    $joinCourses = $client->readOne("
        SELECT s.name, c.subject
        FROM school.students s
        JOIN school.courses c ON s.id = c.student_id
    ")->getRows();

    return response()->json([
        'students' => $students,
        'average_age' => $avgAge,
        'join_courses' => $joinCourses,
    ]);
    
});

Route::get('/koneksi-clickhouse', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    $results = $client->readOne("
        SELECT grade, AVG(age) AS average_age
        FROM school.students
        GROUP BY grade
        ORDER BY grade
    ")->getRows();

    dd($results);
});

Route::get('/crud-create', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Membuat tabel sesuai contoh modul
    $client->writeOne("
        CREATE TABLE IF NOT EXISTS school.students
        (
            id UInt32,
            name String,
            age UInt8,
            grade UInt8
        ) ENGINE = MergeTree()
        ORDER BY id
    ");

    return 'Tabel school.students berhasil dibuat / diverifikasi dari Laravel!';
});

Route::get('/crud-insert', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Gunakan writeOne dengan query SQL tunggal tanpa titik koma di akhir
    $client->writeOne("INSERT INTO school.students (id, name, age, grade) VALUES (1, 'John Doe', 15, 10), (2, 'Jane Smith', 14, 9)");

    return 'Data John Doe dan Jane Smith berhasil disisipkan!';
});

Route::get('/crud-read', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // 1. Menampilkan semua data siswa
    $semuaSiswa = $client->readOne("SELECT * FROM school.students")->getRows();

    // 2. Menampilkan data siswa yang berada di kelas 10
    $siswaKelas10 = $client->readOne("SELECT * FROM school.students WHERE grade = 10")->getRows();

    dd([
        'semua_siswa' => $semuaSiswa,
        'siswa_kelas_10' => $siswaKelas10,
    ]);
});

Route::get('/crud-update', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // 1. Menambahkan data baru (id 3 = John Doe Baru)
    $client->writeOne("INSERT INTO school.students VALUES (3, 'John Doe Baru', 15, 10)");

    // 2. Menghapus data lama (id = 1)
    $client->writeOne("ALTER TABLE school.students DELETE WHERE id = 1");

    return 'Operasi Update (Insert id 3 & Delete id 1) berhasil dijalankan!';
});

Route::get('/crud-delete', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Menghapus data dengan id = 1
    $client->writeOne("ALTER TABLE school.students DELETE WHERE id = 1");

    return 'Data siswa dengan id = 1 berhasil dihapus dari ClickHouse!';
});

Route::get('/analitik-rata-rata', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Menghitung rata-rata umur siswa per kelas
    $results = $client->readOne("
        SELECT grade, AVG(age) AS average_age
        FROM school.students
        GROUP BY grade
        ORDER BY grade
    ")->getRows();

    dd($results);
});

Route::get('/analitik-join', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Menggabungkan data siswa dan mata pelajaran
    $results = $client->readOne("
        SELECT s.name, c.subject
        FROM school.students s
        JOIN school.courses c
        ON s.id = c.student_id
    ")->getRows();

    dd($results);
});

Route::get('/analitik-csv', function () {
    $server = new Server(
        env('CLICKHOUSE_HOST', '127.0.0.1'),
        env('CLICKHOUSE_PORT', 8123),
        env('CLICKHOUSE_DATABASE', 'school'),
        env('CLICKHOUSE_USERNAME', 'default'),
        env('CLICKHOUSE_PASSWORD', '')
    );
    $client = new Client((new ServerProvider())->addServer($server));

    // Membaca file data.csv langsung dari ClickHouse
    $results = $client->readOne("SELECT * FROM file('data.csv', 'CSV')")->getRows();

    dd($results);
});

Route::get('/jalankan-queue', function () {
    \App\Jobs\InsertClickHouseData::dispatch();

    return 'Job InsertClickHouseData berhasil masuk ke dalam antrean (Queue)!';
});