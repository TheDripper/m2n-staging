<template>
  <div id="root" class="flex">
    <div v-if="header.length" id="content" v-html="header.content.rendered" class=""></div>
  </div>
</template>
<script>
export default {
  computed: {
    header() {
      return this.$store.state.header
    }
  }
};
</script>