<template>
  <div>
    <div id="header" v-html="header"></div>
    <Nuxt />
    <div id="footer">
      <div
        class="
          w-full
          mx-auto
          flex flex-col
          md:flex-row
          justify-between
          items-between
        "
        v-html="footer"
      ></div>
    </div>
    <script
      type="text/javascript"
      id="hs-script-loader"
      async
      defer
      src="//js.hs-scripts.com/20008151.js"
    ></script>
  </div>
</template>

<style lang="scss">
h2 {
  font-weight: 500;
  letter-spacing: 0.5px;
  line-height: 110% !important;
}
html,
body {
  overflow-x: hidden !important;
}
#footer {
  .icons {
    .wp-block-group__inner-container {
      color: #716960;
      @apply w-full flex justify-end items-center;
      img {
        width: 20px;
        @apply ml-4;
      }
    }
  }
  .foot {
    @apply flex flex-col items-center justify-center;
    figure {
      @apply mb-6;
      img {
        @apply mx-auto;
        @screen lg {
          @apply m-0;
        }
      }
    }
    li {
      @apply text-center md:text-left;
      font-size: 11px;
      letter-spacing: 1px;
      color: #999999;
    }
  }
  ul,
  p {
    @apply text-white list-none p-0;
    li {
      @apply mt-6;
    }
  }
  .terms {
    @apply flex flex-col;
    ul {
      @apply flex justify-center items-center mb-6;
      @screen lg {
        @apply justify-end items-end mb-2;
      }
      li {
        &:first-child {
          @apply pr-2 border-r;
        }
        &:last-child {
          @apply pl-2;
        }
      }
    }
    li,
    p {
      @apply text-center md:text-right md:mb-2;
      font-size: 11px;
      color: #797979;
    }
    p {
      @screen lg {
        @apply m-0;
      }
    }
  }
  background: black;
  @apply flex items-center justify-between p-6 w-full;
  @screen lg {
    @apply pb-12;
  }
}
#header {
  background: #181818;
  max-height: 80px;
  height: 80px;
  transition: all 0.2s ease;
  @apply flex flex-col items-start justify-between p-6;
  @screen lg {
    @apply flex-row items-center;
    height: 60px;
  }
  .burger {
    @apply m-0 absolute;
    cursor: pointer;
    top: 32px;
    right: 35px;
    @screen lg {
      @apply hidden;
    }
  }
  .nav {
    figure {
      @apply m-0;
      @screen lg {
        margin-right: 10px;
      }
    }
    .wp-block-group__inner-container {
      @apply flex flex-col items-start justify-start;
      @screen lg {
        @apply flex-row items-center justify-center;
      }
    }
  }
  ul {
    @apply flex flex-col text-white list-none hidden;
    @screen lg {
      @apply flex flex-row;
    }
    li {
      font-size: 12px;
      letter-spacing: 1px;
      @apply mb-8;
      @screen lg {
        margin: 0 10px;
      }
      a {
        color: #999999;
      }
    }
  }
  .user {
    @apply p-0 overflow-hidden;
    width: 270px;
    @screen lg {
      @apply absolute;
      top: 0;
      right: 0;
    }
    li {
      @apply mb-8;
      color: #99b4c7;
      @screen lg {
        @apply m-0;
        font-size: 12px;
        letter-spacing: 1px;
      }
    }
    li:first-child {
      @screen lg {
        @apply pr-2 flex items-center justify-center text-white uppercase font-bold absolute;
        right: 40px;
        top: 0;
        background: url("/sign-bg.svg");
        height: 60px;
        background-size: 270px;
        background-position: 50% 50%;
        width: 230px;
      }
    }
    li:last-child {
      @screen lg {
        @apply pl-2 flex items-center justify-center text-white uppercase font-bold;
        transform: translate(110px);
        background: url("/log-bg.svg");
        height: 60px;
        background-size: 270px;
        background-position: 50% 50%;
        width: 230px;
      }
    }
  }
  &.open {
    height: auto;
    // max-height: 9999px;
    .nav {
      img {
        @apply mb-8;
      }
    }
    ul {
      @apply flex;
    }
  }
}
</style>
<script>
import $ from "jquery";
export default {
  mounted() {
    $(".burger").on("click", function () {
      if ($("#header").hasClass("open")) {
        $("#header").css("maxHeight", "80px");
      } else {
        $("#header").css("maxHeight", "422px");
      }
      $("#header").toggleClass("open");
    });
  },
  computed: {
    loggedin() {
      return this.$store.state.loggedin;
    },
    header() {
      return this.$store.state.header;
    },
    footer() {
      return this.$store.state.footer;
    },
    username() {},
  },
};
</script>

