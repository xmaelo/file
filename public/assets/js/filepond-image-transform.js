/*!
 * FilePondPluginImageTransform 3.8.7
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

!(function (t, e) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = e())
        : "function" == typeof define && define.amd
        ? define(e)
        : ((t = t || self).FilePondPluginImageTransform = e());
})(this, function () {
    "use strict";
    var t = { jpeg: "jpg", "svg+xml": "svg" },
        e = {
            1: function () {
                return [1, 0, 0, 1, 0, 0];
            },
            2: function (t) {
                return [-1, 0, 0, 1, t, 0];
            },
            3: function (t, e) {
                return [-1, 0, 0, -1, t, e];
            },
            4: function (t, e) {
                return [1, 0, 0, -1, 0, e];
            },
            5: function () {
                return [0, 1, 1, 0, 0, 0];
            },
            6: function (t, e) {
                return [0, 1, -1, 0, e, 0];
            },
            7: function (t, e) {
                return [0, -1, -1, 0, e, t];
            },
            8: function (t) {
                return [0, -1, 1, 0, 0, t];
            },
        },
        n = function (t, e) {
            return { x: t, y: e };
        },
        r = function (t, e) {
            return n(t.x - e.x, t.y - e.y);
        },
        i = function (t, e) {
            return Math.sqrt(
                (function (t, e) {
                    return (function (t, e) {
                        return t.x * e.x + t.y * e.y;
                    })(r(t, e), r(t, e));
                })(t, e)
            );
        },
        a = function (t, e) {
            var r = t,
                i = e,
                a = 1.5707963267948966 - e,
                o = Math.sin(1.5707963267948966),
                u = Math.sin(i),
                c = Math.sin(a),
                l = Math.cos(a),
                h = r / o;
            return n(l * (h * u), l * (h * c));
        },
        o = function (t, e) {
            var r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0,
                o = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : { x: 0.5, y: 0.5 },
                u = o.x > 0.5 ? 1 - o.x : o.x,
                c = o.y > 0.5 ? 1 - o.y : o.y,
                l = 2 * u * t.width,
                h = 2 * c * t.height,
                f = (function (t, e) {
                    var r = t.width,
                        o = t.height,
                        u = a(r, e),
                        c = a(o, e),
                        l = n(t.x + Math.abs(u.x), t.y - Math.abs(u.y)),
                        h = n(t.x + t.width + Math.abs(c.y), t.y + Math.abs(c.x)),
                        f = n(t.x - Math.abs(c.y), t.y + t.height - Math.abs(c.x));
                    return { width: i(l, h), height: i(l, f) };
                })(e, r);
            return Math.max(f.width / l, f.height / h);
        },
        u = function (t, e) {
            var n = t.width,
                r = n * e;
            return r > t.height && (n = (r = t.height) / e), { x: 0.5 * (t.width - n), y: 0.5 * (t.height - r), width: n, height: r };
        },
        c = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1,
                r = t.height / t.width,
                i = e,
                a = 1,
                o = r;
            o > i && (a = (o = i) / r);
            var u = Math.max(1 / a, i / o),
                c = t.width / (n * u * a);
            return { width: c, height: c * e };
        },
        l = function (t) {
            (t.width = 1), (t.height = 1), t.getContext("2d").clearRect(0, 0, 1, 1);
        },
        h = function (t) {
            return t && (t.horizontal || t.vertical);
        },
        f = function (t, n, r) {
            if (n <= 1 && !h(r)) return (t.width = t.naturalWidth), (t.height = t.naturalHeight), t;
            var i = document.createElement("canvas"),
                a = t.naturalWidth,
                o = t.naturalHeight,
                u = n >= 5 && n <= 8;
            u ? ((i.width = o), (i.height = a)) : ((i.width = a), (i.height = o));
            var c = i.getContext("2d");
            if (
                (n &&
                    c.transform.apply(
                        c,
                        (function (t, n, r) {
                            return -1 === r && (r = 1), e[r](t, n);
                        })(a, o, n)
                    ),
                h(r))
            ) {
                var l = [1, 0, 0, 1, 0, 0];
                ((!u && r.horizontal) || u & r.vertical) && ((l[0] = -1), (l[4] = a)),
                    ((!u && r.vertical) || (u && r.horizontal)) && ((l[3] = -1), (l[5] = o)),
                    c.transform.apply(c, l);
            }
            return c.drawImage(t, 0, 0, a, o), i;
        };
    "undefined" != typeof window &&
        void 0 !== window.document &&
        (HTMLCanvasElement.prototype.toBlob ||
            Object.defineProperty(HTMLCanvasElement.prototype, "toBlob", {
                value: function (t, e, n) {
                    var r = this.toDataURL(e, n).split(",")[1];
                    setTimeout(function () {
                        for (var n = atob(r), i = n.length, a = new Uint8Array(i), o = 0; o < i; o++) a[o] = n.charCodeAt(o);
                        t(new Blob([a], { type: e || "image/png" }));
                    });
                },
            }));
    var s = function (t, e) {
            return y(t.x * e, t.y * e);
        },
        d = function (t, e) {
            return y(t.x + e.x, t.y + e.y);
        },
        g = function (t) {
            var e = Math.sqrt(t.x * t.x + t.y * t.y);
            return 0 === e ? { x: 0, y: 0 } : y(t.x / e, t.y / e);
        },
        v = function (t, e, n) {
            var r = Math.cos(e),
                i = Math.sin(e),
                a = y(t.x - n.x, t.y - n.y);
            return y(n.x + r * a.x - i * a.y, n.y + i * a.x + r * a.y);
        },
        y = function () {
            return { x: arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0, y: arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0 };
        },
        m = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1,
                r = arguments.length > 3 ? arguments[3] : void 0;
            return "string" == typeof t ? parseFloat(t) * n : "number" == typeof t ? t * (r ? e[r] : Math.min(e.width, e.height)) : void 0;
        },
        p = function (t, e, n) {
            var r = t.borderStyle || t.lineStyle || "solid",
                i = t.backgroundColor || t.fontColor || "transparent",
                a = t.borderColor || t.lineColor || "transparent",
                o = m(t.borderWidth || t.lineWidth, e, n);
            return {
                "stroke-linecap": t.lineCap || "round",
                "stroke-linejoin": t.lineJoin || "round",
                "stroke-width": o || 0,
                "stroke-dasharray":
                    "string" == typeof r
                        ? ""
                        : r
                              .map(function (t) {
                                  return m(t, e, n);
                              })
                              .join(","),
                stroke: a,
                fill: i,
                opacity: t.opacity || 1,
            };
        },
        w = function (t) {
            return null != t;
        },
        x = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1,
                r = m(t.x, e, n, "width") || m(t.left, e, n, "width"),
                i = m(t.y, e, n, "height") || m(t.top, e, n, "height"),
                a = m(t.width, e, n, "width"),
                o = m(t.height, e, n, "height"),
                u = m(t.right, e, n, "width"),
                c = m(t.bottom, e, n, "height");
            return (
                w(i) || (i = w(o) && w(c) ? e.height - o - c : c),
                w(r) || (r = w(a) && w(u) ? e.width - a - u : u),
                w(a) || (a = w(r) && w(u) ? e.width - r - u : 0),
                w(o) || (o = w(i) && w(c) ? e.height - i - c : 0),
                { x: r || 0, y: i || 0, width: a || 0, height: o || 0 }
            );
        },
        M = function (t, e) {
            return Object.keys(e).forEach(function (n) {
                return t.setAttribute(n, e[n]);
            });
        },
        T = function (t, e) {
            var n = document.createElementNS("http://www.w3.org/2000/svg", t);
            return e && M(n, e), n;
        },
        b = { contain: "xMidYMid meet", cover: "xMidYMid slice" },
        A = { left: "start", center: "middle", right: "end" },
        R = function (t) {
            return function (e) {
                return T(t, { id: e.id });
            };
        },
        E = {
            image: function (t) {
                var e = T("image", { id: t.id, "stroke-linecap": "round", "stroke-linejoin": "round", opacity: "0" });
                return (
                    (e.onload = function () {
                        e.setAttribute("opacity", t.opacity || 1);
                    }),
                    e.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", t.src),
                    e
                );
            },
            rect: R("rect"),
            ellipse: R("ellipse"),
            text: R("text"),
            path: R("path"),
            line: function (t) {
                var e = T("g", { id: t.id, "stroke-linecap": "round", "stroke-linejoin": "round" }),
                    n = T("line");
                e.appendChild(n);
                var r = T("path");
                e.appendChild(r);
                var i = T("path");
                return e.appendChild(i), e;
            },
        },
        _ = {
            rect: function (t) {
                return M(t, Object.assign({}, t.rect, t.styles));
            },
            ellipse: function (t) {
                var e = t.rect.x + 0.5 * t.rect.width,
                    n = t.rect.y + 0.5 * t.rect.height,
                    r = 0.5 * t.rect.width,
                    i = 0.5 * t.rect.height;
                return M(t, Object.assign({ cx: e, cy: n, rx: r, ry: i }, t.styles));
            },
            image: function (t, e) {
                M(t, Object.assign({}, t.rect, t.styles, { preserveAspectRatio: b[e.fit] || "none" }));
            },
            text: function (t, e, n, r) {
                var i = m(e.fontSize, n, r),
                    a = e.fontFamily || "sans-serif",
                    o = e.fontWeight || "normal",
                    u = A[e.textAlign] || "start";
                M(t, Object.assign({}, t.rect, t.styles, { "stroke-width": 0, "font-weight": o, "font-size": i, "font-family": a, "text-anchor": u })),
                    t.text !== e.text && ((t.text = e.text), (t.textContent = e.text.length ? e.text : " "));
            },
            path: function (t, e, n, r) {
                var i;
                M(
                    t,
                    Object.assign({}, t.styles, {
                        fill: "none",
                        d:
                            ((i = e.points.map(function (t) {
                                return { x: m(t.x, n, r, "width"), y: m(t.y, n, r, "height") };
                            })),
                            i
                                .map(function (t, e) {
                                    return ""
                                        .concat(0 === e ? "M" : "L", " ")
                                        .concat(t.x, " ")
                                        .concat(t.y);
                                })
                                .join(" ")),
                    })
                );
            },
            line: function (t, e, n, r) {
                M(t, Object.assign({}, t.rect, t.styles, { fill: "none" }));
                var i = t.childNodes[0],
                    a = t.childNodes[1],
                    o = t.childNodes[2],
                    u = t.rect,
                    c = { x: t.rect.x + t.rect.width, y: t.rect.y + t.rect.height };
                if ((M(i, { x1: u.x, y1: u.y, x2: c.x, y2: c.y }), e.lineDecoration)) {
                    (a.style.display = "none"), (o.style.display = "none");
                    var l = g({ x: c.x - u.x, y: c.y - u.y }),
                        h = m(0.05, n, r);
                    if (-1 !== e.lineDecoration.indexOf("arrow-begin")) {
                        var f = s(l, h),
                            y = d(u, f),
                            p = v(u, 2, y),
                            w = v(u, -2, y);
                        M(a, { style: "display:block;", d: "M".concat(p.x, ",").concat(p.y, " L").concat(u.x, ",").concat(u.y, " L").concat(w.x, ",").concat(w.y) });
                    }
                    if (-1 !== e.lineDecoration.indexOf("arrow-end")) {
                        var x = s(l, -h),
                            T = d(c, x),
                            b = v(c, 2, T),
                            A = v(c, -2, T);
                        M(o, { style: "display:block;", d: "M".concat(b.x, ",").concat(b.y, " L").concat(c.x, ",").concat(c.y, " L").concat(A.x, ",").concat(A.y) });
                    }
                }
            },
        },
        O = function (t, e) {
            return t[1].zIndex > e[1].zIndex ? 1 : t[1].zIndex < e[1].zIndex ? -1 : 0;
        },
        I = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                n = arguments.length > 2 ? arguments[2] : void 0,
                r = arguments.length > 3 ? arguments[3] : void 0;
            return new Promise(function (i) {
                var a = r.background,
                    c = void 0 === a ? null : a,
                    l = new FileReader();
                (l.onloadend = function () {
                    var t = l.result,
                        r = document.createElement("div");
                    (r.style.cssText = "position:absolute;pointer-events:none;width:0;height:0;visibility:hidden;"), (r.innerHTML = t);
                    var a = r.querySelector("svg");
                    document.body.appendChild(r);
                    var h = a.getBBox();
                    r.parentNode.removeChild(r);
                    var f = r.querySelector("title"),
                        s = a.getAttribute("viewBox") || "",
                        d = a.getAttribute("width") || "",
                        g = a.getAttribute("height") || "",
                        v = parseFloat(d) || null,
                        y = parseFloat(g) || null,
                        m = (d.match(/[a-z]+/) || [])[0] || "",
                        w = (g.match(/[a-z]+/) || [])[0] || "",
                        M = s.split(" ").map(parseFloat),
                        T = M.length ? { x: M[0], y: M[1], width: M[2], height: M[3] } : h,
                        b = null != v ? v : T.width,
                        A = null != y ? y : T.height;
                    (a.style.overflow = "visible"), a.setAttribute("width", b), a.setAttribute("height", A);
                    var R = "";
                    if (n && n.length) {
                        var I = { width: b, height: A };
                        (R = n.sort(O).reduce(function (t, e) {
                            var n,
                                r,
                                i = ((n = e[0]), (r = e[1]), E[n](r));
                            return (
                                (function (t, e, n, r, i) {
                                    "path" !== e && (t.rect = x(n, r, i)), (t.styles = p(n, r, i)), _[e](t, n, r, i);
                                })(i, e[0], e[1], I),
                                i.removeAttribute("id"),
                                1 === i.getAttribute("opacity") && i.removeAttribute("opacity"),
                                t + "\n" + i.outerHTML + "\n"
                            );
                        }, "")),
                            (R = "\n\n<g>".concat(R.replace(/&nbsp;/g, " "), "</g>\n\n"));
                    }
                    var N = e.aspectRatio || A / b,
                        L = b,
                        S = L * N,
                        C = void 0 === e.scaleToFit || e.scaleToFit,
                        U = e.center ? e.center.x : 0.5,
                        k = e.center ? e.center.y : 0.5,
                        P = o({ width: b, height: A }, u({ width: L, height: S }, N), e.rotation, C ? { x: U, y: k } : { x: 0.5, y: 0.5 }),
                        F = e.zoom * P,
                        B = e.rotation * (180 / Math.PI),
                        G = { x: 0.5 * L, y: 0.5 * S },
                        j = { x: G.x - b * U, y: G.y - A * k },
                        z = [
                            "rotate(".concat(B, " ").concat(G.x, " ").concat(G.y, ")"),
                            "translate(".concat(G.x, " ").concat(G.y, ")"),
                            "scale(".concat(F, ")"),
                            "translate(".concat(-G.x, " ").concat(-G.y, ")"),
                            "translate(".concat(j.x, " ").concat(j.y, ")"),
                        ],
                        D = e.flip && e.flip.horizontal,
                        q = e.flip && e.flip.vertical,
                        H = ["scale(".concat(D ? -1 : 1, " ").concat(q ? -1 : 1, ")"), "translate(".concat(D ? -b : 0, " ").concat(q ? -A : 0, ")")],
                        V = '<?xml version="1.0" encoding="UTF-8"?>\n<svg width="'
                            .concat(L)
                            .concat(m, '" height="')
                            .concat(S)
                            .concat(w, '" \nviewBox="0 0 ')
                            .concat(L, " ")
                            .concat(S, '" ')
                            .concat(
                                c ? 'style="background:' + c + '" ' : "",
                                '\npreserveAspectRatio="xMinYMin"\nxmlns:xlink="http://www.w3.org/1999/xlink"\nxmlns="http://www.w3.org/2000/svg">\n\x3c!-- Generated by PQINA - https://pqina.nl/ --\x3e\n<title>'
                            )
                            .concat(f ? f.textContent : "", '</title>\n<g transform="')
                            .concat(z.join(" "), '">\n<g transform="')
                            .concat(H.join(" "), '">\n')
                            .concat(a.outerHTML)
                            .concat(R, "\n</g>\n</g>\n</svg>");
                    i(V);
                }),
                    l.readAsText(t);
            });
        },
        N = function () {
            var t = {
                    resize: function (t, e) {
                        var n = e.mode,
                            r = void 0 === n ? "contain" : n,
                            i = e.upscale,
                            o = void 0 !== i && i,
                            l = e.width,
                            h = e.height,
                            f = e.matrix;
                        if (((f = !f || u(f) ? null : f), !l && !h)) return c(t, f);
                        null === l ? (l = h) : null === h && (h = l);
                        if ("force" !== r) {
                            var s = l / t.width,
                                d = h / t.height,
                                g = 1;
                            if (("cover" === r ? (g = Math.max(s, d)) : "contain" === r && (g = Math.min(s, d)), g > 1 && !1 === o)) return c(t, f);
                            (l = t.width * g), (h = t.height * g);
                        }
                        for (
                            var v = t.width,
                                y = t.height,
                                m = Math.round(l),
                                p = Math.round(h),
                                w = t.data,
                                x = new Uint8ClampedArray(m * p * 4),
                                M = v / m,
                                T = y / p,
                                b = Math.ceil(0.5 * M),
                                A = Math.ceil(0.5 * T),
                                R = 0;
                            R < p;
                            R++
                        )
                            for (var E = 0; E < m; E++) {
                                for (var _ = 4 * (E + R * m), O = 0, I = 0, N = 0, L = 0, S = 0, C = 0, U = 0, k = (R + 0.5) * T, P = Math.floor(R * T); P < (R + 1) * T; P++)
                                    for (var F = Math.abs(k - (P + 0.5)) / A, B = (E + 0.5) * M, G = F * F, j = Math.floor(E * M); j < (E + 1) * M; j++) {
                                        var z = Math.abs(B - (j + 0.5)) / b,
                                            D = Math.sqrt(G + z * z);
                                        if (D >= -1 && D <= 1 && (O = 2 * D * D * D - 3 * D * D + 1) > 0) {
                                            var q = w[(z = 4 * (j + P * v)) + 3];
                                            (U += O * q), (N += O), q < 255 && (O = (O * q) / 250), (L += O * w[z]), (S += O * w[z + 1]), (C += O * w[z + 2]), (I += O);
                                        }
                                    }
                                (x[_] = L / I), (x[_ + 1] = S / I), (x[_ + 2] = C / I), (x[_ + 3] = U / N), f && a(_, x, f);
                            }
                        return { data: x, width: m, height: p };
                    },
                    filter: c,
                },
                e = function (e, n) {
                    var r = e.transforms,
                        i = null;
                    if (
                        (r.forEach(function (t) {
                            "filter" === t.type && (i = t);
                        }),
                        i)
                    ) {
                        var a = null;
                        r.forEach(function (t) {
                            "resize" === t.type && (a = t);
                        }),
                            a &&
                                ((a.data.matrix = i.data),
                                (r = r.filter(function (t) {
                                    return "filter" !== t.type;
                                })));
                    }
                    n(
                        (function (e, n) {
                            return (
                                e.forEach(function (e) {
                                    n = t[e.type](n, e.data);
                                }),
                                n
                            );
                        })(r, e.imageData)
                    );
                };
            self.onmessage = function (t) {
                e(t.data.message, function (e) {
                    self.postMessage({ id: t.data.id, message: e }, [e.data.buffer]);
                });
            };
            var n = 1,
                r = 1,
                i = 1;
            function a(t, e, a) {
                var o = e[t] / 255,
                    u = e[t + 1] / 255,
                    c = e[t + 2] / 255,
                    l = e[t + 3] / 255,
                    h = o * a[0] + u * a[1] + c * a[2] + l * a[3] + a[4],
                    f = o * a[5] + u * a[6] + c * a[7] + l * a[8] + a[9],
                    s = o * a[10] + u * a[11] + c * a[12] + l * a[13] + a[14],
                    d = o * a[15] + u * a[16] + c * a[17] + l * a[18] + a[19],
                    g = Math.max(0, h * d) + n * (1 - d),
                    v = Math.max(0, f * d) + r * (1 - d),
                    y = Math.max(0, s * d) + i * (1 - d);
                (e[t] = 255 * Math.max(0, Math.min(1, g))), (e[t + 1] = 255 * Math.max(0, Math.min(1, v))), (e[t + 2] = 255 * Math.max(0, Math.min(1, y)));
            }
            var o = self.JSON.stringify([1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0]);
            function u(t) {
                return self.JSON.stringify(t || []) === o;
            }
            function c(t, e) {
                if (!e || u(e)) return t;
                for (
                    var a = t.data,
                        o = a.length,
                        c = e[0],
                        l = e[1],
                        h = e[2],
                        f = e[3],
                        s = e[4],
                        d = e[5],
                        g = e[6],
                        v = e[7],
                        y = e[8],
                        m = e[9],
                        p = e[10],
                        w = e[11],
                        x = e[12],
                        M = e[13],
                        T = e[14],
                        b = e[15],
                        A = e[16],
                        R = e[17],
                        E = e[18],
                        _ = e[19],
                        O = 0,
                        I = 0,
                        N = 0,
                        L = 0,
                        S = 0,
                        C = 0,
                        U = 0,
                        k = 0,
                        P = 0,
                        F = 0,
                        B = 0,
                        G = 0;
                    O < o;
                    O += 4
                )
                    (C = (I = a[O] / 255) * c + (N = a[O + 1] / 255) * l + (L = a[O + 2] / 255) * h + (S = a[O + 3] / 255) * f + s),
                        (U = I * d + N * g + L * v + S * y + m),
                        (k = I * p + N * w + L * x + S * M + T),
                        (P = I * b + N * A + L * R + S * E + _),
                        (F = Math.max(0, C * P) + n * (1 - P)),
                        (B = Math.max(0, U * P) + r * (1 - P)),
                        (G = Math.max(0, k * P) + i * (1 - P)),
                        (a[O] = 255 * Math.max(0, Math.min(1, F))),
                        (a[O + 1] = 255 * Math.max(0, Math.min(1, B))),
                        (a[O + 2] = 255 * Math.max(0, Math.min(1, G)));
                return t;
            }
        },
        L = function (t, e) {
            if (1165519206 === t.getUint32(e + 4, !1)) {
                e += 4;
                var n = 18761 === t.getUint16((e += 6), !1);
                e += t.getUint32(e + 4, n);
                var r = t.getUint16(e, n);
                e += 2;
                for (var i = 0; i < r; i++) if (274 === t.getUint16(e + 12 * i, n)) return t.setUint16(e + 12 * i + 8, 1, n), !0;
                return !1;
            }
        },
        S = function (t) {
            return new Promise(function (e) {
                var n = new FileReader();
                (n.onload = function () {
                    return e(
                        (function (t) {
                            var e = new DataView(t);
                            if (65496 !== e.getUint16(0)) return null;
                            for (
                                var n, r, i = 2, a = !1;
                                i < e.byteLength &&
                                ((n = e.getUint16(i, !1)), (r = e.getUint16(i + 2, !1) + 2), (n >= 65504 && n <= 65519) || 65534 === n) &&
                                (a || (a = L(e, i)), !(i + r > e.byteLength));

                            )
                                i += r;
                            return t.slice(0, i);
                        })(n.result) || null
                    );
                }),
                    n.readAsArrayBuffer(t.slice(0, 262144));
            });
        },
        C = function (t, e) {
            var n = (window.BlobBuilder = window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder || window.MSBlobBuilder);
            if (n) {
                var r = new n();
                return r.append(t), r.getBlob(e);
            }
            return new Blob([t], { type: e });
        },
        U = function (t) {
            var e = new Blob(["(", t.toString(), ")()"], { type: "application/javascript" }),
                n = URL.createObjectURL(e),
                r = new Worker(n),
                i = [];
            return {
                transfer: function () {},
                post: function (t, e, n) {
                    var a = Math.random().toString(36).substr(2, 9);
                    (i[a] = e),
                        (r.onmessage = function (t) {
                            var e = i[t.data.id];
                            e && (e(t.data.message), delete i[t.data.id]);
                        }),
                        r.postMessage({ id: a, message: t }, n);
                },
                terminate: function () {
                    r.terminate(), URL.revokeObjectURL(n);
                },
            };
        },
        k = function (t, e) {
            return new Promise(function (n) {
                var r,
                    i = { width: t.width, height: t.height },
                    a = t.getContext("2d"),
                    o = e.sort(O).map(function (t) {
                        return function () {
                            return new Promise(function (e) {
                                B[t[0]](a, i, t[1], e) && e();
                            });
                        };
                    });
                ((r = o),
                r.reduce(function (t, e) {
                    return t.then(function (t) {
                        return e().then(Array.prototype.concat.bind(t));
                    });
                }, Promise.resolve([]))).then(function () {
                    return n(t);
                });
            });
        },
        P = function (t, e) {
            t.beginPath(),
                (t.lineCap = e["stroke-linecap"]),
                (t.lineJoin = e["stroke-linejoin"]),
                (t.lineWidth = e["stroke-width"]),
                e["stroke-dasharray"].length && t.setLineDash(e["stroke-dasharray"].split(",")),
                (t.fillStyle = e.fill),
                (t.strokeStyle = e.stroke),
                (t.globalAlpha = e.opacity || 1);
        },
        F = function (t) {
            t.fill(), t.stroke(), (t.globalAlpha = 1);
        },
        B = {
            rect: function (t, e, n) {
                var r = x(n, e),
                    i = p(n, e);
                return P(t, i), t.rect(r.x, r.y, r.width, r.height), F(t), !0;
            },
            ellipse: function (t, e, n) {
                var r = x(n, e),
                    i = p(n, e);
                P(t, i);
                var a = r.x,
                    o = r.y,
                    u = r.width,
                    c = r.height,
                    l = (u / 2) * 0.5522848,
                    h = (c / 2) * 0.5522848,
                    f = a + u,
                    s = o + c,
                    d = a + u / 2,
                    g = o + c / 2;
                return (
                    t.moveTo(a, g),
                    t.bezierCurveTo(a, g - h, d - l, o, d, o),
                    t.bezierCurveTo(d + l, o, f, g - h, f, g),
                    t.bezierCurveTo(f, g + h, d + l, s, d, s),
                    t.bezierCurveTo(d - l, s, a, g + h, a, g),
                    F(t),
                    !0
                );
            },
            image: function (t, e, n, r) {
                var i = x(n, e),
                    a = p(n, e);
                P(t, a);
                var o = new Image();
                new URL(n.src, window.location.href).origin !== window.location.origin && (o.crossOrigin = ""),
                    (o.onload = function () {
                        if ("cover" === n.fit) {
                            var e = i.width / i.height,
                                a = e > 1 ? o.width : o.height * e,
                                u = e > 1 ? o.width / e : o.height,
                                c = 0.5 * o.width - 0.5 * a,
                                l = 0.5 * o.height - 0.5 * u;
                            t.drawImage(o, c, l, a, u, i.x, i.y, i.width, i.height);
                        } else if ("contain" === n.fit) {
                            var h = Math.min(i.width / o.width, i.height / o.height),
                                f = h * o.width,
                                s = h * o.height,
                                d = i.x + 0.5 * i.width - 0.5 * f,
                                g = i.y + 0.5 * i.height - 0.5 * s;
                            t.drawImage(o, 0, 0, o.width, o.height, d, g, f, s);
                        } else t.drawImage(o, 0, 0, o.width, o.height, i.x, i.y, i.width, i.height);
                        F(t), r();
                    }),
                    (o.src = n.src);
            },
            text: function (t, e, n) {
                var r = x(n, e),
                    i = p(n, e);
                P(t, i);
                var a = m(n.fontSize, e),
                    o = n.fontFamily || "sans-serif",
                    u = n.fontWeight || "normal",
                    c = n.textAlign || "left";
                return (t.font = "".concat(u, " ").concat(a, "px ").concat(o)), (t.textAlign = c), t.fillText(n.text, r.x, r.y), F(t), !0;
            },
            line: function (t, e, n) {
                var r = x(n, e),
                    i = p(n, e);
                P(t, i), t.beginPath();
                var a = { x: r.x, y: r.y },
                    o = { x: r.x + r.width, y: r.y + r.height };
                t.moveTo(a.x, a.y), t.lineTo(o.x, o.y);
                var u = g({ x: o.x - a.x, y: o.y - a.y }),
                    c = 0.04 * Math.min(e.width, e.height);
                if (-1 !== n.lineDecoration.indexOf("arrow-begin")) {
                    var l = s(u, c),
                        h = d(a, l),
                        f = v(a, 2, h),
                        y = v(a, -2, h);
                    t.moveTo(f.x, f.y), t.lineTo(a.x, a.y), t.lineTo(y.x, y.y);
                }
                if (-1 !== n.lineDecoration.indexOf("arrow-end")) {
                    var m = s(u, -c),
                        w = d(o, m),
                        M = v(o, 2, w),
                        T = v(o, -2, w);
                    t.moveTo(M.x, M.y), t.lineTo(o.x, o.y), t.lineTo(T.x, T.y);
                }
                return F(t), !0;
            },
            path: function (t, e, n) {
                var r = p(n, e);
                P(t, r), t.beginPath();
                var i = n.points.map(function (t) {
                    return { x: m(t.x, e, 1, "width"), y: m(t.y, e, 1, "height") };
                });
                t.moveTo(i[0].x, i[0].y);
                for (var a = i.length, o = 1; o < a; o++) t.lineTo(i[o].x, i[o].y);
                return F(t), !0;
            },
        },
        G = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            return new Promise(function (r, i) {
                if (
                    !t ||
                    !(function (t) {
                        return /^image/.test(t.type);
                    })(t)
                )
                    return i({ status: "not an image file", file: t });
                var a = n.stripImageHead,
                    h = n.beforeCreateBlob,
                    s = n.afterCreateBlob,
                    d = n.canvasMemoryLimit,
                    g = e.crop,
                    v = e.size,
                    y = e.filter,
                    m = e.markup,
                    p = e.output,
                    w = e.image && e.image.orientation ? Math.max(1, Math.min(8, e.image.orientation)) : null,
                    x = p && p.quality,
                    M = null === x ? null : x / 100,
                    T = (p && p.type) || null,
                    b = (p && p.background) || null,
                    A = [];
                !v || ("number" != typeof v.width && "number" != typeof v.height) || A.push({ type: "resize", data: v }),
                    y && 20 === y.length && A.push({ type: "filter", data: y });
                var R = function (t) {
                        var e = s ? s(t) : t;
                        Promise.resolve(e).then(r);
                    },
                    E = function (e, n) {
                        var r = (function (t) {
                                var e = document.createElement("canvas");
                                return (e.width = t.width), (e.height = t.height), e.getContext("2d").putImageData(t, 0, 0), e;
                            })(e),
                            o = m.length ? k(r, m) : r;
                        Promise.resolve(o).then(function (e) {
                            (function (t, e) {
                                var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
                                return new Promise(function (r) {
                                    var i = n ? n(t) : t;
                                    Promise.resolve(i).then(function (t) {
                                        t.toBlob(r, e.type, e.quality);
                                    });
                                });
                            })(e, n, h)
                                .then(function (n) {
                                    if ((l(e), a)) return R(n);
                                    S(t).then(function (t) {
                                        null !== t && (n = new Blob([t, n.slice(20)], { type: n.type })), R(n);
                                    });
                                })
                                .catch(i);
                        });
                    };
                if (/svg/.test(t.type) && null === T)
                    return I(t, g, m, { background: b }).then(function (t) {
                        r(C(t, "image/svg+xml"));
                    });
                var _ = URL.createObjectURL(t);
                (function (t) {
                    return new Promise(function (e, n) {
                        var r = new Image();
                        (r.onload = function () {
                            e(r);
                        }),
                            (r.onerror = function (t) {
                                n(t);
                            }),
                            (r.src = t);
                    });
                })(_)
                    .then(function (e) {
                        URL.revokeObjectURL(_);
                        var n = (function (t, e) {
                                var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {},
                                    r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {},
                                    i = r.canvasMemoryLimit,
                                    a = r.background,
                                    h = void 0 === a ? null : a,
                                    s = n.zoom || 1,
                                    d = f(t, e, n.flip),
                                    g = { width: d.width, height: d.height },
                                    v = n.aspectRatio || g.height / g.width,
                                    y = c(g, v, s);
                                if (i) {
                                    var m = y.width * y.height;
                                    if (m > i) {
                                        var p = Math.sqrt(i) / Math.sqrt(m);
                                        (g.width = Math.floor(g.width * p)), (g.height = Math.floor(g.height * p)), (y = c(g, v, s));
                                    }
                                }
                                var w = document.createElement("canvas"),
                                    x = { x: 0.5 * y.width, y: 0.5 * y.height },
                                    M = { x: 0, y: 0, width: y.width, height: y.height, center: x },
                                    T = void 0 === n.scaleToFit || n.scaleToFit,
                                    b = s * o(g, u(M, v), n.rotation, T ? n.center : { x: 0.5, y: 0.5 });
                                (w.width = Math.round(y.width / b)), (w.height = Math.round(y.height / b)), (x.x /= b), (x.y /= b);
                                var A = x.x - g.width * (n.center ? n.center.x : 0.5),
                                    R = x.y - g.height * (n.center ? n.center.y : 0.5),
                                    E = w.getContext("2d");
                                h && ((E.fillStyle = h), E.fillRect(0, 0, w.width, w.height)),
                                    E.translate(x.x, x.y),
                                    E.rotate(n.rotation || 0),
                                    E.drawImage(d, A - x.x, R - x.y, g.width, g.height);
                                var _ = E.getImageData(0, 0, w.width, w.height);
                                return l(w), _;
                            })(e, w, g, { canvasMemoryLimit: d, background: b }),
                            r = { quality: M, type: T || t.type };
                        if (!A.length) return E(n, r);
                        var i = U(N);
                        i.post(
                            { transforms: A, imageData: n },
                            function (t) {
                                E(
                                    (function (t) {
                                        var e;
                                        try {
                                            e = new ImageData(t.width, t.height);
                                        } catch (n) {
                                            e = document.createElement("canvas").getContext("2d").createImageData(t.width, t.height);
                                        }
                                        return e.data.set(t.data), e;
                                    })(t),
                                    r
                                ),
                                    i.terminate();
                            },
                            [n.data.buffer]
                        );
                    })
                    .catch(i);
            });
        };
    function j(t) {
        this.wrapped = t;
    }
    function z(t) {
        var e, n;
        function r(e, n) {
            try {
                var a = t[e](n),
                    o = a.value,
                    u = o instanceof j;
                Promise.resolve(u ? o.wrapped : o).then(
                    function (t) {
                        u ? r("next", t) : i(a.done ? "return" : "normal", t);
                    },
                    function (t) {
                        r("throw", t);
                    }
                );
            } catch (t) {
                i("throw", t);
            }
        }
        function i(t, i) {
            switch (t) {
                case "return":
                    e.resolve({ value: i, done: !0 });
                    break;
                case "throw":
                    e.reject(i);
                    break;
                default:
                    e.resolve({ value: i, done: !1 });
            }
            (e = e.next) ? r(e.key, e.arg) : (n = null);
        }
        (this._invoke = function (t, i) {
            return new Promise(function (a, o) {
                var u = { key: t, arg: i, resolve: a, reject: o, next: null };
                n ? (n = n.next = u) : ((e = n = u), r(t, i));
            });
        }),
            "function" != typeof t.return && (this.return = void 0);
    }
    "function" == typeof Symbol &&
        Symbol.asyncIterator &&
        (z.prototype[Symbol.asyncIterator] = function () {
            return this;
        }),
        (z.prototype.next = function (t) {
            return this._invoke("next", t);
        }),
        (z.prototype.throw = function (t) {
            return this._invoke("throw", t);
        }),
        (z.prototype.return = function (t) {
            return this._invoke("return", t);
        });
    function D(t, e) {
        return (
            q(t) ||
            (function (t, e) {
                var n = [],
                    r = !0,
                    i = !1,
                    a = void 0;
                try {
                    for (var o, u = t[Symbol.iterator](); !(r = (o = u.next()).done) && (n.push(o.value), !e || n.length !== e); r = !0);
                } catch (t) {
                    (i = !0), (a = t);
                } finally {
                    try {
                        r || null == u.return || u.return();
                    } finally {
                        if (i) throw a;
                    }
                }
                return n;
            })(t, e) ||
            H()
        );
    }
    function q(t) {
        if (Array.isArray(t)) return t;
    }
    function H() {
        throw new TypeError("Invalid attempt to destructure non-iterable instance");
    }
    var V = ["x", "y", "left", "top", "right", "bottom", "width", "height"],
        W = function (t) {
            var e = D(t, 2),
                n = e[0],
                r = e[1],
                i = r.points
                    ? {}
                    : V.reduce(function (t, e) {
                          var n;
                          return (t[e] = "string" == typeof (n = r[e]) && /%/.test(n) ? parseFloat(n) / 100 : n), t;
                      }, {});
            return [n, Object.assign({ zIndex: 0 }, r, i)];
        };
    "undefined" != typeof window &&
        void 0 !== window.document &&
        (HTMLCanvasElement.prototype.toBlob ||
            Object.defineProperty(HTMLCanvasElement.prototype, "toBlob", {
                value: function (t, e, n) {
                    var r = this;
                    setTimeout(function () {
                        for (var i = r.toDataURL(e, n).split(",")[1], a = atob(i), o = a.length, u = new Uint8Array(o); o--; ) u[o] = a.charCodeAt(o);
                        t(new Blob([u], { type: e || "image/png" }));
                    });
                },
            }));
    var Y = "undefined" != typeof window && void 0 !== window.document,
        Q = Y && /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream,
        J = function (e) {
            var n = e.addFilter,
                r = e.utils,
                i = r.Type,
                a = r.forin,
                o = r.getFileFromBlob,
                u = r.isFile,
                c = ["crop", "resize", "filter", "markup", "output"],
                l = function (t) {
                    return (
                        null === t.aspectRatio &&
                        0 === t.rotation &&
                        1 === t.zoom &&
                        t.center &&
                        0.5 === t.center.x &&
                        0.5 === t.center.y &&
                        t.flip &&
                        !1 === t.flip.horizontal &&
                        !1 === t.flip.vertical
                    );
                };
            n("SHOULD_PREPARE_OUTPUT", function (t, e) {
                var n = e.query;
                return new Promise(function (t) {
                    t(!n("IS_ASYNC"));
                });
            });
            var h = function (t, e, n) {
                return new Promise(function (r) {
                    if (
                        !t("GET_ALLOW_IMAGE_TRANSFORM") ||
                        n.archived ||
                        !u(e) ||
                        !(function (t) {
                            return /^image/.test(t.type);
                        })(e)
                    )
                        return r(!1);
                    (function (t) {
                        return new Promise(function (e, n) {
                            var r = new Image();
                            r.src = URL.createObjectURL(t);
                            var i = function () {
                                var t = r.naturalWidth,
                                    n = r.naturalHeight;
                                t && n && (URL.revokeObjectURL(r.src), clearInterval(a), e({ width: t, height: n }));
                            };
                            r.onerror = function (t) {
                                URL.revokeObjectURL(r.src), clearInterval(a), n(t);
                            };
                            var a = setInterval(i, 1);
                            i();
                        });
                    })(e)
                        .then(function () {
                            var n = t("GET_IMAGE_TRANSFORM_IMAGE_FILTER");
                            if (n) {
                                var i = n(e);
                                if (null == i) return handleRevert(!0);
                                if ("boolean" == typeof i) return r(i);
                                if ("function" == typeof i.then) return i.then(r);
                            }
                            r(!0);
                        })
                        .catch(function (t) {
                            r(!1);
                        });
                });
            };
            return (
                n("DID_CREATE_ITEM", function (t, e) {
                    var n = e.query,
                        r = e.dispatch;
                    n("GET_ALLOW_IMAGE_TRANSFORM") &&
                        t.extend("requestPrepare", function () {
                            return new Promise(function (e, n) {
                                r("REQUEST_PREPARE_OUTPUT", { query: t.id, item: t, success: e, failure: n }, !0);
                            });
                        });
                }),
                n("PREPARE_OUTPUT", function (e, n) {
                    var r = n.query,
                        i = n.item;
                    return new Promise(function (n) {
                        h(r, e, i).then(function (u) {
                            if (!u) return n(e);
                            var h = [];
                            r("GET_IMAGE_TRANSFORM_VARIANTS_INCLUDE_ORIGINAL") &&
                                h.push(function () {
                                    return new Promise(function (t) {
                                        t({ name: r("GET_IMAGE_TRANSFORM_VARIANTS_ORIGINAL_NAME"), file: e });
                                    });
                                }),
                                r("GET_IMAGE_TRANSFORM_VARIANTS_INCLUDE_DEFAULT") &&
                                    h.push(function (t, e, n) {
                                        return new Promise(function (i) {
                                            t(e, n).then(function (t) {
                                                return i({ name: r("GET_IMAGE_TRANSFORM_VARIANTS_DEFAULT_NAME"), file: t });
                                            });
                                        });
                                    });
                            var f = r("GET_IMAGE_TRANSFORM_VARIANTS") || {};
                            a(f, function (t, e) {
                                var n,
                                    r =
                                        ((n = e),
                                        function (t, e, r) {
                                            return t(e, n ? n(r) : r);
                                        });
                                h.push(function (e, n, i) {
                                    return new Promise(function (a) {
                                        r(e, n, i).then(function (e) {
                                            return a({ name: t, file: e });
                                        });
                                    });
                                });
                            });
                            var s = r("GET_IMAGE_TRANSFORM_OUTPUT_QUALITY"),
                                d = r("GET_IMAGE_TRANSFORM_OUTPUT_QUALITY_MODE"),
                                g = null === s ? null : s / 100,
                                v = r("GET_IMAGE_TRANSFORM_OUTPUT_MIME_TYPE"),
                                y = r("GET_IMAGE_TRANSFORM_CLIENT_TRANSFORMS") || c;
                            i.setMetadata("output", { type: v, quality: g, client: y }, !0);
                            var m = function (e, n) {
                                    return new Promise(function (i, a) {
                                        var u = Object.assign({}, n);
                                        Object.keys(u)
                                            .filter(function (t) {
                                                return "exif" !== t;
                                            })
                                            .forEach(function (t) {
                                                -1 === y.indexOf(t) && delete u[t];
                                            });
                                        var c = u.resize,
                                            h = u.exif,
                                            f = u.output,
                                            s = u.crop,
                                            g = u.filter,
                                            v = u.markup,
                                            m = {
                                                image: { orientation: h ? h.orientation : null },
                                                output:
                                                    f && (f.type || "number" == typeof f.quality || f.background)
                                                        ? {
                                                              type: f.type,
                                                              quality: "number" == typeof f.quality ? 100 * f.quality : null,
                                                              background: f.background || r("GET_IMAGE_TRANSFORM_CANVAS_BACKGROUND_COLOR") || null,
                                                          }
                                                        : void 0,
                                                size: c && (c.size.width || c.size.height) ? Object.assign({ mode: c.mode, upscale: c.upscale }, c.size) : void 0,
                                                crop: s && !l(s) ? Object.assign({}, s) : void 0,
                                                markup: v && v.length ? v.map(W) : [],
                                                filter: g,
                                            };
                                        if (m.output) {
                                            var p = !!f.type && f.type !== e.type,
                                                w = /\/jpe?g$/.test(e.type),
                                                x = null !== f.quality && w && "always" === d;
                                            if (!!!(m.size || m.crop || m.filter || p || x)) return i(e);
                                        }
                                        var M = {
                                            beforeCreateBlob: r("GET_IMAGE_TRANSFORM_BEFORE_CREATE_BLOB"),
                                            afterCreateBlob: r("GET_IMAGE_TRANSFORM_AFTER_CREATE_BLOB"),
                                            canvasMemoryLimit: r("GET_IMAGE_TRANSFORM_CANVAS_MEMORY_LIMIT"),
                                            stripImageHead: r("GET_IMAGE_TRANSFORM_OUTPUT_STRIP_IMAGE_HEAD"),
                                        };
                                        G(e, m, M)
                                            .then(function (n) {
                                                var r,
                                                    a = o(
                                                        n,
                                                        (function (e, n) {
                                                            var r = (function (t) {
                                                                    return t.substr(0, t.lastIndexOf(".")) || t;
                                                                })(e),
                                                                i = n.split("/")[1],
                                                                a = t[i] || i;
                                                            return "".concat(r, ".").concat(a);
                                                        })(e.name, ((r = n.type), /jpeg|png|svg\+xml/.test(r) ? r : "image/jpeg"))
                                                    );
                                                i(a);
                                            })
                                            .catch(a);
                                    });
                                },
                                p = h.map(function (t) {
                                    return t(m, e, i.getMetadata());
                                });
                            Promise.all(p).then(function (t) {
                                n(1 === t.length && null === t[0].name ? t[0].file : t);
                            });
                        });
                    });
                }),
                {
                    options: {
                        allowImageTransform: [!0, i.BOOLEAN],
                        imageTransformImageFilter: [null, i.FUNCTION],
                        imageTransformOutputMimeType: [null, i.STRING],
                        imageTransformOutputQuality: [null, i.INT],
                        imageTransformOutputStripImageHead: [!0, i.BOOLEAN],
                        imageTransformClientTransforms: [null, i.ARRAY],
                        imageTransformOutputQualityMode: ["always", i.STRING],
                        imageTransformVariants: [null, i.OBJECT],
                        imageTransformVariantsIncludeDefault: [!0, i.BOOLEAN],
                        imageTransformVariantsDefaultName: [null, i.STRING],
                        imageTransformVariantsIncludeOriginal: [!1, i.BOOLEAN],
                        imageTransformVariantsOriginalName: ["original_", i.STRING],
                        imageTransformBeforeCreateBlob: [null, i.FUNCTION],
                        imageTransformAfterCreateBlob: [null, i.FUNCTION],
                        imageTransformCanvasMemoryLimit: [Y && Q ? 16777216 : null, i.INT],
                        imageTransformCanvasBackgroundColor: [null, i.STRING],
                    },
                }
            );
        };
    return Y && document.dispatchEvent(new CustomEvent("FilePond:pluginloaded", { detail: J })), J;
});
