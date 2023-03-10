/*!
 * FilePondPluginImageCrop 2.0.6
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

!(function (t, e) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = e())
        : "function" == typeof define && define.amd
        ? define(e)
        : ((t = t || self).FilePondPluginImageCrop = e());
})(this, function () {
    "use strict";
    var t = function (t) {
            return /^image/.test(t.type);
        },
        e = function (e) {
            var n = e.addFilter,
                o = e.utils,
                r = o.Type,
                i = o.isFile,
                a = o.getNumericAspectRatioFromString,
                u = function (e, n) {
                    return !(!t(e.file) || !n("GET_ALLOW_IMAGE_CROP"));
                },
                c = function (t) {
                    return "object" == typeof t;
                },
                f = function (t) {
                    return "number" == typeof t;
                },
                p = function (t, e) {
                    return t.setMetadata("crop", Object.assign({}, t.getMetadata("crop"), e));
                };
            return (
                n("DID_CREATE_ITEM", function (t, e) {
                    var n = e.query;
                    t.extend("setImageCrop", function (e) {
                        if (u(t, n) && c(center)) return t.setMetadata("crop", e), e;
                    }),
                        t.extend("setImageCropCenter", function (e) {
                            if (u(t, n) && c(e)) return p(t, { center: e });
                        }),
                        t.extend("setImageCropZoom", function (e) {
                            if (u(t, n) && f(e)) return p(t, { zoom: Math.max(1, e) });
                        }),
                        t.extend("setImageCropRotation", function (e) {
                            if (u(t, n) && f(e)) return p(t, { rotation: e });
                        }),
                        t.extend("setImageCropFlip", function (e) {
                            if (u(t, n) && c(e)) return p(t, { flip: e });
                        }),
                        t.extend("setImageCropAspectRatio", function (e) {
                            if (u(t, n) && void 0 !== e) {
                                var o = t.getMetadata("crop"),
                                    r = a(e),
                                    i = {
                                        center: { x: 0.5, y: 0.5 },
                                        flip: o ? Object.assign({}, o.flip) : { horizontal: !1, vertical: !1 },
                                        rotation: 0,
                                        zoom: 1,
                                        aspectRatio: r,
                                    };
                                return t.setMetadata("crop", i), i;
                            }
                        });
                }),
                n("DID_LOAD_ITEM", function (e, n) {
                    var o = n.query;
                    return new Promise(function (n, r) {
                        var u = e.file;
                        if (!i(u) || !t(u) || !o("GET_ALLOW_IMAGE_CROP")) return n(e);
                        if (e.getMetadata("crop")) return n(e);
                        var c = o("GET_IMAGE_CROP_ASPECT_RATIO");
                        e.setMetadata("crop", { center: { x: 0.5, y: 0.5 }, flip: { horizontal: !1, vertical: !1 }, rotation: 0, zoom: 1, aspectRatio: c ? a(c) : null }), n(e);
                    });
                }),
                { options: { allowImageCrop: [!0, r.BOOLEAN], imageCropAspectRatio: [null, r.STRING] } }
            );
        };
    return "undefined" != typeof window && void 0 !== window.document && document.dispatchEvent(new CustomEvent("FilePond:pluginloaded", { detail: e })), e;
});
