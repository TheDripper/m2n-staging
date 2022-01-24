<template>
  <div>
    <div id="header" v-html="header"></div>
    <Nuxt />
    <div id="footer" v-html="footer"></div>
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
#footer {
  .icons {
    .wp-block-group__inner-container {
      color: #716960;
      @apply flex items-center;
      figure {
        width: 24px !important;
        height: 34px !important;
      }
      img {
        @apply mx-2;
      }
    }
  }
  .foot {
    @apply flex flex-col;
    figure {
      @apply mb-6;
    }
  }
  ul, p {
    @apply text-white list-none p-0;
    li {
      @apply mb-6;
    }
  }
  .terms {
    @apply flex flex-col;
  }
  background: black;
  @apply flex items-center justify-between p-6 w-full;
}
#header {
  background: #181818;
  @apply flex items-center justify-between p-6 w-full;
  .nav {
    figure {
      @apply m-0;
    }
    .wp-block-group__inner-container {
      @apply flex items-center justify-center;
    }
  }
  ul {
    @apply flex text-white list-none;

    li {
      @apply mx-6;
    }
  }
  .user {
    li {
      @apply m-0;
      color: #99b4c7;
    }
    li:first-child {
      @apply border-r pr-2;
    }
    li:last-child {
      @apply pl-2;
    }
  }
}
</style>
<script>
export default {
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

