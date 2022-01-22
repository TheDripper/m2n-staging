<template>
  <div id="pages" class="flex">
    <ul v-if="false" class="flex flex-col w-1/5" id="facets">
      <li class="list-none" v-for="(tag, index) in facets" :key="index">
        <p class="flex items-center justify-start">
          <input
            class="w-auto mr-4"
            type="checkbox"
            :value="tag.id"
            @change="filter(tag.id)"
          />{{ tag.slug }}
        </p>
      </li>
    </ul>
    <ul v-else class="flex flex-wrap p-8 article w-4/5">
      <li
        v-for="page in search"
        class="flex m-4 p-4 list-none w-full items-center justify-start"
      >
        <div class="frame">
          <NuxtLink :to="page.link"><img :src="page.media" /></NuxtLink>
        </div>
        <div class="flex flex-col">
          <h2 class="text-burnt">{{ page.title }}</h2>
          <p>{{ page.body }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
import wpapi from "wpapi";
import $ from "cheerio";
export default {
  methods: {
    async filter(id) {
      console.log("filter");
      let wp = new wpapi({
        endpoint: "https://eathereindy.nfshost.com/wp-json/",
        username: "tylerhillwebdev",
        password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
        auth: true,
      });
      console.log(id);
      let test = this.selected.indexOf(id);
      console.log("test", test);
      if (test > -1) {
        this.selected.splice(test, 1);
      } else {
        this.selected.push(id);
      }
      console.log("selected", this.selected);
      let filteredPosts = await wp
        .posts()
        .tags(this.selected)
        .categories(183)
        .perPage(100)
        .get();
      let filtered = [];
      for (let post of filteredPosts) {
        var jstr = $("<div/>").html(post.content.rendered).text();
        var obj = JSON.parse(jstr);
        obj.link = post.link;
        obj.title = post.title.rendered;
        filtered.push(obj);
      }
      console.log("filtered", filtered, filtered.length);
      this.filtered = filtered;
    },
  },
  data() {
    return {
      selected: [],
      filtered: [],
    };
  },
  computed: {
    facets() {
      return this.$store.state.facets;
    },
    search() {
      return this.$store.state.posts;
    },
    pages() {
      return this.$store.state.pages.urls;
    },
  },
};
</script>
<style lang="scss">
.article {
  .frame {
    @apply w-1/3 flex-shrink-0 flex items-center justify-center rounded-xl overflow-hidden mr-4;
  }
}
.search {
  list-style: none !important;
}
.thumb {
  border-radius: 30px;
  width: 150px;
}
</style>