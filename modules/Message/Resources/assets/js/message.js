class Message {

    /**
     * message container
     *
     * @type {object}
     */
    $message = null;

    /**
     * conversation container
     *
     * @type {object}
     */
    $thread = null;

    /**
     * configuration object
     *
     * @type {{thread_uri: string, message_uri: string, complete: null}}
     */
    $config = {
        thread_uri: '/threads',
        message_uri: '/threads/{id}',
        complete: null
    };

    /**
     * @param selector Selector of the container
     */
    constructor(message, conversation) {
        this.$message = $(message);
        this.$thread = $(conversation);

        this._scrollTop();
    }

    /**
     *
     * @param config
     */
    setConfig(config) {
        $.extend(this.$config, config);
    }

    /**
     * loads conversations in dom container
     * with pagination
     *
     * @param page
     */
    threads(page) {
        var $this = this;
        var $page = page || 1;

        this._ajax(this.$config.thread_uri, $page, function(data) {
            $this.$thread.empty().append(data);
        });
    }

    /**
     * loads messages in dom container
     * by thread id with pagination
     *
     * @param thread
     * @param page
     */
    messages(thread, page) {
        var $this = this;
        var $page = page || 1;
        var $uri = this.$config.message_uri.replace('{id}', thread);

        this._ajax($uri, $page, function(data) {
            $this.$message.empty().append(data);
        });
    }

    /**
     *
     * @param url
     * @param page
     * @param success
     * @private
     */
    _ajax(url, page, success)
    {
        var $complete = this.$config.complete || function() {};

        $.ajax({
            url: url,
            data: { page: page },
            success: function(data)
            {
                // notify we are finished
                success && success(data);
            },
            complete: function()
            {
                // if a global notifier is set we use this
                $complete();
            }
        });
    }

    /**
     * scroll to the bottom of the messages container
     *
     * @private
     */
    _scrollTop() {
        this.$message && this.$message.scrollTop(this.$message.prop("scrollHeight"));
    }
}

export default Message;