<script>
    load_domain_table();

    function load_domain_table(){
        $.ajax({
            url: "<?=base_url('Rankings/get_all_domains')?>",
            type: "GET",
            beforeSend: function(){
                
            },
            success: function(resp){
                console.log(rsep)
            },
        })

    }

</script>