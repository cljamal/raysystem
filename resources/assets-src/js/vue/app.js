import _ from 'lodash';
import Vue from 'vue';
import axios from 'axios';
import App from './layouts/App';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
    ...App
});
