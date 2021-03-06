<?php
/*
Template part for players page

Created: March 2014
*/
?>

<script>
var get = {
    sort: 'match',
    order: 'desc',
	limit: 20,
};

function toggleOrder() {
    if(get.order == 'asc') {
        get.order = 'desc';
    } else {
        get.order = 'asc';
    }
}

function setSort(q) {
    get.sort = q;
}

function loadPlayers() {
    $('#loader').fadeIn(100, function() {
        $.ajax({
            dataType: "json",
            url: '<?php echo SITE_URL; ?>core/ajax/player.php',
            data: get,
            success: function(data) {
                $('#loader').fadeOut(100, function() {
                    var html = '<tr><th><a href="#" onclick="toggleOrder();setSort(\'firstname\');loadPlayers();">Name</a></th><th class="center"><a href="#" onclick="toggleOrder();setSort(\'match\');loadPlayers();">Matches</a></th><th class="center"><a href="#" onclick="toggleOrder();setSort(\'goal\');loadPlayers();">Goals</a></th></tr>';

                    for(i in data) {
                        html += '<tr>';
                        html += '<td><a href="<?php echo SITE_URL;?>player/' + data[i].id + '">' + data[i].firstName + ' ' + data[i].lastName + '</a></td>';
                        html += '<td class="center"><span class="badge">' + data[i].matches + '</span></td>'
                        html += '<td class="center"><span class="badge">' + data[i].goals + '</span></td>'
                        html += '</tr>';
                    }

                    $('#players').html(html);
                });
            }
        });
    });
}

$(document).ready(function(){
    loadPlayers();
});
</script>

<div class="container">

    <h2 id="title-events">Top Players</h2>

    <div id="loader" class="loader" style="position: fixed; top: 50%; left: 50%; display: none;"></div>

    <table id="players" class="table table-striped">

    </table>

</div>
