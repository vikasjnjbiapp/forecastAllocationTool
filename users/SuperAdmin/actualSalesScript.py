import csv
import mysql.connector

with open('uploads/jnj_actualsalesvalue.csv', 'r') as csvfile:
     reader = csv.reader(csvfile)
     for row in reader:
        print(row)

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jnjbiapplication"
)
mycursor = mydb.cursor()

mycursor.execute("SHOW TABLES")

for x in mycursor:
  print(x)