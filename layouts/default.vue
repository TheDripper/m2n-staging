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
    color: 99b4c7;
    li {
      @apply m-0;
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

