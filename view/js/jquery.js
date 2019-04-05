function tableAsArray(){

    var tableHead = $("table#table-server tr").find('th');
    var tableData = $("table#table-server tr").find('td');

    if(tableData.toArray().length === 1){
        return 0;
    }

    return $.merge(tableHead.toArray(), tableData.toArray())
}

$(document).ready( function () {

    $('#table-server').DataTable({
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
            link.setAttribute("download", "my_data.csv");
            document.body.appendChild(link);
            
            link.click();
        }
    })

});