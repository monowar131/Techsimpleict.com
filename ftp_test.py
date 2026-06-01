import ftplib
import sys

host = 'ftpupload.net'
user = 'if0_41355285'
password = 'Monowar131@'

try:
    print(f"Connecting to {host}...")
    ftp = ftplib.FTP(host)
    ftp.login(user, password)
    print("Login successful!")
    print(ftp.nlst())
    ftp.quit()
except Exception as e:
    print(f"Failed: {e}")
    sys.exit(1)
