#include <string>
using namespace std;

class Tiket {
    private:
        string kodeTiket;
        string namaFilm;
        int harga;
        string nomorKursi;
        string namaBioskop;

    public:
        Tiket(){ } //konstruktor

        Tiket(string kodeTiket, string namaFilm, int harga, string nomorKursi, string namaBioskop) {
            this->kodeTiket = kodeTiket;
            this->namaFilm = namaFilm;
            this->harga = harga;
            this->nomorKursi = nomorKursi;
            this->namaBioskop = namaBioskop;
        }

        // Getter dan Setter
        string getkodeTiket() const {
            return kodeTiket;
        }

        void setkodeTiket(string kodeTiket) {
            this->kodeTiket = kodeTiket;
        }

        string getnamaFilm() const {
            return namaFilm;
        }

        void setnamaFilm(string namaFilm) {
            this->namaFilm = namaFilm;
        }

        int getharga() const {
            return harga;
        }

        void setharga(int harga) {
            this->harga = harga;
        }

        string getnomorKursi() const {
            return nomorKursi;
        }

        void setnomorKursi(string nomorKursi) {
            this->nomorKursi = nomorKursi;
        }

        string getnamaBioskop() const {
            return namaBioskop;
        }

        void setnamaBioskop(string namaBioskop) {
            this->namaBioskop = namaBioskop;
        }   

    ~Tiket() { } //destruktor
};