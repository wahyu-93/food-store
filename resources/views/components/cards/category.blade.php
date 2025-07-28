  <div class="swiper-slide col-6 col-md-4">
    <a href="/category/{{ $category->slug }}" wire:navigate class="text-decoration-none">
        <div class="card border-0 rounded shadow-sm">
            <div class="card-body text-center">
                <img src="{{ asset('/storage/' . $category->image) }}" class="img-fluid mb-2" width="50" height="50">
                <p class="text-center">{{ $category->name }}</p>
            </div>
        </div>
    </a>
</div>