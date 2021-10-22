import $ from "jquery";
import "slick-carousel";
export default ({ app }, inject) => {
  // Inject $hello(msg) in Vue, context and store.
  function slickInit(slider) {
    console.log(slider);
    slider.slick();
  }
  inject("slider", slickInit);
};
