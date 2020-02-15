## required packages
	sudo apt-get update
	sudo apt-get upgrade
	sudo apt-get install build-essential git python3-dev python3-pip python3-smbus MariaDB nginx php7.3-fpm php7.3-mbstring php7.3-mysql php7.3-curl php7.3-gd php7.3-curl php7.3-zip php7.3-xml
	sudo pip3 install spidev mysql-connector-python RPi.GPIO



To install LCD library go to ModedRepo/LCD folder and run:
		sudo python3 setup.py install

To install RC522 library go to /ModedRepo/RFID/MFRC522 folder and run:
		sudo python3 setup.py install

To communicate with the RC522 module, we need to enable SPI interface. To do this, you need to first launch the raspi-config tool by running the following command:

		sudo raspi-config
			interface options >SPI> enable.
		restart the Raspberry (sudo reboot)
	
		cheak that spi interface is active:
			lsmod | grep spi
		If you see the text “spi_bcm2835” appear in the command line, then spi is active.

## LCD
Connecting the LCD to your Raspberry Pi is a pretty simple process if you follow our guide. We have included the physical pin number for each connection that you need to make.

    5V (Physical Pin 2) to breadboard positive rail
    Ground (Physical Pin 6) to breadboard ground rail
    Place the 16×2 LCD Display into the right side of the breadboard
    Place the potentiometer into the left side of the breadboard next to the LCD Display.
    Connect the left pin of the potentiometer to the ground rail
    Connect the right pin of the potentiometer to the positive rail

Now begin connecting the LCD display to your Raspberry Pi.

    Pin 1 of LCD (Ground) to breadboard ground rail
    Pin 2 of LCD (VCC / 5V) to breadboard positive rail
    Pin 3 of LCD (V0) to middle wire of the potentiometer
    Pin 4 of LCD (RS) to GPIO4 (Physical Pin 7)
    Pin 5 of LCD (RW) to breadboard ground rail
    Pin 6 of LCD (EN) to GPIO24 (Physical Pin 18)
    Pin 11 of LCD (D4) to GPIO23 (Physical Pin 16)
    Pin 12 of LCD (D5) to GPIO17 (Physical Pin 11)
    Pin 13 of LCD (D6) to GPIO18 (Physical Pin 12)
    Pin 14 of LCD (D7) to GPIO22 (Physical Pin 15)
    Pin 15 of LCD (LED +) to breadboard positive rail
    Pin 16 of LCD (LED -) to GPIO14 (Physical Pin 8)

## Relay

Relay outpout on GPIO21 (Physical Pin 40)

## RFID
to wire the RFID circuit up to the Raspberry Pi.

    SDA connects to GPIO8 (Physical Pin 24)
    SCK connects to GPIO11 (Physical Pin 23)
    MOSI connects to GPIO10 (Physical Pin 19)
    MISO connects to GPIO9 (Physical Pin 21)
    GND connects to Breadboard Ground Rail.
    RST connects to GPIO25 (Physical Pin 22)
    3.3v connects to 3v3 (Physical Pin 1)

## MySQL server setup:
	sudo mysql_secure_installation
	sudo mysql -u root -p
		
		CREATE DATABASE Admin_Panel;
		CREATE USER 'AccessControlAdmin'@'localhost' IDENTIFIED BY 'qwerty';
		GRANT ALL PRIVILEGES ON Admin_Panel.* TO 'AccessControlAdmin'@'localhost';
	import the database dump
