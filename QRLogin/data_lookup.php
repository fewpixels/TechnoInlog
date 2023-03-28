<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    
<article id='main'>
    <section id='text'>

    <?php

require_once 'backend/classes/timestamp.php';

$timeClass = new timeStamp();

if(isset($_GET['data'])) {
    // echo '<h1>beste ' . $_GET['data'] . ' je bent ingelogd!</h1>'; 
    echo "<h1 id='output'> " . $timeClass->checkIn($_GET['data']) . " </h1>";

     //header( "refresh:2; url=index.html" ); 
}

?>

    </section>
    <section id='filler'>
        
    </section>
</article>


</body>