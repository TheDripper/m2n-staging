(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{397:function(n,t,e){"use strict";var r=e(6),o=e(87).find,l=e(157),c="find",d=!0;c in[]&&Array(1).find((function(){d=!1})),r({target:"Array",proto:!0,forced:d},{find:function(n){return o(this,n,arguments.length>1?arguments[1]:void 0)}}),l(c)},398:function(n,t,e){var content=e(408);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[n.i,content,""]]),content.locals&&(n.exports=content.locals);(0,e(56).default)("2856683d",content,!0,{sourceMap:!1})},407:function(n,t,e){"use strict";e(398)},408:function(n,t,e){var r=e(55)((function(i){return i[1]}));r.push([n.i,'/*purgecss start ignore*/\n#content{\n  overflow-x:hidden;\n  width:100vw\n}\nh1, h2, h3, h4, h5, h6{\n  line-height:1.375\n}\nh1,h2,h3,h4,h5,h6{\n  font-family:"Nunito"\n}\nh1{\n  font-size:4rem;\n  font-weight:700\n}\nh2{\n  font-size:2.25rem;\n  font-weight:700\n}\nh3{\n  font-size:1.875rem;\n  font-weight:700\n}\nh4{\n  margin-bottom:0.5rem\n}\na, li, p{\n  font-weight:300\n}\nul{\n  list-style:circle;\n  padding-left:1rem\n}\n.gallery-vertical li{\n  margin:3rem 0!important\n}\n.gallery-vertical li img{\n  max-width:120px!important;\n  margin-left:auto;\n  margin-right:auto\n}\n.w-full-gutter{\n  width:calc(100% - 2rem)\n}\n.wp-block-button__link{\n  border-radius:0;\n  background:none;\n  border:2px solid #000;\n  color:#000\n}\n.wp-block-buttons{\n  margin-top:2rem\n}\n.bleed-up img{\n  transform:translateY(-30px);\n  position:relative;\n  z-index:10\n}\n.epmt{\n  display:flex;\n  justify-content:flex-end\n}\n.epmt img{\n  max-width:913px;\n  transform:translate(257px)\n}\n.arrow-link a{\n  color:#b8c734;\n  position:relative;\n  margin-top:3rem;\n  display:inline-block;\n  font-weight:400\n}\n.arrow-link a:after{\n  position:absolute;\n  top:50%;\n  right:0;\n  transform:translate(110%,-38%);\n  content:url(/Arrow.svg)\n}\n.list-none ul{\n  list-style:none!important\n}\n.wp-block-image img{\n  height:auto\n}\n.slider{\n  position:relative\n}\n.slick-slide .wp-block-columns{\n  display:flex!important\n}\n.slick-slide .wp-block-columns .wp-block-column:first-child{\n  position:relative;\n  z-index:10;\n  --tw-bg-opacity:1;\n  background-color:rgba(255, 255, 255, var(--tw-bg-opacity));\n  padding:1rem\n}\n.arrows{\n  display:flex;\n  justify-content:flex-end;\n  cursor:pointer\n}\n.arrows .wp-block-column{\n  max-width:70px\n}\n\n/*purgecss end ignore*/',""]),r.locals={},n.exports=r},426:function(n,t,e){"use strict";e.r(t);e(397),e(11);var r=e(156),o=e.n(r),l={created:function(){},mounted:function(){o()(".scroll a").on("click",(function(n){n.preventDefault();var t=o()(this).attr("href");console.log(t);var e=o()(t).offset().top;o()("html,body").animate({scrollTop:e},500)}));var n=this;o()(".slider").each((function(){n.$slider(o()(this).find(".wp-block-group__inner-container"))}))},computed:{page:function(){return this.$store.state.restCreate},header:function(){return this.$store.state.header},footer:function(){return this.$store.state.footer},classes:function(){return this.$store.state.classes}}},c=(e(407),e(57)),component=Object(c.a)(l,(function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"testtttt",attrs:{id:"root"}},[e("div",{class:n.classes}),n._v(" "),e("div",{staticClass:"flex h-screen v-screen"},[e("div",{staticClass:"w-1/4 bg-white",attrs:{id:"header"},domProps:{innerHTML:n._s(n.header.content.rendered)}}),n._v(" "),e("div",{staticClass:"overflow-scroll w-3/4 bg-back-grey p-8",attrs:{id:"page"},domProps:{innerHTML:n._s(n.page.content.rendered)}})]),n._v(" "),e("div",{attrs:{id:"footer"},domProps:{innerHTML:n._s(n.footer.content.rendered)}})])}),[],!1,null,null,null);t.default=component.exports}}]);