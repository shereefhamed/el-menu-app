<!-- <div class="card">
  <img src="{{ $restaurant->logo() }}" class="card-img-top" alt="{{ $restaurant->name }}">
  <div class="card-body">
    <h5 class="card-title">{{ $restaurant->name }}</h5>
    
    <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-success">More details</a>
  </div>
</div> -->
<a href="{{ route('restaurants.show', $restaurant) }}">
  <div class="restaurant-card" style="background-image: url({{ $restaurant->logo() }})">


    <h3 class="restaurant-card-title">{{ $restaurant->name }}</h3>

  </div>
</a>