import csv
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jnjbiapplication"
)
mycursor = mydb.cursor()
with open('C:\\xampp\\htdocs\\Site\\jnj_bi_project\\users\\SuperAdmin\\uploads\\importActualSalesFileTemplate - Copy.csv', 'r') as csvfile:
    next(csvfile)
    csv_reader = csv.reader(csvfile, delimiter=',')
    for row in csv_reader:
        mycursor.execute('INSERT INTO jnj_dummy_actualsalesvalue (id, customerWWID, countryId, type, busSelector, category,\
            itemId, brandId, unit, jan_fcast, feb_fcast, mar_fcast, apr_fcast, may_fcast, jun_fcast, jul_fcast, aug_fcast, sep_fcast,\
            oct_fcast, nov_fcast, dec_fcast, sales, unitPrice, year, status, sapCode, divested, createdDate, modifiedDate) VALUES (%s,\
            %s,%s,"%s","%s","%s",%s,%s,"%s",%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)', row)
    mydb.commit()
print(mycursor.rowcount, "record inserted.")
