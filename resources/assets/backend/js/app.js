import Icons from 'uikit/dist/js/uikit-icons';

try {
    window.$ = window.jQuery = require('jquery');

    window.UIkit = require('uikit');
    UIkit.use(Icons);
} catch (e) {

}