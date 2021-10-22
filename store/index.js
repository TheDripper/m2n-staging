import classes from "~/static/classes.json";
export const state = () => ({
  header: '',
  footer: '',
  posts: [],
  classes: "",
});

export const mutations = {
  header(state, header) {
    state.header = header;
  },
  footer(state, footer) {
    state.footer = footer;
  },
  posts(state, posts) {
    state.posts = posts;
  },
  classes(state, classes) {
    state.classes = classes;
  }
};
export const actions = {
  //  async getPage(context, id) {
  //   //  const page = await this.$axios.$get('/server-middleware/page/'+id);
  //   //  const page = await this.$axios.$get("/wp-json/wp/v2/pages/"+id);
  //    return page
  //  },
  async nuxtServerInit({ commit }) {
    const header = await this.$axios.$get("/api/pages/7");
    commit("header",header);
    const footer = await this.$axios.$get("/api/pages/9");
    commit("footer",footer);
    // if (process.env.NODE_ENV == "development") {
    //   const posts = await this.$axios.$get("/wp-json/wp/v2/pages");
    //   commit("posts", posts);
    // } else {
    //   commit("posts", pages);
    // }
    commit("classes", classes);
  }
};
