/**
 * Created by luis on 8/20/15.
 */
jQuery(function(){
	jQuery("input").removeClass("widefat");


	//background style
	jQuery(document).on("click", "input[name=popup-bg-select]", function(){
		jQuery(".popup-solid-bg").hide();
		jQuery(".popup-image-bg").hide();


		if (jQuery(this).val() == "solid-bg")
		{
			jQuery(".popup-solid-bg").fadeIn();
		} else
		{
			jQuery(".popup-image-bg").fadeIn();
		}
	});

	//bg in css editor
	jQuery(document).on("click", "input[name=css-bg-type]", function(){
		jQuery(".css-bg-type").hide();

		if (jQuery(this).val() == "solid-bg")
		{
			jQuery(".css-bg-solid").fadeIn();
		} else
		{
			jQuery(".css-bg-image").fadeIn();
		}
	});

});