    jQuery(function(){  
        jQuery.noty.defaults = {
            layout: 'center',
            theme: 'defaultTheme',
            type: 'alert',
            text: '', // can be html or string
            dismissQueue: true, // If you want to use queue feature set this true
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: {height: 'toggle'},
                close: {height: 'toggle'},
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: 8000, // delay for closing event. Set false for sticky notifications
            force: false, // adds notification to the beginning of queue when set to true
            modal: true,
            maxVisible: 2, // you can set max visible notification for dismissQueue true option,
            killer: false, // for close all notifications before show
            closeWith: ['click'], // ['click', 'button', 'hover']
            callback: {
                onShow: function() {},
                afterShow: function() {},
                onClose: function() {},
                afterClose: function() {}
            },
            buttons: false // an array of buttons
        };
    });

	function generateNotification(text,type) {
        var n = noty({
            text        : text,
            type        : type
        });
    }
