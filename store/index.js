import classes from "~/static/classes.json";
import wpapi from "wpapi";
import { decode } from "html-entities";
import $ from "cheerio";
export const state = () => ({
  header: null,
  footer: null,
  myPosts: [],
  myPage: null,
  posts: [],
  pages: null,
  users: [],
  loggedin: 0,
  home: null,
  subscribe: null,
  whatWeveDone: null,
  whoWeAre: null,
  restLog: null,
  restReg: null,
  restCreate: null,
  restSubmit: null,
  restDash: null,
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
  myPosts(state, myPosts) {
    state.myPosts = myPosts;
  },
  myPage(state, myPage) {
    state.myPage = myPage;
  },
  posts(state, posts) {
    state.posts = posts;
  },
  pages(state, pages) {
    state.pages = pages;
  },
  users(state, users) {
    state.users = users;
  },
  loggedin(state, loggedin) {
    state.loggedin = loggedin;
  },
  subscribe(state, subscribe) {
    state.subscribe = subscribe;
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
  restDash(state, restDash) {
    state.restDash = restDash;
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
  setUser({ commit, state }, loggedin) {
    commit("loggedin", loggedin);
    // set myPosts
    let wp = new wpapi({
      endpoint: "https://eathereindy.nfshost.com/wp-json",
      username: "tylerhillwebdev",
      password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
      auth: true,
    });
    let allPosts = state.posts;
    let myPosts = [];
    for (let post of allPosts) {
      if (post.author == state.loggedin) {
        if (post.featured_media) {
          let feat = wp.media().id(post.featured_media).get();
          post.feat = feat;
        }
        myPosts.push(post);
      }
    }
    let mySlug = state.pages.authors[loggedin];
    let myPage = state.pages[mySlug];
    console.log(myPage);
    commit("myPosts", myPosts);
    commit("myPage", myPage);
  },
  async nuxtServerInit({ commit }) {
    console.log("init");
    function IsJsonString(str) {
      try {
        JSON.parse(str);
      } catch (e) {
        return false;
      }
      return true;
    }
    console.log("wp");
    let wp = new wpapi({
      endpoint: "https://eathereindy.nfshost.com/wp-json/",
      username: "tylerhillwebdev",
      password: "0MH4 CK5W 2Fm8 GUjP T4GG lHvw",
      auth: true,
    });

    const pages = await wp.pages().perPage(100).get();
    let slugs = {};
    let urls = [];
    let authors = {};
    for (let page of pages) {
      var jstr = $("<div/>").html(page.content.rendered).text();
      let slugfix = page.slug.replace("-", "");
      if (IsJsonString(page.content.rendered)) {
        var obj = JSON.parse(jstr);
        slugs[slugfix] = obj;
        if (page.author !== 1) {
          authors[page.author] = slugfix;
        }
      } else {
        slugs[slugfix] = jstr;
      }
      if (page.author !== 1) {
        let slugLink = "/spots/" + page.slug;
        urls.push({ link: slugLink, title: page.title.rendered });
      } else {
        let slugLink = "/" + page.slug;
        urls.push({ link: slugLink, title: page.title.rendered });
      }
    }
    slugs["urls"] = urls;
    slugs["authors"] = authors;
    commit("pages", slugs);

    // const home = await wp.pages().id(5).get();
    let home = "";
    commit("home", home);
    let subscribe = "";
    commit("subscribe", subscribe);
    // const header = await wp.pages().id(1015).get();
    console.log("slugs", slugs.header);
    let header = slugs.header;
    commit("header", header);
    // const footer = await wp.pages().id(1017).get();
    let footer = slugs.footer;
    commit("footer", footer);
    const users = await wp.users().perPage(100).get();
    let ids = [];
    for (let user of users) {
      ids.push({
        id: user.id,
        username: user.name,
      });
    }
    commit("users", ids);
    // const restLog = await this.$axios.$get(
    //   "https://eathereindy.nfshost.com/wp-json/wp/v2/pages/405"
    // );
    // commit("restLog", restLog);
    // const restReg = await wp.pages().id(244).get();
    let restReg = "";
    commit("restReg", restReg);
    const restCreate = slugs.restaurantcreated;
    commit("restCreate", restCreate);
    // const restSubmit = await wp.pages().id(461).get();
    let restSubmit = "";
    commit("restSubmit", restSubmit);
    // const restDash = await wp.pages().id(546).get();
    let restDash = "";
    commit("restDash", restDash);
    const posts = await wp.posts().get();
    commit("posts", posts);
    // if (process.env.NODE_ENV == "development") {
    //   const posts = await this.$axios.$get("/wp-json/wp/v2/pages");
    //   commit("posts", posts);
    // } else {
    //   commit("posts", pages);
    // }
    commit("classes", classes);
  },
};
