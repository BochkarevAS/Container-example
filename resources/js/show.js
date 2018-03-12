window.onload = function () {  // Не использую jQuery потому что лень ставить ...
    var tf = document.getElementById('tf');
    var message = document.getElementById('message');
    var email = document.getElementById('email');
    var date = document.getElementById('date');

    function handler(sort) {
        var xhr = new XMLHttpRequest();

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

                    if (data[prop]['isadmin'] !== true) {    // Если админ принял что то ...
                        continue;
                    }

                    var row = tbody.insertRow(-1);
                    var cell = row.insertCell(-1);
                    cell.innerHTML = data[prop]['message'];

                    if (data[prop]['upadmin'] === true) {    // Если админ редактировал что то ...
                        cell.appendChild(document.createTextNode('Изменен администратором'));
                    }

                    row.insertCell(-1).innerHTML = data[prop]['email'];
                    row.insertCell(-1).innerHTML = data[prop]['dt'];

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

    if (tf !== null && message != null && email !== null || date !== null) {

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
    }
};
