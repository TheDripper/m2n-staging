import $ from "jquery";
import "slick-carousel";
export default ({ app }, inject) => {
  // Inject $hello(msg) in Vue, context and store.
  function slickInit(slider) {
    console.log(slider);
    slider.slick({
      prevArrow: ".left",
      nextArrow: ".right",
      mobileFirst: true,
      slidesToShow: 1,
      autoplay: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          },
        },
        // {
        //   breakpoint: 1440,
        //   settings: {
        //     slidesToShow: 3,
        //   },
        // },
      ],
    });
  }
  function reviewsInit(slider) {
    console.log(slider);
    slider.slick({
      prevArrow: ".left",
      nextArrow: ".right",
      // mobileFirst: true,
      slidesToShow: 1,
      dots: true
    });
  }
  inject("slider", slickInit);
  inject("reviews", reviewsInit);
};
