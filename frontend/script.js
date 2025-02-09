$(document).ready(function () {
    $('#cardForm').on('submit', function (e) {
        e.preventDefault();

        const people = $('#people').val();

        $.ajax({
            url: 'http://localhost:8787/index.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({people: people}),
            success: function (response) {
                const result = response;
                if (result.error) {
                    $('#output').text(result.error);
                } else {
                    $('#output').text(result.result);
                }
            },
            error: function (response) {
                console.log({response});
                $('#output').text('Irregularity occurred');
            }
        });
    });
});