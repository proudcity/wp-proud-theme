/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./assets/scripts/modernizr.js ***!
  \*************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
/*! modernizr 3.3.1 (Custom Build) | MIT *
 * https://modernizr.com/download/?-backgroundblendmode-csscalc-flexbox-setclasses !*/
!function (e, n, t) {
  function r(e, n) {
    return _typeof(e) === n;
  }
  function o() {
    var e, n, t, o, s, i, a;
    for (var l in x) if (x.hasOwnProperty(l)) {
      if (e = [], n = x[l], n.name && (e.push(n.name.toLowerCase()), n.options && n.options.aliases && n.options.aliases.length)) for (t = 0; t < n.options.aliases.length; t++) e.push(n.options.aliases[t].toLowerCase());
      for (o = r(n.fn, "function") ? n.fn() : n.fn, s = 0; s < e.length; s++) i = e[s], a = i.split("."), 1 === a.length ? Modernizr[a[0]] = o : (!Modernizr[a[0]] || Modernizr[a[0]] instanceof Boolean || (Modernizr[a[0]] = new Boolean(Modernizr[a[0]])), Modernizr[a[0]][a[1]] = o), y.push((o ? "" : "no-") + a.join("-"));
    }
  }
  function s(e) {
    var n = _.className,
      t = Modernizr._config.classPrefix || "";
    if (w && (n = n.baseVal), Modernizr._config.enableJSClass) {
      var r = new RegExp("(^|\\s)" + t + "no-js(\\s|$)");
      n = n.replace(r, "$1" + t + "js$2");
    }
    Modernizr._config.enableClasses && (n += " " + t + e.join(" " + t), w ? _.className.baseVal = n : _.className = n);
  }
  function i(e) {
    return e.replace(/([a-z])-([a-z])/g, function (e, n, t) {
      return n + t.toUpperCase();
    }).replace(/^-/, "");
  }
  function a() {
    return "function" != typeof n.createElement ? n.createElement(arguments[0]) : w ? n.createElementNS.call(n, "http://www.w3.org/2000/svg", arguments[0]) : n.createElement.apply(n, arguments);
  }
  function l(e, n) {
    return !!~("" + e).indexOf(n);
  }
  function f(e, n) {
    return function () {
      return e.apply(n, arguments);
    };
  }
  function u(e, n, t) {
    var o;
    for (var s in e) if (e[s] in n) return t === !1 ? e[s] : (o = n[e[s]], r(o, "function") ? f(o, t || n) : o);
    return !1;
  }
  function d(e) {
    return e.replace(/([A-Z])/g, function (e, n) {
      return "-" + n.toLowerCase();
    }).replace(/^ms-/, "-ms-");
  }
  function p() {
    var e = n.body;
    return e || (e = a(w ? "svg" : "body"), e.fake = !0), e;
  }
  function c(e, t, r, o) {
    var s,
      i,
      l,
      f,
      u = "modernizr",
      d = a("div"),
      c = p();
    if (parseInt(r, 10)) for (; r--;) l = a("div"), l.id = o ? o[r] : u + (r + 1), d.appendChild(l);
    return s = a("style"), s.type = "text/css", s.id = "s" + u, (c.fake ? c : d).appendChild(s), c.appendChild(d), s.styleSheet ? s.styleSheet.cssText = e : s.appendChild(n.createTextNode(e)), d.id = u, c.fake && (c.style.background = "", c.style.overflow = "hidden", f = _.style.overflow, _.style.overflow = "hidden", _.appendChild(c)), i = t(d, e), c.fake ? (c.parentNode.removeChild(c), _.style.overflow = f, _.offsetHeight) : d.parentNode.removeChild(d), !!i;
  }
  function m(n, r) {
    var o = n.length;
    if ("CSS" in e && "supports" in e.CSS) {
      for (; o--;) if (e.CSS.supports(d(n[o]), r)) return !0;
      return !1;
    }
    if ("CSSSupportsRule" in e) {
      for (var s = []; o--;) s.push("(" + d(n[o]) + ":" + r + ")");
      return s = s.join(" or "), c("@supports (" + s + ") { #modernizr { position: absolute; } }", function (e) {
        return "absolute" == getComputedStyle(e, null).position;
      });
    }
    return t;
  }
  function v(e, n, o, s) {
    function f() {
      d && (delete z.style, delete z.modElem);
    }
    if (s = r(s, "undefined") ? !1 : s, !r(o, "undefined")) {
      var u = m(e, o);
      if (!r(u, "undefined")) return u;
    }
    for (var d, p, c, v, h, g = ["modernizr", "tspan", "samp"]; !z.style && g.length;) d = !0, z.modElem = a(g.shift()), z.style = z.modElem.style;
    for (c = e.length, p = 0; c > p; p++) if (v = e[p], h = z.style[v], l(v, "-") && (v = i(v)), z.style[v] !== t) {
      if (s || r(o, "undefined")) return f(), "pfx" == n ? v : !0;
      try {
        z.style[v] = o;
      } catch (y) {}
      if (z.style[v] != h) return f(), "pfx" == n ? v : !0;
    }
    return f(), !1;
  }
  function h(e, n, t, o, s) {
    var i = e.charAt(0).toUpperCase() + e.slice(1),
      a = (e + " " + E.join(i + " ") + i).split(" ");
    return r(n, "string") || r(n, "undefined") ? v(a, n, o, s) : (a = (e + " " + b.join(i + " ") + i).split(" "), u(a, n, t));
  }
  function g(e, n, r) {
    return h(e, t, t, n, r);
  }
  var y = [],
    x = [],
    C = {
      _version: "3.3.1",
      _config: {
        classPrefix: "",
        enableClasses: !0,
        enableJSClass: !0,
        usePrefixes: !0
      },
      _q: [],
      on: function on(e, n) {
        var t = this;
        setTimeout(function () {
          n(t[e]);
        }, 0);
      },
      addTest: function addTest(e, n, t) {
        x.push({
          name: e,
          fn: n,
          options: t
        });
      },
      addAsyncTest: function addAsyncTest(e) {
        x.push({
          name: null,
          fn: e
        });
      }
    },
    Modernizr = function Modernizr() {};
  Modernizr.prototype = C, Modernizr = new Modernizr();
  var _ = n.documentElement,
    w = "svg" === _.nodeName.toLowerCase(),
    S = "Moz O ms Webkit",
    b = C._config.usePrefixes ? S.toLowerCase().split(" ") : [];
  C._domPrefixes = b;
  var E = C._config.usePrefixes ? S.split(" ") : [];
  C._cssomPrefixes = E;
  var P = function P(n) {
    var r,
      o = N.length,
      s = e.CSSRule;
    if ("undefined" == typeof s) return t;
    if (!n) return !1;
    if (n = n.replace(/^@/, ""), r = n.replace(/-/g, "_").toUpperCase() + "_RULE", r in s) return "@" + n;
    for (var i = 0; o > i; i++) {
      var a = N[i],
        l = a.toUpperCase() + "_" + r;
      if (l in s) return "@-" + a.toLowerCase() + "-" + n;
    }
    return !1;
  };
  C.atRule = P;
  var T = {
    elem: a("modernizr")
  };
  Modernizr._q.push(function () {
    delete T.elem;
  });
  var z = {
    style: T.elem.style
  };
  Modernizr._q.unshift(function () {
    delete z.style;
  }), C.testAllProps = h;
  var k = C.prefixed = function (e, n, t) {
    return 0 === e.indexOf("@") ? P(e) : (-1 != e.indexOf("-") && (e = i(e)), n ? h(e, n, t) : h(e, "pfx"));
  };
  Modernizr.addTest("backgroundblendmode", k("backgroundBlendMode", "text")), C.testAllProps = g, Modernizr.addTest("flexbox", g("flexBasis", "1px", !0));
  var N = C._config.usePrefixes ? " -webkit- -moz- -o- -ms- ".split(" ") : ["", ""];
  C._prefixes = N, Modernizr.addTest("csscalc", function () {
    var e = "width:",
      n = "calc(10px);",
      t = a("a");
    return t.style.cssText = e + N.join(n + e), !!t.style.length;
  }), o(), s(y), delete C.addTest, delete C.addAsyncTest;
  for (var j = 0; j < Modernizr._q.length; j++) Modernizr._q[j]();
  e.Modernizr = Modernizr;
}(window, document);
/******/ })()
;
//# sourceMappingURL=modernizr.js.map