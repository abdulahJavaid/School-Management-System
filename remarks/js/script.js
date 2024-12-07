// document.getElementById('remarkForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     alert('Form submitted successfully!');
//     this.reset();
//   });

// for getting the selected school details
function showDetails(clientId) {
  var xhr = new XMLHttpRequest();

  xhr.open('POST', './backend/get-client-details.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // console.log(xhr.responseText);
      try {
        var response = JSON.parse(xhr.responseText);
        if (response[clientId]) {
          var clientData = response[clientId];
          var detailsHtml = '';

          // Display client main details
          if (clientData.main) {
            document.getElementById('selected-input').value = clientId;
            detailsHtml += `
            <section id="client-details" style="
              background-color: #f0f8ff;
              padding: 15px;
              border-radius: 10px;
              margin-bottom: 20px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <h3 style="color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;">Client Details</h3>
              <div style="margin-bottom: 10px;"><strong>Name:</strong> ${clientData.main.temp_client_name}</div>
              <div style="margin-bottom: 10px;"><strong>City:</strong> ${clientData.main.temp_client_city}</div>
              <div style="margin-bottom: 10px;"><strong>Phone:</strong> ${clientData.main.temp_client_phone}</div>
              <div style="margin-bottom: 10px;"><strong>Email:</strong> ${clientData.main.temp_client_email}</div>
              <div style="margin-bottom: 10px;"><strong>Address:</strong> ${clientData.main.temp_client_address}</div>
              <div style="margin-bottom: 10px;"><strong>School:</strong> ${clientData.main.temp_client_school}</div>
            </section>
          `;
          }

          // Display client remarks
          if (clientData.remarks && clientData.remarks.length > 0) {
            detailsHtml += `
            <section id="client-remarks" style="
              background-color: #fff3cd;
              padding: 15px;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <h3 style="color: #856404; border-bottom: 2px solid #ffecb5; padding-bottom: 5px;">Remarks</h3>
          `;

            clientData.remarks.forEach(function(remark) {
              detailsHtml += `
              <div style="
                margin-bottom: 15px;
                padding: 10px;
                border: 1px solid #ffeeba;
                border-radius: 5px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                <p style="margin: 0;"><strong>Remark:</strong> ${remark.temp_remark}</p>
                <p style="margin: 0; color: #6c757d;"><strong>Date:</strong> ${remark.temp_remark_date}</p>
              </div>
            `;
            });

            detailsHtml += `</section>`;
          } else {
            detailsHtml += `
            <section id="client-remarks" style="
              background-color: #fff3cd;
              padding: 15px;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <h3 style="color: #856404; border-bottom: 2px solid #ffecb5; padding-bottom: 5px;">Remarks</h3>
              <p style="margin: 0; color: #6c757d;"><em>No remarks available.</em></p>
            </section>
          `;
          }

          // Display the details on the page
          document.getElementById('main-data').innerHTML = detailsHtml;
        } else {
          document.getElementById('main-data').innerHTML = `
          <p style="
            color: #dc3545;
            text-align: center;
            padding: 15px;
            border: 1px solid #f8d7da;
            background-color: #f8d7da;
            border-radius: 5px;">No details found for this client.</p>
        `;
        }
      } catch (e) {
        console.error('Error parsing JSON:', e);
        console.error('Response text:', xhr.responseText);
      }
    }
  };
  // send ajax request
  xhr.send('temp_client_id=' + encodeURIComponent(clientId));
}

// for adding the remarks
function addRemark() {
  var client_id = document.getElementById('selected-input').value;
  if (client_id === "") {
    alert('Please select a school to add remark');
  } else {
    window.location.href = "./remark.php?client_id=" + encodeURIComponent(client_id);
  }
}

function getQueryParam(param) {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

document.addEventListener("DOMContentLoaded", function () {
  var client_id = getQueryParam('client_id');
  if (client_id) {
    document.getElementById('client-id').value = client_id;
  }
});

// for searching the schools
document.addEventListener('DOMContentLoaded', () => {
  const searchBar = document.getElementById('search-bar');

  searchBar.addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const schoolList = document.querySelectorAll('#school-names li');

    schoolList.forEach(item => {
      const text = item.textContent.toLowerCase();
      item.style.display = text.includes(filter) ? '' : 'none';
    });
  });
});


  