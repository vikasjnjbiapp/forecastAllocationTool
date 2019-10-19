import csv
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="jnjbiapplication"
)
mycursor = mydb.cursor()
with open('C:\\xampp\\htdocs\\Site\\jnj_bi_project\\users\\PricingTeam\\uploads\\importPricingFileTemplate_new.csv', 'r') as csvfile:
    next(csvfile)
    csv_data = csv.reader(csvfile, delimiter=',')
    for row in csv_data:
        mycursor.execute('INSERT INTO jnj_pricing_dataentry (material, SKU, countryCode, \
            currency, cif_jan, cif_feb, cif_mar, cif_apr, cif_may, cif_jun, cif_jul, \
            cif_aug, cif_sep, cif_oct, cif_nov, cif_dec, tnd_jan, tnd_feb, tnd_mar, tnd_apr, \
            tnd_may, tnd_jun, tnd_jul, tnd_aug, tnd_sep, tnd_oct, tnd_nov, tnd_dec, discounts, \
            focs, totalDiscount, month, year, createDate, ModifiedDate) VALUES (%s,"%s","%s",\
            "%s",%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,\
            %s,%s,%s,%s,%s)', row)
        mydb.commit()
       # mycursor.close()
    print ("Done")
