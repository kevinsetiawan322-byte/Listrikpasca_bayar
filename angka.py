def input_angka():
    """Meminta pengguna untuk memasukkan angka dan mengembalikan daftar angka."""
    angka = []
    while True:
        input_angka = input("Masukkan angka (0 untuk selesai): ")
        if input_angka == "0":
            break
        else:
            angka.append(int(input_angka))
    return angka

def sorting(angka):
    """Mengurutkan daftar angka dan mengembalikan daftar yang telah diurutkan."""
    angka.sort()
    return angka

def searching(angka, target):
    """Mencari angka target dalam daftar angka dan mengembalikan True jika ditemukan, False jika tidak."""
    return target in angka

# Inisialisasi variabel angka
angka = []

while True:
    print("Menu Pilihan:")
    print("1. Input angka")
    print("2. Sorting")
    print("3. Searching")
    print("4. Selesai")

    pilihan = input("Masukkan pilihan: ")

    if pilihan == "1":
        angka = input_angka()
        print("Angka yang dimasukkan:", angka)
    elif pilihan == "2":
        if angka:
            angka = sorting(angka)
            print("Angka setelah diurutkan:", angka)
        else:
            print("Silakan masukkan angka terlebih dahulu.")
    elif pilihan == "3":
        if angka:
            target = int(input("Masukkan angka yang ingin dicari: "))
            found = searching(angka, target)
            if found:
                print("Angka ditemukan.")
            else:
                print("Angka tidak ditemukan.")
        else:
            print("Silakan masukkan angka terlebih dahulu.")
    elif pilihan == "4":
        print("Program selesai.")
        break
    else:
        print("Pilihan tidak valid.")