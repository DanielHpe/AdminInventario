function tableAsArray(){

    var tableHead = $("table#table-server tr").find('th');
    var tableData = $("table#table-server tr").find('td');

    if(tableData.toArray().length === 1){
        return 0;
    }

    return $.merge(tableHead.toArray(), tableData.toArray())
}

Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() +"/"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"/"+ this.getFullYear();
}

Date.prototype.timeNow = function () {
    return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}

$(document).ready( function () {

    var table = $('#table-server').DataTable({
        order: [[0, 'DESC']],
        responsive: true,  
    });

    $("#exportCSV").bind("click", function(){

        var tableData = tableAsArray();
        let row = "";
        var csvContent = "data:text/csv;charset=utf-8,";
        var cont = 1;

        if(tableData === 0){
            alert('Nenhum dado para ser gerado');
        } else {
            tableData.forEach(function(element){
                row += element.innerText + ",";
                if(cont % 12 === 0){
                    csvContent += row + "\n";
                    row = "";
                    cont = 0;
                }
                cont++;
            });
            
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "inventario" + new Date().today() + " @ " + new Date().timeNow() + ".csv");
            document.body.appendChild(link);
            
            link.click();
        }
    })

    $(function() {

        var start = moment("2019-01-01");
        var end = moment();
    
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));    
        }
    
        $('#reportrange').daterangepicker({
          startDate: start,
          endDate: end,
          ranges: {
            'Todos': [moment("2019-01-01"), moment()],
            'Hoje': [moment(), moment()],
            'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Esse ano': [moment().startOf('year'), moment()],
            'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
        }, cb);
    
        cb(start, end);
    
    });

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        var start = picker.startDate;
        var end = picker.endDate;     

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = start;
                var max = end;
                var startDate = new Date(data[0]);

                if (min == null && max == null) {
                    return true;
                }
                if (min == null && startDate <= max) {
                    return true;
                }
                if (max == null && startDate >= min) {
                    return true;
                }
                if (startDate <= max && startDate >= min) {
                    return true;
                }
                return false;                    
            }
        );
        table.draw();
        $.fn.dataTable.ext.search.pop();
    });

    

});