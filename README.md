# TechnoInlog
lekker inloggen bij technolab

download de repo, moet gelijk werken zonder problemen

maakt gebruik van instaScan libraries
https://github.com/schmich/instascan

En maakt gebruik van 'PHP QR code'
https://phpqrcode.sourceforge.net/

om een QR code te genereren en het weer te geven moet je bepaalde parameters aanpassen, dat doe je zo:

Windows met xampp:
- ga naar xampp/php/php.ini en open het bestand
- zoek naar ;extension=gd en verwijder de semicolon (;)
- (optioneel) als er een ;extension=gd2 is doe je hetzelfde als hierboven
- sla het bestand op
- start je mysql en php server opnieuw op en het moet gelijk werken

Linux met lampp: (let op! dit kan verschillen per systeem!!)
- ga naar /opt/lampp/etc/php.ini en open het bestand
- zoek naar ;gd.jpeg_ignore_warning = 1 en verwijder de semicolon (;)
- (optioneel) mocht het op een 0 staan, verander je het naar een 1
- sla het bestand op
- start je mysql en php server opnieuw op en het moet gelijk werken
