public class Tiket {
        //atribut
        private String kodeTiket;
        private String namaFilm;
        private int harga;
        private String nomorKursi;
        private String namaBioskop;
        
        public Tiket(){ }
        public Tiket(String kodeTiket, String namaFilm, int harga, String nomorKursi, String namaBioskop){
                this.kodeTiket = kodeTiket;
                this.namaFilm = namaFilm;
                this.harga = harga;
                this.nomorKursi = nomorKursi;
                this.namaBioskop = namaBioskop;
        }

        //getset
        public String getkodeTiket(){
                return kodeTiket;
        }

        public void setkodeTiket(String kodeTiket){
                this.kodeTiket = kodeTiket;
        }

        public String getnamaFilm(){
                return namaFilm;
        }

        public void setnamaFilm(String namaFilm){
                this.namaFilm = namaFilm;
        }

        public int getHarga(){
                return harga;
        }

        public void setHarga(int harga){
                this.harga = harga;
        }

        public String getnomorKursi(){
                return nomorKursi;
        }

        public void setnomorKursi(String nomorKursi){
                this.nomorKursi = nomorKursi;
        }

        public String getnamaBioskop(){
                return namaBioskop;
        }

        public void setnamaBioskop(String namaBioskop){
                this.namaBioskop = namaBioskop;
        }
}
