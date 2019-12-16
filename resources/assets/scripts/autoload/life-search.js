import 'whatwg-fetch'
import 'abortcontroller-polyfill/dist/polyfill-patch-fetch'

const lang = location.href.split('/')[3];

Array.from(document.getElementsByClassName('js-search-form')).forEach((_form) => {
    const _list = _form.querySelector('.js-search-list');
    const _input = _form.querySelector('.js-search');
    const _loupe = _s.parentNode.querySelector('.js-search-loupe');
    let abort =  new AbortController();

    let timeout;

    _input.addEventListener('input', function () {
        this.value = this.value.replace(/^\s+/,'');

        if (this.value.length === 0) {
            clearTimeout(timeout);
            _list.classList.remove('m-show', 'm-search');
            return;
        }

        _list.innerHTML = '';
        _list.classList.add('m-show', 'm-search');

        clearTimeout(timeout);
        timeout = setTimeout(() => {
                abort.abort();
                abort =  new AbortController();

                fetch('/'+lang+'/wp-json/redclick/v1/search', {
                    method: 'POST',
                    signal: abort.signal,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        keyword: this.value,
                    }),
                }).then(r => r.json())
                    .then((response) => {
                        console.log(response);
                        create_search_list_items(_list, response);
                        _list.classList.remove('m-search');
                    })
                    .catch((reason) => {
                        if(! (reason instanceof  DOMException)) {
                            console.warn(reason);
                        }
                    });
            }, 300);
    });

    _form.addEventListener('reset', function() {
        e.preventDefault();

        if(!_s.value) {
            _loupe.dispatchEvent(new Event("click"));
        } else {
            _input.value = "";
        }
    });
});

function create_search_list_items(_list, data) {
    while (_list.firstChild) {
        _list.removeChild(_list.firstChild);
    }

    if(data.length === 1 && data[0].error) {
        const _item = document.createElement('li');
        _item.classList.add('m-empty');
        _item.innerText = data[0].text;
        _list.appendChild(_item);
        return;
    }

    const _container = document.createDocumentFragment();
    data.forEach((el)=>{
        const _item = document.createElement('li');
        const _link = document.createElement('a');

        _link.innerText = el.title;
        _link.href = el.href;

        _item.appendChild(_link);
        _container.appendChild(_item);
    });
    _list.appendChild(_container);
}
