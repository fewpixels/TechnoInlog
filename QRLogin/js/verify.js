function webScan(){  
    let opts = {
      continuous: true, //oneindig door scannen
      video: document.getElementById('scanner'), //welke html element te gebruiken (moet video zijn)
      mirror: true, //spiegelen
      captureImage: false, //foto maken als het iets vindt, niet nodig
      backgroundScan: false, //scannen op achtergrond, uitgezet
      refractoryPeriod: 5000, //time out periode voordat dezelfde qr code opnieuw gescand wordt
      scanPeriod: 30 
      //hoeveel frames overslaan voordat het weer zoekt naar een qr code, op dit moment 30 frames per 'scan' overslaan.
      //dus één keer per seconde kijken naar qr codes
      //dit is om te voorkomen dat de cpu te warm wordt voor niets
    };
    
    let scanner = new Instascan.Scanner(opts);
    
    scanner.addListener('scan', function (content) {
      $(document).ready(function(){
        window.location = './verify.php?data='+content;
      });
    });
    
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('geen camera gevonden!');
      }
    }).catch(function (e) {
      console.error(e);
    });
  };