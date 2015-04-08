class Emoji {

    /**
     * configuration for emojify library
     *
     * @type {object}
     */
    config = {
        img_dir: '/static/images/emojify',
        emoticons_enabled: true,
        people_enabled: true,
        nature_enabled: true,
        objects_enabled: true,
        places_enabled: true,
        symbols_enabled: true
    };

    constructor() {
        emojify.setConfig(this.config);
    }

    /**
     * emojifies the text in the given element
     *
     * @param element
     */
    run(selector) {
        $(selector).each(function() {
            var domElement = $(this)[0];
            emojify.run(domElement);
        });
    }

    /**
     * attaches a text autocompletion for emojis to the given
     * input element behind the specified selector
     *
     * @param selector
     */
    textcomplete(selector) {
        $(selector).textcomplete([
            {
                match: /\B:([\-+\w]*)$/,
                search: function (term, callback) {
                    callback($.map(emojify.emojiNames, function (emoji) {
                        return emoji.indexOf(term) === 0 ? emoji : null;
                    }));
                },
                template: function (value) {
                    return '<img src="'+ emojify.defaultConfig.img_dir +'/' + value + '.png"></img>' + value;
                },
                replace: function (value) {
                    return ':' + value + ': ';
                },
                index: 1
            }
        ]);
    }
}

export default Emoji;