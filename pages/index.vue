<template>
  <div
    id="root"
    class="bg-back-grey"
  >
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
.icons {
  color: #716960;
  img {
    @apply mx-2;
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
.wp-block-button {
  letter-spacing: 1px;
  height: 44px;
  .wp-block-button__link {
    @apply text-white rounded-full;
  }
  &.slate {
    .wp-block-button__link {
      background: #728694;
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