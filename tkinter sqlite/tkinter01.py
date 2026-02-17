import tkinter as tk 

aken=tk.Tk()
aken.title("Andre tinkeri aken")
aken.geometry("400x400")
aken.resizable(True,False)

button=tk.Button(aken, text="sulge", command=aken.destroy)
button.pack()
aken.mainloop()