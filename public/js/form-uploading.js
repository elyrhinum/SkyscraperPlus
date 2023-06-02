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

    filesStore.forEach((item, key) => {
        cont.insertAdjacentHTML('beforeend', `
        <div class="images-block">
            <img src="${URL.createObjectURL(item)}" alt="Фотография">
            <p data-index="${key}" onclick="deleteImg(event)">×</p>
        </div>`);
    })
    e.target.value = '';
}

function deleteImg(e) {
    filesStore.splice(e.target.dataset.index, 1);
    cont.textContent = '';
    filesStore.forEach((item, key) => {
        cont.insertAdjacentHTML('beforeend', `
        <div class="images-block">
            <img src="${URL.createObjectURL(item)}" alt="Фотография" >
            <p data-index="${key}" onclick="deleteImg(event)">×</p>
        </div>`);
    })
}
