@props(['images', 'alt'])

<link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<div {{ $attributes->merge(['class' => 'swiper']) }}>
  <div class="swiper-wrapper">
    @foreach ($images as $index => $image)
        <div class="swiper-slide">
            <img src="{{ $image['image_path'] }}" alt="{{ $alt }}" class="object-cover w-full h-full" />
        </div>
    @endforeach
  </div>

  <div class="swiper-pagination"></div>
</div>

<script>
  new Swiper('.swiper', {
      direction: 'horizontal',
      loop: true,
      effect: 'fade',
      centeredSlides: "true",
      slidesPerView: 'auto',

      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
  });
</script>