<?php
$pageTitle = 'Home Page';
include_once('assets/header.php');
?>
<main class="mt-4">
    <div class="container">
        <div class="text-center mb-5">
            <img src="slide-3.jpg" class="img-fluid rounded shadow" alt="firstimg">
        </div>

        <div class="row align-items-center g-4">
            <div class="col-md-8">
                <h3 class="text-primary">Welcome To British International School</h3>
                <h1 class="fw-bold mb-3">Welcome Message from the Principal</h1>
                <blockquote class="blockquote fst-italic">
                    “Education is the passport to the future, for tomorrow belongs to those who prepare for it today.”  
                    <footer class="blockquote-footer">Malcolm X</footer>
                </blockquote>

                <p>It's with great pleasure that I welcome you to Greenville International School, Lagos which opened its doors in 2001...</p>
                <p>Greenville International School, Lagos is a co-educational school offering cutting-edge facilities...</p>
                <p>Our students have a track record of outstanding performance including producing some of the best CIE academic achievers...</p>
                <p>Welcome on board!</p>
                <p><strong>Tayo Popoola</strong></p>
            </div>

            <div class="col-md-4 text-center">
                <img src="photo.JPG" class="img-fluid rounded-circle shadow" alt="Principal">
            </div>
        </div>

        <div class="mt-5 position-relative text-center">
            <img src="slide.jpg" class="img-fluid rounded" alt="secondimg">
            <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-50 text-white p-4 rounded">
                <h2>Watch Our School</h2>
                <p>Our study environment is conducive and homely for our students’ learning activities.</p>
            </div>
        </div>
    </div>
</main>

<?php include_once('assets/footer.php'); ?>
</body>
</html>
