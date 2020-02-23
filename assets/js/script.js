document.querySelectorAll('.quarter').forEach(function(add_pts){
    add_pts.addEventListener('click', function(){
        let id = this.dataset.id;
        let quarter_num = this.dataset.quarter;
        console.log(id);
        
        $.ajax({
            url: "../controller/get_user_endpoint.php",
            type: "POST",
            data: {
                "id": id,
                "quarter_num": quarter_num
            },
            success: function (response) {
                let parseResponse = JSON.parse(response);

                let result_container = document.querySelector('#result_container');
                result_container.innerHTML = '';
                parseResponse.forEach(function(data){
                    result_container.innerHTML += `<p> Year : ${data.year} </p>  <p>Test Average Grade: <strong>${data.test_ave}</strong></p> <p>Homework Average Grade: <strong>${data.homework_ave}</strong></p> <p>Homework Lowest Grade Removed: <strong>${data.hw_lowest_grade}</strong></p> <p>Final Grade: <strong>${data.final_ave}</strong></p> <div class="alert alert-primary" role="alert">
                    Homework Grades: ${data.homework_records_users}
                  </div> <div class="alert alert-success" role="alert">
                  Test Grades: ${data.test_records_users}
                </div> <hr>`
                });
            }
        });

        $(`#quarter_middle`).text('Quarter '+quarter_num);
        $(`#quarter_modal`).modal('show');
    })
})

document.querySelectorAll('.quarter_overall').forEach(function(add_pts){
    add_pts.addEventListener('click', function(){
        let quarter_num = this.dataset.quarter;
        console.log(quarter_num);
        $.ajax({
            url: "../controller/get_summary_endpoint.php",
            type: "POST",
            data: {
                "quarter_num": quarter_num
            },
            success: function (response) {
                let parseResponse = JSON.parse(response);

                let result_container = document.querySelector('#result_summary_container');
                console.log(parseResponse);
                result_container.innerHTML = '';
                parseResponse.forEach(function(data){
                    result_container.innerHTML += `
                               
                                    <tr>
                                        <th class='text-center'>${data.name}</th>
                                        <th class='text-center'>${data.year}</th>
                                        <td class='text-center'>${data.homework_ave}</td>
                                        <td class='text-center'>${data.test_ave}</td>
                                        <td class='text-center'>${data.final_ave}</td>
                                    </tr>`
                });
            }
        });

        $(`#quarter_middle_overall`).text('Quarter '+quarter_num);
        $(`#quarter_over_modal`).modal('show');
        
    })
})

document.querySelectorAll('.upload_temp').forEach(function(add_pts){
    add_pts.addEventListener('click', function(){
        $(`#upload_modal`).modal('show');
    })
})

document.querySelectorAll('.update_temp').forEach(function(add_pts){
    add_pts.addEventListener('click', function(){
        $(`#update_modal`).modal('show');
    })
})

document.querySelectorAll('.compute_temp').forEach(function(add_pts){
    add_pts.addEventListener('click', function(){
        $(`#compute_modal`).modal('show');
    })
})
