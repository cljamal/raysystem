try{
    //Utils
    window._ = require('lodash');

    // Bootstrap
    window.jquery = window.$ = require('jquery');
    require('bootstrap');

    //Axios
    window.axios = require('axios');
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
} catch (e) {}
