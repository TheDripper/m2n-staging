<template>
  <div id="root" class="bg-back-grey">
    <div :class="classes"></div>
    <div class="w-full" v-html="page"></div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import $ from "jquery";
export default {
  data() {
    return {
      notSent: true,
    };
  },
  methods: {
    copy($event) {
      console.log("copy");
      var dummy = document.createElement("input"),
        text = window.location.href;
      document.body.appendChild(dummy);
      dummy.value = text;
      dummy.select();
      document.execCommand("copy");
      document.body.removeChild(dummy);
      $($event.target).text("Copied!");
    },
    clear(event) {
      let clicked = event.target.dataset.clicked;
      console.log(clicked);
      if (clicked == "false") {
        event.target.value = "";
        event.target.dataset.clicked = "true";
      }
    },
    async send($event) {
      $event.preventDefault();
      console.log("send");
      let form = document.getElementById("splashform");
      let formData = new FormData(form);
      let contact = {
        properties: [
          { property: "firstname", value: "tyler" },
          { property: "lastname", value: "hill" },
          { property: "email", value: "admin@tylerhillweb.dev" },
        ],
      };
      contact = JSON.stringify(contact);
      this.$axios.setHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      let posted = await this.$axios.$post(
        "https://forms.hubspot.com/uploads/form/v2/20008151/f379a28f-402a-46d3-b660-e86a8d1e19cb",
        formData
      );
      console.log("contact", posted);
      this.notSent = false;
      return false;
    },
  },
  created() {},
  mounted() {
    $(".to-top").on("click", function (e) {
      // const offset = $(".community").offset().top;
      $("html,body").animate({ scrollTop: 0 }, 500);
    });
    $(".down").on("click", function (e) {
      const offset = $(".community").offset().top;
      $("html,body").animate({ scrollTop: offset }, 500);
    });
    // $("a").each(function () {
    //   $(this).attr("target", "_blank");
    // });
    $(".scroll a").on("click", function (e) {
      e.preventDefault();
      const hash = $(this).attr("href");
      console.log(hash);
      // const headerHeight = $header.outerHeight() + 500;
      const offset = $(hash).offset().top;
      $("html,body").animate({ scrollTop: offset }, 500);
    });
    let instance = this;
    $(".slider").each(function () {
      instance.$slider($(this));
    });
    $(".reviews").each(function () {
      instance.$reviews($(this).find(".wp-block-group__inner-container"));
    });
  },
  computed: {
    pages() {
      return this.$store.state.pages;
    },
    page() {
      return this.$store.state.home;
    },
    header() {
      return this.$store.state.header;
    },
    footer() {
      return this.$store.state.footer;
    },
    classes() {
      return this.$store.state.classes;
    },
  },
};
</script>
<style lang="scss">
.community {
  @apply flex-col;
  @screen lg {
    @apply items-center;
    .wp-block-column {
      &:first-child {
        padding: 0 86px;
        margin-bottom: 100px;
      }
    }
  }
  @screen xl {
    @apply flex-row;
    max-width: 1126px;
    padding-top: 157px !important;
    .wp-block-column {
      @apply p-0;
      &:first-child {
        @apply pr-4;
      }
      &:last-child {
        @apply pl-4;
      }
    }
    img {
      max-width: 484px;
    }
  }
}
.blue-hollow {
  @apply flex justify-center items-center w-full;
  @screen md {
    @apply justify-start;
  }
  .wp-block-button__link {
    background: none;
    border: 2px solid #adcce0;
    width: 250px;
    letter-spacing: 1px;
    color: #adcce0 !important;
  }
}
.down {
  @apply absolute;
  left: 50%;
  bottom: 40px;
  transform: translate(-50%);
}
.module {
  h2 {
    font-size: 24px;
    @screen xl {
      font-size: 40px;
    }
  }
}
.video {
  @apply mb-20;
  @screen md {
    img {
      max-width: 596px;
    }
  }
  @screen xl {
    img {
      max-width: 1126px;
      width: 1126px;
    }
  }
}
.approach {
  font-size: 40px;
  color: #333333;
  @screen md {
    font-size: 50px;
  }
  @screen xl {
    font-size: 90px;
    transform: translateY(100%);
  }
}
.logobg {
  width: 100vw;
  min-height: 0 !important;
  @screen xl {
    min-height: 1024px !important;
  }
  .wp-block-cover__image-background {
    object-position: 50% 0% !important;
  }
  // @screen md {
  //   .wp-block-cover__image-background {
  //   }
  // }
}
.wp-block-column {
  @apply p-8;
}
.flip {
  @screen md {
    .wp-block-column:first-child {
      order: 2;
    }
    .wp-block-column:last-child {
      order: 1;
    }
  }
}
.hero {
  min-height: 732px;
  .field {
    @apply mb-14;
    .wp-block-group__inner-container {
      @apply flex flex-col items-center justify-center text-center;
    }
    .redrawing {
      color: #716960;
    }
    .leveling {
      @apply relative;
      &:after {
        content: "";
        width: 205px;
        height: 6px;
        background: #716960;
        @apply absolute;
        bottom: 19px;
        left: -10px;
      }
    }
    .oneline {
      .wp-block-group__inner-container {
        @screen md {
          @apply flex flex-row;
        }
      }
    }
    .playing {
      @apply uppercase max-w-xs;
      @screen md {
        @apply max-w-full;
      }
    }
  }
  h2 {
    font-size: 42px;
    letter-spacing: 0px;
    @apply uppercase font-bold mr-2 text-center;
  }
}
.slick-dots {
  display: flex;
  justify-content: center;
  margin: 0;
  padding: 0;
  @apply absolute pb-8;
  left: 50%;
  transform: translateY(-100%);
  li {
    @apply list-none;
    button {
      font-size: 0;
      width: 8px;
      height: 8px;
      background: white;
      opacity: 0.3;
      @apply rounded-full mx-1;
    }
    &.slick-active {
      button {
        opacity: 1;
      }
    }
  }
}
.slider-head {
  @apply absolute z-10 border-b;
  left: 50%;
  transform: translate(-50%, 2rem);
}
.reviews {
  .wp-block-cover {
    display: flex !important;
    min-height: 390px;
    @apply items-center justify-center;
    @screen md {
      min-height: 372px;
    }
    @screen xl {
      min-height: 633px;
    }
  }
  h4 {
    font-size: 18px;
    @screen xl {
      font-size: 22px;
    }
  }
  p {
    @apply relative text-white font-medium max-w-5xl mx-auto px-4;
    letter-spacing: 2%;
    font-size: 32px;
    line-height: 130%;
    @screen md {
      @apply px-0;
    }
    @screen lg {
      max-width: 588px;
    }
    @screen xl {
      font-size: 54px;
      max-width: 1012px;
    }
  }
}
.top {
  @screen md {
    padding-top: 93px;
  }
}
.end {
  padding-bottom: 99px;
  @screen lg {
    padding-bottom: 150px;
  }
}
.newsroom {
  @apply flex justify-center items-center pt-16;
  .wp-block-group__inner-container {
    @apply flex flex-col;
    @screen lg {
      @apply flex-row mb-8;
    }
  }
  h2 {
    color: #333333;
    font-weight: 300;
    font-size: 40px;
    line-height: 100%;
    @screen md {
      font-size: 50px;
    }
    @screen xl {
      font-size: 90px;
    }
    &:last-child {
      @apply font-bold ml-2;
    }
  }
}
.load {
  .wp-block-group__inner-container {
    @apply w-full;
  }
  h4 {
    font-size: 14px;
    color: #859dad;
  }
  @apply w-full flex justify-center bg-back-grey pt-12 pb-24 m-0 relative;
}
.to-top {
  width: 40px;
  height: 40px;
  @apply absolute cursor-pointer;
  right: 2rem;
  bottom: 0;
}
.news-post {
  @apply max-w-6xl overflow-hidden mx-auto p-0 mb-0;
  @screen md {
    @apply px-2;
  }
  @screen lg {
    flex-wrap: nowrap !important;
    padding: 0 70px;
  }
  @screen xl {
    @apply pt-6 pb-0;
  }
  .wp-block-column {
    background: #272727;
    display: flex !important;
    @apply p-8 text-white flex flex-col m-8;
    @screen md {
      @apply m-0;
    }
    @screen lg {
      @apply p-6;
      &:first-child {
        @apply mr-3;
      }
      &:last-child {
        @apply ml-3;
      }
    }
  }
  .post-author {
    font-size: 14px;
    @apply uppercase;
  }
  h2 {
    font-size: 18px;
    @apply font-bold mb-4;
    @screen xl {
      font-size: 22px;
    }
  }
  h4 {
    color: #716960;
    @apply mb-2;
  }
  p {
    font-size: 12px;
    @apply mb-12;
  }
  .wp-block-column {
  }
  h5 {
    color: #716960;
  }
}
.copy {
  color: #716960;
  letter-spacing: 1px;
}
.trans {
  @screen xl {
    @apply fixed w-full;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}
#logo {
  width: 51px;
}
#footer {
  color: #716960;
  p,
  a {
    letter-spacing: 1px;
  }
}
.splash {
  p {
    font-size: 10px;
    letter-spacing: 1px;
    @screen lg {
      font-size: 14px;
    }
  }
  h1 {
    font-size: 21px;
    line-height: 120%;
    max-width: 787px;
    letter-spacing: 0.5px;
    @apply text-center font-bold;
    @screen md {
      font-size: 32px;
    }
  }
  input {
    background: none !important;
    appearance: none !important;
    border-bottom: 2px solid #716960;
    color: white;
    font-size: 14px;
    letter-spacing: 2px;
    @apply mb-6 py-2;
  }
  button {
    height: 44px;
    background: #716960;
    border-radius: 30px;
    color: white;
  }
}
.no-md-break {
  @screen md {
    @apply flex-col;
  }
  .wp-block-column {
    @apply m-0 p-0;
    &:first-child {
      @apply pb-5;
    }
  }
  @screen xl {
    @apply flex-row;
    &:first-child {
      @apply pb-0;
    }
  }
}
.wp-block-button {
  height: 44px;
  display: flex !important;
  width: 255px;
  @apply justify-center items-center;
  .wp-block-button__link {
    flex-shrink: 0;
    max-width: none !important;
    font-weight: 500;
    @apply text-white rounded-full w-full;
  }
  &.slate {
    .wp-block-button__link {
      background: #728694;
      border: none;
    }
  }
  &.hollow {
    .wp-block-button__link {
      background: none;
      border: 2px solid white;
    }
  }
}
.mobile {
  width: 320px;
  max-width: 100%;
  @screen md {
    width: 400px;
  }
}
.full-screen {
  @apply p-0;
  background: #181818;
  img {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain;
  }
}
#content {
  overflow-x: hidden;
  width: 100vw;
  p {
    @apply mb-4;
  }
}
html,
body {
}
h1,
h2,
h3,
h4,
h5,
h6,
input,
button {
  @apply leading-snug;
  font-family: "Roboto";
}
h1 {
  @apply text-6xl font-bold;
}
h2 {
  @apply text-4xl font-bold;
}
h3 {
  @apply text-3xl font-bold;
}
h4 {
  @apply mb-2;
}
p,
a,
li {
  font-family: "Roboto";
}
ul {
  list-style: circle;
  @apply pl-4;
}
// .blocks-gallery-grid.slick-slider {
//   @apply w-full relative pt-12 mt-12;
//   height: 230px;
//   overflow: hidden;
//   figure {
//     height: 230px;
//     overflow: hidden;
//     @apply flex justify-center items-center;
//   }
//   .slick-prev {
//     @apply absolute rounded p-4;
//     top: 0;
//     left: 0;
//     color: white;
//   }
//   .slick-next {
//     @apply absolute rounded p-4;
//     top: 0;
//     right: 0;
//     color: white;
//   }
// }
.gallery-vertical {
  li {
    margin: 3rem 0 !important;
    img {
      max-width: 120px !important;
      @apply mx-auto;
    }
  }
}
.w-full-gutter {
  width: calc(100% - 2rem);
}
.wp-block-button__link {
  border-radius: 0;
  background: none;
  border: 2px solid black;
  color: black;
}
.wp-block-buttons {
  @apply mt-8;
}
.bleed-up {
  img {
    transform: translateY(-30px);
    @apply relative z-10;
  }
}
.epmt {
  @apply flex justify-end;
  img {
    max-width: 913px;
    transform: translate(257px);
  }
}
.arrow-link {
  a {
    color: #b8c734;
    @apply relative font-normal mt-12 inline-block;
    &:after {
      @apply absolute;
      top: 50%;
      right: 0;
      transform: translate(110%, -38%);
      content: url("/Arrow.svg");
    }
  }
}
.list-none {
  ul {
    list-style: none !important;
  }
}
.wp-block-image {
  img {
    height: auto;
  }
}
// #header {
//   position: absolute;
//   z-index: 99;
//   width: 100vw;
//   margin-bottom: 80px;
//   .logo {
//     width: 77px;
//   }
// }
.slider {
  @apply relative;
  .prev {
  }
  .next {
  }
}
.slick-slide {
  .wp-block-columns {
    display: flex !important;
    .wp-block-column {
      &:first-child {
        @apply relative z-10 bg-white p-4;
      }
    }
  }
}
.arrows {
  @apply flex justify-end;
  cursor: pointer;
  .wp-block-column {
    max-width: 70px;
  }
}
</style>