import Siema from 'siema';
import check_mobile from './check-mobile.js';

Siema.prototype.addPagination = function () {
    const _this = this;
    const _dots = _this.selector.parentNode.querySelector('.siema-dots');
    let first = true;

    if(_dots === null) {
        return
    }

    while (_dots.firstChild) {
        _dots.removeChild(_dots.firstChild);
    }

    for (let i = 0; i < this.innerElements.length - this.perPage + 1; i++) {
        const btn = document.createElement('button');
        btn.classList.add('carousel-dot');
        btn.addEventListener('click', function () {
            _this.goTo(i);
            Array.from(this.parentNode.childNodes).forEach(el => el.classList.remove('carousel-dot_active'));
            this.classList.add('carousel-dot_active');
        });
        if(first) {
            btn.classList.add('carousel-dot_active');
            first = false;
        }
        _dots.appendChild(btn);
    }

    this.dots = _dots;
};

Siema.prototype.addArrows = function() {
    const siema = this;
    const _carousel = siema.selector.parentNode;

    const left = _carousel.querySelector('.siema-arrow_left');
    if (left !== null) {
        left.addEventListener('click', function () {
            siema.prev();
        });
    }

    const right = _carousel.querySelector('.siema-arrow_right');
    if (right !== null) {
        right.addEventListener('click', function () {
            siema.next();
        });
    }
};

Siema.prototype.addClasses = function (){
    const wrapper = this.selector.children[0];
    wrapper.classList.add('siema-wrapper');
    Array.from(wrapper.children).forEach(el => el.classList.add('siema-item'))
};

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
    onInit: function () {
        this.addPagination();
        this.addArrows();
        this.addClasses();

        window.addEventListener('resize', () => {
            this.addPagination();
            this.addClasses();
        })
    },
    onChange: function () {
        if(this.dots === undefined) {
            return false;
        }

        const dots = this.selector.parentNode.querySelectorAll('.carousel-dot');
        Array.from(dots).forEach(el => el.classList.remove('carousel-dot_active'));
        dots[this.currentSlide].classList.add('carousel-dot_active');
    },
};

export default function(settings){
    if(settings === undefined) {
        return new Siema(defaults);
    }
    return new Siema({...defaults,...settings});
}