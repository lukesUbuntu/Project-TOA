<!-- <script>
            //global
            window.winWord = null;

            //set words
            $(document).ready(function () {
                $.getJSON('/api/words', function (wordList) {
                    console.log('wordList', wordList);

                    $.each(wordList.data, function (index, key) {
                        //console.log('id',index);
                        //console.log('words',key.mri_word);
                        window.winWord = key.mri_word;
                    });

                    console.log("window.winWord set to :", window.winWord);
                    //throw Error("testing")
                })
            });

</script> -->