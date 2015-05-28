$(document).ready(function() {
    $('#all').attr('checked',true);
    $('[type=checkbox]').click(function() {
        var $val = $(this).attr('value');
        if ($val == 'all') {
            $('.new').show();
            $('.box').attr('checked',false);
        }
        if (!($val == 'all')) {
            $('#all').attr('checked', false);
            $('.new').hide();
            var values = $('input:checkbox:checked').map(function () {
                return this.value;
            }).get();
            for(var i = 0; i < values.length; i+=1) {
                var val = values[i];
                $('#' + val).show();
            }
        }
    });
}); 


