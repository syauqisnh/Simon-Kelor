import mysql.connector
import pandas as pd
import numpy as np

connection = mysql.connector.connect(
  host="localhost", 
  user="root",
  passwd="",
  database="db_simonkelor_native"
)

if connection:
    print("connection success")
else:
    print("gagal connection")

dataset = pd.read_excel('C:/Users/User/Documents/data_kedua.xlsx')
for index, row in dataset.iterrows():
    a = row['Waktu']
    b = float(row['PLTU BOLOK   UNIT 1'])
    c = float(row['PLTU BOLOK   UNIT 2'])
    d = float(row['PLTU IPP KUPANG BARU   UNIT 1'])
    e = float(row['PLTU IPP KUPANG BARU   UNIT 2'])
    f = float(row['PLTD COGINDO (PLANT)'])
    g = float(row['PLTMG KPG PEAKER (PLANT)'])
    h = float(row['PLTS IPP KUPANG'])
    i = float(row['PLTS IPP ATAMBUA'])
    r = float(row['ULPL KUPANG   NIGATA'])
    k = float(row['ULPL KUPANG   MAK'])
    l = float(row['ULPL ATAMBUA   CAT 2'])
    m = float(row['ULPL ATAMBUA   MWM'])
    n = float(row['ULPL ATAMBUA   SWD'])
    o = float(row['PLTU TIMOR-1   UNIT 1'])
    p = float(row['PLTU TIMOR-1   UNIT 2'])
    q = float(row['BEBAN KIT'])
    
    cursor = connection.cursor()
    sql = "INSERT INTO beban_kit VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
    cursor.execute(sql, (a, b, c, d, e, f, g, h, i, r, k, l, m, n, o, p, q))
    connection.commit()

print("{} data berhasil disimpan".format(cursor.rowcount))


