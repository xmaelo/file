/*!
 * Name    : DEPRECATED Elements Extension for Jarallax. Use laxxx instead https://github.com/alexfoxy/laxxx
 * Version : 1.0.0
 * Author  : nK <https://nkdev.info>
 * GitHub  : https://github.com/nk-o/jarallax
 */ !(function () {
    var n = [
            ,
            function (t) {
                t.exports = function (t) {
                    "complete" === document.readyState || "interactive" === document.readyState
                        ? t.call()
                        : document.attachEvent
                        ? document.attachEvent("onreadystatechange", function () {
                              "interactive" === document.readyState && t.call();
                          })
                        : document.addEventListener && document.addEventListener("DOMContentLoaded", t);
                };
            },
            function (t, e, n) {
                n = "undefined" != typeof window ? window : void 0 !== n.g ? n.g : "undefined" != typeof self ? self : {};
                t.exports = n;
            },
            function (t, e, n) {
                "use strict";
                n.r(e),
                    n.d(e, {
                        default: function () {
                            return r;
                        },
                    });
                var e = n(2),
                    o = n.n(e);
                function r() {
                    var t,
                        e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : o().jarallax;
                    void 0 !== e &&
                        ((t = e.constructor),
                        ["initImg", "canInitParallax", "init", "destroy", "clipContainer", "coverImage", "isVisible", "onScroll", "onResize"].forEach(function (l) {
                            var u = t.prototype[l];
                            t.prototype[l] = function () {
                                var t = this;
                                "initImg" === l &&
                                    null !== t.$item.getAttribute("data-jarallax-element") &&
                                    ((t.options.type = "element"), (t.pureOptions.speed = t.$item.getAttribute("data-jarallax-element") || t.pureOptions.speed));
                                for (var e = arguments.length, n = new Array(e), o = 0; o < e; o++) n[o] = arguments[o];
                                if ("element" !== t.options.type) return u.apply(t, n);
                                switch (((t.pureOptions.threshold = t.$item.getAttribute("data-threshold") || ""), l)) {
                                    case "init":
                                        var r = t.pureOptions.speed.split(" ");
                                        (t.options.speed = t.pureOptions.speed || 0),
                                            (t.options.speedY = r[0] ? parseFloat(r[0]) : 0),
                                            (t.options.speedX = r[1] ? parseFloat(r[1]) : 0);
                                        var i = t.pureOptions.threshold.split(" ");
                                        (t.options.thresholdY = i[0] ? parseFloat(i[0]) : null), (t.options.thresholdX = i[1] ? parseFloat(i[1]) : null), u.apply(t, n);
                                        r = t.$item.getAttribute("data-jarallax-original-styles");
                                        return r && t.$item.setAttribute("style", r), !0;
                                    case "onResize":
                                        var a = t.css(t.$item, "transform");
                                        t.css(t.$item, { transform: "" });
                                        var s = t.$item.getBoundingClientRect();
                                        (t.itemData = { width: s.width, height: s.height, y: s.top + t.getWindowData().y, x: s.left }), t.css(t.$item, { transform: a });
                                        break;
                                    case "onScroll":
                                        (i = t.getWindowData()),
                                            (r = (i.y + i.height / 2 - t.itemData.y - t.itemData.height / 2) / (i.height / 2)),
                                            (s = r * t.options.speedY),
                                            (a = r * t.options.speedX),
                                            (i = s),
                                            (r = a);
                                        null !== t.options.thresholdY && s > t.options.thresholdY && (i = 0),
                                            null !== t.options.thresholdX && a > t.options.thresholdX && (r = 0),
                                            t.css(t.$item, { transform: "translate3d(".concat(r, "px,").concat(i, "px,0)") });
                                        break;
                                    case "initImg":
                                    case "isVisible":
                                    case "clipContainer":
                                    case "coverImage":
                                        return !0;
                                }
                                return u.apply(t, n);
                            };
                        }));
                }
            },
        ],
        o = {};
    function r(t) {
        var e = o[t];
        if (void 0 !== e) return e.exports;
        e = o[t] = { exports: {} };
        return n[t](e, e.exports, r), e.exports;
    }
    (r.n = function (t) {
        var e =
            t && t.__esModule
                ? function () {
                      return t.default;
                  }
                : function () {
                      return t;
                  };
        return r.d(e, { a: e }), e;
    }),
        (r.d = function (t, e) {
            for (var n in e) r.o(e, n) && !r.o(t, n) && Object.defineProperty(t, n, { enumerable: !0, get: e[n] });
        }),
        (r.g = (function () {
            if ("object" == typeof globalThis) return globalThis;
            try {
                return this || new Function("return this")();
            } catch (t) {
                if ("object" == typeof window) return window;
            }
        })()),
        (r.o = function (t, e) {
            return Object.prototype.hasOwnProperty.call(t, e);
        }),
        (r.r = function (t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }),
                Object.defineProperty(t, "__esModule", { value: !0 });
        });
    var i = {};
    !(function () {
        "use strict";
        r.r(i);
        var t = r(1),
            e = r.n(t),
            t = r(2),
            n = r.n(t);
        (0, r(3).default)(),
            e()(function () {
                void 0 !== n().jarallax && n().jarallax(document.querySelectorAll("[data-jarallax-element]"));
            });
    })();
})();
