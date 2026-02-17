import tkinter as tk
from tkinter import ttk, messagebox
import sqlite3
import subprocess
import sys

# Andmete laadimine
def load_data_from_db(search_query=""):
    # Puhasta tabel
    for item in tree.get_children():
        tree.delete(item)

    conn = sqlite3.connect("ameronen.db")
    cursor = conn.cursor()

    if search_query:
        cursor.execute("""
            SELECT rowid, first_name, last_name, email, phone, image
            FROM users
            WHERE first_name LIKE ?
        """, ('%' + search_query + '%',))
    else:
        cursor.execute("""
            SELECT rowid, first_name, last_name, email, phone, image
            FROM users
        """)

    rows = cursor.fetchall()

    for row in rows:
        tree.insert("", "end", iid=row[0], values=row[1:])  # iid=row[0] = unikaalne ID

    conn.close()

# Otsing
def on_search():
    query = search_entry.get()
    load_data_from_db(query)

# Lisa kasutaja (avatakse tkinter19.py)

def add_user():
    subprocess.run([sys.executable, "tkinter19.py"])
    load_data_from_db()  # värskenda pärast sulgemist

# Uuendamine
def on_update():
    selected_item = tree.selection()
    if not selected_item:
        messagebox.showwarning("Valik puudub", "Palun vali kõigepealt rida!")
        return

    record_id = selected_item[0]
    
    # Hangi valitud rea andmed
    record_values = tree.item(selected_item[0], "values")
    open_update_window(record_id, record_values)

def open_update_window(record_id, record_values):
    update_window = tk.Toplevel(root)
    update_window.title("Muuda kasutaja andmeid")

    labels = ["Eesnimi", "Perekonnanimi", "Email", "Telefon", "Pildi URL"]
    entries = {}

    for i, label in enumerate(labels):
        tk.Label(update_window, text=label).grid(row=i, column=0, padx=10, pady=5, sticky=tk.W)
        entry = tk.Entry(update_window, width=50)
        entry.grid(row=i, column=1, padx=10, pady=5)
        entry.insert(0, record_values[i])
        entries[label] = entry

    save_button = tk.Button(
        update_window,
        text="Salvesta",
        command=lambda: update_record(record_id, entries, update_window)
    )
    save_button.grid(row=len(labels), column=0, columnspan=2, pady=10)

def update_record(record_id, entries, window):
    first_name = entries["Eesnimi"].get()
    last_name = entries["Perekonnanimi"].get()
    email = entries["Email"].get()
    phone = entries["Telefon"].get()
    image = entries["Pildi URL"].get()

    try:
        conn = sqlite3.connect("ameronen.db")
        cursor = conn.cursor()

        cursor.execute("""
            UPDATE users
            SET first_name=?, last_name=?, email=?, phone=?, image=?
            WHERE rowid=?
        """, (first_name, last_name, email, phone, image, record_id))
        conn.commit()

        if cursor.rowcount > 0:
            messagebox.showinfo("Edukas", "Andmed on edukalt uuendatud!")
        else:
            messagebox.showwarning("Hoiatus", "Andmeid ei muudetud!")

        conn.close()

        load_data_from_db()  # värskenda Treeview
        window.destroy()

    except Exception as e:
        messagebox.showerror("Viga", f"Andmete uuendamine ebaõnnestus!\n{e}")

# GUI
root = tk.Tk()
root.title("Users andmebaas")
root.geometry("950x500")

# OTSINGURIBA
search_frame = tk.Frame(root)
search_frame.pack(pady=10)

search_label = tk.Label(search_frame, text="Otsi eesnime järgi:")
search_label.pack(side=tk.LEFT)

search_entry = tk.Entry(search_frame, width=30)
search_entry.pack(side=tk.LEFT, padx=10)

search_button = tk.Button(search_frame, text="Otsi", command=on_search)
search_button.pack(side=tk.LEFT)

add_button = tk.Button(search_frame, text="Lisa kasutaja", command=add_user)
add_button.pack(side=tk.LEFT, padx=10)

update_button = tk.Button(search_frame, text="Uuenda kasutajat", command=on_update)
update_button.pack(side=tk.LEFT, padx=10)

# TABEL
frame = tk.Frame(root)
frame.pack(fill=tk.BOTH, expand=True)

scrollbar = tk.Scrollbar(frame)
scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

tree = ttk.Treeview(
    frame,
    yscrollcommand=scrollbar.set,
    columns=("first_name", "last_name", "email", "phone", "image"),
    show="headings"
)

tree.pack(fill=tk.BOTH, expand=True)
scrollbar.config(command=tree.yview)

# VEERUD
columns = {
    "first_name": ("Eesnimi", 120),
    "last_name": ("Perekonnanimi", 120),
    "email": ("Email", 200),
    "phone": ("Telefon", 120),
    "image": ("Pildi URL", 250),
}

for col, (text, width) in columns.items():
    tree.heading(col, text=text)
    tree.column(col, width=width)

# Lae andmed käivitamisel
load_data_from_db()

root.mainloop()