/*!
 * FilePondPluginFileValidateSize 2.2.5
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

!(function (e, i) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = i())
        : "function" == typeof define && define.amd
        ? define(i)
        : ((e = e || self).FilePondPluginFileValidateSize = i());
})(this, function () {
    "use strict";
    var e = function (e) {
        var i = e.addFilter,
            E = e.utils,
            l = E.Type,
            _ = E.replaceInString,
            n = E.toNaturalFileSize;
        return (
            i("ALLOW_HOPPER_ITEM", function (e, i) {
                var E = i.query;
                if (!E("GET_ALLOW_FILE_SIZE_VALIDATION")) return !0;
                var l = E("GET_MAX_FILE_SIZE");
                if (null !== l && e.size >= l) return !1;
                var _ = E("GET_MIN_FILE_SIZE");
                return !(null !== _ && e.size <= _);
            }),
            i("LOAD_FILE", function (e, i) {
                var E = i.query;
                return new Promise(function (i, l) {
                    if (!E("GET_ALLOW_FILE_SIZE_VALIDATION")) return i(e);
                    var I = E("GET_FILE_VALIDATE_SIZE_FILTER");
                    if (I && !I(e)) return i(e);
                    var t = E("GET_MAX_FILE_SIZE");
                    if (null !== t && e.size >= t)
                        l({
                            status: {
                                main: E("GET_LABEL_MAX_FILE_SIZE_EXCEEDED"),
                                sub: _(E("GET_LABEL_MAX_FILE_SIZE"), { filesize: n(t, ".", E("GET_FILE_SIZE_BASE"), E("GET_FILE_SIZE_LABELS", E)) }),
                            },
                        });
                    else {
                        var L = E("GET_MIN_FILE_SIZE");
                        if (null !== L && e.size <= L)
                            l({
                                status: {
                                    main: E("GET_LABEL_MIN_FILE_SIZE_EXCEEDED"),
                                    sub: _(E("GET_LABEL_MIN_FILE_SIZE"), { filesize: n(L, ".", E("GET_FILE_SIZE_BASE"), E("GET_FILE_SIZE_LABELS", E)) }),
                                },
                            });
                        else {
                            var a = E("GET_MAX_TOTAL_FILE_SIZE");
                            if (null !== a)
                                if (
                                    E("GET_ACTIVE_ITEMS").reduce(function (e, i) {
                                        return e + i.fileSize;
                                    }, 0) > a
                                )
                                    return void l({
                                        status: {
                                            main: E("GET_LABEL_MAX_TOTAL_FILE_SIZE_EXCEEDED"),
                                            sub: _(E("GET_LABEL_MAX_TOTAL_FILE_SIZE"), { filesize: n(a, ".", E("GET_FILE_SIZE_BASE"), E("GET_FILE_SIZE_LABELS", E)) }),
                                        },
                                    });
                            i(e);
                        }
                    }
                });
            }),
            {
                options: {
                    allowFileSizeValidation: [!0, l.BOOLEAN],
                    maxFileSize: [null, l.INT],
                    minFileSize: [null, l.INT],
                    maxTotalFileSize: [null, l.INT],
                    fileValidateSizeFilter: [null, l.FUNCTION],
                    labelMinFileSizeExceeded: ["File is too small", l.STRING],
                    labelMinFileSize: ["Minimum file size is {filesize}", l.STRING],
                    labelMaxFileSizeExceeded: ["File is too large", l.STRING],
                    labelMaxFileSize: ["Maximum file size is {filesize}", l.STRING],
                    labelMaxTotalFileSizeExceeded: ["Maximum total size exceeded", l.STRING],
                    labelMaxTotalFileSize: ["Maximum total file size is {filesize}", l.STRING],
                },
            }
        );
    };
    return "undefined" != typeof window && void 0 !== window.document && document.dispatchEvent(new CustomEvent("FilePond:pluginloaded", { detail: e })), e;
});
