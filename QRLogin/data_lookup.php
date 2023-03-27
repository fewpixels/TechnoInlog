<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    
<article id='main'>
    <section id='filler'>

    </section>
    <section id='text'>
        
<?php

require_once 'backend/classes/timestamp.php';

$timeClass = new timeStamp();

if(isset($_GET['data'])) {
    //echo '<h1>beste ' . $_GET['data'] . ' je bent ingelogd!</h1>'; 
    $timeClass->checkin($_GET['data']);

     header( "refresh:2; url=index.html" ); 
}

?>

</section>
</article>


</body>