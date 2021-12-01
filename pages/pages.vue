<template>
  <div id="pages">
    <ul>
      <li v-for="page in pages">
        <a :href="page.link">{{ page.title.rendered }}</a>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  computed: {
    pages() {
      return this.$store.state.pages.urls;
    },
  },
};
</script>
