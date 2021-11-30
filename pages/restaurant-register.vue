<template>
  <div id="root" class="testtttt">
    <div :class="classes"></div>
    <div class="flex flex-col h-screen v-screen">
      <label>Restaurant Email</label>
      <input type="text" name="restEmail" v-model="restEmail" />
      <label>Restaurant Password</label>
      <input type="password" name="restPass" v-model="restPass" />
      <label>Restaurant Name</label>
      <input type="text" name="restName" v-model="restName" />
      <label>Restaurant Address</label>
      <input type="text" name="restAddress" v-model="restAddress" />
      <label>Address Line 2</label>
      <input type="text" name="restAddress2" v-model="restAddress2" />
      <label>City</label>
      <input type="text" name="restCity" v-model="restCity" />
      <label>State</label>
      <input type="text" name="restState" v-model="restState" />
      <label>Zip</label>
      <input type="text" name="restZip" v-model="restZip" />
      <label>Category</label>
      <select name="foodType" v-model="foodType">
        <option>Indian</option>
        <option>Vietnamese</option>
        <option>BBQ</option>
      </select>
      <input type="text" name="hours" v-model="hours" />
      <input type="checkbox" name="Sunday" v-model="Sunday" />
      <input type="checkbox" name="Monday" v-model="Monday" />
      <input type="checkbox" name="Tuesday" v-model="Tuesday" />
      <input type="checkbox" name="Wednesday" v-model="Wednesday" />
      <input type="checkbox" name="Thursday" v-model="Thursday" />
      <input type="checkbox" name="Friday" v-model="Friday" />
      <input type="checkbox" name="Saturday" v-model="Saturday" />
      <div class="container">
        <h2>Logo</h2>
        <hr />
        <div class="large-12 medium-12 small-12 cell">
          <label
            >File Preview
            <input
              type="file"
              id="file"
              accept="image/*"
              @change="handleFileUpload($event)"
            />
          </label>
          <img v-bind:src="imagePreview" v-show="showPreview" />
        </div>
      </div>
      <input type="submit" value="Register" @click="sendSub" />
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import $ from "jquery";
import jQuery from "jquery";
// import $axios from "@nuxtjs/axios";
import axios from "axios";
import wpapi from "wpapi";

export default {
  // async asyncData({ $axios }) {
  //   const header = await $axios.$get("/api/pages/7");
  //   console.log(header);
  //   const footer = await $axios.$get("/api/pages/9");
  //   const home = await $axios.$get("/api/pages/5");
  //   return {
  //     header,
  //     footer,
  //     home
  //   }
  // },
  created() {},
  mounted() {
    let wp = new wpapi({
      endpoint: "https://eathereindy.nfshost.com/wp-json",
      username: "tylerhillwebdev",
      password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
      auth: true,
    });
    // $("a").each(function () {
    //   $(this).attr("target", "_blank");
    // });
    let ax = this.$axios;
    console.log(ax);
    $(".scroll a").on("click", function (e) {
      e.preventDefault();
      const hash = $(this).attr("href");
      console.log(hash);
      // const headerHeight = $header.outerHeight() + 500;
      const offset = $(hash).offset().top;
      $("html,body").animate({ scrollTop: offset }, 500);
    });
    let instance = this;
    let logoFile = this.file;
    $(".slider").each(function () {
      instance.$slider($(this).find(".wp-block-group__inner-container"));
    });
    // $("#gform_1").on("submit", async function (e) {
    //   e.preventDefault();
    //   console.log("argh");
    //   // let postRes = await ax.$post("/api/wp/v2/users", {
    //   //   username: "testy",
    //   //   password: "testy",
    //   //   email: "tylerehill@gmail.com",
    //   // });
    //   // let posts = await wp.posts().get();
    //   // let formData = $(this).serializeArray();
    //   let formData = new FormData(e.target);
    //   let send = [];
    //   let title = formData.get("input_1");
    //   let email = formData.get("input_3");
    //   let password = formData.get("input_19");
    //   for (let entry of formData.entries()) {
    //     send.push({
    //       key: entry[0],
    //       value: entry[1],
    //     });
    //   }
    //   console.log(send);
    //   send = JSON.stringify(send);
    //   let posts = await wp.pages().create({
    //     title: title,
    //     content: send,
    //   });
    //   let newUse = await wp.users().create({
    //     username: title,
    //     email: email,
    //     password: password,
    //   });
    //   console.log(newUse);
    //   let logo = await wp.media().file(logoFile).create({
    //     title: title,
    //     post: posts.id,
    //   });
    //   let feat = await wp.posts().id(posts.id).update({
    //     featured_media: logo.id,
    //   });
    //   console.log(feat);
    //   window.location.href = "/restaurant-created";
    //   // let postRes = await ax.$post("/oauth/request",{
    //   //   oauth_consumer_key: 'CCSXk8EYPiAd',
    //   //   oauth_consumer_secret: 'kUdeoqHd4eVNeXkvBXd8IQmupddJOWGu73iedSsZgJ2pEVEH'
    //   // });
    //   // console.log(postRes);
    // });
  },
  data() {
    return {
      restEmail: "",
      restPass: "",
      restName: "",
      restAddress: "",
      restAddress2: "",
      restCity: "",
      restState: "",
      restZip: "",
      foodType: "",
      hours: "",
      Sunday: false,
      Monday: false,
      Tuesday: false,
      Wednesday: false,
      Thursday: false,
      Friday: false,
      Saturday: false,
      title: "",
      body: "",
      file: "",
      showPreview: false,
      imagePreview: "",
    };
  },
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0];
      let reader = new FileReader();
      reader.addEventListener(
        "load",
        function () {
          this.showPreview = true;
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );
      if (this.file) {
        if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
          /*
							Fire the readAsDataURL method which will read the file in and
							upon completion fire a 'load' event which we will listen to and
							display the image in the preview.
						*/
          reader.readAsDataURL(this.file);
        }
      }
    },
    async sendSub() {
      let wp = new wpapi({
        endpoint: "https://eathereindy.nfshost.com/wp-json",
        username: "tylerhillwebdev",
        password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
        auth: true,
      });
      let restData = {
        name: this.restName,
        address: this.restAddress,
        address2: this.restAdress2,
        city: this.restCity,
        state: this.restState,
        zip: this.restZip,
        category: this.foodType,
        hours: this.hours
      }
      let title = this.restName;
      let restSend = JSON.stringify(restData);
      let posts = await wp.pages().create({
        title: title,
        content: restSend,
        author: this.loggedin,
        status: "publish",
      });
      console.log(posts, posts.id);
      // let formData = new FormData();
      // formData.append("file", this.file);
      // var filePath = "/path/to/the/image/to/upload.jpg";
      let logo = await wp.media().file(this.file).create({
        title: this.title,
        post: posts.id,
      });
      let feat = await wp.pages().id(posts.id).update({
        featured_media: logo.id,
      });
      console.log(feat);
    },
  },
  computed: {
    ajax() {
      return this.$store.state.ajax;
    },
    page() {
      return this.$store.state.restReg;
    },
    pages() {
      return this.$store.state.pages;
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
  @apply leading-snug;
  font-family: "Nunito";
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
  font-family: "Nunito";
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
input,
select {
  @apply border border-burnt rounded w-full;
}
.ginput_complex {
  @apply flex flex-col;
}
</style>