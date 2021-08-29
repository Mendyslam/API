<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
    <div class="mydata"></div>

    <button onclick="read_data()">fetch data</button>
    <button onclick="prev()">prev</button>
    <button onclick="next()">next</button>
    <script>

        var id = 1;

        function read_data() {

            const mydiv = document.querySelector(".mydata");

            mydiv.innerHTML = "Loading...";

            var url = "https://mendymarket.000webhostapp.com/employees/" + id;

            fetch(url)
            .then(function(resp) {
               return resp.json();
            })
            .then(function(data) {
                data = data[0];
                mydiv.innerHTML =
                `<div>
                    <h5>ID: ${data.emp_no}</h5>
                    <h4>Employee</h4>
                    <p>Full Name: ${data.first_name} ${data.last_name}</p>
                    <p>Date of Birth: ${data.birth_date}</p>
                    <blockqoute>Hired Date: ${data.hire_date}</blockquote>
                </div>`;
            })
            .catch(function(err){
                alert(err);
            });

        }

        function prev() {
            id -= 1;
            if(id < 1) {
                id = 1;
            }
            read_data();
        }

        function next() {
            id += 1;
            read_data();
        }
    </script>
</body>
</html>