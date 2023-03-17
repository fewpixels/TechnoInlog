import ndef
import nfc
import requests
from time import sleep


def on_connect(tag):
    # When a NFC tag is detected, send the tag ID to the PHP script using a HTTP request
    tag_id = tag.ndef
    url = 'http://localhost/register_user.php'
    payload = {'tag_id': tag_id}
    response = requests.post(url, data=payload)
    print(tag_id)


# Set up the NFC reader
clf = nfc.ContactlessFrontend('usb')
# Start listening for NFC tags
clf.connect(rdwr={'on-connect': on_connect})
sleep(0.5)