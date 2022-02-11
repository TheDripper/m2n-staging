import classes from "~/static/classes.json";
import wpapi from "wpapi";
import { decode } from "html-entities";
import $ from "cheerio";
export const state = () => ({
  news: null,
  featNews: [],
  header: null,
  footer: null,
  myPosts: [],
  myPage: null,
  posts: [],
  pages: null,
  users: [],
  loggedin: 0,
  home: null,
  howitworks: null,
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
  news(state, news) {
    state.news = news;
  },
  featNews(state, featNews) {
    state.featNews = featNews;
  },
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
  howitworks(state, howitworks) {
    state.howitworks = howitworks;
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
      endpoint: "https://m2n.nfshost.com/wp-json",
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
    commit("myPosts", myPosts);
    commit("myPage", myPage);
  },
  async nuxtServerInit({ commit }) {
    function IsJsonString(str) {
      try {
        JSON.parse(str);
      } catch (e) {
        return false;
      }
      return true;
    }
    let wp = new wpapi({
      endpoint: "https://m2n.nfshost.com/wp-json/",
      username: "tylerhillwebdev@gmail.com",
      password: "RpQ5 QwLw jbp1 GkZK S4Aw xrIy",
      auth: true,
    });

    const pages = await wp.pages().perPage(100).get();
    // console.log('pages',pages);
    let slugs = {};
    let urls = [];
    let authors = {};
    for (let page of pages) {
      let slugfix = page.slug.replace(/-/g, "");
      // let feat = page.featured_media;
      // if (feat) {
      //   let featSrc = await wp.media().id(feat).get();
      //   featSrc = featSrc.guid;
      //   slugs[slugfix] = { content: page.content.rendered, media: featSrc };
      // } else {
      //   slugs[slugfix] = { content: page.content.rendered, media: "" };
      // }
      // var jstr = $("<div/>").html(page.content.rendered).text();
      // if (IsJsonString(page.content.rendered)) {
      //   var obj = JSON.parse(jstr);
      //   slugs[slugfix] = obj;
      //   if (page.author !== 1) {
      //     authors[page.author] = slugfix;
      //   }
      // } else {
      //   slugs[slugfix] = page.content.rendered;
      // }
      slugs[slugfix] = page.content.rendered;
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
    console.log("slugs", slugs);
    commit("pages", slugs);

    const home = await wp.pages().id(38).get();
    const howitworks = await wp.pages().id(286).get();
    // const news = await wp.posts().perPage(100).get();
    // let newsSearch = [];
    // let featNews = [];
    // for (let post of news) {
    //   var jstr = $("<div/>").html(post.content.rendered).text();
    //   let slugfix = post.slug.replace("-", "");
    //   if (IsJsonString(post.content.rendered)) {
    //     var obj = JSON.parse(jstr);
    //     let slugLink = "/posts/" + post.slug;
    //     obj.link = slugLink;
    //     newsSearch.push(obj);
    //     if (post.categories.includes(227)) {
    //       featNews.push(obj);
    //     }
    //     slugs[slugfix] = obj;
    //     if (post.author !== 1) {
    //       authors[post.author] = slugfix;
    //     }
    //   } else {
    //     slugs[slugfix] = jstr;
    //   }
    //   let slugLink = "/posts/" + post.slug;
    //   urls.push({ link: slugLink, title: post.title.rendered });
    // }

    // commit("featNews", featNews);
    // commit("news", newsSearch);
    // let home = slugs.home;
    commit("home", home.content.rendered);
    commit("howitworks", howitworks.content.rendered);
    // let subscribe = "";
    // commit("subscribe", subscribe);
    // const users = await wp.users().perPage(100).get();
    // let ids = [];
    // for (let user of users) {
    //   ids.push({
    //     id: user.id,
    //     username: user.name,
    //   });
    // }
    // commit("users", ids);
    // const restLog = await this.$axios.$get(
    //   "https://m2n.nfshost.com/wp-json/wp/v2/pages/405"
    // );
    // commit("restLog", restLog);
    // const restReg = await wp.pages().id(244).get();
    // let restReg = "";
    // commit("restReg", restReg);
    // const restCreate = slugs.restaurantcreated;
    // commit("restCreate", restCreate);
    // const restSubmit = await wp.pages().id(461).get();
    // let restSubmit = "";
    // commit("restSubmit", restSubmit);
    // const restDash = await wp.pages().id(546).get();
    // let restDash = "";
    // commit("restDash", restDash);
    // const posts = await wp.posts().get();
    // commit("posts", posts);
    const header = await wp.pages().id(96).get();
    commit("header", header.content.rendered);
    const footer = await wp.pages().id(99).get();
    commit("footer", footer.content.rendered);
    // if (process.env.NODE_ENV == "development") {
    //   const posts = await this.$axios.$get("/wp-json/wp/v2/pages");
    //   commit("posts", posts);
    // } else {
    //   commit("posts", pages);
    // }
    commit("classes", classes);
  },
};
