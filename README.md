# TechnoInlog
lekker inloggen bij technolab

Installeren
Python opstellen

- Ga naar https://www.python.org/downloads/ en download de nieuwste versie van python.
- je opent de installatie bestand
- vink “Add python.exe to PATH aan
- klik op “install now”
aan het einde van de installatie druk je op “disable path lengt limit”
Nu ben je klaar

pycharm downloaden

- ga naar https://www.jetbrains.com/pycharm/download/#section=windows en download de community edition.
- open het installatie bestand
- druk op volgende totdat je bij “installation options” komt
- vink “update PATH variable” en “Add open folder as project” aan, je mag de rest ook aanvinken als je dat wilt
- je kan nu op volgende blijven drukken totdat de installatie start en klaar is
Dit is nu klaar
Herstart nu je pc

nfcpy installeren

- open command prompt in admin modus (cmd) en checken we of pip wel up to date is
- type “py -m pip install –upgrade pip” (zonder hoge haakjes)
- daarna type “pip install nfcpy” (zonder hoge haakjes)
dat was het

Nfc apparaat klaarmaken 

LET OP, PROGRAMMA’S ZOALS NFC TOOLS WERKEN NA DEZE INSTALLATIE NIET MEER
zorg dat je 7-zip of winrar hebt geïnstalleerd!!!!
- ga naar https://nfcpy.readthedocs.io/en/latest/topics/get-started.html# en volg de instructies tot aan “then, install libusb”
- ga naar https://libusb.info/ en download “latest windows binaries”
- open het in 7-zip of winrar
- ga naar VS2015-x64/dll en kopieer “libusb-1.0.dll” naar “C:\Windows\System32”
- ga naar VS2015-Win32/dll en kopieer “libusb-1.0.dll” naar “C:\Windows\SysWOW64”
- het is nu geïnstalleerd en klaar, start je systeem voor de zekerheid opnieuw op.

Je kan nu beginnen aan je python project
