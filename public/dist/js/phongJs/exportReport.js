var selectTypeReport = document.getElementById('report');
var selectCategoryReport = document.getElementById('categoryReport');
selectCategoryReport.addEventListener('change',function () {
    var strHtml = '';
    document.getElementById('dateRangeReport').disabled = true;
    if (selectCategoryReport.value === "book") {
        strHtml = `<option value="" selected>Lựa chọn loại báo cáo cần xuất</option>
                <option value="bookRent">Thống kê sách được mượn theo thời gian</option>
                <option value="bookMissing">Thống kê sách đang thất lạc</option>`;
    }
    else if (selectCategoryReport.value === 'requestRent') {
        strHtml = `<option value="" selected>Lựa chọn loại báo cáo cần xuất</option>
                <option value="requestRentInDay">Thống kê yêu cầu mượn trong ngày</option>`;
    }
    else {
        strHtml = '';
    }
    selectTypeReport.innerHTML = strHtml;
})
selectTypeReport.addEventListener('change',function () {
    if (selectTypeReport.value === 'bookRent' || selectTypeReport.value === 'requestRentByDateRange') {
        document.getElementById('dateRangeReport').disabled = false;
    }
    else {
        document.getElementById('dateRangeReport').disabled = true;
        document.getElementById('dateRangeReport').value = '';
    }
})
document.getElementById('export').addEventListener('click',function () {
    event.preventDefault();

    var formData = new FormData($('#formExportReport')[0]);

    var loaderContainer = document.getElementById("loaderContainer");
    loaderContainer.classList.remove("hidden");

    $.ajax({
        url : 'http://localhost:8000/api/admin/export-report',
        method : 'POST',
        contentType: false,
        processData: false,
        xhrFields: {
            responseType: 'blob' // Để xác định kiểu dữ liệu là blob (file)
        },
        data : formData,
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
        },
        success: function (response) {
            if (response.errorValidate) {
                for (var key in response.errorValidate) {
                    strHtml = `<p style="color: red">${response.errorValidate[key][0]}</p>`
                    $('#'+key+"Error").html(strHtml);
                }
            }
            else {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(response);
                a.href = url;
                a.download = 'report.xlsx';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                alert('Xuất báo cáo thành công')
            }
            loaderContainer.classList.add("hidden");
        },
    })
})
