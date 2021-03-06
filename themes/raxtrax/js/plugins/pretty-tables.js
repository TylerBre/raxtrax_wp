(function(b) {
    var c = {dataType: "csv",csvDelimiter: ",",dataSrc: "",sortBy: -1,sortDirection: "asc",pageSize: 0,pagerSize: 3,currentPage: 1,statusText: "Showing {1} to {2} of {3} rows.",sorting: true,loader: "ajax-loader.gif",enableZebra: true,caseSensitive: false,globalFilter: "",filter: {}}, a = {init: function(e) {
            var d = b.extend(c, e);
            return this.each(function() {
                var n = b(this), m = [], l = [], h, k = 0, g = 0;
                n.data("options", d);
                if (!b("#bdProgress").length) {
                    b("body").append(b("<img/>").attr({id: "bdProgress",src: d.loader}).css({position: "absolute","z-index": "9999",border: "solid 1px black"}).hide())
                }
                a.showLoader.apply(this);
                if (!n.data("tableData")) {
                    h = b("<table/>");
                    if (d.dataSrc) {
                        if (d.dataType.toLowerCase() == "csv") {
                            b.ajax({url: d.dataSrc,async: false,success: function(j) {
                                    var i = j.split("\n");
                                    l = i[0].split(d.csvDelimiter);
                                    for (k = 1; k < i.length; k++) {
                                        if (i[k]) {
                                            var p = i[k].split(d.csvDelimiter);
                                            m[k - 1] = {};
                                            for (g = 0; g < l.length; g++) {
                                                if (p[g]) {
                                                    m[k - 1][l[g]] = p[g]
                                                }
                                            }
                                        }
                                    }
                                }})
                        }
                        if (d.dataType.toLowerCase() == "json") {
                            b.ajax({url: d.dataSrc,async: false,success: function(j) {
                                    m = b.parseJSON(j);
                                    var i = [];
                                    for (k = 0; k < m.length; k++) {
                                        for (nm in m[k]) {
                                            if (typeof i[nm] == "undefined") {
                                                i[nm] = true;
                                                l.push(nm)
                                            }
                                        }
                                    }
                                }})
                        }
                    } else {
                        n.find("table tr").each(function() {
                            m[k - 1] = {};
                            g = 0;
                            b(this).find("td, th").each(function() {
                                if (k === 0) {
                                    l[g] = this.innerHTML
                                } else {
                                    m[k - 1][l[g]] = this.innerHTML
                                    
                                }
                                g++
                            });
                            k++
                        });
                        n.empty()
                    }
                    n.data("table-data", m).data("columns", l);
                    function o() {
                        if (document.selection && document.selection.empty) {
                            document.selection.empty()
                        } else {
                            if (window.getSelection) {
                                var i = window.getSelection();
                                i.removeAllRanges()
                            }
                        }
                    }
                    var f = b("<tr/>");
                    for (k = 0; k < l.length; k++) {
                        f.append(b("<th/>").text(l[k]).bind("click", {sortBy: k,sorting: d.sorting}, function(i) {
                            if (i.data.sorting) {
                                o();
                                n.beautify("sortCol", i.data.sortBy)
                            }
                        }).append(b("<div/>").addClass("bdSortNone")))
                    }
                    d.statusText = d.statusText;
                    h.find("thead").remove();
                    h.prepend(b("<thead/>").append(f)).append(b("<tbody/>"));
                    if (d.pageSize > 0) {
                        h.append(b("<tfoot/>").append(b("<tr/>").append(b("<td/>").attr("colSpan", l.length).append(b("<div/>").attr("id", "bdFooter").append(b("<div/>").attr("id", "bdStatus")).append(b("<div/>").attr("id", "bdPager"))))))
                    }
                    n.html(h);
                    if (d.sortBy > -1) {
                        n.beautify("sortCol", d.sortBy, d.sortDirection, false)
                    }
                    a.rebuild.apply(this)
                }
            })
        },sortCol: function(l, j, d) {
            a.showLoader.apply(this);
            var g = b(this).data("columns"), k = -1, f;
            if (typeof l == "number") {
                k = l;
                l = g[l]
            } else {
                for (var e = 0; e < g.length; e++) {
                    if (l == g[e]) {
                        k = e
                    }
                }
                if (k < 0) {
                    return 0
                }
            }
            function h(m, i) {
                var o = m[l].toLowerCase(), n = i[l].toLowerCase();
                if (parseFloat(o)) {
                    if (parseFloat(n)) {
                        return parseFloat(o) - parseFloat(n)
                    } else {
                        return -1
                    }
                } else {
                    if (parseFloat(n)) {
                        return 1
                    }
                }
                if (o < n) {
                    return -1
                }
                if (o > n) {
                    return 1
                }
                return 0
            }
            if (!j) {
                if (b(this).data("sortBy") == l) {
                    if (b(this).data("sortDirection") == "asc") {
                        j = "dsc"
                    } else {
                        j = "asc"
                    }
                } else {
                    j = "asc"
                }
            }
            b(this).data("table-data").sort(h);
            if (j == "dsc") {
                b(this).data("table-data").reverse()
            }
            b("thead th").each(function(i) {
                b(this).find("div").removeClass("bdSortAsc bdSortDsc").addClass("bdSortNone")
            });
            if (j.toLowerCase() == "dsc") {
                f = "bdSortDsc"
            } else {
                f = "bdSortAsc"
            }
            b(this).data("sortBy", l).data("sortDirection", j).find("table thead th:nth-child(" + (k + 1) + ")").find("div").removeClass("bdSortNone").addClass(f);
            if (d === true || d === undefined) {
                a.rebuild.apply(this)
            }
        },rebuild: function(k) {
            a.showLoader.apply(this);
            var q = b(this), p = b("<tbody/>"), e = q.data("table-data"), l = q.data("columns"), g = [], r = false, f = b("<ul/>"), o = 0, n = 0;
            var t = b.extend(q.data("options"), k);
            q.find("tbody").empty();
            if (t.globalFilter !== "") {
                r = true
            } else {
                for (o = 0; o < l.length; o++) {
                    if ((t.filter[l[o]]) || (t.filter[parseInt(o + 1, 10)])) {
                        r = true;
                        break
                    }
                }
            }
            function s(j, i) {
                if (!i || i === "") {
                    return false
                }
                if (t.caseSensitive) {
                    if (j.search(i) > -1) {
                        return true
                    } else {
                        return false
                    }
                }
                if (j.toLowerCase().search(i.toLowerCase()) > -1) {
                    return true
                } else {
                    return false
                }
            }
            for (o = 0; o < e.length; o++) {
                var d = false;
                if (r) {
                    for (n = 0; n < l.length && d === false; n++) {
                        if (s(e[o][l[n]], t.filter[l[n]]) || s(e[o][l[n]], t.filter[parseInt(n + 1, 10)]) || s(e[o][l[n]], t.globalFilter)) {
                            d = true;
                            break
                        }
                    }
                }
                if (d === true || r === false) {
                    g[g.length] = o
                }
            }
            for (o = (t.currentPage - 1) * t.pageSize, itemCount = 0; o < g.length && (itemCount < t.pageSize || t.pageSize === 0); o++, itemCount++) {
                p.append("<tr/>");
                for (n = 0; n < l.length; n++) {
                    p.find("tr:last").append(b("<td/>").text(e[g[o]][l[n]]))
                }
                if (itemCount % 2 && t.enableZebra) {
                    p.find("tr:last").addClass("zebra")
                }
            }
            q.find("table tbody").replaceWith(p);
            if (t.pageSize > 0) {
                var h = Math.ceil(g.length / t.pageSize);
                function m(u, v, i, j) {
                    var w = i * v;
                    if (w > j) {
                        w = j
                    }
                    return u.replace(/\{1\}/g, i * v - i + 1).replace(/\{2\}/g, w).replace(/\{3\}/g, j)
                }
                q.find("#bdStatus").text(m(t.statusText, t.currentPage, t.pageSize, g.length));
                if (t.pagerSize > 0) {
                    n = t.currentPage - Math.floor(t.pagerSize / 2) - 1;
                    if (n + Math.ceil(t.pagerSize / 2) * 2 > h) {
                        n = h - t.pagerSize
                    }
                    if (n < 0) {
                        n = 0
                    }
                    for (o = 0; o < t.pagerSize && o < h; o++, n++) {
                        f.append(b("<li/>").append(b("<a/>").attr("href", "javascript:void(0);").text(n + 1)).bind("click", {currentPage: n + 1}, function(i) {
                            q.beautify("rebuild", {currentPage: i.data.currentPage})
                        }));
                        if (n + 1 == t.currentPage) {
                            f.find("li:last").find("a").addClass("active")
                        }
                    }
                } else {
                    f.append(b("<li/>").text("Page " + t.currentPage))
                }
                f.prepend(b("<li/>").append(b("<a/>").attr("href", "javascript:void(0);").text("<")).bind("click", function() {
                    if (t.currentPage > 1) {
                        q.beautify("rebuild", {currentPage: t.currentPage - 1})
                    }
                })).append(b("<li/>").append(b("<a/>").attr("href", "javascript:void(0);").text(">")).bind("click", function() {
                    if (t.currentPage < h) {
                        q.beautify("rebuild", {currentPage: t.currentPage + 1})
                    }
                }));
                if (t.currentPage >= h) {
                    f.find("li:last").find("a").addClass("inactive")
                }
                if (t.currentPage <= 1) {
                    f.find("li:first").find("a").addClass("inactive")
                }
                q.find("#bdPager").html(f)
            }
            a.hideLoader.apply(this)
        },showLoader: function() {
            var e = b(window).height(), d = b(window).width();
            b("#bdProgress").css("top", e / 2 - b("#bdProgress").height() / 2 - 50);
            b("#bdProgress").css("left", d / 2 - b("#bdProgress").width() / 2 - 50);
            b("#bdProgress").show()
        },hideLoader: function() {
            b("#bdProgress").hide()
        }};
    b.fn.beautify = function(d) {
        if (a[d]) {
            return a[d].apply(this, Array.prototype.slice.call(arguments, 1))
        } else {
            if (typeof d === "object" || !d) {
                return a.init.apply(this, arguments)
            } else {
                b.error("Method " + d + " does not exist on jQuery.beautify")
            }
        }
    }
})(jQuery);
