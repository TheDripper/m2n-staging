<template>
  <div id="root" class="testtttt">
    <div :class="classes"></div>
    <div id="header" v-html="header.content.rendered" class=""></div>
    <h1 class="text-4xl max-w-5xl mx-auto py-32">Thoughts & Musings</h1>
    <div id="posts" class="max-w-5xl mx-auto">
      <ul>
        <li v-for="(post, index) in posts">
          <div class="wp-block-columns" :class="{ flip: index % 2 !== 0 }">
            <div class="wp-block-column">
              <h4>BLOG POST</h4>
              <h2>{{ post.title.rendered }}</h2>
              <p>cerpt</p>
            </div>
            <div class="wp-block-column">
              <img :src="post.featured_image_src" />
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div id="footer" v-html="footer.content.rendered" class=""></div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import $ from "jquery";
export default {
  // async asyncData({ $axios }) {
  //   const header = await $axios.$get("/api/whats/7");
  //   console.log(header);
  //   const footer = await $axios.$get("/api/whats/9");
  //   const home = await $axios.$get("/api/whats/5");
  //   return {
  //     header,
  //     footer,
  //     home
  //   }
  // },
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
    posts() {
      return this.$store.state.posts;
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
h6 {
  @apply font-head leading-snug;
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
  @apply font-body font-light;
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
  @apply font-footer;
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
.wp-block-columns {
  &.flip {
    @screen md {
      .wp-block-column {
        &:first-child {
          order: 2;
        }
        &:last-child {
          order: 1;
        }
      }
    }
  }
}
</style>