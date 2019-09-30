$(document).ready(function () {
    let $mainDiv = $('div.starter-template');

    $('body').on('click', 'div.starter-template a', function () {
        let $self = $(this);

        if ($self.hasClass('contact-delete') && !confirm('Вы точно хотите удалить контакт?')) {
            return  false;
        }

        if ($self.hasClass('photo-delete') && !confirm('Вы точно хотите удалить фото у контакта?')) {
            return  false;
        }

        $.get($self.attr('href'), {}, function (response) {
            $mainDiv.html(response);
        });

        return false;
    });

    $('body').on('submit', 'form', function (event) {
        let $self = $(this);
        
        if ($self.find('input').is('#file')) {
            let data = new FormData();
            data.append('file', document.getElementById('file').files[0]);

            $.ajax({
                url: $self.attr('action'),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "html",
                success: function (response) {
                    $mainDiv.html(response);
                }
            });
        } else {
            $.post($self.attr('action'), $self.serializeArray(), function (response) {
                $mainDiv.html(response);
            });
        }

        event.preventDefault();
        return false;
    })
});
