// custom JS here

$( document ).ready(function() {
    initSearchBox();
});

$(window).on('load', function(){
    searchBarWidth();
});

function initSearchBox(){
    var searchToggle = $('.search-toggle');
    if(searchToggle.length > 0 ) {
        searchToggle.on('click', function (event) {
            var form = $('.search-form');
            event.preventDefault();
            if (form.hasClass('active')) {
                form.removeClass('active');
                $('#q').focus();
                $('.search-toggle svg.svg-inline--fa.fa-search').removeClass('d-none');
                $('.search-toggle svg.svg-inline--fa.fa-times').addClass('d-none');

                setTimeout(function () {
                    $('header nav').css('overflow', 'visible');
                }, 400);
            } else {
                $('header nav').css('overflow', 'hidden');
                form.addClass('active');
                $('#q').blur();
                $('.search-toggle svg.svg-inline--fa.fa-times').removeClass('d-none');
                $('.search-toggle svg.svg-inline--fa.fa-search').addClass('d-none');
            }
        });
    }
}
function searchBarWidth(){
    var $window = $(window);


    var nav = $('.navbar-collapse');
    var navWidth = nav.outerWidth();
    var searchButton = nav.find('.search').outerWidth();
    var shoppingcart = nav.find('.shoppingcart').outerWidth();


    var searchbarWidth = (navWidth - searchButton - shoppingcart);

    $window.resize(function(){
        $('.search-form').removeAttr('style');
        if($('.search-form.active').length > 0 ) {
            $('.search-form.active').removeClass('active');
            $('.search-toggle svg.svg-inline--fa.fa-search').removeClass('d-none');
            $('.search-toggle svg.svg-inline--fa.fa-times').addClass('d-none');
        }

        navWidth = nav.outerWidth();
        searchButton = nav.find('.search').outerWidth();
        shoppingcart = nav.find('.shoppingcart').outerWidth();

        searchbarWidth = (navWidth - searchButton - shoppingcart);
    });

    $('.search-toggle').on('click', function (event) {
        var searchForm = $('.search-form.active');
        if (searchForm.length > 0) {

            var buttonWidth = searchForm.find('button').outerWidth();


            var inputWidth = searchbarWidth - buttonWidth;

            searchForm.find('input').css({
                'width': inputWidth + 'px'
            });

            searchForm.css({
                'width': searchbarWidth + 'px',
                'left': '-' + searchbarWidth + 'px'
            });
        } else {
            $('.search-form').removeAttr('style');
        }
        return true;
    });

}



var map;
var Markers = {};
var infowindow;


function initialize() {
    var origin = new google.maps.LatLng(locations[0]['lattitude'], locations[0]['longitude']);

    var mapOptions = {
        zoom: 8,
        center: origin
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    if(locations.length > 0) {
        infowindow = new google.maps.InfoWindow();
        var i = 0;
        for (i = 0; i < locations.length; i++) {
            var position = new google.maps.LatLng(locations[i]['lattitude'], locations[i]['longitude']);
            var marker = new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP,
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i]['content']);
                    infowindow.setOptions({maxWidth: 200});
                    infowindow.open(map, marker);
                }
            })(marker, i));
            Markers[locations[i]['id']] = marker;
        }
        locate(locations[0]['id']);
    }

}

function locate(marker_id) {
    var myMarker = Markers[marker_id];
    var markerPosition = myMarker.getPosition();
    map.setCenter(markerPosition);
    google.maps.event.trigger(myMarker, 'click');
}


if(typeof google != 'undefined' && typeof locations != 'undefined') {
    google.maps.event.addDomListener(window, 'load', initialize);
}