function init_header() {
  $("ul#top-nav-list > li").hover(
          function() {
                  $(this).find("ul").css({
                        'display' : 'block',
                        'z-index' : '1000'
                  });
          },
          function() {
                  $("ul", this).css("display", "none");
          }
  );
}
