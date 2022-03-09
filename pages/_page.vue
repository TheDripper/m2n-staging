<template>
  <div id="root" class="testtttt">
    <div :class="classes"></div>
    <div class="flex bg-back-grey">
      <div id="page" class="w-full text-white">
        <div :id="slug" class="frame">
          <div id="content" v-html="page" class=""></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import $ from "jquery";
export default {
  methods: {
    clear(event) {
      let clicked = event.target.dataset.clicked;
      if (clicked == "false") {
        event.target.value = "";
        event.target.dataset.clicked = "true";
      }
    },
    async send() {
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
    },
  },
  created() {},
  mounted() {
    $('.phone-bio').on("click",function(e){
      $('#bio-view').find('img').attr("srcset",'');
      let person = $(this).attr("id");
      console.log(person);
      let slug = '#'+person+'phone';
      console.log(slug);
      let target = $('#'+person+'-phone').find('img').attr('src');
      console.log(target);
      $('#bio-view').find('img').attr('src',target);
    });
    $(".play").on("click", function (e) {
      $(this).parent().find(".vid").css('opacity','1');
      $(this).fadeOut(200);
      $(this).parent().find("video").get(0).play();
    });
    // $("a").each(function () {
    //   $(this).attr("target", "_blank");
    // });
    let master = $(".scroller").find("img").attr("src");
    $(window).on("scroll", function (e) {
      console.log($(window).innerWidth());
      if ($(window).innerWidth() >= 753) {
        console.log($(window).innerWidth());
        let height = $("#scroll-start").offset().top;
        if ($(window).innerWidth() < 1152) {
          height = height - 75;
        }
        let phone = $(".scroller").outerHeight();
        let tri = $(".tri-top").offset().top;
        let bottom = tri - phone;
        let one = $("#one-copy").offset().top;
        let winHeight = $(window).innerHeight();
        one = one - winHeight;
        let two = $("#two-copy").offset().top;
        two = two - winHeight;
        let three = $("#three-copy").offset().top;
        three = three - winHeight;
        let four = $("#four-copy").offset().top;
        four = four - winHeight;
        let five = $("#five-copy").offset().top;
        five = five - winHeight;
        let six = $("#six-copy").offset().top;
        six = six - winHeight;
        // let masterImg = $('img').attr('src',master);
        $(".scroller").find("img").attr("srcset", null);
        let scrolly = $(document).scrollTop();
        if (scrolly > height) {
          $(".scroller").addClass("scrolling");
        } else {
          $(".scroller").removeClass("scrolling");
          console.log("master", master);
          $(".scroller").find("img").attr("src", master);
        }
        if (scrolly > one) {
          let target = $("#one").find("img").attr("src");
          console.log("one", target);
          $(".scroller").find("img").attr("src", target);
        }
        if (scrolly > two) {
          let target = $("#two").find("img").attr("src");
          console.log("two", target);
          $(".scroller").find("img").attr("src", target);
        }
        if (scrolly > three) {
          let target = $("#three").find("img").attr("src");
          console.log("three", target);
          $(".scroller").find("img").attr("src", target);
        }

        if (scrolly > four) {
          let target = $("#four").find("img").attr("src");
          console.log("four", target);
          $(".scroller").find("img").attr("src", target);
        }

        if (scrolly > five) {
          let target = $("#five").find("img").attr("src");
          console.log("five", target);
          $(".scroller").find("img").attr("src", target);
        }

        if (scrolly > six) {
          let target = $("#six").find("img").attr("src");
          console.log("six", target);
          $(".scroller").find("img").attr("src", target);
        }
        if (scrolly > bottom) {
          // let target = $('#six').find('img').attr('src');
          // console.log('six',target);
          $(".scroller").addClass("done");
          $(".done-img").addClass("open");
        } else {
          $(".scroller").removeClass("done");
          $(".done-img").removeClass("open");
        }
      }
      // if(scrolly < height) {
      //   console.log('top',master);
      //   $(".scroller").removeClass("scrolling");
      //   $(".scroller").find("img").fadeOut(200).remove();
      // }
      // if (scrolly > two) {
      //   let src = $('#two').attr('src');
      //   $('.scroller').attr('src',src);
      // }
      // if (scrolly > bottom) {
      //   $(".scroller").addClass("done");
      // }
    });
    $(".scroll a").on("click", function (e) {
      e.preventDefault();
      const hash = $(this).attr("href");
      // const headerHeight = $header.outerHeight() + 500;
      const offset = $(hash).offset().top;
      $("html,body").animate({ scrollTop: offset }, 500);
    });
    let instance = this;
    $(".slider").each(function () {
      instance.$slider($(this).find(".wp-block-group__inner-container"));
    });
  },
  computed: {
    pages() {
      return this.$store.state.pages;
    },
    page() {
      let slug = this.$route.params.page.replace(/-/g, "");
      return this.$store.state.pages[slug];
    },
    slug() {
      return this.$route.params.page;
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
#how-it-works {
  .wp-block-buttons {
    @apply flex justify-center items-center w-full;
    @screen lg {
      @apply justify-start;
    }
  }

  .why {
    @apply mb-20 p-0;
    @screen lg {
      flex-wrap: nowrap !important;
      .wp-block-column {
        flex-basis: 33% !important;
        &:first-child {
          align-items: center !important;
        }
      }
    }
  }
  .blue-hollow {
    @apply mt-12 mb-20;
  }
  .knowledge {
    padding-top: 256px !important;
    .wp-block-column:first-child {
    }
  }
  .hero {
    @apply p-0 relative items-start;
    min-height: 750px;
    @screen lg {
      min-height: 0;
      height: 750px;
      max-height: 750px;
    }
    .wp-block-columns {
      @screen lg {
        @apply flex-col;
      }
      @screen xl {
        @apply flex-row items-start;
        padding-top: 206px !important;
      }
    }
    h1 {
      @apply mb-4;
      margin-top: 62px;
      @screen xl {
        margin-top: 0;
      }
    }
    h1,
    p {
      max-width: 311px;
      @apply mx-auto;
      @screen lg {
        max-width: 382px;
        width: 382px;
        margin-left: 0;
        margin-right: 0;
      }
    }
  }
  .content-buffer {
    @screen lg {
      margin-top: 124px;
    }
  }
  .wp-block-columns {
    max-width: 311px;
    @apply mx-auto flex flex-col items-center justify-center pt-0;
    @screen lg {
      @apply flex-row justify-start;
      max-width: 596px;
    }
    @screen xl {
      max-width: 1010px;
    }
  }
}
.done {
  opacity: 0;
}
.done-min {
  min-height: 490px !important;
  padding: 0 !important;
  @apply mb-0;
  @screen lg {
    @apply justify-start;
    .wp-block-column:first-child {
      flex-basis: 50%;
      width: 50%;
      max-width: 50%;
    }
  }
  @screen xl {
    min-height: 590px !important;
  }
}
.done-img {
  margin-bottom: 120px;
  &.open {
    @apply absolute;
    width: 225px;
    height: 473px;
    bottom: 0;
    top: auto;
    right: 0px;
    // transform: translate(-86px, 0) !important;
    margin: 0 !important;
    img {
      opacity: 1 !important;
      width: 225px;
      transform: translate(26px);
    }
    @screen xl {
      width: 315px;
      height: 663px;
      img {
        width: 315px;
        transform: translate(-51px);
      }
    }
  }
}
.scroll-pane {
  @apply flex items-center justify-center m-0;
  img {
    width: 225px;
  }
  @screen lg {
    img {
      // width: 315px;
      transform: translate(47px);
      opacity: 0;
      // transition: all 0.2s ease;
    }
  }
}
html,
body {
  font-family: "Roboto";
}
input,
select,
textarea {
  background: none;
  appearance: none;
  border-bottom: 2px solid #57514a;
  font-size: 14px;
  color: #999999;
  letter-spacing: 1px;
  @apply p-4 mb-4;
}
select {
  @apply uppercase;
}
textarea {
  border: 2px solid #57514a;
  height: 244px;
  background: rgba(24, 24, 24, 0.7);
  margin-top: 46px;
  @apply mb-0;
}
.video {
  @apply relative;
  &:after {
    content: url("/play.svg");
    @apply absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
}
form {
  button {
    background: #728694;
    width: 250px;
    letter-spacing: 1px;
    height: 44px;
    @apply flex items-center justify-center uppercase rounded-full mx-auto;
    font-size: 14px;
    margin-top: 60px;
    margin-bottom: 260px;
  }
}
#contact-us {
  .wp-block-group {
    @apply mx-auto;
    max-width: 311px;
    @screen lg {
      max-width: 490px;
    }
  }
}
.wp-block-columns {
  @apply pt-48 px-0 max-w-5xl mx-auto;
  h4 {
    @apply text-sand font-bold uppercase mb-4;
    font-size: 14px;
    @screen xl {
      font-size: 18px;
    }
  }
  h2 {
    font-size: 24px;
    @apply font-light mb-4;
    @screen xl {
      font-size: 40px;
    }
  }
  p {
    @apply mb-6;
  }
}
.blue-hollow {
  .wp-block-button__link {
    font-size: 14px;
    background: none;
    border: 2px solid #adcce0;
    width: 250px;
    letter-spacing: 1px;
    color: #adcce0;
  }
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
.white-hollow {
  .wp-block-button__link {
    font-size: 14px;
    background: none;
    border: 2px solid white;
    width: 250px;
    letter-spacing: 1px;
    color: white;
  }
}
.partner {
  height: 750px;
}
.team {
  min-height: 0;
  @apply flex flex-col items-center text-center;
  h2 {
    @apply uppercase font-thin;
    margin-top: 60px;
    font-size: 40px;
  }
  h5 {
    font-size: 24px;
    @apply font-thin mb-6;
  }
  h3 {
    font-size: 18px;
    @apply uppercase mb-1 mt-3;
    line-height: 110%;
    color: #a89b8c !important;
    letter-spacing: 0.7px;
  }
  p {
    font-size: 14px;
    @apply font-light;
    color: #a89b8c !important;
  }
  .wp-block-columns {
    @apply p-0;
  }

  .team-head {
    margin-bottom: 60px;
  }
  .heads {
    @apply mx-auto;
    @screen lg {
      padding-left: 10px;
    }
    .wp-block-columns {
      @apply flex flex-row justify-between;
      max-width: 232px;
      @screen lg {
        max-width: 496px;
      }
      .wp-block-column {
        flex-basis: 50% !important;
        max-width: 100px;
        @apply text-left block;
        &:first-child {

        }
      }
      figure {
        @apply m-0;
        img {
          @apply m-0;
          width: 100px;
        }
      }
      @screen xl {
        max-width: 496px;
      }
    }
  }
}
.mission {
  max-height: 375px;
  height: 375px;
  min-height: 0;
  @apply p-0;
  @screen lg {
    max-height: 330px;
    height: 330px;
  }
  @screen xl {
    max-height: 620px;
    height: 620px;
  }
  h2 {
    @apply text-head-40 uppercase font-thin mt-12 mb-8;
  }
  .wp-block-group {
    @apply mx-auto flex items-center justify-center text-center;
  }
  p {
    font-size: 14px;
    line-height: 150%;
    max-width: 311px;
    @apply mb-6 font-light mx-auto;
    &:last-child {
      margin-bottom: 54px;
    }
    @screen lg {
      max-width: 614px;
    }
    @screen 2xl {
      font-size: 22px;
    }
  }
}
.behind {
  margin-top: 100px;
  .wp-block-group {
    @apply mx-auto;
    max-width: 311px;
  }
  @screen lg {
    // min-height: 439px;
    min-height: 1010px;
    .wp-block-group {
      max-width: 596px;
      @apply mx-auto;
    }
  }
  padding-bottom: 157px;
  h2 {
    font-size: 24px;
    @screen lg {
      font-size: 40px;
    }
    @apply font-thin uppercase;
  }
  h4 {
    @apply font-bold;
  }
  p {
    font-size: 14px;
    @apply mb-6;
  }
  ul {
    @apply list-disc pl-8 mb-8;
  }
}
.story {
  height: 750px;
  @apply relative;
  .play {
    @apply relative z-20;
    cursor: pointer;
  }
  .vid {
    opacity: 0;
    @apply absolute z-10;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    max-width: none !important;
    width: 100vw !important;
  }
  h1 {
    font-size: 52px;
    @apply uppercase font-thin;
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
.grey-button {
  .wp-block-button__link {
    background: #4c4741;
  }
}
.future {
  @apply p-0 items-start;
  min-height: 330px;
  height: 330px;
  @screen lg {
    align-items: center !important;
  }
  .wp-block-buttons {
    @screen lg {
      justify-content: center !important;
    }
  }
  h2 {
    font-size: 24px;
    max-width: 271px;
    margin-top: 60px;
    @apply mx-auto mb-6;
    @screen lg {
      @apply mt-0;
      max-width: 596px;
    }
    @screen xl {
      font-size: 40px;
    }
  }
}
.everyone {
  @apply p-0 pt-12;
  padding-bottom: 152px;
  .wp-block-group {
    @apply mx-auto;
    max-width: 311px !important;
    @screen lg {
      max-width: 596px !important;
    }
  }
}
.tri-top {
  @apply relative items-start p-0;
  min-height: 1156px;
  height: 1156px;
  h1,
  h2,
  p {
    @apply mx-auto;
    max-width: 182px;
  }
  figure {
    @apply mt-12;
  }
  h1 {
    @apply text-center font-thin uppercase mt-12;
    font-size: 24px;
    @screen xl {
      font-size: 40px;
    }
  }
  h2 {
    @apply text-center font-thin uppercase;
    font-size: 18px;
    @screen xl {
      font-size: 24px;
    }
  }
  .wp-block-column {
    @apply flex flex-col items-center justify-start;
    // align-items: center !important;
    // justify-content: flex-start !important;
    p {
      @apply text-center;
      font-size: 14px;
      @screen xl {
        font-size: 19px;
      }
    }
  }
  &:after {
    content: "";
    background: url("/tri-top.svg");
    background-size: cover;
    background-position: center bottom;
    width: 100vw;
    height: 512px;
    @apply absolute bottom-0 left-0;
  }
  .wp-block-buttons {
    @apply flex items-center justify-center;
    justify-content: center !important;
    .wp-block-button__link {
      background: none;
      border: 2px solid white;
      width: 250px;
      letter-spacing: 1px;
    }
  }
}
#scroll-start {
  @apply m-0;
  @screen lg {
    @apply justify-start;
    margin-top: 160px;
    overflow: visible;
    margin-left: auto !important;
    width: 50%;
    height: 544px;
    min-height: 544px;
    background: url("/bridge.png");
    background-size: 225px;
    background-repeat: no-repeat;
    background-position: 0 0;
  }
  figure {
    @apply mx-auto m-0;
    width: 225px;
    // height: 473px;
    height: 360px;
    transform: translateY(96px);
    @screen lg {
      @apply m-0;
      height: 473px;
      transform: translate(98px, -71px);
    }
    // margin-bottom: 71px;
  }
  @screen scroll {
    left: unset;
  }
  @screen xl {
    right: calc(50% - 383px);
    width: 315px;
    height: 734px;
    background-size: 315px;
    // background-position: 0 71px;
    // transform: none;
    figure {
      transform: translate(138px, -71px);
      width: 315px;
      height: 663px;
    }
    // img {
    //   width: 315px;
    //   height: 663px;
    //   transform: translate(98px);
    //   margin: 0;
    // }
  }
}
.scrolling {
  @screen lg {
    @apply fixed;
    top: 71px;
    // right: calc(50% - 98px);
    right: calc(50% - 225px);
    // transform: translate(98px, -71px) !important;
    img {
      opacity: 1 !important;
      // transform: none;
    }
  }
  @screen xl {
    right: calc(50% - 315px);
  }
  @screen 2xl {
    // transform: translate(0px, -71px) !important;
  }
}
.hero {
  min-height: 750px;
  .wp-block-columns {
    @apply flex-col items-start;
    @screen scroll {
      @apply flex-row;
    }
  }
  h1 {
    font-size: 52px;
    @apply uppercase mb-4;
    line-height: 1;
  }
  p {
    @apply mb-12;
  }
  .wp-block-button__link {
    background: #728694;
    @apply rounded-full;
    width: 250px;
  }
  &.building {
    h1 {
      font-size: 42px;
      @apply font-thin text-center;
    }
    p {
      font-size: 14px;
    }
  }
}
.dark-head {
  font-size: 40px;
  color: #333333;
  @apply font-thin uppercase;
}
.soon {
  margin-top: 40px;
  margin-bottom: 28px;
}
#for-employers {
  .end {
    margin-bottom: 100px;
  }
}
.wp-block-column {
  &:first-child {
    @apply flex flex-col items-center justify-center text-center;
    @screen lg {
      @apply items-start justify-start text-left;
    }
  }
  &:last-child {
    @apply flex items-center justify-center;
  }
}
</style>
