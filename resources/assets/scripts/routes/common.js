import upBtn from '../components/upBtn';
import googleMaps from '../components/googleMaps';
import liveSearch from '../components/liveSearch';
import liveSearchMobile from '../components/liveSearchMobile';
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
        liveSearch();
        liveSearchMobile();
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
