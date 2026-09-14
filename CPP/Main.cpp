#include <iostream>
#include <vector>
#include <string>
#include <iomanip>
#include <limits>
#include "Tiket.cpp" // Pastikan class Tiket sudah di-include

using namespace std;

// Deklarasi global vector untuk menyimpan daftar tiket
vector<Tiket> listTiket;

// Deklarasi fungsi/prosedur
void tampilMenu();
void tambahTiket();
void cetakGarisTabel();
void cetakHeaderTabel();
void cetakBarisTiket(const Tiket& t);
void tampilTiket();
Tiket* cariTiket(const string& kodeTiket);
void cariTiketMenu();
void updateTiket();
void hapusTiket();

int main() {
    // Menambahkan data awal
    listTiket.push_back(Tiket("T01", "Avangers", 45000, "F19", "LTDIX"));
    listTiket.push_back(Tiket("T02", "Spiderman", 50000, "A1", "CGV"));

    int pilihan = 0;
    while (pilihan != 6) {
        tampilMenu();
        cin >> pilihan;
        cin.ignore(numeric_limits<streamsize>::max(), '\n'); // Membersihkan buffer input newline

        switch (pilihan) {
            case 1:
                tambahTiket();
                break;
            case 2:
                tampilTiket();
                break;
            case 3:
                updateTiket();
                break;
            case 4:
                hapusTiket();
                break;
            case 5:
                cariTiketMenu();
                break;
            case 6:
                cout << "Terima kasih!" << endl;
                break;
            default:
                cout << "Pilihan tidak valid!" << endl;
        }
    }

    return 0;
}

void tampilMenu() {
    cout << "+========================================+" << endl;
    cout << "|          MANAGEMENT BIOSKOP            |" << endl;
    cout << "+========================================+" << endl;
    cout << "| 1. Tambah Tiket                        |" << endl;
    cout << "| 2. Tampilkan Tiket                     |" << endl;
    cout << "| 3. Update Tiket                        |" << endl;
    cout << "| 4. Hapus Tiket                         |" << endl;
    cout << "| 5. Cari Tiket                          |" << endl;
    cout << "| 6. Keluar                              |" << endl;
    cout << "+========================================+" << endl;
    cout << "Pilih menu: ";
}

void tambahTiket() {
    string kodeTiket, namaFilm, nomorKursi, namaBioskop;
    int harga;

    cout << "Masukkan kode tiket: ";
    getline(cin, kodeTiket);
    cout << "Masukkan nama film: ";
    getline(cin, namaFilm);
    cout << "Masukkan harga tiket: ";
    cin >> harga;
    cin.ignore(numeric_limits<streamsize>::max(), '\n');
    cout << "Masukkan nomor kursi: ";
    getline(cin, nomorKursi);
    cout << "Masukkan nama bioskop: ";
    getline(cin, namaBioskop);

    listTiket.push_back(Tiket(kodeTiket, namaFilm, harga, nomorKursi, namaBioskop));
    cout << "Tiket berhasil ditambahkan!" << endl;
}

void cetakGarisTabel() {
    cout << "+--------+----------------------+------------+----------+----------------+" << endl;
}

void cetakHeaderTabel() {
    cetakGarisTabel();
    cout << "| " << left << setw(6) << "Kode"
        << " | " << left << setw(20) << "Nama Film"
        << " | " << left << setw(10) << "Harga"
        << " | " << left << setw(8) << "Kursi"
        << " | " << left << setw(14) << "Bioskop" << " |" << endl;
    cetakGarisTabel();
}

void cetakBarisTiket(const Tiket& t) {
    cout << "| " << left << setw(6) << t.getkodeTiket()
        << " | " << left << setw(20) << t.getnamaFilm()
        << " | " << left << setw(10) << t.getharga()
        << " | " << left << setw(8) << t.getnomorKursi()
        << " | " << left << setw(14) << t.getnamaBioskop() << " |" << endl;
}

void tampilTiket() {
    cout << "\n======= Daftar Tiket =======" << endl;
    if (listTiket.empty()) {
        cout << "Belum ada data tiket." << endl;
        return;
    }
    cetakHeaderTabel();
    for (const auto& tiket : listTiket) {
        cetakBarisTiket(tiket);
    }
    cetakGarisTabel();
}

Tiket* cariTiket(const string& kodeTiket) {
    for (auto& tiket : listTiket) {
        if (tiket.getkodeTiket() == kodeTiket) {
            return &tiket; // Mengembalikan pointer ke tiket yang ditemukan
        }
    }
    return nullptr;
}

void cariTiketMenu() {
    string kodeTiket;
    cout << "Masukkan kode tiket yang ingin dicari: ";
    getline(cin, kodeTiket);
    
    Tiket* tiketDitemukan = cariTiket(kodeTiket);

    if (tiketDitemukan != nullptr) {
        cetakHeaderTabel();
        cetakBarisTiket(*tiketDitemukan);
        cetakGarisTabel();
    } else {
        cout << "Tiket dengan kode " << kodeTiket << " tidak ditemukan." << endl;
    }
}

void updateTiket() {
    string kodeTiket;
    cout << "Masukkan kode tiket yang ingin diupdate: ";
    getline(cin, kodeTiket);
    
    Tiket* tiketDitemukan = cariTiket(kodeTiket);

    if (tiketDitemukan != nullptr) {
        string namaFilm, nomorKursi, namaBioskop;
        int harga;

        cout << "Masukkan nama film baru: ";
        getline(cin, namaFilm);
        cout << "Masukkan harga tiket baru: ";
        cin >> harga;
        cin.ignore(numeric_limits<streamsize>::max(), '\n');
        cout << "Masukkan nomor kursi baru: ";
        getline(cin, nomorKursi);
        cout << "Masukkan nama bioskop baru: ";
        getline(cin, namaBioskop);

        tiketDitemukan->setnamaFilm(namaFilm);
        tiketDitemukan->setharga(harga);
        tiketDitemukan->setnomorKursi(nomorKursi);
        tiketDitemukan->setnamaBioskop(namaBioskop);

        cout << "Tiket berhasil diupdate!" << endl;
    } else {
        cout << "Tiket dengan kode " << kodeTiket << " tidak ditemukan." << endl;
    }
}

void hapusTiket() {
    string kodeTiket;
    cout << "Masukkan kode tiket yang ingin dihapus: ";
    getline(cin, kodeTiket);

    for (auto it = listTiket.begin(); it != listTiket.end(); ++it) {
        if (it->getkodeTiket() == kodeTiket) {
            listTiket.erase(it);
            cout << "Tiket berhasil dihapus!" << endl;
            return;
        }
    }
    cout << "Tiket dengan kode " << kodeTiket << " tidak ditemukan." << endl;
}