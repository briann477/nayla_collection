# N.A.Y.L.A Collection E-Commerce

N.A.Y.L.A Collection E-Commerce adalah sistem informasi penjualan berbasis website yang dirancang untuk membantu proses penjualan online pada Nayla Collection Depok. Sistem ini mendukung proses pengelolaan produk, pemesanan, pembayaran, verifikasi pesanan, hingga laporan penjualan.

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template
- HTML
- CSS
- JavaScript
- Laragon

## Fitur Customer

- Melihat halaman utama website
- Melihat katalog produk
- Filter produk berdasarkan kategori
- Melihat detail produk
- Menambahkan produk ke keranjang
- Melakukan checkout
- Memilih metode pembayaran COD, Transfer Virtual Account dummy, atau QRIS dummy
- Upload bukti pembayaran
- Melihat riwayat pesanan
- Melihat detail pesanan
- Menandai pesanan sebagai diterima

## Fitur Admin

- Login admin
- Dashboard admin
- Mengelola kategori produk
- Mengelola data produk
- Mengelola stok, harga, status, dan gambar produk
- Melihat daftar pesanan customer
- Melihat detail pesanan
- Memeriksa bukti pembayaran
- Mengubah status pembayaran
- Mengubah status pesanan
- Melihat laporan penjualan
- Mencetak laporan penjualan

## Alur Sistem

Customer membuka website N.A.Y.L.A, melihat katalog produk, memilih produk, memasukkan produk ke keranjang, lalu melakukan checkout. Setelah checkout, customer memilih metode pembayaran. Jika memilih Transfer Virtual Account atau QRIS, customer dapat mengunggah bukti pembayaran. Admin kemudian memeriksa pesanan dan bukti pembayaran, mengubah status pembayaran, memproses pesanan, serta melihat laporan penjualan.

## Catatan Pembayaran

Metode pembayaran Transfer Virtual Account dan QRIS pada sistem ini masih berupa simulasi atau dummy. Sistem belum terhubung dengan payment gateway resmi. QRIS dummy dibuat sebagai tampilan visual untuk mendukung alur demo pembayaran, sedangkan verifikasi pembayaran dilakukan secara manual oleh admin melalui bukti pembayaran yang diunggah customer.

## Database Utama

Tabel utama yang digunakan pada sistem ini adalah:

- users
- categories
- products
- carts
- orders
- order_items

Tabel bawaan Laravel seperti migrations, sessions, cache, jobs, dan password reset tokens tidak dimasukkan sebagai tabel utama proses bisnis karena hanya digunakan untuk kebutuhan teknis framework.

## Cara Menjalankan Project

1. Clone repository project.
2. Jalankan `composer install`.
3. Copy file `.env.example` menjadi `.env`.
4. Atur konfigurasi database pada file `.env`.
5. Jalankan `php artisan key:generate`.
6. Jalankan `php artisan migrate`.
7. Jalankan `php artisan storage:link`.
8. Jalankan `npm install`.
9. Jalankan `npm run build`.
10. Jalankan `php artisan serve`.
11. Buka aplikasi pada `http://127.0.0.1:8000`.

## Tujuan Project

Project ini dibuat sebagai implementasi sistem informasi penjualan berbasis website pada UMKM Nayla Collection. Sistem ini diharapkan dapat membantu proses penjualan, pengelolaan produk, pengelolaan pesanan, pembayaran, serta pembuatan laporan penjualan secara lebih terstruktur.
