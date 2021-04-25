import Siema from 'siema';
import checkMobile from '../util/checkMobile';

let userOnPage = true;

window.addEventListener('blur', () => {
    userOnPage = false;
});

window.addEventListener('focus', () => {
    userOnPage = true;
});

Siema.prototype.addPagination = function addPagination() {
    const siema = this;
    const dots = this.selector.parentNode.querySelector('.siema-dots');

    if (dots === null) {
        return;
    }

    while (dots.firstChild) {
        dots.removeChild(dots.firstChild);
    }

    for (let i = 0; i < this.innerElements.length - this.perPage + 1; i += 1) {
        const btn = document.createElement('button');

        btn.classList.add('carousel-dot');
        btn.setAttribute('aria-label', `Перейти к слайду ${i + 1}`);
        btn.addEventListener('click', () => {
            siema.goTo(i);
            siema.nextWithTimeout();

            Array.from(this.parentNode.childNodes).forEach((el) => el.classList.remove('carousel-dot_active'));
            btn.classList.add('carousel-dot_active');
        });

        if (i === 0) {
            btn.classList.add('carousel-dot_active');
        }

        dots.appendChild(btn);
    }

    this.dots = dots;
};

Siema.prototype.addArrows = function addArrows() {
    const siema = this;
    const carousel = siema.selector.parentNode;

    const left = carousel.querySelector('.siema-arrow_left');
    if (left !== null) {
        left.addEventListener('click', () => {
            siema.prev();
            left.nextWithTimeout();
        });
    }

    const right = carousel.querySelector('.siema-arrow_right');
    if (right !== null) {
        right.addEventListener('click', () => {
            siema.next();
            right.nextWithTimeout();
        });
    }
};

Siema.prototype.addClasses = function addClasses() {
    const wrapper = this.selector.children[0];
    wrapper.classList.add('siema-wrapper');
    Array.from(wrapper.children).forEach((el) => el.classList.add('siema-item'));
};

Siema.prototype.nextWithTimeout = function nextWithTimeout() {
    if (this.config.intervalMilliseconds) {
        clearTimeout(this.config.timeOutMark);
        this.config.timeOutMark = setTimeout(() => this.next(), this.config.intervalMilliseconds);
    }
};

const defaults = {
    duration: 750,
    easing: 'ease-out',
    perPage: 1,
    startIndex: 0,
    draggable: checkMobile(),
    multipleDrag: checkMobile(),
    threshold: 20,
    loop: true,
    rtl: false,
    timeOutMark: undefined,
    intervalMilliseconds: undefined,
    onInit() {
        this.addPagination();
        this.addArrows();
        this.addClasses();

        window.addEventListener('resize', () => {
            this.addPagination();
            this.addClasses();
        });

        if (this.config.intervalMilliseconds !== undefined) {
            this.nextWithTimeout();
        }
    },
    onChange() {
        if (this.dots !== undefined) {
            const dots = this.selector.parentNode.querySelectorAll('.carousel-dot');
            Array.from(dots).forEach((el) => el.classList.remove('carousel-dot_active'));
            dots[this.currentSlide].classList.add('carousel-dot_active');
        }

        if (this.config.intervalMilliseconds !== undefined) {
            if (userOnPage) {
                this.nextWithTimeout();
            } else {
                window.addEventListener('focus', () => {
                    this.nextWithTimeout();
                }, { once: true });
            }
        }
    },
};

export default () => {
    document.querySelectorAll('.siema-carousel').forEach((carousel) => {
        const settings = {
            ...{
                selector: carousel.querySelector('.siema-inner'),
            },
            ...JSON.parse(carousel.getAttribute('data-settings') || '[]'),
        };

        /* eslint-disable no-new */
        new Siema({ ...defaults, ...settings });
        /* eslint-enable */
    });
};
