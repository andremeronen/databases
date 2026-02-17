import tkinter as tk
from tkinter import ttk
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
            SELECT first_name, last_name, email, phone, image
            FROM users
            WHERE first_name LIKE ?
        """, ('%' + search_query + '%',))
    else:
        cursor.execute("""
            SELECT first_name, last_name, email, phone, image
            FROM users
        """)

    rows = cursor.fetchall()

    for row in rows:
        tree.insert("", "end", values=row)

    conn.close()


# Otsing
def on_search():
    query = search_entry.get()
    load_data_from_db(query)


# Avab 19.py
def add_user():
    subprocess.run([sys.executable, "tkinter19.py"])
    load_data_from_db()  # värskenda pärast sulgemist

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
add_button.pack(side=tk.LEFT, padx=20)


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