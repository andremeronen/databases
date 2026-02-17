import sqlite3
import tkinter as tk
from tkinter import messagebox


# validate_data funktsioon, mis kontrollib kas sisestatud andmed on korrektsed
def validate_data():
    eesnimi = entries["eesnimi"].get()
    perenimi = entries["perenimi"].get()
    email = entries["email"].get()
    telefon = entries["telefon"].get()
    pilt = entries["pilt"].get()
    

    if not eesnimi:
        tk.messagebox.showerror("Viga", "eesnimi on kohustuslik!")
        return False
    if not perenimi:
        tk.messagebox.showerror("Viga", "perenimi on kohustuslik!")
        return False
    if not email:
        tk.messagebox.showerror("Viga", "email  on kohustuslik!")
        return False
    if not telefon:
        tk.messagebox.showerror("Viga", "telefon on kohustuslik!")
        return False
    if not pilt:
        tk.messagebox.showerror("Viga", "pilt on kohustuslik!")
        return False
   

    #tk.messagebox.showinfo("Edu", "Andmed on kehtivad!")
    return True
# valideerib andmed ja lisab need andmebaasi
def insert_data():
    if validate_data():
        connection = sqlite3.connect("ameronen.db")
        cursor = connection.cursor()

        cursor.execute("""
            INSERT INTO users (first_name, last_name, email, phone, image)
            VALUES (?, ?, ?, ?, ?)
        """, (
            entries["eesnimi"].get(),
            entries["perenimi"].get(),
            entries["email"].get(),
            entries["telefon"].get(),
            entries["pilt"].get()
            
        ))

        connection.commit()
        connection.close()

        messagebox.showinfo("Edu", "Andmed sisestati edukalt!")

# Loo Tkinteri aken
root = tk.Tk()
root.title("Kasutajate lisamine")
# Loo sildid ja sisestusväljad
labels = ["eesnimi", "perenimi", "email", "telefon", "pilt"]
entries = {}

for i, label in enumerate(labels):
    tk.Label(root, text=label).grid(row=i, column=0, padx=10, pady=5)
    entry = tk.Entry(root, width=40)
    entry.grid(row=i, column=1, padx=10, pady=5)
    entries[label] = entry

# Loo nupp andmete sisestamiseks
submit_button = tk.Button(root, text="Sisesta Kasutaja", command=insert_data)
submit_button.grid(row=len(labels), column=0, columnspan=2, pady=20)



# Näita Tkinteri akent
root.mainloop()