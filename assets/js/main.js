
(function( $ ) {

  $(function() {

    const Heading = ({title , subtitle, subtitle2}) => `
        <div class="lang-group-head">
          <h2 class="lang-title">${title}</h2>
          <div class="lang-subtitle">${subtitle}</div>
        </div>
        <div class="lang-subtitle-sticky">${subtitle2}</div>
   `;

   const Item = ({ icon, name, url }, index) => `
        <a href="${url}" class="lang-item ${ index > 5 ? 'lang-more-sticky' : ''}">
          <div class="image">
            <img src="${icon}" />
          </div>
          <p class="list-group-item-text">${name}</p>
        </a>
   `;

   const More = ({ url }) => `
        <a href="${url}" class="lang-item lang-more">
          <div class="icon-more">
            <span class="plus"></span>
            <span class="plus"></span>
          </div>
          <p class="list-group-item-text">More...</p>
        </a>
   `;

   var textArr = [
      {
        title : settings.genaral.fluentu_field_heading,
        subtitle : settings.genaral.fluentu_field_sub_heading,
        subtitle2 : settings.genaral.fluentu_field_text_sticky
      }
   ];

   let moreArr = [
     {
       url : settings.genaral.fluentu_field_link_more
     }
   ];

   let width = $(window).width();
   let classF = (width <= 1061) ? 'style-2' : '';

   const $moreLink = settings.genaral.fluentu_field_link_more ? moreArr.map(More).join('') : '';

    const $textLangs = '<div class="text-langs">' + textArr.map(Heading).join('') + '</div>';

    const $htmlLangs = '<div class="fluentu-list-langs">' + settings.langs.map(Item).join('') + $moreLink +'</div>';

    const $container = '<div id="fluentu-sticky-language" class="'+classF+'"><div class="lang-container">' + $textLangs + $htmlLangs + '</div></div>';

    //1. Languages after header
    $(settings.genaral.fluentu_field_position).each(function(index){
      if(index == 0) $($container).insertAfter($(this));
    });

    addEventListener('resize', (event) => {
        width = $(window).width();
        if(width <= 1061){
          $('#fluentu-sticky-language').addClass('style-2');
        }else{
          $('#fluentu-sticky-language').removeClass('style-2');
        }
    });

    //Add class sticky for language
    var $sticky = $(document).find('#fluentu-sticky-language');
    fixedLanguages();
    addEventListener('scroll', fixedLanguages);

    //function run fixed lang
    function fixedLanguages(){
      var scroll = $(window).scrollTop();
      if (scroll > 220) {
        $sticky.addClass('style-2');
      } else if(width > 1061){
        $sticky.removeClass('style-2');
      }
    }

    const slider = document.querySelector('.fluentu-list-langs');
    let mouseDown = false;
    let startX, scrollLeft;

    let startDragging = function (e) {
      mouseDown = true;
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    };
    let stopDragging = function (event) {
      mouseDown = false;
    };

    slider.addEventListener('mousemove', (e) => {
      e.preventDefault();
      if(!mouseDown) { return; }
      const x = e.pageX - slider.offsetLeft;
      const scroll = x - startX;
      slider.scrollLeft = scrollLeft - scroll;
    });

    // Add the event listeners
    slider.addEventListener('mousedown', startDragging, false);
    slider.addEventListener('mouseup', stopDragging, false);
    slider.addEventListener('mouseleave', stopDragging, false);


  });

})(jQuery);
