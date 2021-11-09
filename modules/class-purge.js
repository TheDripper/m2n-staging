import fse from "fs-extra";
import path from "path";
const axios = require("axios");
const cheerio = require('cheerio');

export default async function asyncModule() {
  try {
    const { data } = await axios(
      "https://eathereindy.nfshost.com/wp-json/wp/v2/pages/5"
    );
    const $ = cheerio.load(data);
    let classes = ['hidden'];
    $('.wp-block-columns, .wp-block-column, h1, h2, h3, h4, h5, h6, p, a, li').each(function(){
        classes.push($(this).attr('class'));
    })
    fse.writeFile("./static/classes.json", JSON.stringify(classes));
  } catch (err) {
    console.log(err);
  }
}