jQuery(document).ready(function ($) {

    function accordion_title_updater($accordion, $hook_title_field) {
        jQuery($accordion).each(function () {
            var $accordion_title = jQuery(this).find('.acf-accordion-title');
            var $accordion_title_label = $accordion_title.find('label');
            var $hook_title = jQuery(this).find($hook_title_field);
            var $hook_title_input = $hook_title.find('input[type="text"]').val();

            $accordion_title_label.text($hook_title_input);
        });
    }
    accordion_title_updater('.acf-field-custom-hooks-accordion', '.acf-field-custom-hooks-title');
    accordion_title_updater('.acf-field-custom-shortcode-accordion', '.acf-field-custom-shortcode-title');
    accordion_title_updater('.acf-field.custom-btn .acf-row', '.acf-field.class-btn');
    accordion_title_updater('.acf-field.page-accordion .acf-row', '.acf-field.accordion-title');

    function accordion_title_updater_textarea($accordion, $hook_title_field) {
        jQuery($accordion).each(function () {
            var $accordion_title = jQuery(this).find('.acf-accordion-title');
            var $accordion_title_label = $accordion_title.find('label');
            var $hook_title = jQuery(this).find($hook_title_field);
            var $hook_title_input = $hook_title.find('input[type="text"]').val();

            $accordion_title_label.text($hook_title_input);
        });
    }
    setTimeout(function () {
        accordion_title_updater_textarea('.acf-field.page-accordion .acf-row', '.acf-field.accordion-title');
    }, 3000);
});