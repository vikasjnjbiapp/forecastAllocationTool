# SERVER = "smtp.gmail.com:465"
FROM = "businesstesttest01@gmail.com"
TO = ["businesstesttest01@gmail.com"] # must be a list

SUBJECT = "Hello!"
TEXT = "This is a test of emailing through smtp of example.com."

# Prepare actual message
message = """From: %s\r\nTo: %s\r\nSubject: %s\r\n\

%s
""" % (FROM, ", ".join(TO), SUBJECT, TEXT)

# Send the mail
import smtplib
server = smtplib.SMTP('smtp.gmail.com:587')
server.starttls()
server.login("businesstesttest01", "fIh0cIn#")
server.sendmail(FROM, TO, message)
server.quit()