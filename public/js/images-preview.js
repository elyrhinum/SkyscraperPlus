let input = document.querySelector('#images'),
    cont = document.querySelector('#images-prev');

input.addEventListener('change', () => {
    [...input.files].forEach(item => {
        if(item.size / 1024 > 10) {
            let divImg = document.createElement('div');
            divImg.classList.add('images-block');
            let image = document.createElement('img');
            image.style.display = 'block';
            image.style.width = '150px';
            image.style.height = '150px';
            image.style.objectFit = 'cover';
            image.src = URL.createObjectURL(item);
            image.alt = 'Изображение';
            divImg.append(image);

            let btnDel = document.createElement('p');
            btnDel.textContent = "×";
            divImg.append(btnDel);
            cont.append(divImg);

            btnDel.addEventListener('click', e => {
                e.preventDefault();
                divImg.remove();
            });
        } else {
            alert('Изображение больше 10 МБ');
        }
    });
});
