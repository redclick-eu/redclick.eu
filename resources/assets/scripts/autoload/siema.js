import Siema from 'siema';
import check_mobile from '../util/check-mobile.js';

let userOnPage = true;

window.addEventListener('blur', () => {
    userOnPage = false;
})

window.addEventListener('focus', () => {
    userOnPage = true;
})


Siema.prototype.addPagination = function () {
    const siema = this;
    const _dots = this.selector.parentNode.querySelector('.siema-dots');

    if (_dots === null) {
        return
    }

    while (_dots.firstChild) {
        _dots.removeChild(_dots.firstChild);
    }

    for (let i = 0; i < this.innerElements.length - this.perPage + 1; i++) {
        const btn = document.createElement('button');

        btn.classList.add('carousel-dot');
        btn.setAttribute('aria-label', `Перейти к слайду ${i + 1}`)
        btn.addEventListener('click', function () {
            siema.goTo(i);
            this.nextWithTimeout();

            Array.from(this.parentNode.childNodes).forEach(el => el.classList.remove('carousel-dot_active'));
            this.classList.add('carousel-dot_active');
        });

        if (i === 0) {
            btn.classList.add('carousel-dot_active');
        }

        _dots.appendChild(btn);
    }

    this.dots = _dots;
};

Siema.prototype.addArrows = function () {
    const _carousel = this.selector.parentNode;

    const left = _carousel.querySelector('.siema-arrow_left');
    if (left !== null) {
        left.addEventListener('click',  () => {
            this.prev();
            this.nextWithTimeout();
        });
    }

    const right = _carousel.querySelector('.siema-arrow_right');
    if (right !== null) {
        right.addEventListener('click', () => {
            this.next();
            this.nextWithTimeout();
        });
    }
};

Siema.prototype.addClasses = function () {
    const wrapper = this.selector.children[0];
    wrapper.classList.add('siema-wrapper');
    Array.from(wrapper.children).forEach(el => el.classList.add('siema-item'))
};

Siema.prototype.nextWithTimeout = function () {
    if (this.config.intervalMilliseconds) {
        clearTimeout(this.config.timeOutMark);
        this.config.timeOutMark = setTimeout(() => this.next(), this.config.intervalMilliseconds);
    }
}

const defaults = {
    duration: 750,
    easing: 'ease-out',
    perPage: 1,
    startIndex: 0,
    draggable: check_mobile(),
    multipleDrag: check_mobile(),
    threshold: 20,
    loop: true,
    rtl: false,
    timeOutMark: undefined,
    intervalMilliseconds: undefined,
    onInit: function () {
        this.addPagination();
        this.addArrows();
        this.addClasses();

        window.addEventListener('resize', () => {
            this.addPagination();
            this.addClasses();
        })

        if (this.config.intervalMilliseconds !== undefined) {
            this.nextWithTimeout();
        }
    },
    onChange: function () {
        if (this.dots !== undefined) {
            const dots = this.selector.parentNode.querySelectorAll('.carousel-dot');
            Array.from(dots).forEach(el => el.classList.remove('carousel-dot_active'));
            dots[this.currentSlide].classList.add('carousel-dot_active');
        }

        if (this.config.intervalMilliseconds !== undefined) {
            if (userOnPage) {
                this.nextWithTimeout();
            } else {
                window.addEventListener('focus', () => {
                    this.nextWithTimeout();
                }, {once: true})
            }
        }
    },
};

document.querySelectorAll('.siema-carousel').forEach((carousel) => {
    const settings = {
        ...{
            selector: carousel.querySelector('.siema-inner'),
        },
        ...JSON.parse(carousel.getAttribute('data-settings') || '[]'),
    };


    new Siema({...defaults, ...settings});
});
