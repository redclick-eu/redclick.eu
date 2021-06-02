import { parseJsonVars, matchSome } from '../util/helpers';

export default (dataSelector = 'toggle') => {
    const toggle = document.querySelectorAll(`[data-${dataSelector}]`);

    let showed = [];
    let activator = null;

    const isSmoothEl = (el, settings) => settings.types.includes('smooth') && matchSome(el, settings.smooth_elements);

    /* eslint-disable no-param-reassign */
    const doSmoothEl = (el, isOpening) => {
        el.style.maxHeight = (isOpening ? `${el.scrollHeight}px` : '0px');
    };
    /* eslint-enable */

    const getTargets = (el) => {
        const targetsStr = el.getAttribute('data-toggle');

        if (typeof targetsStr === 'string' && targetsStr.length > 0) {
            return [...Array.from(document.querySelectorAll(targetsStr)), el];
        }

        return [el];
    };

    toggle.forEach((el) => {
        if (!el.getAttribute(`data-${dataSelector}`) && !el.getAttribute(`data-${dataSelector}-settings`)) {
            return;
        }

        /*
            clear - just remove all active classes
            unique - just toggle active class
            smooth - smooth animation
         */

        const settings = parseJsonVars(el.getAttribute('data-toggle-settings'), {
            types: [],
            smooth_elements: [],
        });

        if (el.classList.contains('is-active')) {
            if (!settings.types.includes('unique')) {
                showed = getTargets(el);
                activator = el;
            }

            if (settings.types.includes('smooth')) {
                setTimeout(() => {
                    getTargets(el).forEach((target) => {
                        if (matchSome(target, settings.smooth_elements)) {
                            doSmoothEl(target, true);
                        }
                    });
                });
            }
        }

        el.addEventListener('click', (event) => {
            event.preventDefault();

            const targets = getTargets(el);
            window.dispatchEvent(new CustomEvent('toggle.start', {
                detail: { isOpen: !!activator },
            }));

            if (settings.types.includes('unique')) {
                targets.forEach((target) => {
                    target.classList.toggle('is-active');

                    if (isSmoothEl(target, settings)) {
                        doSmoothEl(target, target.classList.contains('is-active'));
                    }
                });

                window.dispatchEvent(new CustomEvent('toggle.toggle'));

                return;
            }

            if (settings.types.includes('clear')) {
                const closingElements = [...showed, ...Array.from(document.querySelectorAll(`[data-${dataSelector}].is-active, body.is-active`))];
                showed = [];

                while (closingElements.length > 0) {
                    const closingEl = closingElements.pop();

                    closingEl.classList.remove('is-active');

                    if (isSmoothEl(closingEl, settings)) {
                        doSmoothEl(closingEl, false);
                    }
                }

                window.dispatchEvent(new CustomEvent('toggle.toggle'));

                return;
            }

            while (showed.length > 0) {
                showed.pop().classList.remove('is-active');
            }

            window.dispatchEvent(new CustomEvent('toggle.clean'));

            if (activator !== this) {
                targets.forEach((target) => {
                    target.classList.add('is-active');
                    showed.push(target);

                    if (settings.types.includes('smooth')) {
                        /* eslint-disable no-param-reassign */
                        target.style.maxHeight = `${target.scrollHeight}px`;
                        /* eslint-enable */
                    }
                });

                activator = this;

                window.dispatchEvent(new CustomEvent('toggle.opened', {
                    detail: { isOpen: !!activator, targets },
                }));

                return;
            }

            window.dispatchEvent(new CustomEvent('toggle.closed'));

            activator = null;
        });
    });

    ['click', 'touchstart'].forEach((event) => {
        document.body.addEventListener(event, (e) => {
            let current = e.target;

            while (current !== document.documentElement && !showed.includes(current)) {
                if (current === null) {
                    return;
                }
                current = current.parentElement;
            }

            if (current === document.documentElement) {
                while (showed.length > 0) {
                    showed.pop().classList.remove('is-active');
                }
                activator = null;

                window.dispatchEvent(new CustomEvent('toggle.closed'));
            }
        });
    });
};
