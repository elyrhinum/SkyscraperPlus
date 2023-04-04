const cont = document.querySelector('#images-prev'),
    form = document.querySelector('#form'),
    imagesError = document.querySelector('#images-error');

let filesStore = [];

async function postJSON(route, data, _token) {
    let response = await fetch(route, {
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': _token,
        },
        body: data,

    })
    return await response.json()
}

async function dataPostJSON(route, data, _token) {
    let response = await fetch(route, {
        method: 'post',
        headers: {
            'Content-type': 'application/json;charset=utf-8',
        },
        body: JSON.stringify({
            data,
            _token
        }),

    })
    return await response.json()
}

function handleChange(e) {
    if (!e.target.files.length) {
        return;
    }

    [...e.target.files].forEach(item => {
        if (item.size / 1024 > 10) {
            filesStore.push(item);
        }
    })

    if (filesStore.length > 10) {
        imagesError.textContent = 'Изображений должно быть меньше 10!';
        filesStore.splice(10, filesStore.length - 10);
    }

    console.log(filesStore)

    cont.textContent = '';

    filesStore.forEach((item, key) => {
        let divImg = document.createElement('div');
        divImg.classList.add('images-block');
        let image = document.createElement('img');
        image.style.display = 'block';
        image.style.width = '150px';
        image.style.height = '150px';
        image.style.borderRadius = '3px';
        image.style.objectFit = 'cover';
        image.src = URL.createObjectURL(item);
        image.alt = 'Изображение';
        divImg.append(image);

        let btnDel = document.createElement('p');
        btnDel.textContent = "×";
        btnDel.dataset.index = key;
        divImg.append(btnDel);
        cont.append(divImg);

        btnDel.addEventListener('click', e => {
            filesStore.splice(e.target.dataset.index, 1);
            console.log(filesStore)
            divImg.remove();
        });
    })
    e.target.value = '';
}
