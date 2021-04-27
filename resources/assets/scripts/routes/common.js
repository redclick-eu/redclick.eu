import upBtn from '../components/upBtn';
import googleMaps from '../components/googleMaps';
import lifeSearch from '../components/lifeSearch';
import portfolioGrid from '../components/portfolioGrid';
import preloader from '../components/preloader';
import siema from '../components/siema';
import stickyMenu from '../components/stickyMenu';

import formAjax from '../logic/formAjax';
import formValidate from '../logic/formValidate';
import mouseOrKeyboard from '../logic/mouseOrKeyboard';
import toggle from '../logic/toggle';

export default {
    init() {
        upBtn();
        googleMaps();
        lifeSearch();
        portfolioGrid();
        preloader();
        siema();
        stickyMenu();

        formAjax();
        formValidate();
        mouseOrKeyboard();
        toggle();
    },
};
