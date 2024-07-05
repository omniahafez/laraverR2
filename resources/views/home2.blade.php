<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
  <div class="tm-container">
    <div class="tm-row">
    @include('includes.header')
            <!-- Drink Menu Page -->
            @include('includes.drinkMenu')
            <!-- end Drink Menu Page -->
          </div>

          <!-- About Us Page -->
          @include('includes.aboutUs')
          <!-- end About Us Page -->

          <!-- Special Items Page -->
          @include('includes.specialItems')
          <!-- end Special Items Page -->

          <!-- Contact Page -->
          @include('includes.contact')
          <!-- end Contact Page -->
        </main>
      </div>    
    </div>
    @include('includes.footer')
  </div>
    
  <!-- Background video -->
  @include('includes.background')
</body>
</html>