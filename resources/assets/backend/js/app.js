import './bootstrap';

import Icons from 'uikit/dist/js/uikit-icons';

try {
    window.UIkit = require('uikit');
    UIkit.use(Icons);
} catch (e) {

}


