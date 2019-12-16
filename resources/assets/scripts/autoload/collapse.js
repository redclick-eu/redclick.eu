const _toggle = document.querySelectorAll('[data-toggle]');

let _showed = [];
let isOpen = false;

Array.from(_toggle).forEach(function (el) {
    if(el.classList.contains("is-active")) {
        _showed = Array.from(document.querySelectorAll(el.getAttribute('data-toggle')));
        _showed.push(el);
        isOpen = el;
    }

    el.addEventListener('click', function () {
        window.dispatchEvent(new CustomEvent('toggle.start', {
            detail: { isOpen },
        }));

        if (isOpen !== false) {
            while (_showed.length > 0) {
                _showed.pop().classList.remove('is-active');
            }
        }

        window.dispatchEvent(new CustomEvent('toggle.clean'));

        if (isOpen !== this && this.getAttribute('data-toggle-type') !== 'close') {
            const _targets = Array.from(document.querySelectorAll(this.getAttribute('data-toggle')));
            _targets.push(this);

            _targets.forEach(function (el) {
                el.classList.add('is-active');
                _showed.push(el);
            });
            isOpen = this;

            window.dispatchEvent(new CustomEvent('toggle.opened', {
                detail: { isOpen, targets: _targets },
            }));

            return
        }

        window.dispatchEvent(new CustomEvent('toggle.closed'));

        isOpen = false;
    });
});

['click','touchstart'].map((event) => {
    document.body.addEventListener(event, function (e) {
        let _current = e.target;

        while (_current !== document.documentElement && !_showed.some(el => el === _current)) {
            _current = _current.parentElement
        }

        if (_current === document.documentElement) {
            while (_showed.length > 0) {
                _showed.pop().classList.remove('is-active');
            }
            isOpen = false;

            window.dispatchEvent(new CustomEvent('toggle.closed'));
        }
    });
});