<head>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<img src="image/Technolab Logo.png" alt="logo van technolab" id='logo'>
<article id='mainmain'>
    <article id='main'>
        <section id='text'>
        <?php
            require_once 'backend/classes/timestamp.php';
            $timeClass = new timeStamp();
            if(isset($_GET['data'])) {
                echo "<h1 id='output'> " . $timeClass->checkIn($_GET['data']) . " </h1>";
                header( "refresh:3.5; url=index.html" ); 
            }
        ?>
        </section>
        <section id='filler'>  
        </section>
    </article>
</article>
<img src="../image/Capture.PNG" alt="" id="otherimg">
<div id="tri">
    </div>
</body>