// JavaScript Document
require.config({
    baseUrl: '',
    paths: {
        baseCss:"css",
        pluginsJs: 'js/plugin',
        pluginsCss:"css/plugin"
    },
    waitSeconds: 0,
    $:['jquery'],
    shim: {
    	'plugins':{
    		deps: [
          'jquery'
        ],
    		init:function(){
    			return{
    				WOW:WOW,
    				FastClick:FastClick,
    				owlCarousel:owlCarousel,
    				countdown:countdown,
    				swipebox:swipebox,
    				ScrollIt:ScrollIt,
    				Snap:Snap,
            ChoiceUser:choiceuser
    			}
    		}
    	},
    	'custom':{
    		deps: ['jquery','plugins']
    	}
	},
	urlArgs: "bust=" +  (new Date()).getTime()
});

require(['lib/jquery','vlm','custom'], function($, vlm) {
	vlm.init();
	//vlm.checkLogin();
});
