<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    
<article id='main'>
    <section id='filler'>

    </section>
    <section id='text'>
        
<?php

require_once 'backend/classes/DBConfig.php';

if(isset($_GET['data'])) {
    echo '<h1>beste ' . $_GET['data'] . ' je bent ingelogd!</h1>'; 
    //nu dus ervoor zorgen dat het de gebruiker ophaalt en hier weergeeft ipv echo lol

     header( "refresh:2; url=index.html" ); 
}

?>

</section>
</article>


</body>