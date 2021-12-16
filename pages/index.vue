<template>
  <div id="root" class="testtttt">
    <div :class="classes"></div>
    <div class="h-screen v-screen fixed" v-html="page.content"></div>
    <div
      class="
        flex flex-col
        items-center
        justify-start
        p-4
        pt-8
        md:pt-4 md:justify-center
        h-screen
        v-screen
        z-20
        relative
        splash
      "
    >
      <img src="/m2n-logo.svg" class="mb-8" />
      <h1 class="uppercase font-bold text-white mb-4">
        revolutionizing how we approach Diversity & inclusion in the workplace
      </h1>
      <p class="text-white mb-12 text-center">
        Sign up now for your exclusive invite to the
        <span class="font-bold">MPOWER APP</span> when we launch in
        <span class="font-bold">2022.</span>
      </p>
      <input
        type="text"
        name="First Name"
        value="FIRST NAME"
        @click="clear($event)"
        data-clicked="false"
      />
      <input
        type="text"
        name="Last Name"
        value="LAST NAME"
        @click="clear($event)"
        data-clicked="false"
      />
      <input
        type="email"
        name="Email"
        value="EMAIL"
        @click="clear($event)"
        data-clicked="false"
      />
      <button id="submit" @click="submit">SIGN UP</button>
    </div>
    <div
      id="footer"
      class="
        uppercase
        p-4
        z-20
        absolute
        bottom-0
        left-0
        w-full
        flex flex-col
        lg:flex-row
        items-center
        justify-between
      "
    >
      <p>©2021 M2N | Minority Moves Network Inc. • All rights reserved.</p>
      <div class="flex items-center justify-center icons">
        <a href="/" class="mr-8"
          >contact us | Terms & Conditions | Privacy Policy</a
        >
        <img src="/linked.png" />
        <img src="/twitter.png" />
        <img src="/insta.png" />
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
      console.log(clicked);
      if (clicked=='false') {
        event.target.value = "";
        event.target.dataset.clicked = "true";
      }
    },
  },
  created() {},
  mounted() {
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
      instance.$slider($(this).find(".wp-block-group__inner-container"));
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
#footer {
  color: #716960;
}
.icons {
  color: #716960;
  img {
    @apply mx-2;
  }
}
.splash {
  h1 {
    font-size: 32px;
    line-height: 120%;
    max-width: 787px;
    @apply text-center;
  }
  input {
    background: none !important;
    appearance: none !important;
    border-bottom: 2px solid #716960;
    color: white;
    font-size: 14px;
    letter-spacing: 2px;
    @apply mb-6 py-2;
    width: 400px;
    max-width: 100%;
  }
  button {
    width: 400px;
    max-width: 100%;
    height: 44px;
    background: #716960;
    border-radius: 30px;
    color: white;
  }
}
.full-screen {
  @apply h-screen w-screen p-0;
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
input {
  @apply leading-snug;
  font-family: "Open Sans";
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
  @apply font-light;
  font-family: "Open Sans";
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
//     @apply absolute rounded p-2;
//     top: 0;
//     left: 0;
//     color: white;
//   }
//   .slick-next {
//     @apply absolute rounded p-2;
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
#header {
  position: absolute;
  z-index: 99;
  width: 100vw;
  margin-bottom: 80px;
  .logo {
    width: 77px;
  }
}
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