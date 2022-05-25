(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://secan.local',
            routes : [
    {
        "uri": "login",
        "name": "login"
    },
    {
        "uri": "logout",
        "name": "logout"
    },
    {
        "uri": "register",
        "name": "register"
    },
    {
        "uri": "password\/reset",
        "name": "password.request"
    },
    {
        "uri": "password\/email",
        "name": "password.email"
    },
    {
        "uri": "password\/reset\/{token}",
        "name": "password.reset"
    },
    {
        "uri": "password\/reset",
        "name": "password.update"
    },
    {
        "uri": "\/",
        "name": "frontHome"
    },
    {
        "uri": "tentang-secan",
        "name": "frontAbout"
    },
    {
        "uri": "artikel",
        "name": "frontNews"
    },
    {
        "uri": "artikel\/{slug}",
        "name": "frontNewsDetail"
    },
    {
        "uri": "video",
        "name": "frontVideo"
    },
    {
        "uri": "video\/{slug}",
        "name": "frontVideoDetail"
    },
    {
        "uri": "dokter",
        "name": "frontDoctor"
    },
    {
        "uri": "dokter\/artikel",
        "name": "frontDoctorArticle"
    },
    {
        "uri": "dokter\/video",
        "name": "frontDoctorVideo"
    },
    {
        "uri": "cms\/dashboard",
        "name": "dashboard"
    },
    {
        "uri": "cms\/banner",
        "name": "indexBanner"
    },
    {
        "uri": "cms\/banner\/data",
        "name": "dataBanner"
    },
    {
        "uri": "cms\/banner\/edit\/{id}",
        "name": "editBanner"
    },
    {
        "uri": "cms\/banner\/store",
        "name": "storeBanner"
    },
    {
        "uri": "cms\/banner\/delete",
        "name": "deleteBanner"
    },
    {
        "uri": "cms\/news",
        "name": "indexNews"
    },
    {
        "uri": "cms\/news\/data",
        "name": "dataNews"
    },
    {
        "uri": "cms\/news\/edit\/{id}",
        "name": "editNews"
    },
    {
        "uri": "cms\/news\/store",
        "name": "storeNews"
    },
    {
        "uri": "cms\/news\/delete",
        "name": "deleteNews"
    }
],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

