<script>
    // Check if the span exists (to show an alert - success alert)
    if (document.getElementById('passed-out')) {
        // Show the popup
        var popup = document.getElementById('po-success-popup');
        // console.log(popup);
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

        // Hide the popup after 3 seconds
        setTimeout(function() {
            popup.style.display = 'none';
            window.location.href = "./promote-class.php";
        }, 2000);
    }
    // Check if the span exists (to show an alert - success alert)
    if (document.getElementById('promoted')) {
        // Show the popup
        var popup = document.getElementById('p-success-popup');
        // console.log(popup);
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

        // Hide the popup after 3 seconds
        setTimeout(function() {
            popup.style.display = 'none';
            window.location.href = "./promote-class.php";
        }, 2000);
    }
    // pass-out a class
    function passOut() {
        // getting the modal
        const modal = new bootstrap.Modal(document.getElementById('passOut'));
        // getting class and section name
        var classSection = document.getElementById('po_class_section').value;
        // getting section id
        var sectionId = document.getElementById('po_section_id').value;
        // setting section_id in modal
        document.getElementById('passSectionId').value = sectionId;
        // setting section_id in modal
        document.getElementById('passClassSection').value = classSection;
        // setting modal header
        document.getElementById('staticBackdropLabel').innerText = 'Pass Out - ' + classSection;
        // showing the modal
        modal.show();
    }

    // promote a class
    function promote() {
        // getting the modal
        const modal = new bootstrap.Modal(document.getElementById('promote'));
        // getting class and section name
        var classSection = document.getElementById('p_class_section').value;
        // getting section id
        var sectionId = document.getElementById('p_section_id').value;
        // setting section_id in modal
        document.getElementById('promoteSectionId').value = sectionId;
        // setting section_id in modal
        document.getElementById('promoteClassSection').value = classSection;
        // setting modal header
        document.getElementById('pstaticBackdropLabel').innerText = 'Promote - ' + classSection;
        // showing the modal
        modal.show();
    }

    // demote a class
    function demote() {
        var selectedVals = document.getElementById('d_student_ids').value;
        if (selectedVals == "") {
            // Show the popup
            var popup = document.getElementById('d-none-selected');
            // console.log(popup);
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

            // Hide the popup after 3 seconds
            setTimeout(function() {
                popup.style.display = 'none';
            }, 3000);
        } else {
            // getting the modal
            const modal = new bootstrap.Modal(document.getElementById('demote'));
            // getting class and section name
            var classSection = document.getElementById('d_class_section').value;
            // getting section id
            var sectionId = document.getElementById('d_section_id').value;
            // getting students for demotion
            var demotedStudents = document.getElementById('d_student_ids').value;
            // setting section_id in modal
            document.getElementById('demoteSectionId').value = sectionId;
            // setting section_id in modal
            document.getElementById('demoteClassSection').value = classSection;
            // setting demoted student ids in modal
            document.getElementById('demotedStudents').value = demotedStudents;
            // setting modal header
            document.getElementById('dstaticBackdropLabel').innerText = 'Demote Students';
            // showing the modal
            modal.show();
        }
    }

    // Show class students to passout the class
    function passOutStudents(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        if (response[0].message) {
                            // display to none of class select
                            document.getElementById('class-pass-out').style.display = "none";
                            // console.log(response.message);
                            var popup = document.getElementById('po-noStudent-popup');
                            // console.log(popup);
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

                            // Hide the popup after 3 seconds
                            setTimeout(function() {
                                popup.style.display = 'none';
                            }, 3000);
                        } else {
                            // display to block of class select
                            document.getElementById('class-pass-out').style.display = "block";
                            // pushin data records in the map
                            response.forEach(function(item) {
                                subjects.show.push({
                                    id: item.id,
                                    name: item.name,
                                    roll_no: item.roll_no,
                                    class_sect: item.class_sect,
                                    section_id: item.section_id
                                });
                            });
                            var section = subjects.show[0].section_id;
                            document.getElementById('po_section_id').value = section;
                            var classSection = subjects.show[0].class_sect;
                            document.getElementById('po_class_section').value = classSection;

                            const tbody = document.getElementById('po_students_tbody');
                            tbody.innerHTML = "";
                            subjects.show.forEach(item => {
                                const tr = document.createElement('tr');
                                ['roll_no', 'name', 'class_sect'].forEach(key => {
                                    const td = document.createElement('td');
                                    td.innerText = item[key];
                                    tr.appendChild(td);
                                });
                                tbody.appendChild(tr);
                            });
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        // send ajax request
        xhr.send('passout_section_id=' + encodeURIComponent(sectionId));
    }

    // Show class students to promote the class
    function promoteStudents(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        if (response[0].message) {
                            // display to none of class select
                            document.getElementById('class-promote').style.display = "none";
                            // console.log(response.message);
                            var popup = document.getElementById('p-noStudent-popup');
                            // console.log(popup);
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

                            // Hide the popup after 3 seconds
                            setTimeout(function() {
                                popup.style.display = 'none';
                            }, 3000);
                        } else {
                            // display to block of class select
                            document.getElementById('class-promote').style.display = "block";
                            // pushin data records in the map
                            response.forEach(function(item) {
                                subjects.show.push({
                                    id: item.id,
                                    name: item.name,
                                    roll_no: item.roll_no,
                                    class_sect: item.class_sect,
                                    section_id: item.section_id
                                });
                            });
                            var section = subjects.show[0].section_id;
                            document.getElementById('p_section_id').value = section;
                            var classSection = subjects.show[0].class_sect;
                            document.getElementById('p_class_section').value = classSection;

                            const tbody = document.getElementById('p_students_tbody');
                            tbody.innerHTML = "";
                            subjects.show.forEach(item => {
                                const tr = document.createElement('tr');
                                ['roll_no', 'name', 'class_sect'].forEach(key => {
                                    const td = document.createElement('td');
                                    td.innerText = item[key];
                                    tr.appendChild(td);
                                });
                                tbody.appendChild(tr);
                            });
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        // send ajax request
        xhr.send('promote_section_id=' + encodeURIComponent(sectionId));
    }

    // Show class students to promote the class
    function demoteStudents(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        if (response[0].message) {
                            // display to none of class select
                            document.getElementById('class-demote').style.display = "none";
                            // console.log(response.message);
                            var popup = document.getElementById('d-noStudent-popup');
                            // console.log(popup);
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

                            // Hide the popup after 3 seconds
                            setTimeout(function() {
                                popup.style.display = 'none';
                            }, 3000);
                        } else {
                            // display to block of class select
                            document.getElementById('class-demote').style.display = "block";
                            // pushin data records in the map
                            response.forEach(function(item) {
                                subjects.show.push({
                                    id: item.id,
                                    name: item.name,
                                    roll_no: item.roll_no,
                                    class_sect: item.class_sect,
                                    section_id: item.section_id
                                });
                            });
                            var section = subjects.show[0].section_id;
                            document.getElementById('d_section_id').value = section;
                            var classSection = subjects.show[0].class_sect;
                            document.getElementById('d_class_section').value = classSection;

                            const tbody = document.getElementById('d_students_tbody');
                            tbody.innerHTML = "";
                            subjects.show.forEach(item => {
                                const tr = document.createElement('tr');
                                var checktd = document.createElement('td');
                                var checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.id = item['id'];
                                checkbox.value = item['id'];

                                checkbox.addEventListener("click", function() {
                                    var ifchecked = document.getElementById(checkbox.id).checked;
                                    if (ifchecked) {
                                        document.getElementById('d_student_ids').value += checkbox.value + " ";
                                    } else {
                                        var values = document.getElementById('d_student_ids').value;
                                        var toReplace = checkbox.value + " ";
                                        var updatedValues = values.replace(toReplace, "");
                                        document.getElementById('d_student_ids').value = updatedValues;
                                    }
                                });
                                checktd.appendChild(checkbox);
                                tr.appendChild(checktd);

                                ['roll_no', 'name', 'class_sect'].forEach(key => {
                                    const td = document.createElement('td');
                                    td.innerText = item[key];
                                    tr.appendChild(td);
                                });
                                tbody.appendChild(tr);
                            });
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        // send ajax request
        xhr.send('demote_section_id=' + encodeURIComponent(sectionId));
    }

    // If the class for promotion is not empty
    function ifNotEmpty(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        if (response[0].message) {
                            document.getElementById('emptySection').selectedIndex = -1;
                            var popup = document.getElementById('p-notEmpty-popup');
                            // console.log(popup);
                            popup.style.display = 'block';
                            popup.style.position = 'fixed';
                            popup.style.top = '12%';
                            popup.style.right = '33%';
                            popup.style.backgroundColor = '#f8d7da';
                            popup.style.color = '#721c24';
                            popup.style.padding = '10px';
                            popup.style.borderRadius = '5px';
                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                            popup.style.zIndex = '9999';

                            // Hide the popup after 3 seconds
                            setTimeout(function() {
                                popup.style.display = 'none';
                            }, 5000);
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        // send ajax request
        xhr.send('empty_section_id=' + encodeURIComponent(sectionId));
    }

    // If the class for demotion is empty
    function ifEmpty(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        if (response[0].message) {
                            document.getElementById('dEmptySection').selectedIndex = -1;
                            var popup = document.getElementById('d-empty-popup');
                            // console.log(popup);
                            popup.style.display = 'block';
                            popup.style.position = 'fixed';
                            popup.style.top = '12%';
                            popup.style.right = '33%';
                            popup.style.backgroundColor = '#f8d7da';
                            popup.style.color = '#721c24';
                            popup.style.padding = '10px';
                            popup.style.borderRadius = '5px';
                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                            popup.style.zIndex = '9999';

                            // Hide the popup after 3 seconds
                            setTimeout(function() {
                                popup.style.display = 'none';
                            }, 5000);
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };
        // send ajax request
        xhr.send('d_empty_section_id=' + encodeURIComponent(sectionId));
    }
</script>