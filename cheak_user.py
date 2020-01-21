#!/usr/bin/env python
import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector
import Adafruit_CharLCD as LCD

db = mysql.connector.connect(
  host="localhost",
  user="logsadmin",
  passwd="qwerty",
  database="logs"
)
GPIO.setup(21,GPIO.OUT)
cursor = db.cursor()
reader = SimpleMFRC522()

lcd = LCD.Adafruit_CharLCD(4, 24, 23, 17, 18, 22, 16, 2, 4);

try:
  while True:
    lcd.clear()
    lcd.message('Place Card to\nopen door')
    id, text = reader.read()

    cursor.execute("Select id, name FROM users WHERE rfid_uid="+str(id))
    result = cursor.fetchone()

    lcd.clear()

    if cursor.rowcount >= 1:
      lcd.message("Welcome \n" + result[1])
      cursor.execute("INSERT INTO attendance (user_id) VALUES (%s)", (result[0],) )
      db.commit()
      time.sleep(2)
      lcd.clear()
      lcd.message('opening door') 
      GPIO.output(21,GPIO.HIGH)
      time.sleep(5)
      GPIO.output(21,GPIO.LOW)
      lcd.clear()
    else:
      lcd.message("User does \n not exist.")
    time.sleep(2)
finally:
  GPIO.cleanup()
