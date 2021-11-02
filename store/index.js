import classes from "~/static/classes.json";
export const state = () => ({
  header: null,
  footer: null,
  posts: [],
  home: null,
  whatWeveDone: null,
  whoWeAre: null,
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
  },
  whatWeveDone(state, whatWeveDone) {
    state.whatWeveDone = whatWeveDone;
  },
  whoWeAre(state, whoWeAre) {
    state.whoWeAre = whoWeAre;
  },

};
export const actions = {
  //  async getPage(context, id) {
  //   //  const page = await this.$axios.$get('/server-middleware/page/'+id);
  //   //  const page = await this.$axios.$get("/wp-json/wp/v2/pages/"+id);
  //    return page
  //  },
  async nuxtServerInit({ commit }) {
    const home = await this.$axios.$get("https://dgs.nfshost.com/wp-json/wp/v2/pages/5");
    const whatWeveDone = await this.$axios.$get("https://dgs.nfshost.com/wp-json/wp/v2/pages?slug=what-weve-done");
    const whoWeAre = await this.$axios.$get("https://dgs.nfshost.com/wp-json/wp/v2/pages?slug=who-we-are");
    commit("home",home);
    commit("whatWeveDone",whatWeveDone);
    commit("whoWeAre",whoWeAre);
    const header = await this.$axios.$get("https://dgs.nfshost.com/wp-json/wp/v2/pages/7");
    commit("header",header);
    const footer = await this.$axios.$get("https://dgs.nfshost.com/wp-json/wp/v2/pages/9");
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
