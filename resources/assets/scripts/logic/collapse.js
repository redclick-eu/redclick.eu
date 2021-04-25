export default () => {
    const toggle = document.querySelectorAll('[data-toggle]');

    let showed = [];
    let isOpen = false;

    Array.from(toggle).forEach((el) => {
        if (el.classList.contains('is-active')) {
            showed = Array.from(document.querySelectorAll(el.getAttribute('data-toggle')));
            showed.push(el);
            isOpen = el;
        }

        el.addEventListener('click', function () {
            window.dispatchEvent(new CustomEvent('toggle.start', {
                detail: { isOpen },
            }));

            if (isOpen !== false) {
                while (showed.length > 0) {
                    showed.pop().classList.remove('is-active');
                }
            }

            window.dispatchEvent(new CustomEvent('toggle.clean'));

            if (isOpen !== this && this.getAttribute('data-toggle-type') !== 'close') {
                const targets = Array.from(document.querySelectorAll(this.getAttribute('data-toggle')));
                targets.push(this);

                targets.forEach((t) => {
                    t.classList.add('is-active');
                    showed.push(t);
                });
                isOpen = this;

                window.dispatchEvent(new CustomEvent('toggle.opened', {
                    detail: { isOpen, targets: targets },
                }));

                return;
            }

            window.dispatchEvent(new CustomEvent('toggle.closed'));

            isOpen = false;
        });
    });

    ['click', 'touchstart'].forEach((event) => {
        document.body.addEventListener(event, (e) => {
            let target = e.target;

            while (target !== document.documentElement && !showed.includes(target)) {
                target = target.parentElement;
            }

            if (target === document.documentElement) {
                while (showed.length > 0) {
                    showed.pop().classList.remove('is-active');
                }
                isOpen = false;

                window.dispatchEvent(new CustomEvent('toggle.closed'));
            }
        });
    });
}
