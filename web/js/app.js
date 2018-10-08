$(function () {
    $('#btn').on('click', function () {
        event.preventDefault();
        $.ajax({
            url: 'index.php?r=post/index',
            data: { test: '123'},
            type: 'POST',
            success: function (res) {
                console.log(res)
            },
            error: function () {
                alert('Error')
            }
        })
        
    })
})