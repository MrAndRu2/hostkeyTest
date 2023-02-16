<?php 
$this->registerJs(
    '$("#submit").on("click", function() {



        let postData = {
            "ownerId": $(this).siblings("#owner_id")[0].value, 
        };
        
        $.post( "/web/site/servers", postData, function( data ) {
            const responce = JSON.parse(data);
            
            if (responce["success"] == true) {
                const servers = responce["data"];
                let tableHtml = "";

                tableHtml += "<table width=\"100%\" class=\"table-bordered\">";
                tableHtml += "<tr class=\"hr\"><td width=\"350\">server.id</td><td>server.ip</td><td width=\"350\">description</td><td>server.name</td></tr>";
                if (servers.length > 0) {
                    
                    servers.forEach(function(item, i, arr) {
                        let status;

                        if(item["ip"] == null) {
                            item["ip"] = "-";
                            item["description"] = "-";
                        }

                        tableHtml += "<tr><td>" + item["id"] + "</td><td>" + item["ip"] + "</td><td>" + item["description"] + "</td><td>" + item["name"] + "</td></tr>";
                    });
                } else {
                    tableHtml += "<tr><td colspan=\"4\"> Данных нет </td></tr>";
                }
                tableHtml += "</table>";
                serverData.innerHTML = tableHtml;
            }
        });    
    });'
);
?>


<tr>
    <td>
        <p>Укажите owner_id</p>
        <input id="owner_id" value='1'>
    </td>
</tr>
<tr>
    <td>
        <button id="submit" request_id="<?= $model->id ?>" class="btn btn-primary" style="width: 23%; min-width: 100px" ?>Поехали</button>
    </td>
</tr>

<div id='serverData' style="margin-top: 20px; text-align:center;"></div>
