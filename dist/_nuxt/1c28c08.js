(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{255:function(n,t,e){"use strict";var o=e(5),r=e(72).find,l=e(124),c="find",d=!0;c in[]&&Array(1).find((function(){d=!1})),o({target:"Array",proto:!0,forced:d},{find:function(n){return r(this,n,arguments.length>1?arguments[1]:void 0)}}),l(c)},256:function(n,t,e){var content=e(260);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[n.i,content,""]]),content.locals&&(n.exports=content.locals);(0,e(41).default)("747a7dfd",content,!0,{sourceMap:!1})},259:function(n,t,e){"use strict";e(256)},260:function(n,t,e){var o=e(40)((function(i){return i[1]}));o.push([n.i,"#content{\n  overflow-x:hidden;\n  width:100vw\n}\nh1,h2,h3,h4,h5,h6{\n  font-family:freight-big-pro;\n  line-height:1.375\n}\nh1{\n  font-size:4rem;\n  font-weight:700\n}\nh2{\n  font-size:2.25rem;\n  font-weight:700\n}\nh3{\n  font-size:1.875rem;\n  font-weight:700\n}\nh4{\n  margin-bottom:0.5rem\n}\na,li,p{\n  font-family:europa;\n  font-weight:300\n}\nul{\n  list-style:circle;\n  padding-left:1rem\n}\n.gallery-vertical li{\n  margin:3rem 0!important\n}\n.gallery-vertical li img{\n  max-width:120px!important;\n  margin-left:auto;\n  margin-right:auto\n}\n.w-full-gutter{\n  width:calc(100% - 2rem)\n}\n.wp-block-button__link{\n  border-radius:0;\n  background:none;\n  border:2px solid #000;\n  color:#000;\n  font-family:futura-pt\n}\n.wp-block-buttons{\n  margin-top:2rem\n}\n.bleed-up img{\n  transform:translateY(-30px);\n  position:relative;\n  z-index:10\n}\n.epmt{\n  display:flex;\n  justify-content:flex-end\n}\n.epmt img{\n  max-width:913px;\n  transform:translate(257px)\n}\n.arrow-link a{\n  color:#b8c734;\n  position:relative;\n  font-weight:400;\n  margin-top:3rem;\n  display:inline-block\n}\n.arrow-link a:after{\n  position:absolute;\n  top:50%;\n  right:0;\n  transform:translate(110%,-38%);\n  content:url(/Arrow.svg)\n}\n.list-none ul{\n  list-style:none!important\n}\n.wp-block-image img{\n  height:auto\n}\n#header{\n  position:absolute;\n  z-index:99;\n  width:100vw;\n  margin-bottom:80px\n}\n#header .logo{\n  width:77px\n}\n.slider{\n  position:relative\n}\n.slick-slide .wp-block-columns{\n  display:flex!important\n}\n.slick-slide .wp-block-columns .wp-block-column:first-child{\n  position:relative;\n  z-index:10;\n  --bg-opacity:1;\n  background-color:#fff;\n  background-color:rgba(255, 255, 255, var(--bg-opacity));\n  padding:1rem\n}\n.arrows{\n  display:flex;\n  justify-content:flex-end;\n  cursor:pointer\n}\n.arrows .wp-block-column{\n  max-width:70px\n}",""]),o.locals={},n.exports=o},265:function(n,t,e){"use strict";e.r(t);e(255);var o=e(125),r=e.n(o),l={created:function(){},mounted:function(){r()(".scroll a").on("click",(function(n){n.preventDefault();var t=r()(this).attr("href");console.log(t);var e=r()(t).offset().top;r()("html,body").animate({scrollTop:e},500)}));var n=this;r()(".slider").each((function(){n.$slider(r()(this).find(".wp-block-group__inner-container"))}))},computed:{what:function(){return this.$store.state.whatWeveDone[0]},header:function(){return this.$store.state.header},footer:function(){return this.$store.state.footer},classes:function(){return this.$store.state.classes}}},c=(e(259),e(42)),component=Object(c.a)(l,(function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"testtttt",attrs:{id:"root"}},[e("div",{class:n.classes}),n._v(" "),e("div",{attrs:{id:"header"},domProps:{innerHTML:n._s(n.header.content.rendered)}}),n._v(" "),e("div",{attrs:{id:"content"},domProps:{innerHTML:n._s(n.what.content.rendered)}}),n._v(" "),e("div",{attrs:{id:"footer"},domProps:{innerHTML:n._s(n.footer.content.rendered)}})])}),[],!1,null,null,null);t.default=component.exports}}]);