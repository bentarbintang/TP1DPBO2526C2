class Tiket:

    # constructor
    def __init__(self, kodeFilm:str, namaFilm:str, harga:int, nomorKursi:str, namaBioskop:str):
        self.__kodeFilm = str(kodeFilm)
        self.__namaFilm = str(namaFilm)
        self.__harga = int(harga)
        self.__nomorKursi = str(nomorKursi)
        self.__namaBioskop = str(namaBioskop)

    # getter
    def getkodeFilm(self) -> str:
        return self.__kodeFilm

    def getnamaFilm(self) -> str:
        return self.__namaFilm

    def getharga(self) -> int:
        return self.__harga

    def getnomorKursi(self) -> str:
        return self.__nomorKursi

    def getnamaBioskop(self) -> str:
        return self.__namaBioskop

    # setter
    def setkodeFilm(self, kodeFilm:str) -> None:
        self.__kodeFilm = str(kodeFilm)

    def setnamaFilm(self, namaFilm:str) -> None:
        self.__namaFilm = str(namaFilm)

    def setharga(self, harga:int) -> None:
        self.__harga = int(harga)

    def setnomorKursi(self, nomorKursi:str) -> None:
        self.__nomorKursi = str(nomorKursi)

    def setnamaBioskop(self, namaBioskop:str) -> None:
        self.__namaBioskop = str(namaBioskop)