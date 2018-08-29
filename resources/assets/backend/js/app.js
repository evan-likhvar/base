import './bootstrap';

import Icons from 'uikit/dist/js/uikit-icons';
//import './backend';
//require ('./backend.js');

try {
    //window.$ = window.jQuery = require('jquery');

    window.UIkit = require('uikit');
    UIkit.use(Icons);
} catch (e) {

}


