import $ from 'jquery';

window.$ = $;

import Clicker from './components/Clicker';
import User from './components/User';
import Shop from './components/Shop';
import Ranking from './components/Ranking';

window.user = new User();
let clicker = new Clicker();
let shop = new Shop();
let ranking = new Ranking();