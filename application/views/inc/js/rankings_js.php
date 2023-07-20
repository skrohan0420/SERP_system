<script>
    load_domain_table();

    function load_domain_table(){

        $.ajax({
            url: "<?=base_url('Rankings/get_all_domains')?>",
            type: "GET",
            beforeSend: function(){
                
            },
            success: function(resp){
                console.log(resp)
                if(resp.status){
                    if(resp.data.length > 0){
                        let output = '';
                        $.each(resp.data , function(index, item){
                            output += `<tr>
                                        <td>${item.name}</td>
                                        <td>${item.url}</td>
                                        <td>${item.key_words}</td>
                                        <td>${item.language}</td>
                                        <td>${item.region}</td>
                                        <td>
                                            <a href="<?=base_url('rankings/keyword/')?>${item.uid}">
                                                <button class="btn btn-success sites_btn">VIEW</button>
                                            </a>
                                        </td>
                                    </tr>`
                        })
                        $('#table_result').html(output);
                    }
                }
            }
        })
    }

</script>