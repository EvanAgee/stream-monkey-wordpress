export default {
  data() {
    return {
      slickOptions: {
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 4,
        infinite: false,
        dots: true,
        prevArrow: '<button class="slider-nav slider-prev" aria-label="Previous" type="button" style="" aria-disabled="false"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button class="slider-nav slider-next" aria-label="Next" type="button" style="" aria-disabled="false"><i class="fa fa-angle-right"></i></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      }
    }
  },

  methods: {
    equalizeCards() {
      setTimeout(function(){
        jQuery(".sermon-center .card").matchHeight()
      }, 500)
    }
  }
}