<template>
  <div id="root" class="testtttt">
    <div :class="classes"></div>
    <div class="flex bg-back-grey">
      <div id="page" class="w-full text-white">
        <div class="frame">
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
    // $("a").each(function () {
    //   $(this).attr("target", "_blank");
    // });
    $(window).on("scroll", function (e) {
      let hero = $(".hero").outerHeight();
      let header = $("#header").outerHeight();
      let height = hero + header + 192;
      console.log("height", height);
      let scrolly = $(document).scrollTop();
      console.log("scroll", scrolly);
      if (scrolly > height) {
        $(".scroller").addClass("scrolling");
      } else {
        $(".scroller").removeClass("scrolling");
      }
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
    background: none;
    border: 2px solid #adcce0;
    width: 250px;
    letter-spacing: 1px;
    color: #adcce0;
  }
}
.team {
  @apply py-32;
  h2 {
    @apply uppercase font-thin mb-8;
  }
  h5 {
    font-size: 24px;
    @apply font-light mb-6;
  }
  h3 {
    font-size: 18px;
    @apply uppercase mb-2;
  }
  p {
    font-size: 14px;
  }
  .wp-block-columns {
    @apply p-0;
  }
}
.mission {
  h2 {
    @apply text-head-40 uppercase font-thin mb-16;
  }
  p {
    font-size: 22px;
    @apply mb-6 font-light;
  }
}
.behind {
  min-height: 1024px;
  h2 {
    font-size: 40px;
    @apply font-thin uppercase;
  }
  h4 {
    @apply font-bold;
  }
  p {
    @apply mb-6;
  }
  ul {
    @apply list-disc pl-8 mb-8;
  }
}
.story {
  height: 750px;
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
.tri-top {
  @apply relative;
  min-height: 1013px;
  h1 {
    @apply text-center font-thin uppercase;
    font-size: 40px;
  }
  h2 {
    @apply text-center font-thin;
    font-size: 28px !important;
  }
  .wp-block-column {
    @apply flex flex-col items-center justify-start;
    p {
      @apply text-center;
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
    .wp-block-button__link {
      background: none;
      border: 2px solid white;
      width: 250px;
      letter-spacing: 1px;
    }
  }
}
.scrolling {
  @apply fixed top-0;
}
.hero {
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
}

.text-img {
  .wp-block-column {
    &:first-child {
      @apply flex flex-col items-start justify-center;
    }
    &:last-child {
      @apply flex items-center justify-center;
    }
  }
}
</style>
