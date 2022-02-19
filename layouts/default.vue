<template>
  <div>
    <div id="header" v-html="header"></div>
    <Nuxt />
    <div id="footer">
      <div
        class="
          max-w-5xl
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
      }
    }
    li {
      @apply text-center md:text-left;
      font-size: 11px;
      letter-spacing: 1px;
      color: #999999
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
  }
  background: black;
  @apply flex items-center justify-between p-6 w-full;
}
#header {
  background: #181818;
  max-height: 80px;
  height: 80px;
  transition: all 0.2s ease;
  @apply flex flex-col items-start justify-between p-6;
  @screen md {
    @apply flex-row items-center;
  }
  .burger {
    @apply m-0 absolute;
    cursor: pointer;
    top: 32px;
    right: 35px;
    @screen md {
      @apply hidden;
    }
  }
  .nav {
    figure {
      @apply m-0;
      @screen md {
        @apply m-0;
      }
    }
    .wp-block-group__inner-container {
      @apply flex flex-col items-start justify-start;
      @screen md {
        @apply flex-row items-center justify-center;
      }
    }
  }
  ul {
    @apply flex flex-col text-white list-none hidden;
    @screen md {
      @apply flex flex-row;
    }
    li {
      font-size: 12px;
      letter-spacing: 1px;
      @apply mb-8;
      @screen md {
        @apply mx-6 mb-0;
      }
    }
  }
  .user {
    @apply p-0;
    li {
      @apply mb-8;
      color: #99b4c7;
      @screen md {
        @apply m-0;
      }
    }
    li:first-child {
      @screen md {
        @apply border-r pr-2;
      }
    }
    li:last-child {
      @screen md {
        @apply pl-2;
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

