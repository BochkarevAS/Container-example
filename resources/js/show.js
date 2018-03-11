window.onload = function () {  // Не использую jQuery потому что лень ставить ...

    function handler(sort) {
        var xhr = new XMLHttpRequest();

        function createInput(type, name, value, id) {
            var input = document.createElement('input');
            input.type = type;
            input.name = name;
            input.value = value;

            if (id !== undefined) {
                input.setAttribute('form', 'idform' + id);
            }

            return input;
        }

        xhr.onload = xhr.onerror = function() {

            if (this.status === 200) {
                var data = JSON.parse(xhr.responseText); // Данные что пришли с сервера ...
                var table = document.getElementById('tbl');
                var tbody = document.getElementById('tbody');

                table.style.display = (table.style.display == 'none') ? '' : 'none';

                while (tbody.lastChild) {            // Удалим всех потомков ...
                    tbody.removeChild(tbody.lastChild);
                }

                for (var prop in data) {

                    if (!(data[prop] instanceof Object)) {
                        continue;
                    }

                    // Форма для редактирования ...
                    var form = document.createElement('form');
                    form.id = 'idform' + data[prop]['id'];
                    form.action = '/admin/update';
                    form.method = 'POST';
                    form.appendChild(createInput('hidden', 'id', data[prop]['id']));
                    form.appendChild(createInput('submit', 'submit', 'Редактировать'));

                    // Форма для загрузки изображения ...
                    var formImg = document.createElement('form');
                    formImg.id = 'idformImg' + data[prop]['id'];
                    formImg.action = '/admin/addImage/' +  data[prop]['id'];
                    formImg.method = 'POST';
                    formImg.enctype = 'multipart/form-data';
                    formImg.appendChild(createInput('file', 'file', ''));
                    formImg.appendChild(createInput('submit', 'submit', 'Залить'));

                    // Форма для подтверждения админа ...
                    var formAdmin = document.createElement('form');
                    formAdmin.id = 'idformAdmin' + data[prop]['id'];
                    formAdmin.action = '/admin/isAdmin';
                    formAdmin.method = 'POST';
                    formAdmin.appendChild(createInput('hidden', 'id', data[prop]['id']));
                    formAdmin.appendChild(createInput('submit', 'submit', 'Принять'));

                    var a = document.createElement('a');
                    var textNode = document.createTextNode('Удалить');
                    a.href = '/admin/delete/' + data[prop]['id'];
                    a.appendChild(textNode);

                    var row = tbody.insertRow(-1);
                    var cell = row.insertCell(-1);
                    cell.appendChild(createInput('text', 'message', data[prop]['message'], data[prop]['id']));

                    if (data[prop]['upadmin'] === true) {    // Если админ редактировал что то ...
                        cell.appendChild(document.createTextNode('Изменен администратором'));
                    }

                    if (data[prop]['isadmin'] === true) {    // Если админ принял что то ...
                        cell.appendChild(document.createTextNode('Принято'));
                    }

                    row.insertCell(-1).innerHTML = data[prop]['email'];
                    row.insertCell(-1).innerHTML = data[prop]['dt'];

                    if (data['admin'] === true) {
                        row.insertCell(-1).appendChild(form);
                        row.insertCell(-1).appendChild(a);
                        row.insertCell(-1).appendChild(formImg);
                        row.insertCell(-1).appendChild(formAdmin);
                    }

                    if (data[prop]['img']) {
                        var img = document.createElement('img');
                        img.src = '/UploadedFiles/' + data[prop]['img'];
                        img.width = 100;
                        img.height = 100;
                        row.insertCell(-1).appendChild(img);
                    }
                }
            } else {
                log("error " + this.status);
            }
        };

        xhr.open("POST", "/message/showAjax", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('sort=' + sort);

        return false;
    }

    document.getElementById('tf').addEventListener('submit', function (evt) {
        evt.preventDefault();
        handler('m.date::date');
    });
    document.getElementById('message').addEventListener("click", function (evt) {
        evt.preventDefault();
        var table = document.getElementById('tbl').style.display = 'none';
        handler('message');
    });
    document.getElementById('email').addEventListener("click", function (evt) {
        evt.preventDefault();
        var table = document.getElementById('tbl').style.display = 'none';
        handler('email')
    });
    document.getElementById('date').addEventListener("click", function (evt) {
        evt.preventDefault();
        var table = document.getElementById('tbl').style.display = 'none';
        handler('m.date::date')
    });
};
