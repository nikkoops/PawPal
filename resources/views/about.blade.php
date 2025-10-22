<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - PawPal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
</head>

<body>
  <!-- Header -->
  @include('components.header')

  <main>
    <!-- HERO -->
    <div class="bg-gradient-to-r from-orange-600 to-orange-800 text-white py-20">
      <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">
          <span class="font-normal">About</span> PawPal
        </h1>
        <p class="text-xl opacity-90">
          Saving lives, one adoption at a time
        </p>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
      <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
        
        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
          PawPal is dedicated to connecting loving families with pets in need of homes. We believe every pet deserves a second chance at happiness.
        </p>
        
        <p class="text-gray-600 leading-relaxed">
          Our platform makes it easy to find your perfect companion while helping reduce pet homelessness in our community. Through our comprehensive matching system, we ensure that both pets and families find their ideal match, creating lasting bonds that enrich lives on both sides.
        </p>
      </div>
    </div>
  </main>

</body>
</html>

</div><!-- col-md-12 Ends -->



</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
