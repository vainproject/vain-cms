import Message from './message';
import Emoji from './emoji';

var message = new Message('#msg-wrap', '.conversation-wrap');
var emoji = new Emoji();

message.setConfig({
    complete: function() {
        emoji.textcomplete('[data-emoji-typehint]');
        emoji.run('[data-emojify]');
    }
});

/**
 * load data
 */
var invoke = function(element) {
    $('[data-thread]')
        .closest('.media')
        .removeClass('media-message-active');

    element
        .closest('.media')
        .addClass('media-message-active');

    message.messages(element.data('thread'), 1);
};

/**
 * trigger loading
 */
$(document).on('ready', function() {

    message.threads(1);
});

$(document.body).on('click', '[data-thread]', function (e) {
    invoke($(this));
});

