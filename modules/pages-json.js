import fs from "fs"
import path from "path";
const axios = require("axios");

export default async function asyncModule() {
  try {
    const { data } = await axios(
      "https://eathereindy.nfshost.com/wp-json/wp/v2/pages"
    );
    fs.writeFileSync("./static/pages.json", JSON.stringify(data));
  } catch (err) {
    console.log(err);
  }
}