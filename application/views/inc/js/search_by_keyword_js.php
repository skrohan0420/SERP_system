<script>

    $('#dataTableResultCon').hide()







    $('#serachDomain').on('click', function (e) {
        $('#table_result').html('')
        e.preventDefault();
        let domain = $('#domain').val()
        let keyWords = $('#keyWords').val()
        keyWords = keyWords.split('\n')

       


        let parsedURL = new URL(domain);
        let hostname = parsedURL.hostname;
        let domain_name = hostname.replace(/^www\./i, '');

        // console.log(domain_name)

        if (domain.length == 0) {
            toast('Not a valid domain', 'center')
        } else if (keyWords.length == 0) {
            toast('Please enter atleast one key word', 'center')
        } else {
            async function processKeywords(keyWords, domain) {
                try {
                    for (const [index, item] of keyWords.entries()) {
                        await new Promise((resolve, reject) => {
                            $.ajax({
                                url: "<?= base_url('Search/custom_search')?>",
                                type: "GET",
                                data: {
                                    "domain": domain,
                                    "keyWords": item.split(' ').join('%20'),
                                },
                                beforeSend: function () {
                                    $('#serachDomain').html(`<div class="spinner-border text-light" role="status"></div>`);
                                },
                                success: function (resp) {
                                    $('#serachDomain').html(`SEARCH`);
                                    let results = resp.items;
                                   
                                    let isInResults = false;
                                    $.each(results, function (index2, item2) {
                                        if (item2.formattedUrl.includes(domain)) {
                                            isInResults = !isInResults
                                            $('#dataTableResultCon').show()
                                            let output = `<tr>
                                                            <td>${item}</td>
                                                            <td align="center">${index2+1}</td>
                                                            </tr>`
                                            $('#table_result').append(output)
                                            $('#dataTableResult').DataTable();
                                            return false;
                                        }
                                    })  
                                    // if(!isInResults){
                                    //     let output = `<tr>
                                    //                     <td>${item}</td>
                                    //                     <td align="center">not found</td>
                                    //                     </tr>`
                                    //     $('#table_result').append(output)
                                    //     $('#dataTableResult').DataTable();
                                    //     return false;
                                    // }
                                    resolve(); // Resolve the promise when the AJAX call is successful.
                                },
                                error: function (xhr, status, error) {
                                    console.error("AJAX Error:", status, error);
                                    reject(); // Reject the promise if there is an error in the AJAX call.
                                }
                            });
                        });
                    }
                } catch (err) {
                    console.error("Error occurred:", err);
                }
            }
            processKeywords(keyWords, domain_name);
        }
    })







</script>