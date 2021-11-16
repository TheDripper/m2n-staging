import classes from "~/static/classes.json";
import wpapi from "wpapi";
export const state = () => ({
  header: null,
  footer: null,
  posts: [],
  home: null,
  whatWeveDone: null,
  whoWeAre: null,
  restLog: null,
  restReg: null,
  restCreate: null,
  restSubmit: null,
  classes: "",
  ajax: "",
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
  restLog(state, restLog) {
    state.restLog = restLog;
  },
  restReg(state, restReg) {
    state.restReg = restReg;
  },
  restCreate(state, restCreate) {
    state.restCreate = restCreate;
  },
  restSubmit(state, restSubmit) {
    state.restSubmit = restSubmit;
  },
  whatWeveDone(state, whatWeveDone) {
    state.whatWeveDone = whatWeveDone;
  },
  whoWeAre(state, whoWeAre) {
    state.whoWeAre = whoWeAre;
  },
  ajax(state, ajax) {
    state.ajax = ajax;
  },
};
export const actions = {
  //  async getPage(context, id) {
  //   //  const page = await this.$axios.$get('/server-middleware/page/'+id);
  //   //  const page = await this.$axios.$get("/wp-json/wp/v2/pages/"+id);
  //    return page
  //  },
  async nuxtServerInit({ commit }) {
    let wp = new wpapi({
      endpoint: "https://eathereindy.nfshost.com/wp-json/",
      username: "tylerhillwebdev",
      password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
      auth: true,
    });
    // const ajax = await this.$axios.$get(
    //   "https://eathereindy.nfshost.com/wp-json/presspack/v1/ajax"
    // );
    // commit("ajax", ajax);
    // // const home = await this.$axios.$get(
    // //   "https://eathereindy.nfshost.com/wp-json/wp/v2/pages/5"
    // // );
    // // const whatWeveDone = await this.$axios.$get("https://eathereindy.nfshost.com/wp-json/wp/v2/pages?slug=what-weve-done");
    // // const whoWeAre = await this.$axios.$get("https://eathereindy.nfshost.com/wp-json/wp/v2/pages?slug=who-we-are");
    // const posts = await this.$axios.$get(
    //   "https://eathereindy.nfshost.com/wp-json/wp/v2/posts"
    // );
    // commit("home", home);
    // commit("posts", posts);
    // commit("whatWeveDone",whatWeveDone);
    // commit("whoWeAre",whoWeAre);

    const header = await wp.pages().id(1015).get();
    commit("header", header);
    const footer = await wp.pages().id(1017).get();
    commit("footer", footer);
    // const restLog = await this.$axios.$get(
    //   "https://eathereindy.nfshost.com/wp-json/wp/v2/pages/405"
    // );
    // commit("restLog", restLog);
    const restReg = await wp.pages().id(244).get();
    commit("restReg", restReg);
    const restCreate = await wp.pages().id(708).get();
    commit("restCreate", restCreate);
    const restSubmit = await wp.pages().id(461).get();
    commit("restSubmit", restSubmit);
    // if (process.env.NODE_ENV == "development") {
    //   const posts = await this.$axios.$get("/wp-json/wp/v2/pages");
    //   commit("posts", posts);
    // } else {
    //   commit("posts", pages);
    // }
    commit("classes", classes);
  },
};
