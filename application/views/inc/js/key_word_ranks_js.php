<script>
    load_key_words_ranks();
    function load_key_words_ranks(){
        $.ajax({
            url: "<?=base_url('Rankings/get_key_word_rankings')?>",
            type: "GET",
            data: {
                "domain_id" : '<?= $domain_id ?>'
            },
            success: function(resp){
                if(resp.status){
                    if(resp.data.length > 0){
                        let output = ``
                        $.each(resp.data,function(index,item){
                            output += `<tr>
                                        <td>${item.key_word}</td>
                                        <td>--</td>
                                        <td>${item.current_rank.rank}</td>
                                        <td>--</td>
                                    </tr>`
                        })
                        $('#table_keywords').html(output)
                        $('#dataTableKeywords').DataTable();
                    }
                }
            }
        })
    }
</script>