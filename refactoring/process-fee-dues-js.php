<script>
    // process the unpaid fees of the student
    let fee = document.getElementById('fee-input');
    fee.addEventListener('keyup', function() {
        let search = fee.value.trim();
        var input = 'fee-input';
        var dropdown = 'fee-menu';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/search-process-fee-dues.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    var resultsDiv = document.getElementById(dropdown);
                    resultsDiv.innerHTML = ''; // Clear previous results
                    // console.log(response);
                    if (response.length > 0) {
                        // Show and style the results div
                        resultsDiv.style.display = 'block';
                        resultsDiv.style.maxHeight = '200px';
                        resultsDiv.style.overflowY = 'scroll';
                        resultsDiv.style.cursor = 'pointer';
                        resultsDiv.style.position = "absolute";
                        resultsDiv.style.top = "100%";
                        resultsDiv.style.width = "100%";

                        // Loop through each result
                        response.forEach(function(item) {
                            var resultItem = document.createElement('div');
                            // Bootstrap styling for each item
                            resultItem.classList.add('dropdown-item');

                            // Create element
                            var name = document.createElement('span');
                            name.textContent = item.name + ' - roll#' + item.roll_no;
                            name.style.display = 'block';
                            resultItem.appendChild(name);

                            // Add the result item to the results div
                            resultsDiv.appendChild(resultItem);

                            // Add onclick event for each result item
                            resultItem.onclick = function() {
                                var rollNo = item.roll_no;
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        try {
                                            var response = JSON.parse(xhr.responseText);
                                            // console.log(response);
                                            if (Object.keys(response).length > 0) {
                                                var the_div = document.getElementById('show-fee');
                                                the_div.innerHTML = "";
                                                // console.log(Object.keys(response));
                                                // console.log('ksj');
                                                //                       Object.keys(response).forEach(function(main_id) {
                                                //   var item = response[main_id];
                                                //   console.log(item); // Log each item to confirm it contains the expected data
                                                //   // Proceed with creating feeTab here
                                                // });
                                                // Loop through each result
                                                Object.keys(response).forEach(function(main_id) {
                                                    var item = response[main_id];

                                                    const feeTab = document.createElement('div');
                                                    feeTab.className = 'col-xl-8';
                                                    feeTab.id = '' + item.main_data.fee_id + '';

                                                    const card = document.createElement('div');
                                                    card.className = 'card';

                                                    const cardBody = document.createElement('div');
                                                    cardBody.className = 'card-body pt-3';

                                                    // Bordered Tabs
                                                    const navTabs = document.createElement('ul');
                                                    navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                                                    const navItem = document.createElement('li');
                                                    navItem.className = 'nav-item';

                                                    const navLink = document.createElement('button');
                                                    navLink.className = 'nav-link active';
                                                    navLink.setAttribute('data-bs-toggle', 'tab');
                                                    navLink.setAttribute('data-bs-target', '#profile-edit');
                                                    navLink.textContent = 'Student Fee';

                                                    navItem.appendChild(navLink);
                                                    navTabs.appendChild(navItem);

                                                    // Tab Content
                                                    const tabContent = document.createElement('div');
                                                    tabContent.className = 'tab-content pt-2';

                                                    const tabPane = document.createElement('div');
                                                    tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                                                    tabPane.id = 'profile-edit';

                                                    // Table
                                                    const tableContainer = document.createElement('div');
                                                    tableContainer.className = 'table-responsive';

                                                    const table = document.createElement('table');
                                                    table.className = 'table table-bordered border-primary';

                                                    const thead = document.createElement('thead');
                                                    const headerRow = document.createElement('tr');
                                                    ['Reg#', 'Name', 'Monthly Fee', 'Funds', 'Total Fee', 'Month'].forEach(text => {
                                                        const th = document.createElement('th');
                                                        th.scope = 'col';
                                                        th.textContent = text;
                                                        headerRow.appendChild(th);
                                                    });
                                                    thead.appendChild(headerRow);

                                                    const tbody = document.createElement('tbody');
                                                    const tableRow = document.createElement('tr');
                                                    tableRow.id = 'fee-t-row';

                                                    let arr = [item.main_data.roll_no, item.main_data.name, item.main_data.monthly_fee, item.main_data.name, item.main_data.total_fee, item.main_data.month + ', ' + item.main_data.year];
                                                    for (let i = 0; i < 6; i++) {
                                                        const td = document.createElement('td');
                                                        if (i === 3) {
                                                            td.className = 'text-center';
                                                            const span = document.createElement('span');
                                                            span.className = 'd-inline-block text-center';
                                                            span.setAttribute('tabindex', '0');
                                                            span.setAttribute('data-bs-toggle', 'tooltip');
                                                            if (!item.funds) {
                                                                span.setAttribute('title', '---');
                                                            } else {
                                                                span.setAttribute('title', item.funds);
                                                            }

                                                            const button = document.createElement('button');
                                                            button.type = 'button';
                                                            button.className = 'btn btn-sm btn-outline-dark';
                                                            const icon = document.createElement('i');
                                                            icon.className = 'fas fa-question pro-header-icon ms-2';
                                                            button.appendChild(icon);
                                                            span.appendChild(button);
                                                            td.appendChild(span);
                                                        } else {
                                                            td.innerText = arr[i];
                                                        }
                                                        tableRow.appendChild(td);
                                                    }
                                                    tbody.appendChild(tableRow);

                                                    table.appendChild(thead);
                                                    table.appendChild(tbody);
                                                    tableContainer.appendChild(table);

                                                    // Form
                                                    const form = document.createElement('div');
                                                    // form.method = 'post';
                                                    // form.action = '';
                                                    // form.enctype = 'multipart/form-data';

                                                    // var arr1 = [item.main_data.fee_id, item.main_data.student_id, item.main_data.name, item.main_data.roll_no, item.main_data.monthly_fee, item.main_data.year, item.main_data.month];
                                                    // var counter = 0;
                                                    // ['id', 'student_id', 'student_name', 'roll_no', 'monthly_fee', 'year', 'month'].forEach(name => {
                                                    //   const input = document.createElement('input');
                                                    //   input.id = name + item.main_data.fee_id + '';
                                                    //   input.type = 'hidden';
                                                    //   input.name = name;
                                                    //   // input.value = arr1[counter];
                                                    //   form.appendChild(input);
                                                    //   counter++;
                                                    // });

                                                    const formRow = document.createElement('div');
                                                    formRow.className = 'row mb-3';

                                                    const col = document.createElement('div');
                                                    col.className = 'col-md-8 col-lg-9 mt-2';

                                                    const duesInput = document.createElement('input');
                                                    duesInput.name = 'dues';
                                                    duesInput.type = 'text';
                                                    duesInput.id = "reason" + item.main_data.fee_id + '';
                                                    duesInput.className = 'form-control';
                                                    duesInput.placeholder = 'Remaining dues (if fees is not full paid)';
                                                    col.appendChild(duesInput);
                                                    formRow.appendChild(col);

                                                    form.appendChild(formRow);

                                                    const buttonsContainer = document.createElement('div');
                                                    buttonsContainer.className = 'text-center';

                                                    ['Full Paid', 'Add dues'].forEach((text, index) => {
                                                        const button = document.createElement('button');
                                                        button.type = 'submit';
                                                        button.name = index === 0 ? 'paid' : 'due';
                                                        button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                                                        button.textContent = text;
                                                        // Add onclick event to the button
                                                        button.onclick = function() {
                                                            // console.log(`${text} button clicked`);
                                                            if (text === 'Full Paid') {
                                                                var the_fee_id = item.main_data.fee_id;
                                                                var fee_id = the_fee_id;
                                                                var student_id = item.main_data.student_id;
                                                                var name = item.main_data.name;
                                                                var roll_no = item.main_data.roll_no;
                                                                var total_fee = item.main_data.total_fee;
                                                                var year = item.main_data.year;
                                                                var month = item.main_data.month;

                                                                var xhr = new XMLHttpRequest();
                                                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                                        try {
                                                                            var response = JSON.parse(xhr.responseText);
                                                                            // console.log(response);
                                                                            if (response.length > 0) {
                                                                                // Loop through each result
                                                                                response.forEach(function(data) {
                                                                                    if (data.message.includes('paid')) {
                                                                                        document.getElementById(item.main_data.fee_id).style.display = "none";
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#d4edda';
                                                                                        popup.style.color = '#155724';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    } else if (data.message.includes('error')) {
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#f8d7da';
                                                                                        popup.style.color = '#721c24';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    }
                                                                                });
                                                                            }
                                                                        } catch (e) {
                                                                            console.error('Error parsing JSON:', e);
                                                                            console.error('Response text:', xhr.responseText);
                                                                        }
                                                                    }
                                                                };
                                                                xhr.send('all_fee_clear=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month));

                                                            } else if (text === 'Add dues') {
                                                                const duesInput = document.getElementById('reason' + item.main_data.fee_id);
                                                                if (duesInput && duesInput.value.trim() == '') {
                                                                    var popup = document.getElementById('pop-up');
                                                                    popup.innerText = "";
                                                                    popup.style.display = 'block';
                                                                    popup.style.position = 'fixed';
                                                                    popup.style.top = '15%';
                                                                    popup.style.right = '30%';
                                                                    popup.style.backgroundColor = '#f8d7da';
                                                                    popup.style.color = '#721c24';
                                                                    popup.style.padding = '10px';
                                                                    popup.style.borderRadius = '5px';
                                                                    popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                    popup.style.zIndex = '9999';
                                                                    popup.innerText = 'Add the amount of remaining dues!';

                                                                    // Hide the popup after 3 seconds
                                                                    setTimeout(function() {
                                                                        popup.style.display = 'none';
                                                                    }, 3000);
                                                                } else {
                                                                    var dues = duesInput.value.trim();
                                                                    var the_fee_id = item.main_data.fee_id;
                                                                    var fee_id = the_fee_id;
                                                                    var student_id = item.main_data.student_id;
                                                                    var name = item.main_data.name;
                                                                    var roll_no = item.main_data.roll_no;
                                                                    var total_fee = item.main_data.total_fee;
                                                                    var year = item.main_data.year;
                                                                    var month = item.main_data.month;

                                                                    var xhr = new XMLHttpRequest();
                                                                    xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                    xhr.onreadystatechange = function() {
                                                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                                                            try {
                                                                                var response = JSON.parse(xhr.responseText);
                                                                                // console.log(response);
                                                                                if (response.length > 0) {
                                                                                    // Loop through each result
                                                                                    response.forEach(function(data) {
                                                                                        if (data.message.includes('paid')) {
                                                                                            document.getElementById(item.main_data.fee_id).style.display = "none";
                                                                                            var popup = document.getElementById('pop-up');
                                                                                            popup.innerText = "";
                                                                                            popup.style.display = 'block';
                                                                                            popup.style.position = 'fixed';
                                                                                            popup.style.top = '15%';
                                                                                            popup.style.right = '30%';
                                                                                            popup.style.backgroundColor = '#d4edda';
                                                                                            popup.style.color = '#155724';
                                                                                            popup.style.padding = '10px';
                                                                                            popup.style.borderRadius = '5px';
                                                                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                            popup.style.zIndex = '9999';
                                                                                            popup.innerText = data.message;

                                                                                            // Hide the popup after 3 seconds
                                                                                            setTimeout(function() {
                                                                                                popup.style.display = 'none';
                                                                                            }, 3000);
                                                                                        } else if (data.message.includes('error')) {
                                                                                            var popup = document.getElementById('pop-up');
                                                                                            popup.innerText = "";
                                                                                            popup.style.display = 'block';
                                                                                            popup.style.position = 'fixed';
                                                                                            popup.style.top = '15%';
                                                                                            popup.style.right = '30%';
                                                                                            popup.style.backgroundColor = '#f8d7da';
                                                                                            popup.style.color = '#721c24';
                                                                                            popup.style.padding = '10px';
                                                                                            popup.style.borderRadius = '5px';
                                                                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                            popup.style.zIndex = '9999';
                                                                                            popup.innerText = data.message;

                                                                                            // Hide the popup after 3 seconds
                                                                                            setTimeout(function() {
                                                                                                popup.style.display = 'none';
                                                                                            }, 3000);
                                                                                        }
                                                                                    });
                                                                                }
                                                                            } catch (e) {
                                                                                console.error('Error parsing JSON:', e);
                                                                                console.error('Response text:', xhr.responseText);
                                                                            }
                                                                        }
                                                                    };
                                                                    xhr.send('fee_clear_dues=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month) + '&dues=' + encodeURIComponent(dues));
                                                                }
                                                            }
                                                        };
                                                        buttonsContainer.appendChild(button);
                                                    });

                                                    form.appendChild(buttonsContainer);

                                                    // Assemble structure
                                                    tabPane.appendChild(tableContainer);
                                                    tabPane.appendChild(form);
                                                    tabContent.appendChild(tabPane);

                                                    cardBody.appendChild(navTabs);
                                                    cardBody.appendChild(tabContent);

                                                    card.appendChild(cardBody);
                                                    feeTab.appendChild(card);
                                                    //   console.log(feeTab);
                                                    document.getElementById('show-fee').appendChild(feeTab);
                                                });
                                            } else {
                                                resultsDiv.style.display = 'none';
                                            }
                                        } catch (e) {
                                            console.error('Error parsing JSON:', e);
                                            console.error('Response text:', xhr.responseText);
                                        }
                                    }
                                };
                                xhr.send('unpaidFee=' + encodeURIComponent(rollNo));
                            };
                        });
                    } else {
                        resultsDiv.style.display = 'none';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        xhr.send('searchFee=' + encodeURIComponent(search));
    });

    // code to get all the students with unpaid fees
    function feeStudents() {
        var input = 'fee-input';
        var dropdown = 'fee-menu';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/search-process-fee-dues.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    var resultsDiv = document.getElementById(dropdown);
                    resultsDiv.innerHTML = '';
                    // console.log(response);
                    if (response.length > 0) {
                        // Show and style the results div
                        resultsDiv.style.display = 'block';
                        resultsDiv.style.maxHeight = '200px';
                        resultsDiv.style.overflowY = 'scroll';
                        resultsDiv.style.cursor = 'pointer';
                        resultsDiv.style.position = "absolute";
                        resultsDiv.style.top = "100%";
                        resultsDiv.style.width = "100%";

                        // Loop through each result
                        response.forEach(function(item) {
                            var resultItem = document.createElement('div');
                            // Bootstrap styling for each item
                            resultItem.classList.add('dropdown-item');

                            // Create element
                            var name = document.createElement('span');
                            name.textContent = item.name + ' - roll#' + item.roll_no;
                            name.style.display = 'block';
                            resultItem.appendChild(name);

                            // Add the result item to the results div
                            resultsDiv.appendChild(resultItem);

                            // Add onclick event for each result item
                            resultItem.onclick = function() {
                                var rollNo = item.roll_no;
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        try {
                                            var response = JSON.parse(xhr.responseText);
                                            // console.log(response);
                                            if (Object.keys(response).length > 0) {
                                                var the_div = document.getElementById('show-fee');
                                                the_div.innerHTML = "";

                                                // Loop through each result
                                                Object.keys(response).forEach(function(main_id) {
                                                    var item = response[main_id];

                                                    const feeTab = document.createElement('div');
                                                    feeTab.className = 'col-xl-8';
                                                    feeTab.id = '' + item.main_data.fee_id + '';

                                                    const card = document.createElement('div');
                                                    card.className = 'card';

                                                    const cardBody = document.createElement('div');
                                                    cardBody.className = 'card-body pt-3';

                                                    // Bordered Tabs
                                                    const navTabs = document.createElement('ul');
                                                    navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                                                    const navItem = document.createElement('li');
                                                    navItem.className = 'nav-item';

                                                    const navLink = document.createElement('button');
                                                    navLink.className = 'nav-link active';
                                                    navLink.setAttribute('data-bs-toggle', 'tab');
                                                    navLink.setAttribute('data-bs-target', '#profile-edit');
                                                    navLink.textContent = 'Student Fee';

                                                    navItem.appendChild(navLink);
                                                    navTabs.appendChild(navItem);

                                                    // Tab Content
                                                    const tabContent = document.createElement('div');
                                                    tabContent.className = 'tab-content pt-2';

                                                    const tabPane = document.createElement('div');
                                                    tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                                                    tabPane.id = 'profile-edit';

                                                    // Table
                                                    const tableContainer = document.createElement('div');
                                                    tableContainer.className = 'table-responsive';

                                                    const table = document.createElement('table');
                                                    table.className = 'table table-bordered border-primary';

                                                    const thead = document.createElement('thead');
                                                    const headerRow = document.createElement('tr');
                                                    ['Reg#', 'Name', 'Monthly Fee', 'Funds', 'Total Fee', 'Month'].forEach(text => {
                                                        const th = document.createElement('th');
                                                        th.scope = 'col';
                                                        th.textContent = text;
                                                        headerRow.appendChild(th);
                                                    });
                                                    thead.appendChild(headerRow);

                                                    const tbody = document.createElement('tbody');
                                                    const tableRow = document.createElement('tr');
                                                    tableRow.id = 'fee-t-row';

                                                    let arr = [item.main_data.roll_no, item.main_data.name, item.main_data.monthly_fee, item.main_data.name, item.main_data.total_fee, item.main_data.month + ', ' + item.main_data.year];
                                                    for (let i = 0; i < 6; i++) {
                                                        const td = document.createElement('td');
                                                        if (i === 3) {
                                                            td.className = 'text-center';
                                                            const span = document.createElement('span');
                                                            span.className = 'd-inline-block text-center';
                                                            span.setAttribute('tabindex', '0');
                                                            span.setAttribute('data-bs-toggle', 'tooltip');
                                                            if (!item.funds) {
                                                                span.setAttribute('title', '---');
                                                            } else {
                                                                span.setAttribute('title', item.funds);
                                                            }

                                                            const button = document.createElement('button');
                                                            button.type = 'button';
                                                            button.className = 'btn btn-sm btn-outline-dark';
                                                            const icon = document.createElement('i');
                                                            icon.className = 'fas fa-question pro-header-icon ms-2';
                                                            button.appendChild(icon);
                                                            span.appendChild(button);
                                                            td.appendChild(span);
                                                        } else {
                                                            td.innerText = arr[i];
                                                        }
                                                        tableRow.appendChild(td);
                                                    }
                                                    tbody.appendChild(tableRow);

                                                    table.appendChild(thead);
                                                    table.appendChild(tbody);
                                                    tableContainer.appendChild(table);

                                                    // Form
                                                    const form = document.createElement('div');

                                                    const formRow = document.createElement('div');
                                                    formRow.className = 'row mb-3';

                                                    const col = document.createElement('div');
                                                    col.className = 'col-md-8 col-lg-9 mt-2';

                                                    const duesInput = document.createElement('input');
                                                    duesInput.name = 'dues';
                                                    duesInput.type = 'text';
                                                    duesInput.id = "reason" + item.main_data.fee_id + '';
                                                    duesInput.className = 'form-control';
                                                    duesInput.placeholder = 'Remaining dues (if fees is not full paid)';
                                                    col.appendChild(duesInput);
                                                    formRow.appendChild(col);

                                                    form.appendChild(formRow);

                                                    const buttonsContainer = document.createElement('div');
                                                    buttonsContainer.className = 'text-center';

                                                    ['Full Paid', 'Add dues'].forEach((text, index) => {
                                                        const button = document.createElement('button');
                                                        button.type = 'submit';
                                                        button.name = index === 0 ? 'paid' : 'due';
                                                        button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                                                        button.textContent = text;
                                                        // Add onclick event to the button
                                                        button.onclick = function() {
                                                            // console.log(`${text} button clicked`);
                                                            if (text === 'Full Paid') {
                                                                var the_fee_id = item.main_data.fee_id;
                                                                var fee_id = the_fee_id;
                                                                var student_id = item.main_data.student_id;
                                                                var name = item.main_data.name;
                                                                var roll_no = item.main_data.roll_no;
                                                                var total_fee = item.main_data.total_fee;
                                                                var year = item.main_data.year;
                                                                var month = item.main_data.month;

                                                                var xhr = new XMLHttpRequest();
                                                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                                        try {
                                                                            var response = JSON.parse(xhr.responseText);
                                                                            // console.log(response);
                                                                            if (response.length > 0) {
                                                                                // Loop through each result
                                                                                response.forEach(function(data) {
                                                                                    if (data.message.includes('paid')) {
                                                                                        document.getElementById(item.main_data.fee_id).style.display = "none";
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#d4edda';
                                                                                        popup.style.color = '#155724';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    } else if (data.message.includes('error')) {
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#f8d7da';
                                                                                        popup.style.color = '#721c24';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    }
                                                                                });
                                                                            } else {
                                                                                resultsDiv.style.display = 'none';
                                                                            }
                                                                        } catch (e) {
                                                                            console.error('Error parsing JSON:', e);
                                                                            console.error('Response text:', xhr.responseText);
                                                                        }
                                                                    }
                                                                };
                                                                xhr.send('all_fee_clear=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month));

                                                            } else if (text === 'Add dues') {
                                                                const duesInput = document.getElementById('reason' + item.main_data.fee_id);
                                                                if (duesInput && duesInput.value.trim() == '') {
                                                                    var popup = document.getElementById('pop-up');
                                                                    popup.innerText = "";
                                                                    popup.style.display = 'block';
                                                                    popup.style.position = 'fixed';
                                                                    popup.style.top = '15%';
                                                                    popup.style.right = '30%';
                                                                    popup.style.backgroundColor = '#f8d7da';
                                                                    popup.style.color = '#721c24';
                                                                    popup.style.padding = '10px';
                                                                    popup.style.borderRadius = '5px';
                                                                    popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                    popup.style.zIndex = '9999';
                                                                    popup.innerText = 'Add the amount of remaining dues!';

                                                                    // Hide the popup after 3 seconds
                                                                    setTimeout(function() {
                                                                        popup.style.display = 'none';
                                                                    }, 3000);
                                                                } else {
                                                                    var dues = duesInput.value.trim();
                                                                    var the_fee_id = item.main_data.fee_id;
                                                                    var fee_id = the_fee_id;
                                                                    var student_id = item.main_data.student_id;
                                                                    var name = item.main_data.name;
                                                                    var roll_no = item.main_data.roll_no;
                                                                    var total_fee = item.main_data.total_fee;
                                                                    var year = item.main_data.year;
                                                                    var month = item.main_data.month;

                                                                    var xhr = new XMLHttpRequest();
                                                                    xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                    xhr.onreadystatechange = function() {
                                                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                                                            try {
                                                                                var response = JSON.parse(xhr.responseText);
                                                                                // console.log(response);
                                                                                if (response.length > 0) {
                                                                                    // Loop through each result
                                                                                    response.forEach(function(data) {
                                                                                        if (data.message.includes('paid')) {
                                                                                            document.getElementById(item.main_data.fee_id).style.display = "none";
                                                                                            var popup = document.getElementById('pop-up');
                                                                                            popup.innerText = "";
                                                                                            popup.style.display = 'block';
                                                                                            popup.style.position = 'fixed';
                                                                                            popup.style.top = '15%';
                                                                                            popup.style.right = '30%';
                                                                                            popup.style.backgroundColor = '#d4edda';
                                                                                            popup.style.color = '#155724';
                                                                                            popup.style.padding = '10px';
                                                                                            popup.style.borderRadius = '5px';
                                                                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                            popup.style.zIndex = '9999';
                                                                                            popup.innerText = data.message;

                                                                                            // Hide the popup after 3 seconds
                                                                                            setTimeout(function() {
                                                                                                popup.style.display = 'none';
                                                                                            }, 3000);
                                                                                        } else if (data.message.includes('error')) {
                                                                                            var popup = document.getElementById('pop-up');
                                                                                            popup.innerText = "";
                                                                                            popup.style.display = 'block';
                                                                                            popup.style.position = 'fixed';
                                                                                            popup.style.top = '15%';
                                                                                            popup.style.right = '30%';
                                                                                            popup.style.backgroundColor = '#f8d7da';
                                                                                            popup.style.color = '#721c24';
                                                                                            popup.style.padding = '10px';
                                                                                            popup.style.borderRadius = '5px';
                                                                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                            popup.style.zIndex = '9999';
                                                                                            popup.innerText = data.message;

                                                                                            // Hide the popup after 3 seconds
                                                                                            setTimeout(function() {
                                                                                                popup.style.display = 'none';
                                                                                            }, 3000);
                                                                                        }
                                                                                    });
                                                                                }
                                                                            } catch (e) {
                                                                                console.error('Error parsing JSON:', e);
                                                                                console.error('Response text:', xhr.responseText);
                                                                            }
                                                                        }
                                                                    };
                                                                    xhr.send('fee_clear_dues=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month) + '&dues=' + encodeURIComponent(dues));
                                                                }
                                                            }
                                                        };
                                                        buttonsContainer.appendChild(button);
                                                    });

                                                    form.appendChild(buttonsContainer);

                                                    // Assemble structure
                                                    tabPane.appendChild(tableContainer);
                                                    tabPane.appendChild(form);
                                                    tabContent.appendChild(tabPane);

                                                    cardBody.appendChild(navTabs);
                                                    cardBody.appendChild(tabContent);

                                                    card.appendChild(cardBody);
                                                    feeTab.appendChild(card);
                                                    //   console.log(feeTab);
                                                    document.getElementById('show-fee').appendChild(feeTab);
                                                });
                                            } else {
                                                resultsDiv.style.display = 'none';
                                            }
                                        } catch (e) {
                                            console.error('Error parsing JSON:', e);
                                            console.error('Response text:', xhr.responseText);
                                        }
                                    }
                                };
                                xhr.send('unpaidFee=' + encodeURIComponent(rollNo));
                            };
                        });
                    } else {
                        resultsDiv.style.display = 'none';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        xhr.send('allQueryF=' + encodeURIComponent('1'));
    }

    let dues = document.getElementById('dues-input');
    dues.addEventListener('keyup', function() {
        let search = dues.value.trim();
        var input = 'dues-input';
        var dropdown = 'dues-menu';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/search-process-fee-dues.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    var resultsDiv = document.getElementById(dropdown);
                    resultsDiv.innerHTML = '';
                    // console.log(response);
                    if (response.length > 0) {
                        // Show and style the results div
                        resultsDiv.style.display = 'block';
                        resultsDiv.style.maxHeight = '200px';
                        resultsDiv.style.overflowY = 'scroll';
                        resultsDiv.style.cursor = 'pointer';
                        resultsDiv.style.position = "absolute";
                        resultsDiv.style.top = "100%";
                        resultsDiv.style.width = "100%";

                        // Loop through each result
                        response.forEach(function(item) {
                            var resultItem = document.createElement('div');
                            // Bootstrap styling for each item
                            resultItem.classList.add('dropdown-item');

                            // Create element
                            var name = document.createElement('span');
                            name.textContent = item.name + ' - roll#' + item.roll_no;
                            name.style.display = 'block';
                            resultItem.appendChild(name);

                            // Add the result item to the results div
                            resultsDiv.appendChild(resultItem);

                            // Add onclick event for each result item
                            resultItem.onclick = function() {
                                var rollNo = item.roll_no;
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        try {
                                            var response = JSON.parse(xhr.responseText);
                                            // console.log(response);
                                            if (Object.keys(response).length > 0) {
                                                var the_div = document.getElementById('show-fee');
                                                the_div.innerHTML = "";

                                                const feeTab = document.createElement('div');
                                                feeTab.className = 'col-xl-8';
                                                feeTab.id = 'top-id-change';

                                                const card = document.createElement('div');
                                                card.className = 'card';

                                                const cardBody = document.createElement('div');
                                                cardBody.className = 'card-body pt-3';

                                                // Bordered Tabs
                                                const navTabs = document.createElement('ul');
                                                navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                                                const navItem = document.createElement('li');
                                                navItem.className = 'nav-item';

                                                const navLink = document.createElement('button');
                                                navLink.className = 'nav-link active';
                                                navLink.setAttribute('data-bs-toggle', 'tab');
                                                navLink.setAttribute('data-bs-target', '#profile-edit');
                                                navLink.textContent = 'Student Dues';

                                                navItem.appendChild(navLink);
                                                navTabs.appendChild(navItem);

                                                // Tab Content
                                                const tabContent = document.createElement('div');
                                                tabContent.className = 'tab-content pt-2';

                                                const tabPane = document.createElement('div');
                                                tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                                                tabPane.id = 'profile-edit';

                                                // Table
                                                const tableContainer = document.createElement('div');
                                                tableContainer.className = 'table-responsive';

                                                const table = document.createElement('table');
                                                table.className = 'table table-bordered border-primary';

                                                const thead = document.createElement('thead');
                                                const headerRow = document.createElement('tr');
                                                ['Reg#', 'Name', 'Month', 'Dues'].forEach(text => {
                                                    const th = document.createElement('th');
                                                    th.scope = 'col';
                                                    th.textContent = text;
                                                    headerRow.appendChild(th);
                                                });
                                                thead.appendChild(headerRow);

                                                const tbody = document.createElement('tbody');

                                                var student_id;
                                                var name;
                                                var roll_no;
                                                var total_dues = 0;

                                                Object.keys(response).forEach(function(main_id) {
                                                    var item = response[main_id];

                                                    // Assign variables
                                                    student_id = item.main_data.student_id;
                                                    name = item.main_data.name;
                                                    roll_no = item.main_data.roll_no;
                                                    // Update total dues
                                                    total_dues += parseInt(item.main_data.pending_dues);

                                                    // Create table row
                                                    const tableRow = document.createElement('tr');

                                                    // Array to hold row data
                                                    let arr = [
                                                        item.main_data.roll_no,
                                                        item.main_data.name,
                                                        item.main_data.month + ', ' + item.main_data.year,
                                                        item.main_data.pending_dues,
                                                    ];

                                                    // Loop through array and add cells
                                                    arr.forEach(function(text) {
                                                        const td = document.createElement('td');
                                                        td.innerText = text;
                                                        tableRow.appendChild(td);
                                                    });

                                                    // Append the row to tbody inside the loop
                                                    tbody.appendChild(tableRow);
                                                });

                                                const tableRow = document.createElement('tr');
                                                const td = document.createElement('td');
                                                td.colSpan = "3";
                                                td.innerHTML = "<strong>Total Dues</strong>";
                                                const td1 = document.createElement('td');
                                                td1.innerText = total_dues;
                                                tableRow.appendChild(td);
                                                tableRow.appendChild(td1);

                                                tbody.appendChild(tableRow);

                                                // Update the ID for top element based on the last roll_no
                                                // var change_id = document.getElementById('top-id-change');
                                                // if (change_id) {
                                                //   change_id.id = roll_no;
                                                // }

                                                table.appendChild(thead);
                                                table.appendChild(tbody);
                                                tableContainer.appendChild(table);

                                                // Form
                                                const form = document.createElement('div');

                                                const formRow = document.createElement('div');
                                                formRow.className = 'row mb-3';

                                                const col = document.createElement('div');
                                                col.className = 'col-md-8 col-lg-9 mt-2';

                                                const duesInput = document.createElement('input');
                                                duesInput.name = 'paid_amount';
                                                duesInput.type = 'text';
                                                duesInput.id = "paid_amount";
                                                duesInput.className = 'form-control';
                                                duesInput.placeholder = 'Amount (Rs.) that student paid';
                                                col.appendChild(duesInput);
                                                formRow.appendChild(col);

                                                form.appendChild(formRow);

                                                const buttonsContainer = document.createElement('div');
                                                buttonsContainer.className = 'text-center';

                                                ['Clear Dues'].forEach((text, index) => {
                                                    const button = document.createElement('button');
                                                    button.type = 'submit';
                                                    button.name = index === 0 ? 'paid' : 'due';
                                                    button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                                                    button.textContent = text;
                                                    // Add onclick event to the button
                                                    button.onclick = function() {
                                                        // console.log(`${text} button clicked`);
                                                        if (text === 'Clear Dues') {
                                                            const duesInput = document.getElementById('paid_amount');
                                                            if (duesInput && duesInput.value.trim() == '') {
                                                                var popup = document.getElementById('pop-up');
                                                                popup.innerText = "";
                                                                popup.style.display = 'block';
                                                                popup.style.position = 'fixed';
                                                                popup.style.top = '15%';
                                                                popup.style.right = '30%';
                                                                popup.style.backgroundColor = '#f8d7da';
                                                                popup.style.color = '#721c24';
                                                                popup.style.padding = '10px';
                                                                popup.style.borderRadius = '5px';
                                                                popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                popup.style.zIndex = '9999';
                                                                popup.innerText = 'Add how much amount student paid!';

                                                                // Hide the popup after 3 seconds
                                                                setTimeout(function() {
                                                                    popup.style.display = 'none';
                                                                }, 3000);
                                                            } else {
                                                                var total_paid = duesInput.value.trim();
                                                                var xhr = new XMLHttpRequest();
                                                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                                        try {
                                                                            var response = JSON.parse(xhr.responseText);
                                                                            console.log(response);
                                                                            if (response.length > 0) {
                                                                                // Loop through each result
                                                                                response.forEach(function(data) {
                                                                                    if (data.message.includes('cleared')) {
                                                                                        document.getElementById('top-id-change').style.display = "none";
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#d4edda';
                                                                                        popup.style.color = '#155724';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    } else if (data.message.includes('error')) {
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#f8d7da';
                                                                                        popup.style.color = '#721c24';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    }
                                                                                });
                                                                            } else {
                                                                                resultsDiv.style.display = 'none';
                                                                            }
                                                                        } catch (e) {
                                                                            console.error('Error parsing JSON:', e);
                                                                            console.error('Response text:', xhr.responseText);
                                                                        }
                                                                    }
                                                                };
                                                                xhr.send('clear_dues=done&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_dues=' + encodeURIComponent(total_dues) + '&total_paid=' + encodeURIComponent(total_paid));
                                                            }

                                                        }
                                                    };
                                                    buttonsContainer.appendChild(button);
                                                });

                                                form.appendChild(buttonsContainer);

                                                // Assemble structure
                                                tabPane.appendChild(tableContainer);
                                                tabPane.appendChild(form);
                                                tabContent.appendChild(tabPane);

                                                cardBody.appendChild(navTabs);
                                                cardBody.appendChild(tabContent);

                                                card.appendChild(cardBody);
                                                feeTab.appendChild(card);
                                                //   console.log(feeTab);
                                                document.getElementById('show-fee').appendChild(feeTab);
                                            } else {
                                                resultsDiv.style.display = 'none';
                                            }
                                        } catch (e) {
                                            console.error('Error parsing JSON:', e);
                                            console.error('Response text:', xhr.responseText);
                                        }
                                    }
                                };
                                xhr.send('pendingDues=' + encodeURIComponent(rollNo));
                            };
                        });
                    } else {
                        resultsDiv.style.display = 'none';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        xhr.send('searchDues=' + encodeURIComponent(search));
    });

    // code to get all the teachers of the school
    function duesStudents() {
        var input = 'dues-input';
        var dropdown = 'dues-menu';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/search-process-fee-dues.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    var resultsDiv = document.getElementById(dropdown);
                    resultsDiv.innerHTML = '';
                    // console.log(response);
                    if (response.length > 0) {
                        // Show and style the results div
                        resultsDiv.style.display = 'block';
                        resultsDiv.style.maxHeight = '200px';
                        resultsDiv.style.overflowY = 'scroll';
                        resultsDiv.style.cursor = 'pointer';
                        resultsDiv.style.position = "absolute";
                        resultsDiv.style.top = "100%";
                        resultsDiv.style.width = "100%";

                        // Loop through each result
                        response.forEach(function(item) {
                            var resultItem = document.createElement('div');
                            // Bootstrap styling for each item
                            resultItem.classList.add('dropdown-item');

                            // Create element
                            var name = document.createElement('span');
                            name.textContent = item.name + ' - roll#' + item.roll_no;
                            name.style.display = 'block';
                            resultItem.appendChild(name);

                            // Add the result item to the results div
                            resultsDiv.appendChild(resultItem);

                            // Add onclick event for each result item
                            resultItem.onclick = function() {
                                var rollNo = item.roll_no;
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        try {
                                            var response = JSON.parse(xhr.responseText);
                                            // console.log(response);
                                            if (Object.keys(response).length > 0) {
                                                var the_div = document.getElementById('show-fee');
                                                the_div.innerHTML = "";

                                                const feeTab = document.createElement('div');
                                                feeTab.className = 'col-xl-8';
                                                feeTab.id = 'top-id-change';

                                                const card = document.createElement('div');
                                                card.className = 'card';

                                                const cardBody = document.createElement('div');
                                                cardBody.className = 'card-body pt-3';

                                                // Bordered Tabs
                                                const navTabs = document.createElement('ul');
                                                navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                                                const navItem = document.createElement('li');
                                                navItem.className = 'nav-item';

                                                const navLink = document.createElement('button');
                                                navLink.className = 'nav-link active';
                                                navLink.setAttribute('data-bs-toggle', 'tab');
                                                navLink.setAttribute('data-bs-target', '#profile-edit');
                                                navLink.textContent = 'Student Dues';

                                                navItem.appendChild(navLink);
                                                navTabs.appendChild(navItem);

                                                // Tab Content
                                                const tabContent = document.createElement('div');
                                                tabContent.className = 'tab-content pt-2';

                                                const tabPane = document.createElement('div');
                                                tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                                                tabPane.id = 'profile-edit';

                                                // Table
                                                const tableContainer = document.createElement('div');
                                                tableContainer.className = 'table-responsive';

                                                const table = document.createElement('table');
                                                table.className = 'table table-bordered border-primary';

                                                const thead = document.createElement('thead');
                                                const headerRow = document.createElement('tr');
                                                ['Reg#', 'Name', 'Month', 'Dues'].forEach(text => {
                                                    const th = document.createElement('th');
                                                    th.scope = 'col';
                                                    th.textContent = text;
                                                    headerRow.appendChild(th);
                                                });
                                                thead.appendChild(headerRow);

                                                const tbody = document.createElement('tbody');

                                                var student_id;
                                                var name;
                                                var roll_no;
                                                var total_dues = 0;

                                                Object.keys(response).forEach(function(main_id) {
                                                    var item = response[main_id];

                                                    // Assign variables
                                                    student_id = item.main_data.student_id;
                                                    name = item.main_data.name;
                                                    roll_no = item.main_data.roll_no;
                                                    // Update total dues
                                                    total_dues += parseInt(item.main_data.pending_dues);

                                                    // Create table row
                                                    const tableRow = document.createElement('tr');

                                                    // Array to hold row data
                                                    let arr = [
                                                        item.main_data.roll_no,
                                                        item.main_data.name,
                                                        item.main_data.month + ', ' + item.main_data.year,
                                                        item.main_data.pending_dues,
                                                    ];

                                                    // Loop through array and add cells
                                                    arr.forEach(function(text) {
                                                        const td = document.createElement('td');
                                                        td.innerText = text;
                                                        tableRow.appendChild(td);
                                                    });

                                                    // Append the row to tbody inside the loop
                                                    tbody.appendChild(tableRow);
                                                });

                                                const tableRow = document.createElement('tr');
                                                const td = document.createElement('td');
                                                td.colSpan = "3";
                                                td.innerHTML = "<strong>Total Dues</strong>";
                                                const td1 = document.createElement('td');
                                                td1.innerText = total_dues;
                                                tableRow.appendChild(td);
                                                tableRow.appendChild(td1);

                                                tbody.appendChild(tableRow);

                                                table.appendChild(thead);
                                                table.appendChild(tbody);
                                                tableContainer.appendChild(table);

                                                // Form
                                                const form = document.createElement('div');

                                                const formRow = document.createElement('div');
                                                formRow.className = 'row mb-3';

                                                const col = document.createElement('div');
                                                col.className = 'col-md-8 col-lg-9 mt-2';

                                                const duesInput = document.createElement('input');
                                                duesInput.name = 'paid_amount';
                                                duesInput.type = 'text';
                                                duesInput.id = "paid_amount";
                                                duesInput.className = 'form-control';
                                                duesInput.placeholder = 'Amount (Rs.) that student paid';
                                                col.appendChild(duesInput);
                                                formRow.appendChild(col);

                                                form.appendChild(formRow);

                                                const buttonsContainer = document.createElement('div');
                                                buttonsContainer.className = 'text-center';

                                                ['Clear Dues'].forEach((text, index) => {
                                                    const button = document.createElement('button');
                                                    button.type = 'submit';
                                                    button.name = index === 0 ? 'paid' : 'due';
                                                    button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                                                    button.textContent = text;
                                                    // Add onclick event to the button
                                                    button.onclick = function() {
                                                        // console.log(`${text} button clicked`);
                                                        if (text === 'Clear Dues') {
                                                            const duesInput = document.getElementById('paid_amount');
                                                            if (duesInput && duesInput.value.trim() == '') {
                                                                var popup = document.getElementById('pop-up');
                                                                popup.innerText = "";
                                                                popup.style.display = 'block';
                                                                popup.style.position = 'fixed';
                                                                popup.style.top = '15%';
                                                                popup.style.right = '30%';
                                                                popup.style.backgroundColor = '#f8d7da';
                                                                popup.style.color = '#721c24';
                                                                popup.style.padding = '10px';
                                                                popup.style.borderRadius = '5px';
                                                                popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                popup.style.zIndex = '9999';
                                                                popup.innerText = 'Add how much amount student paid!';

                                                                // Hide the popup after 3 seconds
                                                                setTimeout(function() {
                                                                    popup.style.display = 'none';
                                                                }, 3000);
                                                            } else {
                                                                var total_paid = duesInput.value.trim();
                                                                var xhr = new XMLHttpRequest();
                                                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                                        try {
                                                                            var response = JSON.parse(xhr.responseText);
                                                                            console.log(response);
                                                                            if (response.length > 0) {
                                                                                // Loop through each result
                                                                                response.forEach(function(data) {
                                                                                    if (data.message.includes('cleared')) {
                                                                                        document.getElementById('top-id-change').style.display = "none";
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#d4edda';
                                                                                        popup.style.color = '#155724';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    } else if (data.message.includes('error')) {
                                                                                        var popup = document.getElementById('pop-up');
                                                                                        popup.innerText = "";
                                                                                        popup.style.display = 'block';
                                                                                        popup.style.position = 'fixed';
                                                                                        popup.style.top = '15%';
                                                                                        popup.style.right = '30%';
                                                                                        popup.style.backgroundColor = '#f8d7da';
                                                                                        popup.style.color = '#721c24';
                                                                                        popup.style.padding = '10px';
                                                                                        popup.style.borderRadius = '5px';
                                                                                        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                                                                        popup.style.zIndex = '9999';
                                                                                        popup.innerText = data.message;

                                                                                        // Hide the popup after 3 seconds
                                                                                        setTimeout(function() {
                                                                                            popup.style.display = 'none';
                                                                                        }, 3000);
                                                                                    }
                                                                                });
                                                                            } else {
                                                                                resultsDiv.style.display = 'none';
                                                                            }
                                                                        } catch (e) {
                                                                            console.error('Error parsing JSON:', e);
                                                                            console.error('Response text:', xhr.responseText);
                                                                        }
                                                                    }
                                                                };
                                                                xhr.send('clear_dues=done&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_dues=' + encodeURIComponent(total_dues) + '&total_paid=' + encodeURIComponent(total_paid));
                                                            }

                                                        }
                                                    };
                                                    buttonsContainer.appendChild(button);
                                                });

                                                form.appendChild(buttonsContainer);

                                                // Assemble structure
                                                tabPane.appendChild(tableContainer);
                                                tabPane.appendChild(form);
                                                tabContent.appendChild(tabPane);

                                                cardBody.appendChild(navTabs);
                                                cardBody.appendChild(tabContent);

                                                card.appendChild(cardBody);
                                                feeTab.appendChild(card);
                                                //   console.log(feeTab);
                                                document.getElementById('show-fee').appendChild(feeTab);
                                            } else {
                                                resultsDiv.style.display = 'none';
                                            }
                                        } catch (e) {
                                            console.error('Error parsing JSON:', e);
                                            console.error('Response text:', xhr.responseText);
                                        }
                                    }
                                };
                                xhr.send('pendingDues=' + encodeURIComponent(rollNo));
                            };
                        });
                    } else {
                        resultsDiv.style.display = 'none';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        xhr.send('allQueryD=' + encodeURIComponent('1'));
    }
</script>