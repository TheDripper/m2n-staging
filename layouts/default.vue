<template>
  <div>
    <div id="header" v-html="header"></div>
    <Nuxt />
    <div id="footer">
      <div class="max-w-5xl w-full mx-auto flex justify-between items-between" v-html="footer"></div>
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
html, body {
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
    @apply flex flex-col;
    figure {
      @apply mb-6;
    }
  }
  ul, p {
    @apply text-white list-none p-0;
    li {
      @apply mt-6;
    }
  }
  .terms {
    @apply flex flex-col;
    ul {
      @apply flex justify-end;
      li {
        &:first-child {
        @apply pr-2 border-r;
        } 
        &:last-child {
        @apply pl-2;
        } 
      }
    }
    li, p {
      @apply text-right mb-2;
      font-size: 11px;
      color: #797979;
    }
  }
  background: black;
  @apply flex items-center justify-between p-6 w-full;
}
#header {
  background: #181818;
  @apply flex items-center justify-between p-6;
  .burger {
    @apply m-0;
    @screen md {
      @apply hidden;
    }
  }
  .nav {
    figure {
      @apply m-0;
    }
    .wp-block-group__inner-container {
      @apply flex items-center justify-center;
    }
  }
  ul {
    @apply hidden flex text-white list-none;
    @screen md {
      @apply flex;
    }
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

