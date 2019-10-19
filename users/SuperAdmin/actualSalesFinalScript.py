import csv
import mysql.connector
from datetime import datetime
from datetime import date

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jnjbiapplication"
)
mycursor = mydb.cursor()
arrayA = []
with open('uploads/importActualSalesFileTemplate.csv', 'r') as csvfile:
    csv_reader = csv.reader(csvfile, delimiter=',')
    line_count = 0
    for row in csv_reader:
        if line_count == 0:
            print(f'Column names are {", ".join(row)}')
            line_count += 1
        else:
            line_count += 1
            valueToBeInserted = (row[1], row[2], row[3].replace("?","").strip(), row[4], row[5].replace("?","").strip(), row[6], row[7], row[8], row[9],\
                                 row[10], row[11],row[12], row[13], row[14], row[15], row[16], row[17], row[18], row[19], row[20], row[21], row[22],\
                                 row[23], row[24],row[25], row[26], datetime.now(), datetime.today())
            arrayA.append(valueToBeInserted)

    for abc in arrayA:
        mycursor.execute('INSERT INTO jnj_dummy_actualsalesvalue (customerWWID, countryId, type, busSelector, category,\
            itemId, brandId, unit, jan_fcast, feb_fcast, mar_fcast, apr_fcast, may_fcast, jun_fcast, jul_fcast, aug_fcast, sep_fcast,\
            oct_fcast, nov_fcast, dec_fcast, sales, unitPrice, year, status, sapCode, divested, createdDate, modifiedDate) VALUES (\
            %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)', abc)
        
    mydb.commit()
print(mycursor.rowcount, "record inserted.")
print(f'Processed {line_count} lines.')
