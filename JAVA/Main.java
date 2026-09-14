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
            tampilMenu();
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

    private static void tampilMenu() {
        System.out.println("+========================================+");
        System.out.println("|          MANAGEMENT BIOSKOP             |");
        System.out.println("+========================================+");
        System.out.println("| 1. Tambah Tiket                         |");
        System.out.println("| 2. Tampilkan Tiket                      |");
        System.out.println("| 3. Update Tiket                         |");
        System.out.println("| 4. Hapus Tiket                          |");
        System.out.println("| 5. Cari Tiket                           |");
        System.out.println("| 6. Keluar                               |");
        System.out.println("+========================================+");
        System.out.print("Pilih menu: ");
    }

    private static void tambahTiket() {
        System.out.print("Masukkan kode tiket: ");
        String kodeTiket = scanner.nextLine();
        System.out.print("Masukkan nama film: ");
        String namaFilm = scanner.nextLine();
        System.out.print("Masukkan harga tiket: ");
        int harga = scanner.nextInt();
        scanner.nextLine();
        System.out.print("Masukkan nomor kursi: ");
        String nomorKursi = scanner.nextLine();
        System.out.print("Masukkan nama bioskop: ");
        String namaBioskop = scanner.nextLine();

        listTiket.add(new Tiket(kodeTiket, namaFilm, harga, nomorKursi, namaBioskop));
        System.out.println("Tiket berhasil ditambahkan!");
    }

    private static void cetakGarisTabel() {
        System.out.println("+--------+----------------------+------------+----------+----------------+");
    }

    private static void cetakHeaderTabel() {
        cetakGarisTabel();
        System.out.printf("| %-6s | %-20s | %-10s | %-8s | %-14s |%n",
                "Kode", "Nama Film", "Harga", "Kursi", "Bioskop");
        cetakGarisTabel();
    }

    private static void cetakBarisTiket(Tiket t) {
        System.out.printf("| %-6s | %-20s | %-10d | %-8s | %-14s |%n",
                t.getkodeTiket(), t.getnamaFilm(), t.getHarga(), t.getnomorKursi(), t.getnamaBioskop());
    }

    private static void tampilTiket() {
        System.out.println("\n======= Daftar Tiket =======");
        if (listTiket.isEmpty()) {
            System.out.println("Belum ada data tiket.");
            return;
        }
        cetakHeaderTabel();
        for (Tiket tiket : listTiket) {
            cetakBarisTiket(tiket);
        }
        cetakGarisTabel();
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
            scanner.nextLine();
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
        Tiket tiketDitemukan = cariTiket(kodeTiket);

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
            cetakHeaderTabel();
            cetakBarisTiket(tiketDitemukan);
            cetakGarisTabel();
        } else {
            System.out.println("Tiket dengan kode " + kodeTiket + " tidak ditemukan.");
        }
    }
}