import {parse_json_vars, match_some} from '../util/helpers'

export default (data_selector = 'toggle') => {
    const _toggle = document.querySelectorAll(`[data-${data_selector}]`);

    let _showed = [];
    let _activator = null;

    const isSmoothEl = (el ,settings) => settings.types.includes('smooth') && match_some(el, settings.smooth_elements);

    const doSmoothEl = (el, isOpening) => el.style.maxHeight = (isOpening ? `${el.scrollHeight}px` : '0px');

    const getTargets = (el) => {
        const targets_str = el.getAttribute('data-toggle');

        if(typeof targets_str === 'string' && targets_str.length > 0) {
             return [...Array.from(document.querySelectorAll(targets_str)), el];
        }

        return [el];
    }

    _toggle.forEach((el) => {

        /*
            clear - just remove all active classes
            unique - just toggle active class
            smooth - smooth animation
         */

        const settings = parse_json_vars(el.getAttribute('data-toggle-settings'), {
            types: [],
            smooth_elements: [],
        });

        if (el.classList.contains('is-active')) {
            if (!settings.types.includes('unique')) {
                _showed = getTargets(el);
                _activator = el;
            }

            if (settings.types.includes('smooth')) {
                setTimeout(() => {
                    getTargets(el).forEach((el) => {
                        if (match_some(el, settings.smooth_elements)) {
                            doSmoothEl(el, true)
                        }
                    })
                })
            }
        }

        el.addEventListener('click', function (event) {
            event.preventDefault();

            const _targets = getTargets(this);
            window.dispatchEvent(new CustomEvent('toggle.start', {
                detail: {isOpen: !!_activator},
            }));

            if (settings.types.includes('unique')) {
                _targets.forEach(function (el) {
                    el.classList.toggle('is-active');

                    if (isSmoothEl(el, settings)) {
                        doSmoothEl(el, el.classList.contains('is-active'))
                    }
                });

                window.dispatchEvent(new CustomEvent('toggle.toggle'));

                return;
            }

            if (settings.types.includes('clear')) {
                const closingElements = [..._showed, ...Array.from(document.querySelectorAll('.is-active'))];
                _showed = [];

                while (closingElements.length > 0) {
                    const el = closingElements.pop();

                    el.classList.remove('is-active');

                    if (isSmoothEl(el, settings)) {
                        doSmoothEl(el, false)
                    }
                }

                window.dispatchEvent(new CustomEvent('toggle.toggle'));

                return;
            }

            while (_showed.length > 0) {
                _showed.pop().classList.remove('is-active');
            }

            window.dispatchEvent(new CustomEvent('toggle.clean'));

            if (_activator !== this) {
                _targets.forEach(function (el) {
                    el.classList.add('is-active');
                    _showed.push(el);

                    if (settings.types.includes('smooth')) {
                        el.style.maxHeight = `${el.scrollHeight}px`
                    }
                });

                _activator = this;

                window.dispatchEvent(new CustomEvent('toggle.opened', {
                    detail: {isOpen: !!_activator, targets: _targets},
                }));

                return;
            }

            window.dispatchEvent(new CustomEvent('toggle.closed'));

            _activator = null;
        });
    });

    ['click', 'touchstart'].map(function (event) {
        document.body.addEventListener(event, function (e) {
            let _current = e.target;

            while (_current !== document.documentElement && !_showed.some(function (el) {
                return el === _current;
            })) { // jshint ignore:line
                if (_current === null) {
                    return
                }
                _current = _current.parentElement;
            }

            if (_current === document.documentElement) {
                while (_showed.length > 0) {
                    _showed.pop().classList.remove('is-active');
                }
                _activator = null;

                window.dispatchEvent(new CustomEvent('toggle.closed'));
            }
        });
    });
}
