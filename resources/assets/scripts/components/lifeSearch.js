const lang = window.location.href.split('/')[3];

function createListItems(list, data) {
    while (list.firstChild) {
        list.removeChild(list.firstChild);
    }

    if (data.length === 1 && data[0].error) {
        const item = document.createElement('li');
        item.classList.add('m-empty');
        item.innerText = data[0].text;
        list.appendChild(item);
        return;
    }

    const container = document.createDocumentFragment();
    data.forEach((el) => {
        const item = document.createElement('li');
        const link = document.createElement('a');

        link.innerText = el.title;
        link.href = el.href;

        item.appendChild(link);
        container.appendChild(item);
    });
    list.appendChild(container);
}

export default () => {
    document.getElementsByClassName('js-search-form').forEach((_form) => {
        const list = _form.querySelector('.js-search-list');
        const input = _form.querySelector('.js-search');
        const loupe = _form.querySelector('.js-search-loupe');
        let abort = new AbortController();

        let timeout;

        input.addEventListener('input', () => {
            this.value = this.value.replace(/^\s+/, '');

            if (this.value.length === 0) {
                clearTimeout(timeout);
                list.classList.remove('m-show', 'm-search');
                return;
            }

            list.innerHTML = '';
            list.classList.add('m-show', 'm-search');

            clearTimeout(timeout);
            timeout = setTimeout(() => {
                abort.abort();
                abort = new AbortController();

                fetch(`/${lang}/wp-json/redclick/v1/search`, {
                    method: 'POST',
                    signal: abort.signal,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        keyword: this.value,
                    }),
                }).then((r) => r.json())
                    .then((response) => {
                        console.log(response);
                        createListItems(list, response);
                        list.classList.remove('m-search');
                    })
                    .catch((reason) => {
                        if (!(reason instanceof DOMException)) {
                            console.warn(reason);
                        }
                    });
            }, 300);
        });

        _form.addEventListener('reset', (e) => {
            e.preventDefault();

            if (!input.value) {
                loupe.dispatchEvent(new Event('click'));
            } else {
                input.value = '';
            }
        });
    });
};
