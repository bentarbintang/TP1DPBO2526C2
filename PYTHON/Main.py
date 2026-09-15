from Tiket import Tiket

list_tiket = []

def input_int(prompt: str) -> int:
    """Helper untuk validasi input angka agar program tidak crash."""
    while True:
        try:
            return int(input(prompt))
        except ValueError:
            print("Input harus berupa angka! Silakan coba lagi.")

def tampil_menu():
    print("+========================================+")
    print("|          MANAGEMENT BIOSKOP            |")
    print("+========================================+")
    print("| 1. Tambah Tiket                        |")
    print("| 2. Tampilkan Tiket                     |")
    print("| 3. Update Tiket                        |")
    print("| 4. Hapus Tiket                         |")
    print("| 5. Cari Tiket                          |")
    print("| 6. Keluar                              |")
    print("+========================================+")

def cetak_garis_tabel():
    print("+--------+----------------------+------------+----------+----------------+")

def cetak_header_tabel():
    cetak_garis_tabel()
    print(f"| {'Kode':<6} | {'Nama Film':<20} | {'Harga':<10} | {'Kursi':<8} | {'Bioskop':<14} |")
    cetak_garis_tabel()

def cetak_baris_tiket(t: Tiket):
    print(f"| {t.getkodeFilm():<6} | {t.getnamaFilm():<20} | {t.getharga():<10} | {t.getnomorKursi():<8} | {t.getnamaBioskop():<14} |")

def tambah_tiket():
    kode_film = input("Masukkan kode tiket: ")
    nama_film = input("Masukkan nama film: ")
    harga = input_int("Masukkan harga tiket: ")
    nomor_kursi = input("Masukkan nomor kursi: ")
    nama_bioskop = input("Masukkan nama bioskop: ")

    list_tiket.append(Tiket(kode_film, nama_film, harga, nomor_kursi, nama_bioskop))
    print("Tiket berhasil ditambahkan!")

def tampil_tiket():
    print("\n======= Daftar Tiket =======")
    if not list_tiket:
        print("Belum ada data tiket.")
        return
    cetak_header_tabel()
    for tiket in list_tiket:
        cetak_baris_tiket(tiket)
    cetak_garis_tabel()

def cari_tiket_by_kode(kode_film: str):
    for tiket in list_tiket:
        if tiket.getkodeFilm() == kode_film:
            return tiket
    return None

def update_tiket():
    kode_film = input("Masukkan kode tiket yang ingin diupdate: ")
    tiket_ditemukan = cari_tiket_by_kode(kode_film)

    if tiket_ditemukan is not None:
        nama_film = input("Masukkan nama film baru: ")
        harga = input_int("Masukkan harga tiket baru: ")
        nomor_kursi = input("Masukkan nomor kursi baru: ")
        nama_bioskop = input("Masukkan nama bioskop baru: ")

        tiket_ditemukan.setnamaFilm(nama_film)
        tiket_ditemukan.setharga(harga)
        tiket_ditemukan.setnomorKursi(nomor_kursi)
        tiket_ditemukan.setnamaBioskop(nama_bioskop)

        print("Tiket berhasil diupdate!")
    else:
        print(f"Tiket dengan kode {kode_film} tidak ditemukan.")

def hapus_tiket():
    kode_film = input("Masukkan kode tiket yang ingin dihapus: ")
    tiket_ditemukan = cari_tiket_by_kode(kode_film)

    if tiket_ditemukan is not None:
        list_tiket.remove(tiket_ditemukan)
        print("Tiket berhasil dihapus!")
    else:
        print(f"Tiket dengan kode {kode_film} tidak ditemukan.")

def menu_cari_tiket():
    kode_film = input("Masukkan kode tiket yang ingin dicari: ")
    tiket_ditemukan = cari_tiket_by_kode(kode_film)

    if tiket_ditemukan is not None:
        cetak_header_tabel()
        cetak_baris_tiket(tiket_ditemukan)
        cetak_garis_tabel()
    else:
        print(f"Tiket dengan kode {kode_film} tidak ditemukan.")

def main():
    # Data Awal
    list_tiket.append(Tiket("T01", "Avangers", 45000, "F19", "LTDIX"))
    list_tiket.append(Tiket("T02", "Spiderman", 50000, "A1", "CGV"))

    pilihan = 0
    while pilihan != 6:
        tampil_menu()
        pilihan = input_int("Pilih menu: ")

        if pilihan == 1:
            tambah_tiket()
        elif pilihan == 2:
            tampil_tiket()
        elif pilihan == 3:
            update_tiket()
        elif pilihan == 4:
            hapus_tiket()
        elif pilihan == 5:
            menu_cari_tiket()
        elif pilihan == 6:
            print("Terima kasih!")
        else:
            print("Pilihan tidak valid!")

if __name__ == "__main__":
    main()