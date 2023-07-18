<script>

    $('#addDomain').on('click', function(e){
        e.preventDefault();
        let domain   = $('#domain').val()
        let keyWords = $('#keyWords').val()
        let language = $('#language').val()
        let country  = $('#country').val()

        keyWords = keyWords.split('\n')
        let parsedURL = new URL(domain);
        let hostname = parsedURL.hostname;
        let domain_name = hostname.replace(/^www\./i, '');


        if (domain.length == 0) {
            toast('Not a valid domain', 'center')
        } else if (keyWords.length == 0) {
            toast('Please enter atleast one key word', 'center')
        } else {
            $.ajax({
                url: "<?= base_url('Domain/add_domain')?>",
                type: "POST",
                data : {
                    "domain": domain,
                    "domain_name" : domain_name,
                    "keyWords": keyWords,
                    "language" : language,
                    "country" : country,
                },
                beforeSend: function(){
                    $('#addDomain').html(`<div class="spinner-border text-light" role="status"></div>`);
                },
                success : function(resp){
                    $('#addDomain').html(`ADD`);
                }
            })
        }

    })

</script>