import java.util.ArrayList;
import java.util.Scanner;

public class Main{
    private static ArrayList<Tiket> listTiket = new ArrayList<>();
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args){
        listTiket.add(new Tiket("T01", "Avangers", 45000, "F19", "LTDIX"));
        listTiket.add(new Tiket("T02", "Spiderman", 50000, "A1", "CGV"));

        int pilihan = 0;
        while (pilihan != 6) {
            System.out.println("___ MANAGEMENT BIOSKOP ___");
            System.out.println("1. Tambah Tiket");
            System.out.println("2. Tampilkan Tiket");
            System.out.println("3. Update Tiket");
            System.out.println("4. Hapus Tiket");
            System.out.println("5. Cari Tiket");
            System.out.println("6. Keluar");
            pilihan = scanner.nextInt();
            scanner.nextLine();
            
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
                    cariTiket();
                    break;
                case 6:
                    System.out.println("Terima kasih!");
                    break;
                default:
                    System.out.println("Pilihan tidak valid!");
            }
        }
    }

    private static void tambahTiket() {
        System.out.print("Masukkan kode tiket: ");
        String kodeTiket = scanner.nextLine();
        System.out.print("Masukkan nama film: ");
        String namaFilm = scanner.nextLine();
        System.out.print("Masukkan harga tiket: ");
        int harga = scanner.nextInt();
        scanner.nextLine(); // consume newline
        System.out.print("Masukkan nomor kursi: ");
        String nomorKursi = scanner.nextLine();
        System.out.print("Masukkan nama bioskop: ");
        String namaBioskop = scanner.nextLine();

        Tiket tiketBaru = new Tiket(kodeTiket, namaFilm, harga, nomorKursi, namaBioskop);
        listTiket.add(tiketBaru);
        System.out.println("Tiket berhasil ditambahkan!");
    }

    private static void tampilTiket() {
        System.out.println("======= Daftar Tiket =======");
        for (Tiket tiket : listTiket) {
            System.out.println("Kode Tiket: " + tiket.getkodeTiket());
            System.out.println("Nama Film: " + tiket.getnamaFilm());
            System.out.println("Harga: " + tiket.getHarga());
            System.out.println("Nomor Kursi: " + tiket.getnomorKursi());
            System.out.println("Nama Bioskop: " + tiket.getnamaBioskop());
            System.out.println("================================");
        }
    }

    private static void updateTiket() {
        System.out.print("Masukkan kode tiket yang ingin diupdate: ");
        String kodeTiket = scanner.nextLine();
        Tiket tiketDitemukan = cariTiket(kodeTiket);

        if (tiketDitemukan != null) {
            System.out.print("Masukkan nama film baru: ");
            String namaFilm = scanner.nextLine();
            System.out.print("Masukkan harga tiket baru: ");
            int harga = scanner.nextInt();
            scanner.nextLine(); // consume newline
            System.out.print("Masukkan nomor kursi baru: ");
            String nomorKursi = scanner.nextLine();
            System.out.print("Masukkan nama bioskop baru: ");
            String namaBioskop = scanner.nextLine();

            tiketDitemukan.setnamaFilm(namaFilm);
            tiketDitemukan.setHarga(harga);
            tiketDitemukan.setnomorKursi(nomorKursi);
            tiketDitemukan.setnamaBioskop(namaBioskop);

            System.out.println("Tiket berhasil diupdate!");
        } else {
            System.out.println("Tiket dengan kode " + kodeTiket + " tidak ditemukan.");
        }
    }

    private static void hapusTiket() {
        System.out.print("Masukkan kode tiket yang ingin dihapus: ");
        String kodeTiket = scanner.nextLine();
        Tiket tiketDitemukan = null;

        for (Tiket tiket : listTiket) {
            if (tiket.getkodeTiket().equals(kodeTiket)) {
                tiketDitemukan = tiket;
                break;
            }
        }

        if (tiketDitemukan != null) {
            listTiket.remove(tiketDitemukan);
            System.out.println("Tiket berhasil dihapus!");
        } else {
            System.out.println("Tiket dengan kode " + kodeTiket + " tidak ditemukan.");
        }
    }

    private static Tiket cariTiket(String kodeTiket) {
        for (Tiket tiket : listTiket) {
            if (tiket.getkodeTiket().equals(kodeTiket)) {
                return tiket;
            }
        }
        return null;
    }

    private static void cariTiket() {
        System.out.print("Masukkan kode tiket yang ingin dicari: ");
        String kodeTiket = scanner.nextLine();
        Tiket tiketDitemukan = cariTiket(kodeTiket);

        if (tiketDitemukan != null) {
            System.out.println("Kode Tiket: " + tiketDitemukan.getkodeTiket());
            System.out.println("Nama Film: " + tiketDitemukan.getnamaFilm());
            System.out.println("Harga: " + tiketDitemukan.getHarga());
            System.out.println("Nomor Kursi: " + tiketDitemukan.getnomorKursi());
            System.out.println("Nama Bioskop: " + tiketDitemukan.getnamaBioskop());
        } else {
            System.out.println("Tiket dengan kode " + kodeTiket + " tidak ditemukan.");
        }
    }
}