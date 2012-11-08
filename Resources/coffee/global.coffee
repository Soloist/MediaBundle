(($) ->

    window.soloist = {} if not window.fw?

    #
    #
    # Add events on media manager
    windowOptions = 'menubar=no,location=no,resizable=yes,scrollbars=yes,status=no,toolbar=no,width=800,height=600'
    newWindow     = null
    addMediaManagerEvents = window.soloist.addMediaManagerEvents = ->
        $('.soloist-media-add').click ->
            $(this).parent().parent().attr 'id', 'soloist-media-subject'
            newWindow = window.open $(this).attr('href'), 'Media manager', windowOptions
            return false

    removeImage = (e) ->
        e.preventDefault()

        $thumbnail = $(this).parents('.thumbnail:first')
        $thumbnail.find('input').each( ->
            $this = $(this)
            $this.val(null) if $this.attr('name').match(/\[title|path\]$/)
        )
        $thumbnail.find('[data-beahvior="image-display"]').attr('src', 'null')

    $ ->
        #
        #
        # Manage page blocks. Ajax.
        $container = $('#soloist-node-pagetype')
        $container.find('select').change ->
            $.ajax
                type: 'post'
                url:  $container.attr 'data-uri'
                data: $container.parents('form:first').serialize()
                success: (data) ->
                    $('#soloist-node-blocks').html(data)
                    window.fw.replaceTextareas()
                    addMediaManagerEvents()

        $('[data-behavior="remove-image"]').click(removeImage)

        #
        #
        # Manage Media manager
        addMediaManagerEvents()

)(jQuery)
