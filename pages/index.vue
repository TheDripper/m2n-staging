<template>
  <div
    id="root"
    class="h-screen w-screen bg-back-grey flex flex-col lg:justify-between"
  >
    <div :class="classes"></div>
    <div class="w-full fixed" v-html="page"></div>
    <div
      class="
        flex flex-col
        items-center
        justify-start
        p-8
        xl:pb-0
        lg:justify-center
        w-screen
        z-20
        relative
        splash
      "
    >
      <div
        class="
          lg:max-w-lg
          xl:max-w-4xl
          flex flex-col
          items-center
          justify-start
          lg:justify-center
          trans
        "
      >
        <img src="/m2n-logo.svg" id="logo" class="mb-4" />
        <div v-if="notSent" class="flex flex-col items-center justify-center">
          <h1 class="uppercase font-bold text-white mb-4 xl:px-2">
            revolutionizing how we approach Diversity & inclusion in the
            workplace
          </h1>
          <p class="text-white mb-12 text-center xl:w-5/6 px-10">
            Get on the list for your invitation to Join
            <span class="font-bold">MPOWER</span>, a community of diverse
            professionals raising their hands to say...
            <span class="font-bold">HERE WE ARE.</span>
          </p>
          <form id="splashform" class="flex flex-col w-full lg:w-1/2">
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
            <button id="submit" class="mt-6" @click="send">SIGN UP</button>
          </form>
        </div>
        <div class="confirm flex flex-col items-center justify-center" v-else>
          <h1 class="text-white text-4xl uppercase font-bold mb-4">
            Thank you for signing up!
          </h1>
          <p class="text-center text-white mb-4">
            Thank you for your interest in being one of the first to experience
            a revolutionary approach to diversity and inclusion in the
            workforce. We will send your invitation to join MPOWER as we
            approach our launch date in early 2022.
          </p>
          <p class="text-center text-white">
            If you have family, friends or colleagues that you’d like to invite
            to MPower, please share via this link.
          </p>
        </div>
      </div>
    </div>
    <div
      id="footer"
      class="
        uppercase
        p-4
        z-20
        relative
        bottom-0
        left-0
        w-full
        flex flex-col
        xl:flex-row
        items-center
        justify-between
      "
    >
      <div
        class="
          flex flex-col
          xl:flex-row
          items-center
          justify-center
          icons
          xl:order-2
        "
      >
        <div class="flex items-center pb-8 xl:pb-0 xl:order-2 lg:ml-4 xl:ml-6">
          <img src="/insta.png" />
          <img src="/twitter.png" />
          <img src="/linked.png" />
        </div>
        <div
          class="
            flex flex-col
            xl:flex-row xl:order-1
            items-center
            justify-center
            mb-8
            xl:mb-0
            text-xs
            xl:order-1
          "
        >
          <a href="/" class="my-2 xl:border-r pr-2">contact us</a>
          <a href="/terms-of-use" class="my-2 xl:border-r px-2"
            >Terms & Conditions</a
          >
          <a href="/privacy-policy" class="my-2 xl:pl-2">Privacy Policy</a>
        </div>
      </div>
      <p class="text-center text-xs mb-6 xl:mb-0">
        ©2021 M2N | Minority Moves Network Inc. • All rights reserved.
      </p>
    </div>
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
    clear(event) {
      let clicked = event.target.dataset.clicked;
      console.log(clicked);
      if (clicked == "false") {
        event.target.value = "";
        event.target.dataset.clicked = "true";
      }
    },
    async send() {
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
button {
  letter-spacing: 1px;
  @apply font-bold;
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