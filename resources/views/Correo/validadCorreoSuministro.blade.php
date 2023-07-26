  <!DOCTYPE html>
<html>
<head>
<title>Validacion de coreo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>EP</b> Electro Puno S.A.A.</a>
    <!-- Float links to the right. Hide them on small screens -->
    
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="/assets/img/examples/example12.jpeg" alt="Architecture" width="100%" height="50%">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>EP</b></span> </h1>
    <h4 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-white w3-opacity-min"><b>Electro Puno S.A.A.</b></span></h4>
  </div>
</header>

<div class="w3-content w3-padding" style="max-width:1564px">

 
  

  <!-- About Section -->
  <div class="w3-container w3-padding-32 w3-center" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Correo validado</h3>
    <h5 class="w3-border-bottom w3-border-light-grey w3-padding-16">{{$correo}}</h5> 
    
    <p>
         Usted valido el correo , para la emision de su recibo.
    </p>
    <p>Ahora sus recibos le llegaran al correo que valido</p>
    <p>La emision de recibo en fisico continuara con normalidad.</p>
  </div>
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>Pagina web <a href="https://www.electropuno.com.pe" title="W3.CSS" target="_blank" class="w3-hover-text-green">https://www.electropuno.com.pe</a> - 2022</p>
</footer>

</body>
</html>
