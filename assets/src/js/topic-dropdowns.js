(function ($) {
    'use strict';

    /**
     * Init functionality.
     *
     * @since 0.1.0
     */
    function init() {

        var $topics = $('#learndash_lesson_topics_list').find('.topic_item');

        if (!$topics.length) {
            return;
        }

        $topics.find('.learndash-topic-content').hide();
        $topics.find('> a').click(click_topic);
    }

    /**
     * @since 0.1.0
     */
    function click_topic(event) {

        event.preventDefault();

        $(this).siblings('.learndash-topic-content').slideToggle();

        return false;
    }

    $(init);
})(jQuery);