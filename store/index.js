import classes from "~/static/classes.json";
export const state = () => ({
  header: '',
  footer: '',
  posts: [],
  home: null,
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
  },
  home(state, home) {
    state.home = home;
  }
};
export const actions = {
  //  async getPage(context, id) {
  //   //  const page = await this.$axios.$get('/server-middleware/page/'+id);
  //   //  const page = await this.$axios.$get("/wp-json/wp/v2/pages/"+id);
  //    return page
  //  },
  async nuxtServerInit({ commit }) {
    console.log('init');
    const header = await this.$axios.$get("/api/pages/7");
    console.log(header);
    commit("header",header);
    const footer = await this.$axios.$get("/api/pages/9");
    commit("footer",footer);
    const home = await this.$axios.$get("/api/pages/5");
    commit("home",home);
    // if (process.env.NODE_ENV == "development") {
    //   const posts = await this.$axios.$get("/wp-json/wp/v2/pages");
    //   commit("posts", posts);
    // } else {
    //   commit("posts", pages);
    // }
    commit("classes", classes);
  }
};
