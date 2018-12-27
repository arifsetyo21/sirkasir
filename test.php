<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Test</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
   <script src="main.js"></script>
   <script src="https://raw.githubusercontent.com/sitepoint-editors/jsqrcode/master/src/qrcode.js"></script>
   <style>
      .qrcode-text-btn {
      display: inline-block;
      height: 1em;
      width: 1em;
      background: url(assets/img/qr_icon.svg) 50% 50% no-repeat;
      cursor: pointer;
      }

      .qrcode-text-btn > input[type=file] {
      position: absolute;
      overflow: hidden;
      width: 1px;
      height: 1px;
      opacity: 0;
      }
   </style>
</head>
<body>
<input type=text class=qrcode-text
><label class=qrcode-text-btn>
   <input type=file
         accept="image/*"
         capture=environment
         onclick="return showQRIntro();"
         onchange="openQRCamera(this);"
         tabindex=-1>
</label>
</body>

<script>

   function openQRCamera(node) {
   var reader = new FileReader();
   reader.onload = function() {
      node.value = "";
      qrcode.callback = function(res) {
         if(res instanceof Error) {
         alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
         } else {
         node.parentNode.previousElementSibling.value = res;
         }
      };
      qrcode.decode(reader.result);
   };
   reader.readAsDataURL(node.files[0]);
   }

   function showQRIntro() {
   return confirm("Use your camera to take a picture of a QR code.");
   }
</script>
</html>