/** Import polyfills here **/
import "./polyfill/prepend";
import "./polyfill/remove";

import App from "./modules/App";

(() => {
  App.init();
})();
