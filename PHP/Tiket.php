<?php

class Tiket {
    private string $kodeTiket;
    private string $namaFilm;
    private int $harga;
    private string $nomorKursi;
    private string $namaBioskop;
    private string $gambar; // path file lokal gambar tiket/poster film

    public function __construct(
        string $kodeTiket = "",
        string $namaFilm = "",
        int $harga = 0,
        string $nomorKursi = "",
        string $namaBioskop = "",
        string $gambar = ""
    ) {
        $this->kodeTiket = $kodeTiket;
        $this->namaFilm = $namaFilm;
        $this->harga = $harga;
        $this->nomorKursi = $nomorKursi;
        $this->namaBioskop = $namaBioskop;
        $this->gambar = $gambar;
    }

    // getter
    public function getKodeTiket(): string { return $this->kodeTiket; }
    public function getNamaFilm(): string { return $this->namaFilm; }
    public function getHarga(): int { return $this->harga; }
    public function getNomorKursi(): string { return $this->nomorKursi; }
    public function getNamaBioskop(): string { return $this->namaBioskop; }
    public function getGambar(): string { return $this->gambar; }

    // setter
    public function setKodeTiket(string $kodeTiket): void { $this->kodeTiket = $kodeTiket; }
    public function setNamaFilm(string $namaFilm): void { $this->namaFilm = $namaFilm; }
    public function setHarga(int $harga): void { $this->harga = $harga; }
    public function setNomorKursi(string $nomorKursi): void { $this->nomorKursi = $nomorKursi; }
    public function setNamaBioskop(string $namaBioskop): void { $this->namaBioskop = $namaBioskop; }
    public function setGambar(string $gambar): void { $this->gambar = $gambar; }

    // ubah object jadi array asosiatif, supaya gampang disimpan di $_SESSION
    public function toArray(): array {
        return [
            'kodeTiket'   => $this->kodeTiket,
            'namaFilm'    => $this->namaFilm,
            'harga'       => $this->harga,
            'nomorKursi'  => $this->nomorKursi,
            'namaBioskop' => $this->namaBioskop,
            'gambar'      => $this->gambar,
        ];
    }

    // bikin object Tiket dari array asosiatif (kebalikan dari toArray)
    public static function fromArray(array $data): Tiket {
        return new Tiket(
            $data['kodeTiket'] ?? "",
            $data['namaFilm'] ?? "",
            (int)($data['harga'] ?? 0),
            $data['nomorKursi'] ?? "",
            $data['namaBioskop'] ?? "",
            $data['gambar'] ?? ""
        );
    }
}
