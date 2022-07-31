
(function( $ ) {

  $(function() {

    //Add Language

    var $parent_container = $(".parent-container");

    $("#add").on("click", function(){
      var key = makeid(5);
      var content = "<div class='container'><input type='hidden' class='icon' name='fluentu_langs_options["+key+"][icon]' placeholder='Icon'/><a href='javascript:;' class='insert-my-media button'>Icon</a> <input type='text' placeholder='Name' name='fluentu_langs_options["+key+"][name]' class='name'><input type='text'placeholder='URL' name='fluentu_langs_options["+key+"][url]' class='url'> <button type='button' id='remove'>-</button></div>";
    	$parent_container.append(content);
    });

    $parent_container.on("click", "#remove", function(){
    	   $(this).parent().remove();
      	$("#add").show();
    });

   //Inster meida
    $parent_container.on("click", ".insert-my-media",open_media_window);
    function open_media_window() {
      $button = $(this);
      if (this.window === undefined) {
          this.window = wp.media({
                  title: 'Insert a media',
                  library: {type: 'image'},
                  multiple: false,
                  button: {text: 'Insert'}
              });

          var self = this; // Needed to retrieve our variable in the anonymous function below
          this.window.on('select', function() {
                  var first = self.window.state().get('selection').first().toJSON();
                  $button.parent().find('input.icon').val(first.id);
                  $button.html('<img src="'+first.url+'" width="30" />')
          });
      }

      this.window.open();
      return false;

    }

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() *
     charactersLength));
       }
       return result;
    }



  });
})(jQuery);
