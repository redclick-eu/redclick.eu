// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
});

// Load Events
document.addEventListener('DOMContentLoaded', () => routes.loadEvents());
