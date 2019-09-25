const _up = document.querySelector('.up');

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        _up.classList.add('is-active');
    } else {
        _up.classList.remove('is-active');
    }
}

if (_up !== null) {
    window.addEventListener('scroll', function () {
        scrollFunction()
    });

    _up.addEventListener('click', function () {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
}